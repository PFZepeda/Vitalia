<div class="min-h-screen bg-white flex flex-col font-sans">
    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full max-w-3xl mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <x-vitalia-logo class="scale-[0.45] sm:scale-[0.55]" />
        </div>

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="{{ route('pharmaceutical.dashboard') }}" class="text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de pacientes</h1>
        </div>
        
        <!-- Search -->
        <div class="mb-6 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-500 text-lg"></i>
            </div>
            <input type="text" wire:model.live="search" class="block w-full pl-10 pr-3 py-3 border-none rounded-xl bg-[#f4f4f5] focus:ring-2 focus:ring-[#0b67c2] focus:bg-white text-gray-900 placeholder-gray-400 text-sm transition-colors" placeholder="Buscar paciente por nombre o correo">
        </div>

        <!-- List -->
        <main class="space-y-4 mb-24">
            @forelse($patients as $patient)
                <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 flex items-start relative">
                    <!-- Avatar -->
                    <div class="flex-shrink-0 mr-4">
                        <div class="h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-[#e3e9ee] flex items-center justify-center text-[#0b67c2] text-2xl sm:text-3xl font-bold">
                            {{ collect(explode(' ', $patient->name))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('') }}
                        </div>
                    </div>
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <h2 class="text-[15px] sm:text-base font-bold text-black truncate">{{ $patient->name }}</h2>
                            <a href="{{ route('pharmaceutical.medications.current', ['patient' => $patient->id]) }}" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                        </div>
                        <div class="mt-1 text-sm text-gray-600 space-y-1">
                            <div class="truncate">
                                <span class="font-bold text-black">Correo:</span> 
                                <span class="text-gray-400 underline">{{ $patient->email }}</span>
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-1">
                                <div><span class="font-bold text-black">Altura:</span> <span class="text-gray-400">{{ $patient->height ?? 'N/A' }} m</span></div>
                                <div><span class="font-bold text-black">Peso:</span> <span class="text-gray-400">{{ $patient->weight ?? 'N/A' }} kg</span></div>
                                <div><span class="font-bold text-black">Edad:</span> <span class="text-gray-400">{{ $patient->getAge() }} años</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">No se encontraron pacientes.</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $patients->links() }}
            </div>
        </main>
    </div>
    <x-vitalia-bottom-nav active="home" />
</div>
