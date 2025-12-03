<?php

namespace App\Http\Controllers\Media;
use App\Http\Controllers\Controller;

use App\Models\Media;
use App\Models\Publicite;
use App\Models\VuePublicite;
use App\Models\ClicPublicite;
use App\Models\PaiementMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MediaController extends Controller
{
    public function dashboard()
    {
        $media = auth()->user()->media;        
        
        // Statistiques du mois en cours
        $debutMois = now()->startOfMonth();
        $finMois = now()->endOfMonth();

        $statsMois = [
            'vues' => $media->vues()->whereBetween('date_vue', [$debutMois, $finMois])->count(),
            'clics' => $media->clics()->whereBetween('date_clic', [$debutMois, $finMois])->count(),
            'revenu_estime' => ($media->vues()->whereBetween('date_vue', [$debutMois, $finMois])->count() * 0.001) + 
                              ($media->clics()->whereBetween('date_clic', [$debutMois, $finMois])->count() * 0.01)
        ];

        $statsMois['taux_conversion'] = $statsMois['vues'] > 0 ? 
            round(($statsMois['clics'] / $statsMois['vues']) * 100, 2) : 0;

        // Publicités actives
        $publicitesActives = $media->publicites()
            ->wherePivot('status', 'active')
            ->where('statut', 'validé')
            ->with('forfait')
            ->get();

        // Derniers paiements
        $derniersPaiements = $media->paiementsComplets()
            ->orderBy('date_paiement', 'desc')
            ->take(5)
            ->get();

        // Performances des 7 derniers jours
        $performances7Jours = $this->getPerformancesParPeriode($media, now()->subDays(7), now());

        return view('dashboard.pages.media.home', compact(
            'media',
            'statsMois',
            'publicitesActives',
            'derniersPaiements',
            'performances7Jours'
        ));
    }

    public function rapports(Request $request)
    {
        $media = auth()->user()->media;

        // if (!$media) {
        //     return back()->with('error', 'Aucun média trouvé.');
        // }

        // Période par défaut : 30 derniers jours
        $dateDebut = $request->filled('date_debut') ? $request->date_debut : now()->subDays(30)->format('Y-m-d');
        $dateFin = $request->filled('date_fin') ? $request->date_fin : now()->format('Y-m-d');

        // Statistiques globales pour la période
        $statsPeriode = $this->getPerformancesParPeriode($media, $dateDebut, $dateFin);

        // Performances par publicité
        $performancesPublicites = $media->publicites()
            ->with('forfait')
            ->withCount([
                'vues as vues_periode' => function ($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('date_vue', [$dateDebut, $dateFin]);
                },
                'clics as clics_periode' => function ($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('date_clic', [$dateDebut, $dateFin]);
                }
            ])
            ->get()
            ->map(function ($publicite) {
                $publicite->revenu_estime = ($publicite->vues_periode * 0.001) + ($publicite->clics_periode * 0.01);
                $publicite->taux_conversion = $publicite->vues_periode > 0 ? 
                    round(($publicite->clics_periode / $publicite->vues_periode) * 100, 2) : 0;
                return $publicite;
            });

        // Données pour graphiques (évolution sur la période)
        $evolutionData = $this->getEvolutionData($media, $dateDebut, $dateFin);

        // Analyse de fraude
        $analyseFraude = $media->analyserFraudeAvancee();

        return view('dashboard.pages.media.rapport', compact(
            'media',
            'statsPeriode',
            'performancesPublicites',
            'evolutionData',
            'analyseFraude',
            'dateDebut',
            'dateFin'
        ));
    }

    public function rapportDetail(Publicite $publicite)
    {
        $media = auth()->user()->media;

        // Vérifier que la publicité appartient bien au média
        if (!$media->publicites()->where('publicite_id', $publicite->id)->exists()) {
            return back()->with('error', 'Publicité non trouvée.');
        }

        // Statistiques détaillées de la publicité
        $statsPublicite = [
            'vues_total' => $publicite->vues()->where('media_id', $media->id)->count(),
            'clics_total' => $publicite->clics()->where('media_id', $media->id)->count(),
            'revenu_total' => ($publicite->vues()->where('media_id', $media->id)->count() * 0.001) + 
                             ($publicite->clics()->where('media_id', $media->id)->count() * 0.01)
        ];

        $statsPublicite['taux_conversion'] = $statsPublicite['vues_total'] > 0 ? 
            round(($statsPublicite['clics_total'] / $statsPublicite['vues_total']) * 100, 2) : 0;

        // Top pages référentes
        $topReferers = $publicite->vues()
            ->where('media_id', $media->id)
            ->select('referer', DB::raw('COUNT(*) as count'))
            ->groupBy('referer')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        // Géolocalisation des vues (par IP)
        $geolocalisation = $publicite->vues()
            ->where('media_id', $media->id)
            ->select('visiteur_ip', DB::raw('COUNT(*) as count'))
            ->groupBy('visiteur_ip')
            ->orderBy('count', 'desc')
            ->take(15)
            ->get();

        return view('dashboard.pages.media.rapport-detail', compact(
            'publicite',
            'media',
            'statsPublicite',
            'topReferers',
            'geolocalisation'
        ));
    }

    public function apiStatistiques(Request $request)
    {
       $media = auth()->user()->media;

        $periode = $request->get('periode', '7jours'); // 7jours, 30jours, 3mois

        switch ($periode) {
            case '30jours':
                $dateDebut = now()->subDays(30);
                $dateFin = now();
                $groupBy = 'day';
                break;
            case '3mois':
                $dateDebut = now()->subMonths(3);
                $dateFin = now();
                $groupBy = 'week';
                break;
            default:
                $dateDebut = now()->subDays(7);
                $dateFin = now();
                $groupBy = 'day';
        }

        $data = $this->getDataForChart($media, $dateDebut, $dateFin, $groupBy);

        return response()->json($data);
    }

    private function getPerformancesParPeriode($media, $dateDebut, $dateFin)
    {
        $vues = $media->vues()->whereBetween('date_vue', [$dateDebut, $dateFin])->count();
        $clics = $media->clics()->whereBetween('date_clic', [$dateDebut, $dateFin])->count();
        $revenu = ($vues * 0.001) + ($clics * 0.01);
        $tauxConversion = $vues > 0 ? round(($clics / $vues) * 100, 2) : 0;

        return [
            'vues' => $vues,
            'clics' => $clics,
            'revenu' => $revenu,
            'taux_conversion' => $tauxConversion,
            'vues_jour' => $vues > 0 ? round($vues / max(1, Carbon::parse($dateDebut)->diffInDays($dateFin)), 2) : 0,
            'clics_jour' => $clics > 0 ? round($clics / max(1, Carbon::parse($dateDebut)->diffInDays($dateFin)), 2) : 0,
        ];
    }

    private function getEvolutionData($media, $dateDebut, $dateFin)
    {
        $jours = Carbon::parse($dateDebut)->diffInDays($dateFin);
        $data = [];

        for ($i = 0; $i <= $jours; $i++) {
            $date = Carbon::parse($dateDebut)->addDays($i)->format('Y-m-d');
            
            $vues = $media->vues()->whereDate('date_vue', $date)->count();
            $clics = $media->clics()->whereDate('date_clic', $date)->count();
            
            $data[] = [
                'date' => $date,
                'vues' => $vues,
                'clics' => $clics,
                'revenu' => ($vues * 0.001) + ($clics * 0.01)
            ];
        }

        return $data;
    }

    private function getDataForChart($media, $dateDebut, $dateFin, $groupBy = 'day')
    {
        $queryVues = $media->vues()
            ->whereBetween('date_vue', [$dateDebut, $dateFin])
            ->select(
                DB::raw('DATE(date_vue) as date'),
                DB::raw('COUNT(*) as vues')
            )
            ->groupBy('date')
            ->orderBy('date');

        $queryClics = $media->clics()
            ->whereBetween('date_clic', [$dateDebut, $dateFin])
            ->select(
                DB::raw('DATE(date_clic) as date'),
                DB::raw('COUNT(*) as clics')
            )
            ->groupBy('date')
            ->orderBy('date');

        $vuesData = $queryVues->get()->keyBy('date');
        $clicsData = $queryClics->get()->keyBy('date');

        $labels = [];
        $vues = [];
        $clics = [];
        $revenus = [];

        $currentDate = Carbon::parse($dateDebut);
        while ($currentDate <= $dateFin) {
            $dateStr = $currentDate->format('Y-m-d');
            $label = $groupBy === 'day' ? $currentDate->format('d/m') : 'Sem ' . $currentDate->weekOfYear;
            
            $vuesCount = $vuesData->get($dateStr)->vues ?? 0;
            $clicsCount = $clicsData->get($dateStr)->clics ?? 0;
            $revenu = ($vuesCount * 0.001) + ($clicsCount * 0.01);

            $labels[] = $label;
            $vues[] = $vuesCount;
            $clics[] = $clicsCount;
            $revenus[] = $revenu;

            $currentDate->addDay();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Vues',
                    'data' => $vues,
                    'borderColor' => '#3498db',
                    'backgroundColor' => 'rgba(52, 152, 219, 0.1)',
                ],
                [
                    'label' => 'Clics',
                    'data' => $clics,
                    'borderColor' => '#2ecc71',
                    'backgroundColor' => 'rgba(46, 204, 113, 0.1)',
                ],
                [
                    'label' => 'Revenu (FCFA)',
                    'data' => $revenus,
                    'borderColor' => '#f39c12',
                    'backgroundColor' => 'rgba(243, 156, 18, 0.1)',
                    'yAxisID' => 'y1'
                ]
            ]
        ];
    }
}