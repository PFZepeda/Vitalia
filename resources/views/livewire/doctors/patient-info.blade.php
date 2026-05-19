<div class="relative min-h-screen bg-white pb-[calc(8rem+env(safe-area-inset-bottom))]">
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.opacity.duration.500ms
            class="fixed top-5 right-5 z-[150] flex items-center gap-2 rounded-lg bg-[#10b981] px-4 py-3 font-semibold text-white shadow-lg">
            <i class="fa-solid fa-circle-check text-white"></i>
            <span class="text-[14px]">{{ session('success') }}</span>
        </div>
    @endif

    <main class="mx-auto flex w-full max-w-lg flex-col px-4 pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('doctor.patients.index') }}" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Crear Receta</h1>
            </div>

            <div class="rounded-[24px] bg-[#f4f5f7] p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-[14px] font-bold text-slate-900 mb-2">{{ $patient->name }}</h2>

                        <!-- Height block -->
                        <div class="mb-1.5 flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Altura:</span>
                                @if ($patient->height)
                                    <span class="text-[13px] text-slate-400 font-medium">{{ $patient->height }} m</span>
                                @else
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </div>
                            <button type="button" wire:click="$set('showEditModal', 'height')"
                                class="cursor-pointer text-[#0b67c2] hover:opacity-70 transition-colors"><i
                                    class="fas fa-edit cursor-pointer text-[16px]"></i></button>
                        </div>

                        <!-- Weight block -->
                        <div class="flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Peso:</span>
                                @if ($patient->weight)
                                    <span class="text-[13px] text-slate-400 font-medium">{{ $patient->weight }}
                                        kg</span>
                                @else
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </div>
                            <button type="button" wire:click="$set('showEditModal', 'weight')"
                                class="cursor-pointer text-[#0b67c2] hover:opacity-70 transition-colors"><i
                                    class="fas fa-edit text-[16px]"></i></button>
                        </div>

                        <!-- Age block -->
                        <div class="mt-1.5 flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Edad:</span>
                                @if ($this->age)
                                    <span class="text-[13px] text-slate-400 font-medium">{{ $this->age }} años</span>
                                @else
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col items-end gap-1">
                        <span class="text-[12px] font-bold text-[#0b67c2]">Modo hospitalario</span>
                        <div
                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full bg-slate-300 transition-colors duration-200 ease-in-out">
                            <span
                                class="inline-block h-4 w-4 translate-x-1 transform rounded-full bg-white transition duration-200 ease-in-out"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex rounded-full bg-[#f4f5f7] p-1.5 shadow-sm">
                <button type="button" wire:click="$set('activeTab', 'receta')"
                    class="cursor-pointer w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors {{ $activeTab === 'receta' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]' }}">
                    Receta
                </button>
                <button type="button" wire:click="$set('activeTab', 'historial')"
                    class="cursor-pointer w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors {{ $activeTab === 'historial' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]' }}">
                    Historial
                </button>
            </div>

            @if ($activeTab === 'receta')
                <!-- Lista de Medicamentos agregados -->
                <div class="flex flex-col gap-4">
                    @forelse($this->myPrescriptionItems as $prescription)
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm relative pr-16">
                            <h3 class="text-[14px] font-bold text-[#0b67c2] mb-1.5">
                                {{ $prescription->medication?->medication_name ?? 'Medicamento sin asignar' }}
                                {{ $prescription->dose + 0 }} {{ $prescription->dose_unit ?? 'mg' }}
                            </h3>
                            @if ($prescription->pill_count)
                                <p class="text-[12px] text-slate-600 font-semibold">Pastillas: {{ $prescription->pill_count }}</p>
                            @endif
                            @if ($prescription->frequency_hours)
                                <p class="text-[12px] text-slate-600 font-semibold">Frecuencia: Cada {{ $prescription->frequency_hours }} horas</p>
                            @endif
                            @if ($prescription->observations)
                                <p class="text-[13px] text-slate-900 font-bold break-words">Observaciones: <span
                                        class="text-slate-700 font-medium break-words">{{ $prescription->observations }}</span></p>
                            @endif

                            @if ($prescription->start_date && $prescription->end_date)
                                <div class="mt-2 text-[12px] text-slate-600">
                                    <p><span class="font-bold">📅 Fechas:</span>
                                        {{ $prescription->start_date->format('d/m/Y') }} -
                                        {{ $prescription->end_date->format('d/m/Y') }}</p>
                                    @if ($prescription->administration_time)
                                        <p><span class="font-bold">⏰ Hora de inicio:</span>
                                            {{ Carbon\Carbon::parse($prescription->administration_time)->format('h:i a') }}
                                        </p>
                                    @endif
                                    @if ($prescription->weekdays)
                                        <p><span class="font-bold">📅 Días:</span> {{ $prescription->weekdays }}</p>
                                    @endif
                                </div>
                            @else
                                <div class="mt-2 text-[12px] text-amber-600">
                                    <p>⚠️ Sin fechas configuradas</p>
                                </div>
                            @endif

                            <div class="absolute right-4 top-1/2 -translate-y-1/2 flex gap-3">
                                <button type="button" wire:click="editItem({{ $prescription->id }})"
                                    class="text-[#0b67c2] cursor-pointer hover:opacity-70"><i
                                        class="fa-regular fa-pen-to-square text-[15px]"></i></button>
                                <button type="button" wire:click="confirmDeleteItem({{ $prescription->id }})"
                                    class="text-red-500 cursor-pointer hover:opacity-70"><i
                                        class="fa-regular fa-trash-can text-[15px]"></i></button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-[13px] text-slate-400">No hay medicamentos en la receta actual.</p>
                    @endforelse

                    <button type="button" wire:click="openMedicationModal"
                        class="cursor-pointer w-[120px] rounded-full bg-[#aeb3bb] py-2 text-center text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                        Agregar
                    </button>
                </div>
            @endif

            @if ($activeTab === 'historial')

                <div class="flex flex-col gap-4 mt-2">
                    @forelse($this->allPrescriptionItems as $prescription)
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm">
                            <p class="text-[13px] font-bold text-[#0b67c2] mb-1.5">
                                {{ $prescription->created_at->format('d/m/Y') }}</p>
                                <p class="text-[13px] text-slate-900 mb-1.5"><span
                                    class="font-bold text-[#0b67c2]">Medicamento:</span> <span
                                    class="text-[#f78b31] font-bold">{{ $prescription->medication?->medication_name ?? 'Medicamento sin asignar' }}
                                    {{ $prescription->dose + 0 }} {{ $prescription->dose_unit ?? 'mg' }}</span></p>
                            @if ($prescription->pill_count)
                                <p class="text-[12px] text-slate-600 font-semibold">Pastillas: {{ $prescription->pill_count }}</p>
                            @endif
                            @if ($prescription->frequency_hours)
                                <p class="text-[12px] text-slate-600 font-semibold">Frecuencia: Cada {{ $prescription->frequency_hours }} horas</p>
                            @endif

                            @if ($prescription->observations)
                                <p class="text-[13px] text-slate-900 font-bold mt-2 break-words">Observaciones: <span
                                        class="font-medium text-slate-700 break-words">{{ $prescription->observations }}</span>
                                </p>
                            @else
                                <p class="text-[13px] text-[#0b67c2] font-bold mt-2">Observaciones:<br><span
                                        class="font-medium text-slate-900">Ninguna</span></p>
                            @endif

                            @if ($prescription->start_date && $prescription->end_date)
                                <div class="mt-2 text-[12px] text-slate-600 max-w-[85%]">
                                    <p><span class="font-bold">📅 Fechas:</span>
                                        {{ $prescription->start_date->format('d/m/Y') }} -
                                        {{ $prescription->end_date->format('d/m/Y') }}</p>
                                    @if ($prescription->administration_time)
                                        <p><span class="font-bold">⏰ Hora de inicio:</span>
                                            {{ Carbon\Carbon::parse($prescription->administration_time)->format('h:i a') }}
                                        </p>
                                    @endif
                                    @if ($prescription->weekdays)
                                        <p><span class="font-bold">📅 Días:</span> {{ $prescription->weekdays }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-[13px] text-slate-400">El historial está vacío.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </main>

    <!-- Modal Agregar Medicamento -->
    @if ($showMedicationModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div
                class="relative w-full max-w-sm max-h-[85vh] overflow-y-auto rounded-[24px] bg-[#f4f5f7] p-5 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showMedicationModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-4 pr-6 text-center text-[16px] font-bold text-slate-900">
                    {{ $editItemId ? 'Editar medicamento' : 'Agrega el medicamento' }}</h3>

                <!-- 1. Medicamento -->
                <div class="mb-4 relative" x-data="{ open: false }">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">1.- Medicamento <span class="text-red-500">*</span></label>
                    <div class="relative" @click.outside="open = false">
                        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" wire:model.live.debounce.300ms="searchMedication" @focus="open = true"
                            @click="open = true"
                            class="w-full rounded-[12px] border border-white bg-white py-2 pl-9 pr-8 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2]"
                            placeholder="Buscar medicamento...">
                        <button type="button" @click="open = !open"
                            class="absolute right-0 top-0 flex h-full items-center px-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" style="display: none;"
                            class="absolute left-0 top-full z-10 mt-1 max-h-44 w-full overflow-y-auto rounded-xl bg-white p-2 shadow-lg border border-slate-100">
                            @forelse($this->filteredMedications as $med)
                                <button type="button"
                                    wire:click="selectMedication('{{ $med }}'); open = false"
                                    class="block w-full rounded-lg px-3 py-2 text-left text-[13px] hover:bg-[#dcdedf]">
                                    {{ $med }}
                                </button>
                            @empty
                                <div class="px-3 py-2 text-[13px] text-slate-500">Sin resultados</div>
                            @endforelse
                        </div>
                    </div>
                    @if ($selectedMedication)
                        <div
                            class="mt-2 inline-flex items-center rounded-[12px] bg-[#dcdedf] px-3 py-1.5 text-[13px] font-bold text-slate-900 shadow-sm">
                            {{ $selectedMedication }}
                            <button type="button" wire:click="$set('selectedMedication', '')"
                                class="ml-2 text-slate-500 hover:text-slate-800"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endif
                    @error('selectedMedication')
                        <span class="text-[11px] text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- 2. Dosis -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">2.- Dosis <span class="text-red-500">*</span></label>

                    @if ($calculatedDosis)
                        <div class="space-y-3">
                            <!-- Método de cálculo -->
                            <div class="rounded-[12px] bg-[#dcdedf] px-3 py-2.5">
                                <p class="text-[12px] text-slate-600 font-medium">{{ $calculatedDosis['method'] }}</p>
                            </div>

                            <!-- Presentación del medicamento -->
                            <div class="rounded-[12px] bg-[#e0f2fe] px-3 py-2.5">
                                <p class="text-[11px] text-slate-700"><span class="font-bold">Presentación:</span>
                                    {{ $calculatedDosis['presentation_unit'] }}</p>

                                <p class="text-[11px] mt-3 text-slate-600"><i class="fa-solid fa-info-circle"></i>
                                    Recuerda que la dósis puede variar según el paciente, como médico te recomendamos tu
                                    criterio clínico para el buen uso de la dósis de médicamentos.</p>
                            </div>

                            <!-- Selector de Nivel de Dosis -->
                            <div>
                                <label class="mb-1 block text-[12px] font-bold text-slate-700">Nivel de Dosis <span class="text-red-500">*</span></label>
                                <select wire:model.live="selectedDosisLevel"
                                    class="w-full rounded-[12px] border border-slate-200 bg-white px-3 py-2 text-[13px] text-slate-900 font-semibold outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                                    @if($selectedMedication && isset($medicationsList[$selectedMedication]))
                                        <option value="1">Dosis 1 - {{ $medicationsList[$selectedMedication]['dosis_1'] }} mg</option>
                                        <option value="2">Dosis 2 - {{ $medicationsList[$selectedMedication]['dosis_2'] }} mg</option>
                                    @endif
                                </select>
                                <p class="text-[11px] text-slate-500 mt-1">Seleccionado automáticamente según edad. Puedes cambiar si es necesario.</p>
                            </div>

                            <div>
                                <label class="mb-1 block text-[12px] font-bold text-slate-700">Pastillas <span class="text-red-500">*</span></label>
                                <input type="number" min="1" max="2" step="1" wire:model="pillCount"
                                    class="w-full rounded-[12px] border border-slate-200 bg-white px-3 py-2 text-[13px] text-slate-900 font-bold outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]"
                                    placeholder="1">
                                @error('pillCount')
                                    <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Información de dosis máxima -->
                            <div class="rounded-[12px] bg-[#f1f3f5] px-3 py-2">
                                <p class="text-[11px] text-slate-600">Máximo recomendado: <span
                                        class="font-bold text-slate-900">{{ $calculatedDosis['max_dose'] }}
                                        {{ $calculatedDosis['unit'] }}</span></p>
                            </div>

                            <!-- Observaciones -->
                            @if (!empty($calculatedDosis['observations']))
                                <div class="space-y-1.5">
                                    @foreach ($calculatedDosis['observations'] as $obs)
                                        <div class="rounded-[12px] bg-[#fef3c7] px-3 py-2">
                                            <p class="text-[11px] text-slate-800">{{ $obs }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <div
                                    class="flex-1 rounded-[12px] bg-slate-100 px-3 py-2 text-center text-[13px] text-slate-700 font-medium">
                                    —
                                </div>
                                <div
                                    class="rounded-[12px] border border-slate-300 bg-slate-100 px-3 py-2 text-[13px] font-bold text-slate-900 min-w-fit">
                                    —
                                </div>
                            </div>
                            <div>
                                <label class="mb-1 block text-[12px] font-bold text-slate-500">Pastillas</label>
                                <input type="number" min="1" max="2" step="1" disabled
                                    class="w-full rounded-[12px] border border-slate-200 bg-slate-100 px-3 py-2 text-[13px] text-slate-400 font-bold"
                                    placeholder="1">
                            </div>
                            <p class="text-[12px] text-slate-400">Selecciona un medicamento para calcular la dosis</p>
                        </div>
                    @endif
                </div>

                <!-- 3. Definir Fechas -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">3.- Horarios de toma <span class="text-red-500">*</span></label>
                    <button type="button" wire:click="openDatesModal"
                        class="flex items-center gap-2 rounded-[12px] bg-[#0b67c2] px-4 py-2 text-[13px] font-bold text-white w-full justify-center hover:opacity-90 transition-opacity cursor-pointer">
                        <i class="fa-solid fa-calendar"></i>
                        Definir Fechas
                    </button>
                    @if ($selectedDaysString)
                        <div class="mt-2 inline-flex items-center rounded-[12px] bg-[#0b67c2]/10 px-3 py-1.5 text-[12px] font-bold text-[#0b67c2]">
                            <i class="fa-solid fa-check mr-2"></i>
                            {{ $selectedDaysString }}
                        </div>
                    @endif
                    @error('startDate')
                        <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                    @error('endDate')
                        <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                    @error('selectedDaysString')
                        <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Frecuencia de toma -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">Frecuencia de toma <span class="text-red-500">*</span></label>
                    <select wire:model="frequencyHours"
                        class="w-full rounded-[12px] border border-slate-200 bg-white px-3 py-2 text-[13px] text-slate-900 font-semibold outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                        <option value="">Selecciona la frecuencia</option>
                        <option value="4">Cada 4 horas</option>
                        <option value="8">Cada 8 horas</option>
                        <option value="12">Cada 12 horas</option>
                        <option value="24">Cada 24 horas</option>
                    </select>
                    @error('frequencyHours')
                        <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- 4. Observaciones -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-[13px] font-bold text-slate-900">4.- Observaciones</label>
                        <span class="text-[11px] text-slate-500" wire:key="char-count-{{ strlen($observations ?? '') }}">{{ strlen($observations ?? '') }}/255</span>
                    </div>
                    <textarea wire:model.live="observations" rows="2" maxlength="255"
                        class="w-full rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none break-words whitespace-normal resize-none"
                        placeholder="Máximo 255 caracteres"></textarea>
                </div>

                <!-- Footer -->
                <div class="flex justify-end mt-2">
                    <button type="button" wire:click="savePrescriptionItem"
                        class="cursor-pointer rounded-[10px] bg-[#0b67c2] px-6 py-2.5 text-[14px] font-bold text-white transition-opacity hover:opacity-90">Guardar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Editar Datos del Paciente -->
    @if ($showEditModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div class="relative w-full max-w-sm rounded-[24px] bg-[#f4f5f7] p-5 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showEditModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-6 pr-6 text-center text-[16px] font-bold text-slate-900">
                    @if ($showEditModal === 'height')
                        Editar Altura
                    @elseif($showEditModal === 'weight')
                        Editar Peso
                    @endif
                </h3>

                <!-- Height Edit Form -->
                @if ($showEditModal === 'height')
                    <div class="mb-6">
                        <label class="mb-2 block text-[13px] font-bold text-slate-900">Altura (metros)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" step="0.01" min="0.5" max="3" wire:model="height"
                                class="flex-1 rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none focus:ring-2 focus:ring-[#0b67c2]"
                                placeholder="Ej. 1.75">
                            <span class="text-[13px] font-bold text-slate-900">m</span>
                        </div>
                        @error('height')
                            <span class="block text-[11px] text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <!-- Weight Edit Form -->
                @if ($showEditModal === 'weight')
                    <div class="mb-6">
                        <label class="mb-2 block text-[13px] font-bold text-slate-900">Peso (kilogramos)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" step="0.1" min="0" max="300" wire:model="weight"
                                class="flex-1 rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none focus:ring-2 focus:ring-[#0b67c2]"
                                placeholder="Ej. 70">
                            <span class="text-[13px] font-bold text-slate-900">kg</span>
                        </div>
                        @error('weight')
                            <span class="block text-[11px] text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <!-- Footer -->
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="rounded-[10px] bg-slate-300 px-4 py-2 text-[14px] font-bold text-slate-900 transition-opacity hover:opacity-90">Cancelar</button>
                    <button type="button" @if ($showEditModal === 'height') wire:click="saveHeight" @endif
                        @if ($showEditModal === 'weight') wire:click="saveWeight" @endif
                        class="rounded-[10px] bg-[#0b67c2] px-6 py-2 text-[14px] font-bold text-white transition-opacity hover:opacity-90 cursor-pointer">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Confirmar Eliminación de Medicamento -->
    @if ($showDeleteConfirmModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div class="relative w-full max-w-sm rounded-[24px] bg-white p-6 shadow-2xl border border-slate-200">
                <div class="flex flex-col items-center text-center">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#0b67c2] mb-6">
                        <i class="fa-solid fa-info text-[48px] text-white"></i>
                    </div>

                    <h3 class="mb-4 text-[18px] font-bold text-slate-900">¿Estás seguro de Eliminar el Medicamento?
                    </h3>

                    <div class="flex w-full gap-3 justify-center">
                        <button type="button" wire:click="finalizeDeleteItem"
                            class="flex-1 rounded-full bg-[#ef4444] px-6 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                            Si
                        </button>
                        <button type="button" wire:click="cancelDeleteItem"
                            class="flex-1 rounded-full bg-[#10b981] px-6 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Definir Fechas -->
    @if ($showDatesModal ?? false)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div
                class="relative w-full max-w-md max-h-[90vh] overflow-y-auto rounded-[24px] bg-white p-6 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showDatesModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-6 pr-6 text-center text-[18px] font-bold text-slate-900">Definir fechas de la receta</h3>

                <!-- Inicio de toma -->
                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Inicio de toma</h4>

                    <!-- Fecha de inicio -->
                    <div class="mb-4">
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Fecha de inicio <span class="text-red-500">*</span></label>
                        <input type="date" wire:model="startDate" min="{{ date('Y-m-d') }}"
                            max="{{ date('Y-m-d', strtotime('+3 days')) }}"
                            class="w-full rounded-[12px] border border-slate-200 bg-white px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                        @error('startDate')
                            <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora -->
                    <div>
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Hora de toma</label>
                        <div
                            class="flex items-center justify-between rounded-[12px] border border-slate-200 bg-white px-4 py-3 shadow-sm">
                            <div class="flex-1">
                                <div class="text-center text-[24px] font-bold text-slate-900">
                                    <span
                                        wire:key="hour-{{ $startHour }}-minute-{{ $startMinute }}">{{ str_pad($startHour, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($startMinute, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[16px]">{{ $startTimeFormat ?? 'a.m.' }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <button type="button" wire:click="incrementHour"
                                    class="cursor-pointer flex h-6 w-6 items-center justify-center rounded text-slate-400 hover:bg-slate-100 hover:text-[#0b67c2] transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 15l7-7 7 7"></path>
                                    </svg>
                                </button>
                                <button type="button" wire:click="toggleTimeFormat"
                                    class="cursor-pointer flex h-8 w-8 items-center justify-center rounded-lg border-2 transition-all duration-300 shadow-sm hover:shadow-md {{ $isPm ? 'bg-[#0b67c2]/10 border-[#0b67c2] text-[#0b67c2]' : 'bg-amber-50 border-amber-200 text-amber-600 hover:bg-amber-100' }}"
                                    title="{{ $isPm ? 'Cambiar a AM' : 'Cambiar a PM' }}">

                                    @if ($isPm)
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                        </svg>
                                    @else
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="5"></circle>
                                            <line x1="12" y1="1" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="12" y1="21" x2="12" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="1" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="21" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                        </svg>
                                    @endif
                                </button>
                                <button type="button" wire:click="decrementHour"
                                    class="cursor-pointer flex h-6 w-6 items-center justify-center rounded text-slate-400 hover:bg-slate-100 hover:text-[#0b67c2] transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @if ($pastHourError)
                            <span class="block text-[11px] text-red-500 mt-2">{{ $pastHourError }}</span>
                        @endif
                        @error('startHour')
                            <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Días de Toma Específicos</h4>

                    <!-- Selector de días de la semana -->
                    <div>
                        <label class="mb-3 block text-[13px] font-bold text-slate-500">Selecciona los días <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-4 gap-2">
                            @php
                                $weekdays = [
                                    'Lunes' => 'Lun',
                                    'Martes' => 'Mar',
                                    'Miercoles' => 'Mie',
                                    'Jueves' => 'Jue',
                                    'Viernes' => 'Vie',
                                    'Sábado' => 'Sab',
                                    'Domingo' => 'Dom',
                                ];
                                $selectedDays = explode(', ', $selectedDaysString ?? '');
                            @endphp

                            @foreach ($weekdays as $dayName => $dayLetter)
                                <button type="button" wire:click="toggleWeekday('{{ $dayName }}')"
                                    class="flex flex-col items-center justify-center py-3 px-2 rounded-[12px] font-bold text-[14px] transition-all border-2 {{ in_array($dayName, $selectedDays) ? 'bg-[#0b67c2] border-[#0b67c2] text-white' : 'bg-white border-slate-200 text-slate-900 hover:border-[#0b67c2]' }}">
                                    <span class="text-[16px]">{{ $dayLetter }}</span>
                                    <span class="text-[10px] mt-1">{{ substr($dayName, 0, 3) }}</span>
                                </button>
                            @endforeach
                        </div>
                        @if ($selectedDaysString)
                            <div
                                class="mt-3 inline-flex items-center rounded-[12px] bg-[#0b67c2]/10 px-3 py-2 text-[12px] font-bold text-[#0b67c2]">
                                <i class="fa-solid fa-check mr-2"></i>
                                {{ $selectedDaysString }}
                            </div>
                        @endif
                        @error('selectedDaysString')
                            <span class="block text-[11px] text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Fin de toma -->
                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Fin de toma</h4>

                    <!-- Fecha de termino -->
                    <div>
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Fecha de termino <span class="text-red-500">*</span></label>
                        <input type="date" wire:model="endDate" min="{{ date('Y-m-d') }}"
                            max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                            class="w-full rounded-[12px] border border-slate-200 bg-white px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                        @error('endDate')
                            <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end">
                    <button type="button" wire:click="saveDates"
                        class="rounded-[12px] bg-[#0b67c2] px-8 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90 cursor-pointer">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>
