<div class="relative min-h-screen bg-white">
    <main class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
            </div>

            <div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.users.index') }}" class="text-slate-900">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <h1 class="text-[22px] font-bold text-slate-900">Editar usuario</h1>
                </div>
                <p class="ml-8 mt-1 text-[12px] text-slate-400">Solo puedes modificar el rol del usuario</p>
            </div>

            <div class="rounded-[24px] bg-[#f4f5f7] p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    @php
                        $parts = explode(' ', $user->name);
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                    @endphp
                    <div class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-full bg-[#dcdedf]">
                        <span class="text-[28px] font-bold text-[#0b67c2]">{{ $initials }}</span>
                    </div>
                    <div>
                        <h2 class="text-[15px] font-bold text-slate-900">{{ $user->email }}</h2>
                        <p class="text-[13px] text-slate-500"><span class="font-bold text-slate-900">Rol:</span> {{ $user->getRoleNames()->first() ?? 'Paciente' }}</p>
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    <div class="flex items-center justify-between border-b border-white pb-3">
                        <span class="text-[15px] font-bold text-slate-900">Nombre</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400">{{ $user->name }}</span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between border-b border-white pb-3">
                        <span class="text-[15px] font-bold text-slate-900">Email</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400">{{ $user->email }}</span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pb-2">
                        <span class="text-[15px] font-bold text-slate-900">Teléfono</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400">{{ $user->phone ?? '—' }}</span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-[16px] bg-white p-5 shadow-sm">
                    <label class="mb-2 block text-[15px] font-bold text-[#0b67c2]">Editar rol</label>
                    <select wire:model="role" class="w-full appearance-none rounded-[12px] border border-[#0b67c2] bg-white px-4 py-2.5 text-[14px] text-slate-500 outline-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M7%2010L12%2015L17%2010%22%20stroke%3D%22%23000%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E')] bg-[length:24px_24px] bg-[right_12px_center] bg-no-repeat pr-10">
                        @foreach($roles as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="w-full sm:flex-1 rounded-[12px] bg-[#f1f3f5] py-3.5 text-center text-[15px] font-bold text-slate-900 transition-opacity hover:opacity-80">
                    Cancelar
                </a>
                <button type="button" wire:click="save" class="w-full sm:flex-1 rounded-[12px] bg-[#0b67c2] py-3.5 text-center text-[15px] font-bold text-white transition-opacity hover:opacity-90">
                    Guardar cambios
                </button>
            </div>
        </div>
    </main>
    <x-vitalia-bottom-nav active="home" />
</div>
