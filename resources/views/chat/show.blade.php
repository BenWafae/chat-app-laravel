{{-- resources/views/user/chat/show.blade.php --}}
<x-app-layout>
    <style>
        .chat-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .message-bubble {
            max-width: 70%;
            word-wrap: break-word;
            animation: fadeInUp 0.3s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .typing-indicator {
            display: none;
            align-items: center;
            padding: 10px 15px;
            background: #f1f1f1;
            border-radius: 20px;
            margin: 5px 0;
            max-width: 80px;
        }
        
        .typing-dots {
            display: flex;
            align-items: center;
            height: 17px;
        }
        
        .typing-dots span {
            height: 5px;
            width: 5px;
            background: #999;
            border-radius: 50%;
            display: inline-block;
            margin-right: 3px;
            animation: wave 1.3s linear infinite;
        }
        
        .typing-dots span:nth-child(2) { animation-delay: -1.1s; }
        .typing-dots span:nth-child(3) { animation-delay: -0.9s; }
        
        @keyframes wave {
            0%, 60%, 100% { transform: initial; }
            30% { transform: translateY(-10px); }
        }
        
        .chat-container {
            height: calc(100vh - 140px);
        }
        
        .messages-area {
            height: calc(100% - 80px);
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.15) 0%, transparent 50%);
            background-attachment: fixed;
        }
        
        .online-indicator {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        
        .send-button {
            transition: all 0.2s ease-in-out;
        }
        
        .send-button:hover {
            transform: scale(1.05);
        }
        
        .send-button:active {
            transform: scale(0.95);
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

    <!-- Header avec info de l'utilisateur -->
    <div class="chat-gradient text-black shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('user.chat.index') }}" class="mr-4 text-black hover:text-gray-200 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    
                    <div class="flex items-center">
                        <div class="relative mr-3">
                            <div class="w-10 h-10 avatar-gradient-{{ $user->id % 8 + 1 }} rounded-full flex items-center justify-center text-black font-bold shadow-lg">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white online-indicator" id="user-status-{{ $user->id }}"></div>
                        </div>
                        
                        <div>
                            <h2 class="font-bold text-xl">{{ $user->name }}</h2>
                            <p class="text-sm text-white/80" id="user-last-seen">
                                @if($user->updated_at->diffInMinutes() < 5)
                                    En ligne
                                @else
                                    Vu {{ $user->updated_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button class="p-2 hover:bg-white/10 rounded-full transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </button>
                    <button class="p-2 hover:bg-white/10 rounded-full transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                    <button class="p-2 hover:bg-white/10 rounded-full transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Container principal du chat -->
    <div class="chat-container flex flex-col bg-gray-100">
        <!-- Zone des messages -->
        <div class="messages-area flex-1 overflow-y-auto p-4" id="messages-container">
            <div id="messages" class="space-y-3">
                @forelse($messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        @if($message->user_id != Auth::id())
                            <div class="flex items-end space-x-2">
                                <div class="w-8 h-8 avatar-gradient-{{ $user->id % 8 + 1 }} rounded-full flex items-center justify-center text-black font-bold text-sm flex-shrink-0">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="message-bubble bg-white rounded-2xl rounded-bl-md px-4 py-3 shadow-sm border">
                                    <p class="text-black-800 text-sm">{{ $message->message }}</p>
                                    <p class="text-xs text-black-500 mt-1">{{ $message->created_at->format('H:i') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="message-bubble bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl rounded-br-md px-4 py-3 text-white shadow-lg">
                                <p class="text-sm">{{ $message->message }}</p>
                                <div class="flex items-center justify-end mt-1 space-x-1">
                                    <p class="text-xs text-black-100">{{ $message->created_at->format('H:i') }}</p>
                                    <svg class="w-3 h-3 text-black-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-800 mb-2">Nouvelle conversation</h3>
                        <p class="text-gray-600">Envoyez le premier message à {{ $user->name }} !</p>
                    </div>
                @endforelse
            </div>

            <!-- Indicateur de frappe -->
            <div class="typing-indicator" id="typing-indicator">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 avatar-gradient-{{ $user->id % 8 + 1 }} rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="bg-white rounded-2xl rounded-bl-md px-4 py-3 shadow-sm border">
                        <div class="typing-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone de saisie -->
        <div class="bg-white border-t border-gray-200 p-4">
            <form id="message-form" class="flex items-end space-x-3">
                @csrf
                <div class="flex items-center space-x-2">
                    <button type="button" class="p-2 text-gray-500 hover:text-blue-600 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                    </button>
                    <button type="button" class="p-2 text-gray-500 hover:text-blue-600 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
                
                <div class="flex-1 relative">
                    <textarea 
                        id="message-input" 
                        name="message" 
                        placeholder="Tapez votre message..." 
                        rows="1"
                        class="w-full resize-none border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-full px-4 py-3 pr-12 text-gray-800 placeholder-gray-500 shadow-sm"
                        style="min-height: 44px; max-height: 120px;"
                        required></textarea>
                    
                    <button type="button" class="absolute right-3 top-3 p-1 text-gray-400 hover:text-blue-600 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>
                
                <button 
                    type="submit" 
                    id="send-button"
                    class="send-button p-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-black rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const messagesContainer = document.getElementById('messages-container');
            const messages = document.getElementById('messages');
            const sendButton = document.getElementById('send-button');
            const typingIndicator = document.getElementById('typing-indicator');
            const userId = {{ $user->id }};
            const currentUserId = {{ Auth::id() }};

            // Auto-resize du textarea
            messageInput.addEventListener('input', function() {
                this.style.height = '44px';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            // Fonction pour faire défiler vers le bas
            function scrollToBottom(smooth = true) {
                const behavior = smooth ? 'smooth' : 'instant';
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            // Faire défiler vers le bas au chargement
            scrollToBottom(false);

            // Fonction pour ajouter un message à l'interface
            function addMessageToUI(message, isOwn = false, animate = true) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `flex ${isOwn ? 'justify-end' : 'justify-start'}`;
                
                if (animate) {
                    messageDiv.style.opacity = '0';
                    messageDiv.style.transform = 'translateY(10px)';
                }

                const now = new Date();
                const timeString = now.toLocaleTimeString('fr-FR', { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });

                if (isOwn) {
                    messageDiv.innerHTML = `
                        <div class="message-bubble bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl rounded-br-md px-4 py-3 text-white shadow-lg">
                            <p class="text-sm">${message}</p>
                            <div class="flex items-center justify-end mt-1 space-x-1">
                                <p class="text-xs text-blue-100">${timeString}</p>
                                <svg class="w-3 h-3 text-blue-100" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    `;
                } else {
                    messageDiv.innerHTML = `
                        <div class="flex items-end space-x-2">
                            <div class="w-8 h-8 avatar-gradient-${userId % 8 + 1} rounded-full flex items-center justify-center text-black font-bold text-sm flex-shrink-0">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="message-bubble bg-white rounded-2xl rounded-bl-md px-4 py-3 shadow-sm border">
                                <p class="text-black-800 text-sm">${message}</p>
                                <p class="text-xs text-black-500 mt-1">${timeString}</p>
                            </div>
                        </div>
                    `;
                }

                messages.appendChild(messageDiv);

                if (animate) {
                    setTimeout(() => {
                        messageDiv.style.transition = 'all 0.3s ease-out';
                        messageDiv.style.opacity = '1';
                        messageDiv.style.transform = 'translateY(0)';
                    }, 10);
                }

                scrollToBottom();
            }

            // Fonction pour afficher l'indicateur de frappe
            function showTypingIndicator() {
                typingIndicator.style.display = 'flex';
                scrollToBottom();
            }

            // Fonction pour masquer l'indicateur de frappe
            function hideTypingIndicator() {
                typingIndicator.style.display = 'none';
            }

            // Envoi de message
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const message = messageInput.value.trim();
                if (!message) return;

                // Désactiver le formulaire pendant l'envoi
                messageInput.disabled = true;
                sendButton.disabled = true;
                sendButton.innerHTML = `
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;

                // Ajouter le message immédiatement à l'interface
                addMessageToUI(message, true);
                messageInput.value = '';
                messageInput.style.height = '44px';

                // Envoyer le message au serveur
                fetch(`/user/chat/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.message || 'Erreur lors de l\'envoi du message');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors de l\'envoi du message: ' + error.message);
                })
                .finally(() => {
                    // Réactiver le formulaire
                    messageInput.disabled = false;
                    sendButton.disabled = false;
                    sendButton.innerHTML = `
                        <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    `;
                    messageInput.focus();
                });
            });

            // Gestion de la touche Entrée
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    messageForm.dispatchEvent(new Event('submit'));
                }
            });

            // Fonction pour charger les nouveaux messages
            function loadMessages() {
                fetch(`/user/messages/${userId}`)
                    .then(response => response.json())
                    .then(messagesData => {
                        const currentMessages = messages.children.length;
                        
                        if (messagesData.length === 0 && currentMessages === 0) {
                            messages.innerHTML = `
                                <div class="text-center py-12">
                                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-2">Nouvelle conversation</h3>
                                    <p class="text-gray-600">Envoyez le premier message à {{ $user->name }} !</p>
                                </div>
                            `;
                            return;
                        }

                        // Si de nouveaux messages sont disponibles
                        if (messagesData.length > currentMessages) {
                            // Ajouter uniquement les nouveaux messages
                            const newMessages = messagesData.slice(currentMessages);
                            newMessages.forEach(message => {
                                const isOwn = message.user_id == currentUserId;
                                addMessageToUI(message.message, isOwn, true);
                            });
                        }
                    })
                    .catch(error => console.error('Erreur lors du chargement des messages:', error));
            }

            // Actualiser les messages toutes les 2 secondes
            setInterval(loadMessages, 2000);

            // Simulation d'indicateur de frappe (à remplacer par WebSocket plus tard)
            let typingTimer;
            messageInput.addEventListener('input', function() {
                // Ici vous pourrez envoyer un signal de frappe via WebSocket
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    // Signal d'arrêt de frappe
                }, 1000);
            });
        });
    </script>
</x-app-layout>