<div class="relative min-h-screen bg-white pb-[calc(8rem+env(safe-area-inset-bottom))]">
    <main class="mx-auto flex w-full max-w-lg flex-col px-4 pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('doctor.patients.index') }}" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Crear Receta</h1>
            </div>

            <div class="rounded-[24px] bg-[#f4f5f7] p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-[14px] font-bold text-slate-900 mb-2">{{ $patient->name }}</h2>
                        
                        <!-- Height block -->
                        <div class="mb-1.5 flex min-h-[24px] items-center">
                            @if($editingHeight)
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-[13px] text-slate-900">Altura:</span>
                                    <input type="number" step="0.01" wire:model="height" class="w-16 rounded border border-[#0b67c2] px-1 py-0.5 text-[13px] outline-none focus:ring-1 focus:ring-[#0b67c2]">
                                    <span class="text-[13px] text-slate-500">m</span>
                                    <button type="button" wire:click="saveHeight" class="text-[#0b67c2] transition-opacity hover:opacity-80"><i class="fa-solid fa-check"></i></button>
                                    <button type="button" wire:click="cancelHeight" class="text-slate-400 transition-opacity hover:opacity-80"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-[13px] text-slate-900">Altura:</span>
                                    <span class="text-[13px] text-slate-400 font-medium">{{ $patient->height ?? '1.80' }} m</span>
                                    @if($isAssigned)
                                        <button type="button" wire:click="editHeight" class="text-[#0b67c2]"><i class="fa-regular fa-pen-to-square text-[14px]"></i></button>
                                    @endif
                                </div>
                            @endif
                        </div>
                        @error('height') <span class="block text-[11px] text-red-500 mb-1.5">{{ $message }}</span> @enderror

                        <!-- Weight block -->
                        <div class="flex min-h-[24px] items-center">
                            @if($editingWeight)
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-[13px] text-slate-900">Peso:</span>
                                    <input type="number" step="0.1" wire:model="weight" class="w-16 rounded border border-[#0b67c2] px-1 py-0.5 text-[13px] outline-none focus:ring-1 focus:ring-[#0b67c2]">
                                    <span class="text-[13px] text-slate-500">kg</span>
                                    <button type="button" wire:click="saveWeight" class="text-[#0b67c2] transition-opacity hover:opacity-80"><i class="fa-solid fa-check"></i></button>
                                    <button type="button" wire:click="cancelWeight" class="text-slate-400 transition-opacity hover:opacity-80"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-[13px] text-slate-900">Peso:</span>
                                    <span class="text-[13px] text-slate-400 font-medium">{{ $patient->weight ?? '70' }} kg</span>
                                    @if($isAssigned)
                                        <button type="button" wire:click="editWeight" class="text-[#0b67c2]"><i class="fa-regular fa-pen-to-square text-[14px]"></i></button>
                                    @endif
                                </div>
                            @endif
                        </div>
                        @error('weight') <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span> @enderror

                    </div>

                    <div class="flex flex-col items-end gap-1">
                        <span class="text-[12px] font-bold text-[#0b67c2]">Modo hospitalario</span>
                        <div class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full bg-slate-300 transition-colors duration-200 ease-in-out">
                            <span class="inline-block h-4 w-4 translate-x-1 transform rounded-full bg-white transition duration-200 ease-in-out"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex rounded-full bg-[#f4f5f7] p-1.5 shadow-sm">
                <button type="button" wire:click="$set('activeTab', 'receta')" class="w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors {{ $activeTab === 'receta' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]' }}">
                    Receta
                </button>
                <button type="button" wire:click="$set('activeTab', 'historial')" class="w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors {{ $activeTab === 'historial' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]' }}">
                    Historial
                </button>
            </div>

            @if($activeTab === 'receta')
                <!-- Lista de Medicamentos agregados -->
                <div class="flex flex-col gap-4">
                    @forelse($this->myPrescriptionItems as $item)
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm relative">
                            <h3 class="text-[14px] font-bold text-[#0b67c2] mb-1.5">{{ $item->medication_name }} {{ $item->dose + 0 }} {{ $item->dose_unit }}</h3>
                            <p class="text-[13px] text-slate-900 font-bold max-w-[85%]">Frecuencia: <span class="text-slate-700 font-medium">{{ $item->frequency }}</span></p>
                            
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 flex gap-3">
                                <button type="button" class="text-[#0b67c2]"><i class="fa-regular fa-pen-to-square text-[15px]"></i></button>
                                <button type="button" wire:click="deleteItem({{ $item->id }})" class="text-red-500"><i class="fa-regular fa-trash-can text-[15px]"></i></button>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-[13px] text-slate-400">No hay medicamentos en la receta actual.</p>
                    @endforelse

                    <button type="button" wire:click="openMedicationModal" class="w-[120px] rounded-full bg-[#aeb3bb] py-2 text-center text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                        Agregar
                    </button>
                </div>
            @endif

            @if($activeTab === 'historial')
                <div class="flex items-center rounded-[8px] bg-[#f1f3f5] px-3 py-2.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Buscar historial..." class="w-full bg-transparent px-2 text-[13px] text-slate-900 focus:outline-none placeholder:text-slate-400">
                </div>

                <div class="flex flex-col gap-4 mt-2">
                    @forelse($this->allPrescriptionItems as $item)
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm">
                            <p class="text-[13px] font-bold text-[#0b67c2] mb-1.5">{{ $item->created_at->format('d/m/Y') }}</p>
                            <p class="text-[13px] text-slate-900 mb-0.5"><span class="font-bold text-[#0b67c2]">Medicamento:</span> <span class="text-[#f78b31] font-bold">{{ $item->medication_name }} {{ $item->dose + 0 }} {{ $item->dose_unit }}</span></p>
                            <p class="text-[13px] text-slate-900 font-bold mb-1">Frecuencia: <span class="font-medium text-slate-700">{{ $item->frequency }}</span></p>
                            @if($item->observations)
                                <p class="text-[13px] text-slate-900 font-bold">Observaciones: <br><span class="font-medium text-slate-700">{{ $item->observations }}</span></p>
                            @else
                                <p class="text-[13px] text-[#0b67c2] font-bold">Observaciones:<br><span class="font-medium text-slate-900">Ninguna</span></p>
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
    @if($showMedicationModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div class="relative w-full max-w-sm max-h-[85vh] overflow-y-auto rounded-[24px] bg-[#f4f5f7] p-5 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showMedicationModal', false)" class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>
                
                <h3 class="mb-4 pr-6 text-center text-[16px] font-bold text-slate-900">Agrega el medicamento</h3>

                <!-- 1. Medicamento -->
                <div class="mb-4 relative" x-data="{ open: false }">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">1.- Medicamento</label>
                    <div class="relative" @click.outside="open = false">
                        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" wire:model.live.debounce.300ms="searchMedication" @focus="open = true" @click="open = true" class="w-full rounded-[12px] border border-white bg-white py-2 pl-9 pr-8 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2]" placeholder="Buscar medicamento...">
                        <button type="button" @click="open = !open" class="absolute right-0 top-0 flex h-full items-center px-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" style="display: none;" class="absolute left-0 top-full z-10 mt-1 max-h-44 w-full overflow-y-auto rounded-xl bg-white p-2 shadow-lg border border-slate-100">
                            @forelse($this->filteredMedications as $med)
                                <button type="button" wire:click="selectMedication('{{ $med }}'); open = false" class="block w-full rounded-lg px-3 py-2 text-left text-[13px] hover:bg-[#dcdedf]">
                                    {{ $med }}
                                </button>
                            @empty
                                <div class="px-3 py-2 text-[13px] text-slate-500">Sin resultados</div>
                            @endforelse
                        </div>
                    </div>
                    @if($selectedMedication)
                        <div class="mt-2 inline-flex items-center rounded-[12px] bg-[#dcdedf] px-3 py-1.5 text-[13px] font-bold text-slate-900 shadow-sm">
                            {{ $selectedMedication }}
                            <button type="button" wire:click="$set('selectedMedication', '')" class="ml-2 text-slate-500 hover:text-slate-800"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endif
                    @error('selectedMedication') <span class="text-[11px] text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- 2. Dosis -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">2.- Dosis</label>
                    <div class="flex items-center gap-2">
                        <input type="number" wire:model="dose" class="w-24 rounded-[12px] border-none bg-white px-3 py-2 text-center text-[13px] outline-none" placeholder="Ej. 500">
                        <select wire:model="doseUnit" class="rounded-[12px] border-none bg-white px-2 py-2 pr-6 text-[13px] outline-none">
                            <option value="mg">mg</option>
                            <option value="mL">mL</option>
                        </select>
                    </div>
                    @error('dose') <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- 3. Frecuencia -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">3.- Frecuencia</label>
                    <input type="text" wire:model="frequency" class="w-full rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none" placeholder="Ej. 1 pastilla cada 8 Horas 7 Días">
                    @error('frequency') <span class="block text-[11px] text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- 4. Horarios -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">4.- Horarios específicos</label>
                    <button type="button" class="flex items-center gap-2 rounded-[12px] bg-[#dcdedf] px-4 py-2 text-[13px] font-bold text-slate-800">
                        <i class="fa-solid fa-clock-rotate-left text-[#0b67c2]"></i>
                        Definir Horarios
                    </button>
                </div>

                <!-- 5. Observaciones -->
                <div class="mb-6">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">5.- Observaciones (opcional)</label>
                    <textarea wire:model="observations" rows="2" class="w-full rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none"></textarea>
                </div>

                <!-- Footer -->
                <div class="flex justify-end mt-2">
                    <button type="button" wire:click="savePrescriptionItem" class="rounded-[10px] bg-[#0b67c2] px-6 py-2.5 text-[14px] font-bold text-white transition-opacity hover:opacity-90">Guardar</button>
                </div>
            </div>
        </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>
