<div class="relative min-h-screen bg-white">
    <main class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Gestión de usuarios</h1>
            </div>

            @if(session('status'))
                <div class="flex items-center justify-between rounded-[14px] bg-[#6dec68] p-4 text-white shadow-sm">
                    <span class="text-[14px] font-semibold">{{ session('status') }}</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            @endif

            <div class="flex items-center gap-3">
                <div class="flex flex-1 items-center rounded-[8px] bg-[#f1f3f5] px-3 py-2.5">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar" class="w-full bg-transparent px-2 text-[14px] text-slate-900 focus:outline-none placeholder:text-slate-400">
                </div>
            </div>

            <div class="flex flex-col gap-4">
                @foreach($users as $user)
                    @php
                        $parts = explode(' ', $user->name);
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                    @endphp
                    <div class="relative flex items-center gap-4 rounded-[16px] bg-[#f4f5f7] p-5 shadow-sm">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-[#dcdedf]">
                            <span class="text-[22px] font-bold text-[#0b67c2]">{{ $initials }}</span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-[14px] font-bold text-slate-900">{{ $user->email }}</h2>
                            <p class="text-[12px] text-slate-500"><span class="font-bold text-slate-900">Rol:</span> {{ $user->getRoleNames()->first() ?? 'Paciente' }}</p>
                        </div>
                        <div class="absolute right-4 top-4 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-[#0b67c2]">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <button type="button" wire:click="confirmDelete({{ $user->id }})" class="text-[#ef4444]">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 px-4 backdrop-blur-sm" wire:click.self="cancelDelete">
            <div class="w-full max-w-sm rounded-[16px] bg-white p-6 shadow-xl relative border-[3px] border-[#0b67c2]">
                <div class="text-center">
                    <h3 class="mb-3 text-[22px] font-bold text-slate-900 leading-tight">¿Seguro que quieres<br>eliminar esta cuenta?</h3>
                    <p class="mb-6 text-[14px] text-slate-400">Una vez eliminada la cuenta, todos sus<br>datos se borrarán permanentemente y no<br>podrán ser recuperados de ninguna<br>manera.</p>
                    <button type="button" wire:click="deleteUser" class="mx-auto w-[200px] rounded-[8px] bg-[#b91c1c] py-3 text-[15px] font-bold text-white transition-opacity hover:opacity-90">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>
