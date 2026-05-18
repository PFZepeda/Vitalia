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
                <a href="{{ route('pharmaceutical.patients.list')}}" class="group rounded-2xl bg-[#eef2f4] p-4 sm:p-6 flex items-center justify-between shadow-sm transition-all hover:bg-[#e3e9ee] hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#e6eef6] text-[#0b67c2] shadow-[inset_0_0_0_1px_rgba(11,103,194,0.08)] p-4">
                            <i class="fa-solid fa-user text-[26px] leading-none transition-transform group-hover:-translate-y-0.5"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Gestion de Pacientes</h2>
                            <p class="text-sm text-slate-500">Gestion de pacientes.</p>
                        </div>
                    </div>
                    <div>
                        <svg class="h-6 w-6 text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-[#0b67c2]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </main>
        </div>
    </div>

    <x-vitalia-bottom-nav active="home" />
</div>
