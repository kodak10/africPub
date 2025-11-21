<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Publicite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class MediaController extends Controller
{
    public function index(Request $request)
{
    $statut = $request->statut; // validé, suspendu, etc.

    // Charger les médias avec leur relation publicites
    $medias = Media::query()
        ->when($statut, function ($q) use ($statut) {
            return $q->where('statut', $statut);
        })
        ->with(['user', 'publicites' => function($q) {
            $q->wherePivot('status', 'active'); // Ne prendre que les pubs actives
        }])
        ->orderByDesc('id')
        ->get();

    // Nombre total de pubs actives (optionnel, global)
    $activePubsCount = Publicite::where('statut', 'active')->count();

    return view('dashboard.pages.admin.medias.index', compact('medias', 'activePubsCount', 'statut'));
}



  public function toggleStatus($id, $action)
{
    $media = Media::findOrFail($id);

    if ($action === 'validate') {
        $media->statut = 'validé';
        $media->save();
        session()->flash('success', 'Média validé avec succès !');
    } elseif ($action === 'suspend') {
        $media->statut = 'suspendu';
        $media->save();
        session()->flash('success', 'Média suspendu !');
    } else {
        session()->flash('error', 'Action inconnue');
    }

    return redirect()->route('admin.medias.index');
}


    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json(['message' => 'Média supprimé avec succès !']);
    }
}
