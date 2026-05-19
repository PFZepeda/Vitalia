<div class="relative min-h-screen bg-slate-50">
    <main class="mx-auto flex min-h-screen w-full max-w-6xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full max-w-5xl flex-col gap-8">
            <div class="flex flex-col items-center gap-5 text-center md:items-start md:text-left">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.68] md:scale-75" />

                <div class="self-stretch space-y-1 pt-2 text-left">
                    <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Hola, {{ $caregiverName }}</h1>
                    <p class="text-[16px] font-medium text-slate-400 sm:text-[18px]">Monitorea el estado de tus pacientes</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-2">
                <a href="{{ route('patient.medicamentos') }}" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="2" />
                            <path d="M4 20c0-3.4 3.6-6.2 8-6.2s8 2.8 8 6.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[18px] font-bold text-slate-950">Tomas del paciente</h2>
                        <p class="mt-1 text-[15px] leading-5 text-slate-400">Consulta de información acerca del paciente que estas cuidando</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <a href="{{ route('patient.recetas') }}" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <path d="M12 4L3.5 19.5H20.5L12 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                            <path d="M12 9v5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <circle cx="12" cy="17" r="1" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[18px] font-bold text-slate-950">Recetas del paciente</h2>
                        <p class="mt-1 text-[15px] leading-5 text-slate-400">Consulta información acerca de los medicamentos y recetas del paciente</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
                <button type="submit">Cerrar sesion</button>
            </form>
        </div>
    </main>

    <x-vitalia-bottom-nav active="home" />
</div>
