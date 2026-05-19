<div class="min-h-screen bg-slate-50 font-sans">
    <main class="mx-auto w-full max-w-lg px-4 pb-[calc(10rem+env(safe-area-inset-bottom))] pt-6">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <x-vitalia-logo class="scale-[0.55]" />
        </div>

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('doctor.patients.index') }}" class="text-slate-900 mr-4">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <h1 class="text-[22px] font-bold text-slate-900">Reporte Semanal</h1>
        </div>

        <!-- Period Info -->
        <div class="flex items-center gap-2 mb-6">
            <i class="fa-regular fa-calendar text-slate-400"></i>
            <span class="text-[14px] font-bold text-slate-700">{{ $stats['period'] }}</span>
        </div>

        <!-- On Time Card -->
        <div class="bg-white rounded-[24px] p-6 mb-4 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <h3 class="text-slate-400 text-[14px] font-bold mb-2 uppercase tracking-wide">Tomas a tiempo</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-[#0b67c2] text-3xl font-extrabold">{{ $stats['taken_percentage'] }}%</span>
                        <span class="text-slate-400 text-[14px] font-bold">/ {{ $stats['total'] }} tomas</span>
                    </div>
                </div>
                
                <!-- Ring Progress Chart (Simple SVG) -->
                <div class="relative w-20 h-20">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="6" fill="transparent" class="text-slate-100" />
                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="6" fill="transparent" stroke-dasharray="213.6" stroke-dashoffset="{{ 213.6 - (213.6 * $stats['taken_percentage']) / 100 }}" class="text-[#0b67c2]" stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fa-solid fa-check text-[#0b67c2] text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Missed and Delayed Row -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Omisiones -->
            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fa-regular fa-circle-xmark text-red-400 text-sm"></i>
                    <span class="text-slate-400 text-[12px] font-bold uppercase">Omisiones</span>
                </div>
                <h4 class="text-red-500 text-2xl font-extrabold mb-1">{{ $stats['missed_percentage'] }}%</h4>
                <p class="text-slate-400 text-[12px] font-bold">{{ $stats['missed'] }} Tomas</p>
            </div>

            <!-- Retrasos -->
            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fa-solid fa-clock-rotate-left text-slate-300 text-sm"></i>
                    <span class="text-slate-400 text-[12px] font-bold uppercase">Retrasos</span>
                </div>
                <h4 class="text-slate-400 text-2xl font-extrabold mb-1">{{ $stats['delayed_percentage'] }}%</h4>
                <p class="text-slate-400 text-[12px] font-bold">{{ $stats['delayed'] }} Toma</p>
            </div>
        </div>

        <!-- Reasons Card -->
        <div class="bg-white rounded-[24px] p-6 mb-8 shadow-sm">
            <h3 class="text-slate-900 text-[14px] font-bold mb-6">Razón de Omisión</h3>
            
            <div class="space-y-6">
                @foreach($stats['reasons'] as $reason => $count)
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-900 text-[14px] font-bold">{{ $reason }}</span>
                            <span class="text-slate-400 text-[12px] font-bold">{{ $stats['reasons_percentages'][$reason] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full transition-all duration-500" style="width: {{ $stats['reasons_percentages'][$reason] }}%"></div>
                        </div>
                        <p class="text-slate-400 text-[11px] font-bold">{{ $count }} {{ $count == 1 ? 'toma' : 'tomas' }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Download Button -->
        <button wire:click="downloadPdf" type="button" class="mb-4 w-full bg-[#0b67c2] hover:bg-blue-700 text-white font-bold py-4 rounded-[18px] flex items-center justify-center gap-2 shadow-lg transition shadow-blue-100">
            <i class="fa-solid fa-file-pdf"></i>
            Descargar reporte
        </button>
    </main>
    
    <x-vitalia-bottom-nav active="home" />
</div>
