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
            @if($prescriptions && $prescriptions->isNotEmpty())
                <div class="flex flex-col gap-7 sm:gap-6">
                    @foreach($prescriptions as $prescription)
                        <div class="rounded-[18px] bg-[#f1f3f5] px-4 py-6 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:rounded-[26px] sm:p-5">
                            <div class="grid grid-cols-[34px_minmax(92px,1fr)_minmax(132px,auto)] items-center gap-2 sm:grid-cols-[70px_minmax(0,1fr)_minmax(230px,auto)] sm:gap-4">
                                <div class="flex items-center justify-center text-slate-900">
                                    <i class="fa-solid fa-capsules text-[26px] sm:text-[46px]"></i>
                                </div>

                                <div class="min-w-0">
                                    <span class="block text-[12px] font-bold leading-tight text-[#2f6edb] sm:text-[20px]">
                                        {{ $prescription->medication?->medication_name ?? 'Medicamento sin asignar' }}
                                    </span>

                                    <p class="mt-1 text-[12px] font-bold leading-tight text-slate-600 sm:mt-2 sm:text-[18px]">
                                        @if($prescription->dose !== null && $prescription->dose_unit)
                                            Dosis: {{ $prescription->dose + 0 }} {{ $prescription->dose_unit }}
                                        @else
                                            Dosis por confirmar
                                        @endif
                                    </p>
                                    @if($prescription->pill_count)
                                        <p class="mt-1 text-[11px] font-semibold leading-tight text-slate-500 sm:text-[14px]">Pastillas: {{ $prescription->pill_count }}</p>
                                    @endif
                                    @if($prescription->frequency_hours)
                                        <p class="mt-1 text-[11px] font-semibold leading-tight text-slate-500 sm:text-[14px]">Frecuencia: Cada {{ $prescription->frequency_hours }} horas</p>
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <div class="space-y-[2px] text-[8.5px] leading-tight text-slate-700 sm:text-xs">
                                        @if($prescription->start_date && $prescription->end_date)
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Fechas:</span>
                                                    {{ $prescription->start_date->format('d/m/Y') }} - {{ $prescription->end_date->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Fechas:</span>
                                                    Sin fechas configuradas
                                                </span>
                                            </div>
                                        @endif

                                        @if($prescription->administration_time)
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-clock text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Hora de inicio:</span>
                                                    {{ \Carbon\Carbon::parse($prescription->administration_time)->format('h:i a') }}
                                                </span>
                                            </div>
                                        @endif

                                        @if($prescription->weekdays)
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar-check text-[#8ea0d7]"></i>
                                                <span class="line-clamp-2">
                                                    <span class="font-bold">Días:</span>
                                                    {{ $prescription->weekdays }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <button wire:click="openModal({{ $prescription->id }})" class="mt-3 w-full rounded-full bg-[#0b67c2] px-3 py-2 text-[11px] font-bold text-white shadow transition hover:bg-blue-700 sm:w-auto sm:px-5 sm:text-[12px]">
                                        Observaciones de receta
                                    </button>
                                </div>
                            </div>

                            @php
                                $stock = $prescription->patient->medicationStocks->where('prescription_item_id', $prescription->prescription_item_id)->first();
                                $currentPills = $stock->current_pills ?? 0;
                                $totalCapacity = 30;
                                $percentage = min(100, max(0, ($currentPills / $totalCapacity) * 100));
                                if ($percentage >= 50) {
                                    $barClass = 'bg-green-500';
                                    $textClass = 'text-green-600';
                                } elseif ($percentage >= 25) {
                                    $barClass = 'bg-yellow-500';
                                    $textClass = 'text-yellow-600';
                                } else {
                                    $barClass = 'bg-red-500';
                                    $textClass = 'text-red-500';
                                }
                            @endphp
                            <div class="mt-4 border-slate-300">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[10px] font-bold text-slate-700">Disponibilidad</span>
                                    <span class="text-[10px] font-bold {{ $textClass }}">{{ $currentPills }} pastillas</span>
                                </div>
                                <div class="w-full bg-slate-300 rounded-full h-3 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-500 {{ $barClass }}" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <!-- Modal de Observaciones -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="relative w-full max-w-sm rounded-2xl bg-[#f1f3f5] shadow-2xl">
            <!-- Botón Cerrar -->
            <button wire:click="closeModal()" class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-400 shadow transition hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Contenido del Modal -->
            <div class="space-y-4 p-6">
                <h2 class="text-lg font-bold text-slate-950">Observaciones de la receta</h2>
                
                <div class="min-h-32 rounded-xl bg-[#d9d9d9] p-4 text-center">
                    @if($selectedObservations)
                        <p class="text-sm text-slate-700">{{ $selectedObservations }}</p>
                    @else
                        <p class="text-sm text-slate-600">No cuentas con observaciones de la receta</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>