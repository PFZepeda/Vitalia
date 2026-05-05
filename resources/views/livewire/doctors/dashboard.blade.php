<div class="relative min-h-screen bg-[#fafbfd]">
    <main class="mx-auto flex min-h-screen w-full max-w-5xl flex-col px-6 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-8 sm:px-6 sm:pt-10 lg:px-8">
        <div class="w-full space-y-8">
            <!-- Logo -->
            <div class="flex justify-center">
                <div class="flex items-center gap-3">
                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="block">
                        <rect x="0" y="0" width="24" height="24" rx="4" fill="#ffffff"/>
                        <path d="M12 3v18M3 12h18" stroke="#0b67c2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12c0-2 2-3 4-3s4 1 4 3-2 3-4 3-4-1-4-3z" stroke="#0b67c2" stroke-width="1.4" fill="none"/>
                    </svg>
                    <div class="hidden sm:block">
                        <span class="block text-sm font-extrabold text-[#0b67c2]">VITALIA</span>
                    </div>
                </div>
            </div>

            <!-- Header -->
            <div class="space-y-2 pt-2">
                <h1 class="text-[34px] font-extrabold text-slate-900 sm:text-[40px] md:text-[44px]">
                    Hola, {{ optional(auth()->user())->name ?? 'Doctor' }}
                </h1>
                <p class="text-[15px] font-medium text-slate-500 sm:text-[16px]">
                    Gestiona y monitorea a tus pacientes
                </p>
            </div>


            <!-- Main Actions Grid -->
            <div class="space-y-5 sm:space-y-6">
                @php
                    $cardBg = 'bg-[#eef2f4]';
                    $iconBg = 'bg-[#e6eef6]';
                @endphp

                <!-- Panel de Alertas -->
                <a href="#" class="group flex items-center gap-4 rounded-2xl {{ $cardBg }} p-5 shadow-sm transition-all hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg {{ $iconBg }} text-[#0b67c2] sm:h-18 sm:w-18">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                            <circle cx="12" cy="12" r="9" fill="#0b67c2"/>
                            <path d="M12 7v6" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/>
                            <path d="M12 15h.01" stroke="#fff" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Panel de alertas</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Visualiza primero los pacientes que requieren atención inmediata.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <!-- Lista Rápida de Pacientes -->
                <a href="#" class="group flex items-center gap-4 rounded-2xl {{ $cardBg }} p-5 shadow-sm transition-all hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg {{ $iconBg }} text-[#0b67c2] sm:h-18 sm:w-18">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                            <rect x="3" y="5" width="4" height="4" rx="0.75" fill="#0b67c2"/>
                            <rect x="3" y="11" width="4" height="4" rx="0.75" fill="#0b67c2"/>
                            <rect x="3" y="17" width="4" height="4" rx="0.75" fill="#0b67c2"/>
                            <path d="M9 7.5h10" stroke="#0b67c2" stroke-width="1.6" stroke-linecap="round"/>
                            <path d="M9 13.5h10" stroke="#0b67c2" stroke-width="1.6" stroke-linecap="round"/>
                            <path d="M9 19.5h10" stroke="#0b67c2" stroke-width="1.6" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Lista rápida de pacientes</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Consulta nombre, tratamiento activo y porcentaje de adherencia actual.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <!-- Gestión de Pacientes -->
                <a href="#" class="group flex items-center gap-4 rounded-2xl {{ $cardBg }} p-5 shadow-sm transition-all hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg {{ $iconBg }} text-[#0b67c2] sm:h-18 sm:w-18">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                            <circle cx="12" cy="9" r="3" fill="#0b67c2"/>
                            <path d="M4 20c0-3.866 3.582-7 8-7s8 3.134 8 7" stroke="#0b67c2" stroke-width="1.6" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Gestión de pacientes</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Agrega, edita y elimina registros de pacientes.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

            </div>
        </div>
    </main>

    <x-vitalia-bottom-nav active="home" />
</div>
