<div class="min-h-screen bg-white flex flex-col font-sans">
    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full max-w-3xl mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <x-vitalia-logo class="scale-[0.45] sm:scale-[0.55]" />
        </div>

        <!-- Success Message -->
        @if($showSuccessMessage)
        <div class="fixed top-6 left-1/2 -translate-x-1/2 z-[60] bg-[#10b981] text-white px-6 py-3 rounded-full font-bold shadow-lg flex items-center gap-2 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            Stock Actualizado
            <button wire:click="$set('showSuccessMessage', false)" class="ml-2 hover:scale-110 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endif

        <!-- Error Message -->
        @if($errorMessage)
        <div class="fixed top-6 left-1/2 -translate-x-1/2 z-[60] bg-[#ef4444] text-white px-6 py-3 rounded-full font-bold shadow-lg flex items-center gap-2 animate-in fade-in slide-in-from-top-4 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            {{ $errorMessage }}
            <button wire:click="$set('errorMessage', '')" class="ml-2 hover:scale-110 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        @endif

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('pharmaceutical.medications.current', ['patient' => $patient->id]) }}" class="text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Stock de medicamentos</h1>
        </div>

        <main class="space-y-4 mb-24">
            <!-- Info Card -->
            <div class="bg-[#f4f4f5] rounded-2xl p-5 space-y-4 shadow-sm">
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Medicamento</h3>
                    <p class="text-[15px] font-bold text-gray-400">{{ $item->medication_name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Dosis</h3>
                    <p class="text-[15px] font-bold text-gray-400">{{ $prescription->dose ?? 'N/A' }} {{ $prescription->dose_unit ?? '' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Patente sugerida</h3>
                    <p class="text-[15px] font-bold text-gray-400">{{ $suggestedBrand->brand_name ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Blue Stock Card -->
            <div class="bg-[#2b88c7] rounded-xl p-5 flex justify-between items-center text-white relative overflow-hidden shadow-sm">
                <div class="relative z-10">
                    <p class="text-[11px] font-bold tracking-wider mb-1 text-blue-100 uppercase">TOTAL STOCK ACTUAL</p>
                    <h2 class="text-3xl font-bold">{{ $currentStockCount }} Unidades</h2>
                </div>
                <div class="relative z-10 opacity-90 scale-125 origin-right">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="12" y="10" width="16" height="28" rx="2" fill="#e2e8f0" />
                        <path d="M28 10L38 24L28 38V10Z" fill="#e2e8f0" opacity="0.8"/>
                        <circle cx="16" cy="14" r="1.5" fill="#fca5a5"/>
                        <circle cx="16" cy="20" r="1.5" fill="#fca5a5"/>
                        <circle cx="16" cy="26" r="1.5" fill="#fca5a5"/>
                        <circle cx="16" cy="32" r="1.5" fill="#fca5a5"/>
                        <circle cx="22" cy="14" r="1.5" fill="#fca5a5"/>
                        <circle cx="22" cy="20" r="1.5" fill="#fca5a5"/>
                        <circle cx="22" cy="26" r="1.5" fill="#fca5a5"/>
                        <circle cx="22" cy="32" r="1.5" fill="#fca5a5"/>
                    </svg>
                </div>
            </div>

            <!-- Selected Patents Cards -->
            <div class="space-y-4">
                @foreach($selectedPatents as $brandId => $patent)
                    <div class="border-2 border-[#2b88c7] rounded-2xl p-5 bg-white relative">
                        <button wire:click="removePatent({{ $brandId }})" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-3 mb-6">
                            <h3 class="text-[17px] font-bold text-black">{{ $patent['name'] }}</h3>
                            <span class="text-[17px] font-bold text-gray-400">{{ $patent['dose'] }} {{ $patent['dose_unit'] }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2">Número de cajas</label>
                                <div class="flex items-center justify-between border-2 border-gray-600 rounded-xl h-[46px] px-3">
                                    <button wire:click="decrementBoxes({{ $brandId }})" type="button" class="text-[#2b88c7] hover:bg-blue-50 w-8 h-8 rounded flex items-center justify-center transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                        </svg>
                                    </button>
                                    <span class="font-bold text-black text-lg">{{ $patent['boxes'] }}</span>
                                    <button wire:click="incrementBoxes({{ $brandId }})" type="button" class="text-[#2b88c7] hover:bg-blue-50 w-8 h-8 rounded flex items-center justify-center transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 mb-2">Pastillas por caja</label>
                                <div class="block w-full border-2 border-gray-100 rounded-xl h-[46px] px-3 flex items-center justify-center font-bold text-gray-400 text-lg bg-gray-50">
                                    {{ $patent['pills_per_box'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add other dropdown -->
            <div class="relative mb-20">
                <button wire:click="togglePatentDropdown" type="button" class="w-full border-2 border-[#2b88c7] rounded-2xl py-6 flex flex-row items-center justify-center gap-3 hover:bg-blue-50 transition text-[#2b88c7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 transition-transform duration-200 {{ $showPatentDropdown ? 'rotate-180' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    <span class="font-bold text-[15px]">Agregar otra patente</span>
                </button>

                @if($showPatentDropdown && $otherBrands->count() > 0)
                <div class="absolute top-full left-0 w-full mt-2 bg-white border-2 border-[#2b88c7] rounded-2xl shadow-2xl z-[70] overflow-hidden animate-in fade-in slide-in-from-top-2 duration-200">
                    <div class="max-h-[200px] overflow-y-auto overflow-x-hidden custom-scrollbar">
                        @foreach($otherBrands as $brand)
                        <button wire:click="addPatent({{ $brand->id }})" class="w-full px-6 py-4 text-left hover:bg-blue-50 flex justify-between items-center transition group border-b border-gray-50 last:border-none">
                            <div class="flex flex-col">
                                <span class="font-bold text-black">{{ $brand->brand_name }}</span>
                                <span class="text-xs text-gray-400 font-bold">{{ $brand->dose }} {{ $brand->dose_unit }} &deg; {{ $brand->pills_per_box }} pastillas</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5 text-[#2b88c7] opacity-0 group-hover:opacity-100 transition">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                        @endforeach
                    </div>
                </div>
                @elseif($showPatentDropdown)
                <div class="absolute top-full left-0 w-full mt-2 bg-white border-2 border-gray-100 rounded-2xl p-4 text-center text-gray-400 font-bold shadow-xl z-[70]">
                    No hay más patentes disponibles
                </div>
                @endif
            </div>

            <!-- Global Update Button -->
            <button wire:click="openModal" type="button" class="w-full bg-[#2b88c7] hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-bold py-4 px-4 rounded-2xl transition-all shadow-md text-[16px]" @if($this->getTotalToSum() == 0) disabled @endif>
                Actualizar unidades
            </button>
        </main>
    </div>

    <!-- Modal de Confirmación -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-300">
        <div class="bg-white rounded-[32px] p-6 w-full max-w-[340px] flex flex-col items-center shadow-2xl animate-in zoom-in-95 duration-300">
            <!-- Green Checkmark -->
            <div class="w-20 h-20 bg-[#a7f3d0] rounded-full flex items-center justify-center mb-6 mt-2 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-[#059669]" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Summary Card -->
            <div class="w-full bg-[#f4f4f5] rounded-2xl p-5 mb-4 relative overflow-hidden shadow-sm">
                <div class="space-y-4 mb-4">
                    @foreach($selectedPatents as $patent)
                        @if($patent['boxes'] > 0)
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 flex-shrink-0 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black">
                                    <path d="M11 13L15 9M17.5 11.5C18.8807 10.1193 18.8807 7.88071 17.5 6.5C16.1193 5.11929 13.8807 5.11929 12.5 6.5L6.5 12.5C5.11929 13.8807 5.11929 16.1193 6.5 17.5C7.88071 18.8807 10.1193 18.8807 11.5 17.5L17.5 11.5Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="8" cy="8" r="2.5" fill="currentColor"/>
                                    <circle cx="4.5" cy="12" r="2.5" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-black text-[15px] mb-0.5">{{ $patent['name'] }}</h3>
                                <p class="text-[13px] font-bold text-gray-400">{{ $patent['boxes'] }} caja{{ $patent['boxes'] > 1 ? 's' : '' }} &deg; {{ $patent['pills_per_box'] }} pastillas por caja</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="h-[3px] w-full bg-[#2b88c7] rounded-full mb-4 opacity-30"></div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-400">Total a sumar</span>
                    <span class="text-sm font-bold text-[#2b88c7]">{{ $this->getTotalToSum() }} unidades</span>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="w-full bg-[#fff7ed] border border-[#ffedd5] rounded-2xl p-4 flex gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 flex-shrink-0 text-orange-500 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                <p class="text-[13px] font-bold text-orange-700/80 leading-snug">
                    Se añadirán {{ $this->getTotalToSum() }} unidades al stock total disponible. Esta acción no se puede deshacer de forma automática.
                </p>
            </div>

            <!-- Buttons -->
            <div class="w-full space-y-3">
                <button wire:click="saveChanges" type="button" class="w-full bg-[#005cbb] hover:bg-blue-800 transition-all text-white font-bold py-4 rounded-2xl text-[15px] shadow-lg shadow-blue-200">
                    Guardar cambios
                </button>
                <button wire:click="closeModal" type="button" class="w-full bg-[#f4f4f5] hover:bg-gray-200 transition-all text-black font-bold py-4 rounded-2xl text-[15px]">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    @endif
    <x-vitalia-bottom-nav active="home" />
</div>