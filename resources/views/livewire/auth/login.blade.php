<main class="min-h-screen">
    <div class="mx-auto flex min-h-screen w-full max-w-lg flex-col items-center justify-center px-6 py-12">
        <x-vitalia-logo class="mb-4" />

        <div class="w-full rounded-[20px] bg-white p-5 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[22px] font-bold text-slate-900">Bienvenido</h1>
            <p class="mt-1 text-[13px] text-slate-500">Por favor, ingresa tus datos para acceder.</p>

            <form class="mt-4 space-y-4" wire:submit.prevent="login">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Correo electronico</label>
                    <input
                        type="email"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="correo@ejemplo.com"
                        wire:model="email"
                        autocomplete="email"
                    />
                    @error('email')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Contrasena</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="{{ $passwordVisible ? 'text' : 'password' }}"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="********"
                            wire:model="password"
                            autocomplete="current-password"
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

                <div class="flex justify-end">
                    <a href="{{ route('password.request') }}" class="text-[12px] font-semibold text-[#2f7ac9]">
                        Olvidaste tu Contrasena?
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-[12px] bg-[#0b67c2] py-3 text-[16px] font-bold text-white transition-opacity disabled:opacity-70"
                    wire:loading.attr="disabled"
                    wire:target="login"
                >
                    <span wire:loading.remove wire:target="login">Iniciar Sesion</span>
                    <span wire:loading wire:target="login">Ingresando...</span>
                </button>
            </form>

            @if ($errors->has('form'))
                <p class="mt-3 text-center text-[12px] text-red-600">{{ $errors->first('form') }}</p>
            @endif

            @if (session('status'))
                <p class="mt-3 text-center text-[12px] text-emerald-600">{{ session('status') }}</p>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ route('register') }}" class="text-[12px] font-semibold text-[#2f7ac9]">
                    No tienes cuenta? Registrate
                </a>
            </div>
        </div>
    </div>
</main>
