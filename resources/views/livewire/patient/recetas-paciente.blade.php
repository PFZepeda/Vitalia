<div class="relative min-h-screen bg-slate-50">
    <main class="mx-auto min-h-screen w-full max-w-[430px] px-3 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-3 sm:max-w-5xl sm:px-6 sm:pt-6 lg:px-8">

        <div class="mx-auto flex w-full flex-col gap-12 sm:gap-8">

            <!-- Header -->
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.68] md:scale-75" />

                <div class="mt-2 flex w-full items-center gap-4">
                    <a href="{{ route('patient.dashboard') }}"
                       class="inline-flex shrink-0 items-center justify-center text-slate-700 transition hover:text-slate-900">
                        <i class="fa-solid fa-chevron-left text-[24px] sm:text-3xl"></i>
                    </a>

                    <h1 class="text-[26px] font-bold leading-tight text-slate-950 sm:text-[34px] md:text-[38px]">
                        Recetas del Médico
                    </h1>
                </div>
            </div>

            <!-- Lista de recetas -->
            <div class="flex flex-col gap-7 sm:gap-6">

                <!-- Receta 1 -->
                <div class="rounded-[18px] bg-[#f1f3f5] px-4 py-6 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:rounded-[26px] sm:p-5">

                    <!-- Parte superior -->
                    <div class="grid grid-cols-[34px_minmax(92px,1fr)_minmax(132px,auto)] items-center gap-2 sm:grid-cols-[70px_minmax(0,1fr)_minmax(230px,auto)] sm:gap-4">

                        <!-- Icono -->
                        <div class="flex items-center justify-center text-slate-900">
                            <i class="fa-solid fa-capsules text-[26px] sm:text-[46px]"></i>
                        </div>

                        <!-- Medicamento -->
                        <div class="min-w-0">
                            <a href="#"
                               class="block text-[12px] font-bold leading-tight text-[#2f6edb] hover:underline sm:text-[20px]">
                                Amoxicilina 400 mg
                            </a>

                            <p class="mt-1 text-[12px] font-bold leading-tight text-slate-600 sm:mt-2 sm:text-[18px]">
                                1 pastilla cada 8h
                            </p>
                        </div>

                        <!-- Datos + botón -->
                        <div class="min-w-0">
                            <div class="space-y-[2px] text-[8.5px] leading-tight text-slate-700 sm:text-xs">
                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Fechas:</span>
                                        15/05/2026 - 16/05/2026
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Hora de inicio:</span>
                                        08:00 pm
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar-check text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Días:</span>
                                        Lunes, Martes
                                    </span>
                                </div>
                            </div>

                            <button wire:click="openModal(1)" class="mt-3 w-full rounded-full bg-[#0b67c2] px-3 py-2 text-[11px] font-bold text-white shadow transition hover:bg-blue-700 sm:w-auto sm:px-5 sm:text-[12px]">
                                observacion de receta
                            </button>
                        </div>
                    </div>

                    <!-- Barra de disponibilidad mejorada -->
                    <div class="mt-5 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-slate-700 sm:text-xs">Disponibilidad</span>
                            <span class="text-[11px] font-bold text-red-500 sm:text-xs">2/16 pastillas</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-gradient-to-r from-slate-200 to-slate-300">
                            <div class="h-2 rounded-full bg-gradient-to-r from-red-400 to-red-500" style="width: 12%"></div>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] text-slate-600">
                            <i class="fa-regular fa-clock text-slate-400"></i>
                            <span>Última toma: Hoy, 08:00 AM</span>
                        </div>
                    </div>
                </div>

                <!-- Receta 2 -->
                <div class="rounded-[18px] bg-[#f1f3f5] px-4 py-6 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:rounded-[26px] sm:p-5">

                    <!-- Parte superior -->
                    <div class="grid grid-cols-[34px_minmax(92px,1fr)_minmax(132px,auto)] items-center gap-2 sm:grid-cols-[70px_minmax(0,1fr)_minmax(230px,auto)] sm:gap-4">

                        <!-- Icono -->
                        <div class="flex items-center justify-center text-slate-900">
                            <i class="fa-solid fa-capsules text-[26px] sm:text-[46px]"></i>
                        </div>

                        <!-- Medicamento -->
                        <div class="min-w-0">
                            <a href="#"
                               class="block text-[12px] font-bold leading-tight text-[#2f6edb] hover:underline sm:text-[20px]">
                                Ibuprofeno 400 mg
                            </a>

                            <p class="mt-1 text-[12px] font-bold leading-tight text-slate-600 sm:mt-2 sm:text-[18px]">
                                1 pastilla cada 8h
                            </p>
                        </div>

                        <!-- Datos + botón -->
                        <div class="min-w-0">
                            <div class="space-y-[2px] text-[8.5px] leading-tight text-slate-700 sm:text-xs">
                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Fechas:</span>
                                        15/05/2026 - 16/05/2026
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Hora de inicio:</span>
                                        08:00 pm
                                    </span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar-check text-[#8ea0d7]"></i>
                                    <span class="whitespace-nowrap">
                                        <span class="font-bold">Días:</span>
                                        Lunes, Martes
                                    </span>
                                </div>
                            </div>

                            <button wire:click="openModal(2)" class="mt-3 w-full rounded-full bg-[#0b67c2] px-3 py-2 text-[11px] font-bold text-white shadow transition hover:bg-blue-700 sm:w-auto sm:px-5 sm:text-[12px]">
                                observacion de receta
                            </button>
                        </div>
                    </div>

                    <!-- Barra de disponibilidad mejorada -->
                    <div class="mt-5 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-slate-700 sm:text-xs">Disponibilidad</span>
                            <span class="text-[11px] font-bold text-emerald-500 sm:text-xs">12/16 pastillas</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-gradient-to-r from-slate-200 to-slate-300">
                            <div class="h-2 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500" style="width: 74%"></div>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] text-slate-600">
                            <i class="fa-regular fa-clock text-slate-400"></i>
                            <span>Próxima toma: 09:00 PM</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Modal de Observaciones -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="relative w-full max-w-sm rounded-2xl bg-white shadow-2xl">
            <!-- Botón Cerrar -->
            <button wire:click="closeModal()" class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-400 shadow transition hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Contenido del Modal -->
            <div class="space-y-4 p-6">
                <h2 class="text-lg font-bold text-slate-950">Observaciones de la receta</h2>
                
                <div class="min-h-32 rounded-xl bg-slate-100 p-4 text-center">
                    <p class="text-sm text-slate-500">No cuentas con observaciones en esta receta</p>
                </div>

                <!-- Botón de Acción -->
                <button wire:click="closeModal()" class="w-full rounded-full bg-[#0b67c2] px-4 py-2 font-semibold text-white transition hover:bg-blue-700">
                    Entendido
                </button>
            </div>
        </div>
    </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>