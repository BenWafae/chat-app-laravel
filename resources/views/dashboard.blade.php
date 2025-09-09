<x-app-layout>
    <x-slot name="header">
       
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                💬 Tableau de Bord Chat
            </h2>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-sm text-gray-600 dark:text-gray-300">En ligne</span>
            </div>
        </div>
    </x-slot>

    
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="px-8 py-12 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">
                                Salut {{ Auth::user()->name }}! 👋
                            </h1>
                            <p class="text-blue-100 text-lg">
                                Bienvenue sur votre espace de discussion personnel
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Live Chat Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Actif</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                            Chat en Direct
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Commencez une nouvelle conversation ou continuez vos discussions
                        </p>
                        <a href="{{ route('user.chat.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500 text-white font-semibold rounded-lg hover:from-blue-500 hover:to-green-500 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Commencer à Chatter
                        </a>
                    </div>
                </div>

                <!-- Profile Management Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Personnel</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                            Mon Profil
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Gérez vos informations personnelles et préférences
                        </p>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-purple-500 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier le Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Corrected Real-time Statistics using only Message model -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    📊 Vos Statistiques
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            {{ \App\Models\Message::where('user_id', Auth::id())->count() }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">Messages envoyés</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                            {{ \App\Models\Message::where('user_id', Auth::id())->whereDate('created_at', today())->count() }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">Messages aujourd'hui</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            {{ \App\Models\Message::where('user_id', Auth::id())->whereDate('created_at', '>=', now()->subDays(7))->count() }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">Cette semaine</div>
                    </div>
                    <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">
                            {{ \App\Models\Message::distinct('receiver_id')->where('user_id', Auth::id())->count('receiver_id') ?? 0 }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">Personnes contactées</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
