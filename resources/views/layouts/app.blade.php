<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Vitalia') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <style>
            .flash-message {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 16px 24px;
                border-radius: 8px;
                font-weight: 600;
                z-index: 9999;
                animation: slideIn 0.3s ease-in-out, slideOut 0.5s ease-in-out 3.5s forwards;
            }
            .flash-success {
                background-color: #10b981;
                color: white;
            }
            .flash-error {
                background-color: #ef4444;
                color: white;
            }
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        </style>
        @livewireStyles
    </head>
    <body class="{{ $bodyClass ?? 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased' }}">
        @if (session('success'))
            <div class="flash-message flash-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @endif

        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif

        @livewireScripts
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const flashMessages = document.querySelectorAll('.flash-message');
                flashMessages.forEach(message => {
                    setTimeout(() => {
                        message.remove();
                    }, 4000);
                });
            });
        </script>
    </body>
</html>
