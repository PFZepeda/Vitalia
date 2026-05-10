<main class="min-h-screen">
    <div class="mx-auto flex min-h-screen w-full max-w-lg flex-col items-center justify-center px-6 py-12">
        <x-vitalia-logo class="mb-4" />

        <div class="w-full rounded-[22px] bg-white p-6 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[20px] font-bold text-slate-900">Nueva Contrasena</h1>

            <form class="mt-4 space-y-4" wire:submit.prevent="save">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Ingresa nueva contrasena</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="{{ $passwordVisible ? 'text' : 'password' }}"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="Al menos 8 caracteres"
                            wire:model="password"
                            autocomplete="new-password"
                        />
                        <button
                            type="button"
                            class="px-3 py-2 text-[12px] font-semibold text-[#2f7ac9]"
                            wire:click="togglePasswordVisibility"
                        >
                            {{ $passwordVisible ? 'Ocultar' : 'Mostrar' }}
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Confirmar contrasena</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="{{ $confirmPasswordVisible ? 'text' : 'password' }}"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="Al menos 8 caracteres"
                            wire:model="password_confirmation"
                            autocomplete="new-password"
                        />
                        <button
                            type="button"
                            class="px-3 py-2 text-[12px] font-semibold text-[#2f7ac9]"
                            wire:click="toggleConfirmPasswordVisibility"
                        >
                            {{ $confirmPasswordVisible ? 'Ocultar' : 'Mostrar' }}
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3">
                    <button
                        type="submit"
                        class="w-full rounded-[12px] bg-[#0b67c2] py-3 text-[16px] font-bold text-white transition-opacity disabled:opacity-70"
                        wire:loading.attr="disabled"
                        wire:target="save"
                    >
                        <span wire:loading.remove wire:target="save">Guardar cambios</span>
                        <span wire:loading wire:target="save">Guardando...</span>
                    </button>

                    <a href="{{ route('login') }}" class="text-center text-[12px] font-semibold text-[#2f7ac9]">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>
