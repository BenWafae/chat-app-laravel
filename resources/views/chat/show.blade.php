{{-- chow.blade c la fenetre de conversation entre deux utilisateurs --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('user.chat.index') }}" class="mr-4 text-blue-600 hover:text-blue-800">
                    ← Retour
                </a>
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-black font-semibold mr-3">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Chat avec {{ $user->name }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Zone des messages -->
                <div class="h-96 overflow-y-auto p-6 bg-gray-50" id="messages-container">
                    <div id="messages">
                        @forelse($messages as $message)
                            <div class="mb-4 {{ $message->user_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-white text-gray-900 border' }}">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <p class="text-xs mt-1 {{ $message->user_id == Auth::id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-black-500 py-8">
                                <p>Aucun message encore. Commencez la conversation !</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Formulaire d'envoi -->
                <div class="p-6 border-t bg-white">
                    <form id="message-form" class="flex space-x-4">
                        @csrf
                        <input type="text" 
                               id="message-input" 
                               name="message" 
                               placeholder="Tapez votre message..." 
                               class="flex-1 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                               required>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-black font-medium rounded-md transition duration-200">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const messagesContainer = document.getElementById('messages');
            const userId = {{ $user->id }};

            // Fonction pour faire défiler vers le bas
            function scrollToBottom() {
                const container = document.getElementById('messages-container');
                container.scrollTop = container.scrollHeight;
            }

            // Faire défiler vers le bas au chargement
            scrollToBottom();

            // Envoi de message
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const message = messageInput.value.trim();
                if (!message) return;

                // Désactiver le formulaire temporairement
                messageInput.disabled = true;
                messageForm.querySelector('button').disabled = true;

                fetch(`/user/chat/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Ajouter le message à l'interface
                        const messageDiv = document.createElement('div');
                        messageDiv.className = 'mb-4 text-right';
                        messageDiv.innerHTML = `
                            <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-blue-500 text-black">
                                <p class="text-sm">${message}</p>
                                <p class="text-xs mt-1 text-blue-100">À l'instant</p>
                            </div>
                        `;
                        messagesContainer.appendChild(messageDiv);
                        
                        // Vider le champ de saisie
                        messageInput.value = '';
                        
                        // Faire défiler vers le bas
                        scrollToBottom();
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors de l\'envoi du message');
                })
                .finally(() => {
                    // Réactiver le formulaire
                    messageInput.disabled = false;
                    messageForm.querySelector('button').disabled = false;
                    messageInput.focus();
                });
            });

            // Actualiser les messages périodiquement
            function loadMessages() {
                fetch(`/user/messages/${userId}`)
                    .then(response => response.json())
                    .then(messages => {
                        messagesContainer.innerHTML = '';
                        
                        if (messages.length === 0) {
                            messagesContainer.innerHTML = `
                                <div class="text-center text-black-500 py-8">
                                    <p>Aucun message encore. Commencez la conversation !</p>
                                </div>
                            `;
                            return;
                        }

                        messages.forEach(message => {
                            const isOwn = message.user_id == {{ Auth::id() }};
                            const messageDiv = document.createElement('div');
                            messageDiv.className = `mb-4 ${isOwn ? 'text-right' : 'text-left'}`;
                            
                            const date = new Date(message.created_at);
                            const timeString = date.toLocaleTimeString('fr-FR', { 
                                hour: '2-digit', 
                                minute: '2-digit' 
                            });
                            
                            messageDiv.innerHTML = `
                                <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                                    isOwn ? 'bg-blue-500 text-black' : 'bg-white text-gray-900 border'
                                }">
                                    <p class="text-sm">${message.message}</p>
                                    <p class="text-xs mt-1 ${
                                        isOwn ? 'text-blue-100' : 'text-gray-500'
                                    }">${timeString}</p>
                                </div>
                            `;
                            messagesContainer.appendChild(messageDiv);
                        });
                        
                        scrollToBottom();
                    })
                    .catch(error => console.error('Erreur lors du chargement des messages:', error));
            }

            // Actualiser les messages toutes les 3 secondes
            setInterval(loadMessages, 3000);
        });
    </script>
</x-app-layout>