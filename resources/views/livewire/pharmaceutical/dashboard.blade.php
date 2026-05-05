<div class="pharmaceutical-dashboard min-h-screen bg-white flex flex-col">
    <div class="py-8 px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-center mb-6">
                <x-vitalia-logo class="scale-[0.48] sm:scale-[0.58] md:scale-[0.66]" />
            </div>

            <header class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Hola, {{ $pharmacistName ?? 'Usuario' }}</h1>
                <p class="mt-2 text-gray-500">Gestiona el catálogo de medicamento</p>
            </header>

            <main class="space-y-6 mb-24"> <!-- add bottom margin so content isn't hidden behind fixed nav -->
                <a href="#" class="block bg-gray-100 hover:bg-gray-200 transition rounded-2xl p-4 sm:p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="bg-white/60 rounded-lg p-3 shadow-sm">
                            <!-- Magnifier icon -->
                            <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Buscador de medicamentos</h2>
                            <p class="text-sm text-gray-400">Buscar medicamentos por sustancia o nombre comercial.</p>
                        </div>
                    </div>
                    <div>
                        <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <a href="#" class="block bg-gray-100 hover:bg-gray-200 transition rounded-2xl p-4 sm:p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="bg-white/60 rounded-lg p-3 shadow-sm">
                            <!-- Pills icon -->
                            <svg class="h-8 w-8 text-blue-600" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 3a3 3 0 00-3 3v1h6V6a3 3 0 00-3-3z" opacity=".9" />
                                <path d="M9 8v7a3 3 0 006 0V8H9z" opacity=".8" />
                                <path d="M5 11a2 2 0 00-2 2v3a4 4 0 004 4h10a4 4 0 004-4v-3a2 2 0 00-2-2H5z" opacity=".6" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Gestión de medicamentos</h2>
                            <p class="text-sm text-gray-400">Agrega, edita y elimina medicamentos, incluyendo el inventario</p>
                        </div>
                    </div>
                    <div>
                        <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </main>
        </div>
    </div>

    <x-vitalia-bottom-nav active="home" />
</div>
