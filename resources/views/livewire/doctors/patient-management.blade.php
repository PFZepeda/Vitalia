<div class="relative min-h-screen bg-white">
    <main
        class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('doctor.dashboard') }}" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Gestión de Pacientes</h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex flex-1 items-center rounded-[8px] bg-[#f1f3f5] px-3 py-2.5">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Buscar paciente por correo"
                        class="w-full bg-transparent px-2 text-[14px] text-slate-900 focus:outline-none placeholder:text-slate-400">
                </div>
            </div>

            <div class="flex flex-col gap-4">
                @forelse($patients as $patient)
                    @php
                        $parts = explode(' ', $patient->name);
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                        if (empty($initials)) {
                            $initials = '??';
                        }
                    @endphp
                    <div class="relative flex items-center gap-4 rounded-[16px] bg-[#f4f5f7] p-5 shadow-sm">
                        <div
                            class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-full bg-[#dcdedf]">
                            <span class="text-[26px] font-bold text-[#0b67c2]">{{ $initials }}</span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-[14px] font-bold text-slate-900 mb-1.5">{{ $patient->name }}</h2>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Correo:</span> <span
                                    class="text-slate-400 font-medium">{{ $patient->email }}</span></p>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Altura:</span>
                                @if ($patient->height)
                                    <span class="text-slate-400 font-medium">{{ $patient->height }} m</span>
                                @else
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </p>
                            <p class="text-[13px] text-slate-500"><span class="font-bold text-slate-900">Peso:</span>
                                @if ($patient->weight)
                                    <span class="text-slate-400 font-medium">{{ $patient->weight }} kg</span>
                                @else
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </p>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Edad:</span>
                                @if ($patient->birth_date)
                                    <span
                                        class="text-slate-400 font-medium">{{ \Carbon\Carbon::parse($patient->birth_date)->age }}
                                        años</span>
                                @else
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                @endif
                            </p>

                        </div>
                        <div class="absolute right-4 top-4 flex gap-2">
                            <a href="{{ route('doctor.patients.show', $patient) }}" class="text-[#0b67c2]">
                                <i class="fa-regular fa-pen-to-square text-[18px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-[14px] text-slate-500 py-6">No se encontraron pacientes.</p>
                @endforelse
            </div>
        </div>
    </main>
    <x-vitalia-bottom-nav active="home" />
</div>
