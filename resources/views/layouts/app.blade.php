<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
       
          <meta name="user-id" content="{{ auth()->id() }}">

        <!-- Updated title for chat site -->
        <title>{{ config('app.name', 'ChatConnect') }} - Plateforme de Chat en Temps Réel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Added Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            'chat-primary': '#6366f1',
                            'chat-secondary': '#8b5cf6',
                            'chat-accent': '#06b6d4',
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Added chat-specific meta tags -->
        <meta name="description" content="Plateforme de chat moderne et sécurisée pour communiquer en temps réel">
        <meta name="keywords" content="chat, messagerie, communication, temps réel">
    </head>
    <!-- Updated body with chat-themed styling -->
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-slate-900">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Updated header with chat styling -->
            @if (isset($header))
                <header class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 shadow-lg border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-chat-primary to-chat-secondary rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative">
                {{ $slot }}
            </main>

            <!-- Added chat-themed footer -->
            <footer class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border-t border-gray-200 dark:border-gray-700 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-gradient-to-r from-chat-primary to-chat-secondary rounded-md flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">ChatConnect</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            © {{ date('Y') }} ChatConnect. Plateforme de chat sécurisée.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Added chat notification system -->
        <div id="chat-notifications" class="fixed top-4 right-4 z-50 space-y-2"></div>
    </body>
</html>
