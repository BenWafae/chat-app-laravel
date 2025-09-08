<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            Bienvenue, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-sm text-gray-600">
                            Vous êtes connecté en tant qu'utilisateur. Vous pouvez maintenant accéder au chat.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-blue-800 mb-2">
                                💬 Chat
                            </h4>
                            <p class="text-sm text-blue-700 mb-3">
                                Communiquez avec les autres utilisateurs de la plateforme
                            </p>
                <a href="{{ route('user.chat.index') }}" 
   class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest 
          hover:bg-gray-800 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
    Accéder au Chat
</a>


                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-green-800 mb-2">
                                👤 Profil
                            </h4>
                            <p class="text-sm text-green-700 mb-3">
                                Gérez vos informations personnelles
                            </p>
                            <a href="{{ route('profile.edit') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Modifier le Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
