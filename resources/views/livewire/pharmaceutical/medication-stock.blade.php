<div class="min-h-screen bg-white flex flex-col font-sans">
    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full max-w-3xl mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <x-vitalia-logo class="scale-[0.45] sm:scale-[0.55]" />
        </div>

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('pharmaceutical.medications.current') }}" class="text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Stock de medicamentos</h1>
        </div>

        <main class="space-y-4 mb-24">
            <!-- Info Card -->
            <div class="bg-[#f4f4f5] rounded-2xl p-5 space-y-4">
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Medicamento</h3>
                    <p class="text-[15px] font-bold text-gray-400">Ibuprofeno</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Dosis</h3>
                    <p class="text-[15px] font-bold text-gray-400">400 mg</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-black mb-1">Patente sugerida</h3>
                    <p class="text-[15px] font-bold text-gray-400">Advil</p>
                </div>
            </div>

            <!-- Blue Stock Card -->
            <div class="bg-[#2b88c7] rounded-xl p-5 flex justify-between items-center text-white relative overflow-hidden shadow-sm">
                <div class="relative z-10">
                    <p class="text-[11px] font-bold tracking-wider mb-1 text-blue-100">TOTAL STOCK ACTUAL</p>
                    <h2 class="text-3xl font-bold">25 Unidades</h2>
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

            <!-- Update Card -->
            <div class="border-2 border-[#2b88c7] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-6">
                    <h3 class="text-[17px] font-bold text-black">Advil</h3>
                    <span class="text-[17px] font-bold text-gray-400">400 mg</span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2">Números de cajas</label>
                        <div class="flex items-center justify-between border-2 border-gray-600 rounded-xl h-[46px] px-3">
                            <button type="button" class="text-[#2b88c7] hover:bg-blue-50 w-8 h-8 rounded flex items-center justify-center transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                </svg>
                            </button>
                            <span class="font-bold text-black text-lg">1</span>
                            <button type="button" class="text-[#2b88c7] hover:bg-blue-50 w-8 h-8 rounded flex items-center justify-center transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2">Pastillas por caja</label>
                        <input type="text" value="10" class="block w-full border-2 border-gray-600 rounded-xl h-[46px] px-3 text-center font-bold text-black text-lg focus:ring-[#2b88c7] focus:border-[#2b88c7] shadow-sm">
                    </div>
                </div>
                
                <button wire:click="openModal" type="button" class="w-full bg-[#2b88c7] hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl transition text-[15px]">
                    Actualizar unidades
                </button>
            </div>

            <!-- Add other button -->
            <button type="button" class="w-full border-2 border-[#2b88c7] rounded-2xl py-6 flex flex-row items-center justify-center gap-3 hover:bg-blue-50 transition text-[#2b88c7]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="font-bold text-[15px]">Agregar otra patente</span>
            </button>
        </main>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-[32px] p-6 w-full max-w-[340px] flex flex-col items-center shadow-xl">
            <!-- Green Checkmark -->
            <div class="w-20 h-20 bg-[#a7f3d0] rounded-full flex items-center justify-center mb-6 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-[#059669]" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Info Card -->
            <div class="w-full bg-[#f4f4f5] rounded-2xl p-5 mb-4 relative overflow-hidden">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-10 h-10 flex-shrink-0">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-black">
                            <path d="M11 13L15 9M17.5 11.5C18.8807 10.1193 18.8807 7.88071 17.5 6.5C16.1193 5.11929 13.8807 5.11929 12.5 6.5L6.5 12.5C5.11929 13.8807 5.11929 16.1193 6.5 17.5C7.88071 18.8807 10.1193 18.8807 11.5 17.5L17.5 11.5Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="8" cy="8" r="2.5" fill="currentColor"/>
                            <circle cx="4.5" cy="12" r="2.5" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-black text-[15px] mb-0.5">Advil</h3>
                        <p class="text-[13px] font-bold text-gray-400">1 caja &deg; 10 pastillas por caja</p>
                    </div>
                </div>
                
                <div class="h-[3px] w-full bg-[#2b88c7] rounded-full mb-4"></div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-400">Total a sumar</span>
                    <span class="text-sm font-bold text-gray-400">10 unidades</span>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="w-full bg-[#f4f4f5] rounded-2xl p-4 flex gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 flex-shrink-0 text-black mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                <p class="text-[13px] font-bold text-gray-400 leading-snug">
                    Se añadirán 10 unidades al stock total disponible en inventario. Esta acción no se puede deshacer de forma automática.
                </p>
            </div>

            <!-- Buttons -->
            <div class="w-full space-y-3">
                <button type="button" class="w-full bg-[#005cbb] hover:bg-blue-800 transition text-white font-bold py-3.5 rounded-xl text-[15px]">
                    Guardar cambios
                </button>
                <button wire:click="closeModal" type="button" class="w-full bg-[#f4f4f5] hover:bg-gray-200 transition text-black font-bold py-3.5 rounded-xl text-[15px]">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    @endif
        <x-vitalia-bottom-nav active="home" />
</div>
