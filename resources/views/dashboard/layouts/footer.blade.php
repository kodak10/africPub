<div class="bg-card px-lg py-md d-flex justify-content-between align-items-center flex-wrap shadow-6dp">
    <p class="text-muted m-0">
        Tous droits réservés &copy; 
        {{ env('APP_NAME') }} 
        {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('YYYY') }}
    </p>
</div>
