@extends('home.layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Créez votre compte
            </h2>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="media-tab" data-tabs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">Média</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="annonceur-tab" data-tabs-target="#annonceur" type="button" role="tab" aria-controls="annonceur" aria-selected="false">Annonceur</button>
                </li>
            </ul>
        </div>

        <div id="myTabContent">
            <!-- Formulaire Média -->
            <div class="hidden p-4 rounded-lg bg-gray-50" id="media" role="tabpanel" aria-labelledby="media-tab">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_type" value="media">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du média *</label>
                            <input type="text" name="name" id="name" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="url_site" class="block text-sm font-medium text-gray-700">URL du site *</label>
                            <input type="url" name="url_site" id="url_site" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('url_site') }}">
                        </div>

                        <div>
                            <label for="numero_rccm" class="block text-sm font-medium text-gray-700">Numéro RCCM *</label>
                            <input type="text" name="numero_rccm" id="numero_rccm" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('numero_rccm') }}">
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                            <input type="tel" name="telephone" id="telephone" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('telephone') }}">
                        </div>

                        <div class="md:col-span-2">
                            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse *</label>
                            <input type="text" name="adresse" id="adresse" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('adresse') }}">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
                            <input type="password" name="password" id="password" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            S'inscrire en tant que Média
                        </button>
                    </div>
                </form>
            </div>

            <!-- Formulaire Annonceur -->
            <div class="hidden p-4 rounded-lg bg-gray-50" id="annonceur" role="tabpanel" aria-labelledby="annonceur-tab">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_type" value="annonceur">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'annonceur *</label>
                            <input type="text" name="name" id="name" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="email_annonceur" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email_annonceur" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="telephone_annonceur" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="tel" name="telephone_annonceur" id="telephone_annonceur" 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('telephone_annonceur') }}">
                        </div>

                        <div class="md:col-span-2">
                            <label for="adresse_annonceur" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="adresse_annonceur" id="adresse_annonceur" 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                   value="{{ old('adresse_annonceur') }}">
                        </div>

                        <div>
                            <label for="password_annonceur" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
                            <input type="password" name="password" id="password_annonceur" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="password_confirmation_annonceur" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation_annonceur" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            S'inscrire en tant qu'Annonceur
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                Déjà un compte ? Connectez-vous
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('[data-tabs-toggle]');
    const tabContents = document.querySelectorAll('#myTabContent > div');
    
    function activateTab(tabId) {
        // Désactiver tous les tabs
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Activer le tab sélectionné
        const activeContent = document.querySelector(tabId);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
        
        // Mettre à jour les styles des boutons
        const tabButtons = document.querySelectorAll('[role="tab"]');
        tabButtons.forEach(button => {
            button.classList.remove('border-indigo-600', 'text-indigo-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });
        
        const activeButton = document.querySelector(`[data-tabs-target="${tabId}"]`);
        if (activeButton) {
            activeButton.classList.remove('border-transparent', 'text-gray-500');
            activeButton.classList.add('border-indigo-600', 'text-indigo-600');
        }
    }
    
    // Activer le premier tab par défaut
    activateTab('#media');
    
    // Gérer les clics sur les tabs
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            const target = e.target.getAttribute('data-tabs-target');
            activateTab(target);
        });
    });
});
</script>
@endsection