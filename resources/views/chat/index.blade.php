{{-- resources/views/user/chat/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="chat-gradient text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            <h1 class="text-2xl font-bold">Chat</h1>
                        </div>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 rounded-full transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour au Dashboard
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        .chat-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .user-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .user-card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .online-indicator {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(0, 168, 132, 0.1);
        }

        .avatar-gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .avatar-gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .avatar-gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .avatar-gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .avatar-gradient-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .avatar-gradient-6 { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
        .avatar-gradient-7 { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }
        .avatar-gradient-8 { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); }
    </style>

    <div class="max-w-7xl mx-auto h-screen flex bg-gray-100">
        <!-- Sidebar avec liste des utilisateurs -->
        <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
            <!-- Search bar -->
            <div class="p-4 border-b border-gray-100">
                <div class="relative">
                    <input type="text" 
                           id="search-users"
                           placeholder="Rechercher un utilisateur..." 
                           class="search-input w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Header de la liste -->
            <div class="p-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.5 8H16c-.8 0-1.5.7-1.5 1.5v3c0 1.1.9 2 2 2h2v3h-2.5c-.28 0-.5.22-.5.5s.22.5.5.5H20c.28 0 .5-.22.5-.5s-.22-.5-.5-.5zm-8.5-4.5c0-.8-.7-1.5-1.5-1.5s-1.5.7-1.5 1.5.7 1.5 1.5 1.5 1.5-.7 1.5-1.5zM7 18c.28 0 .5-.22.5-.5s-.22-.5-.5-.5H4.5v-3h2c1.1 0 2-.9 2-2v-3C8.5 8.7 7.8 8 7 8H4.5A1.5 1.5 0 0 0 3 9.5V17c0 .8.7 1.5 1.5 1.5H7z"/>
                    </svg>
                    Utilisateurs disponibles
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $users->count() }}</span>
                </h3>
            </div>

            <!-- Liste des utilisateurs -->
            <div class="flex-1 overflow-y-auto" id="users-list">
                @if($users->count() > 0)
                    @foreach($users as $index => $user)
                        <div class="user-card-hover p-4 border-b border-gray-50 cursor-pointer hover:bg-gray-50 user-item" 
                             data-name="{{ strtolower($user->name) }}" 
                             data-email="{{ strtolower($user->email) }}"
                             onclick="window.location='{{ route('user.chat.show', $user) }}'">
                            <div class="flex items-center">
                                <div class="relative">
                                    <div class="w-12 h-12 avatar-gradient-{{ ($index % 8) + 1 }} rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <!-- Indicateur de statut (vous pouvez ajouter la logique de statut plus tard) -->
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-gray-400 rounded-full border-2 border-white status-indicator" data-user-id="{{ $user->id }}"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-semibold text-gray-900">{{ $user->name }}</h4>
                                        <span class="text-xs text-gray-500 last-seen" data-user-id="{{ $user->id }}">
                                            @if($user->updated_at->diffInMinutes() < 5)
                                                En ligne
                                            @elseif($user->updated_at->diffInMinutes() < 60)
                                                Il y a {{ $user->updated_at->diffInMinutes() }}min
                                            @elseif($user->updated_at->diffInHours() < 24)
                                                Il y a {{ $user->updated_at->diffInHours() }}h
                                            @else
                                                {{ $user->updated_at->diffForHumans() }}
                                            @endif
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                                    <div class="flex items-center mt-1">
                                        <div class="w-2 h-2 bg-gray-400 rounded-full mr-2 status-dot" data-user-id="{{ $user->id }}"></div>
                                        <span class="text-xs text-gray-500 status-text" data-user-id="{{ $user->id }}">
                                            @if($user->updated_at->diffInMinutes() < 5)
                                                Actif maintenant
                                            @elseif($user->updated_at->diffInMinutes() < 30)
                                                Récemment actif
                                            @else
                                                Hors ligne
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex-1 flex items-center justify-center p-8">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.5 8H16c-.8 0-1.5.7-1.5 1.5v3c0 1.1.9 2 2 2h2v3h-2.5c-.28 0-.5.22-.5.5s.22.5.5.5H20c.28 0 .5-.22.5-.5s-.22-.5-.5-.5zm-8.5-4.5c0-.8-.7-1.5-1.5-1.5s-1.5.7-1.5 1.5.7 1.5 1.5 1.5 1.5-.7 1.5-1.5zM7 18c.28 0 .5-.22.5-.5s-.22-.5-.5-.5H4.5v-3h2c1.1 0 2-.9 2-2v-3C8.5 8.7 7.8 8 7 8H4.5A1.5 1.5 0 0 0 3 9.5V17c0 .8.7 1.5 1.5 1.5H7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun utilisateur disponible</h3>
                            <p class="text-gray-600">Il n'y a actuellement aucun autre utilisateur avec qui chatter.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Zone de chat principale -->
        <div class="flex-1 flex flex-col bg-gray-50">
            <!-- Placeholder quand aucune conversation n'est sélectionnée -->
            <div class="flex-1 flex items-center justify-center">
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue {{ Auth::user()->name }}</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                        Sélectionnez un utilisateur dans la liste de gauche pour commencer une conversation
                    </p>
                    <div class="flex items-center justify-center space-x-8 text-gray-400">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <span class="text-sm">Messages sécurisés</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm">Interface moderne</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                </svg>
                            </div>
                            <span class="text-sm">Temps réel</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction de recherche d'utilisateurs
            const searchInput = document.getElementById('search-users');
            const userItems = document.querySelectorAll('.user-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                userItems.forEach(item => {
                    const name = item.dataset.name;
                    const email = item.dataset.email;
                    
                    if (name.includes(searchTerm) || email.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // Fonction pour mettre à jour le statut des utilisateurs (à implémenter plus tard avec WebSocket)
            function updateUserStatus() {
                // Cette fonction sera utilisée plus tard avec les WebSockets
                // pour mettre à jour le statut en temps réel
                console.log('Mise à jour du statut des utilisateurs...');
                
                // Exemple de logique de mise à jour de statut
                document.querySelectorAll('.status-indicator').forEach(indicator => {
                    const userId = indicator.dataset.userId;
                    // Ici vous pourrez ajouter la logique de vérification du statut via API
                });
            }

            // Mettre à jour le statut toutes les 30 secondes
            setInterval(updateUserStatus, 30000);

            // Animation d'entrée pour les cartes utilisateur
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            });

            userItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'all 0.3s ease-out';
                observer.observe(item);
            });
        });
    </script>
</x-app-layout>