<main class="min-h-screen">
    <div class="mx-auto flex min-h-screen w-full max-w-2xl flex-col items-center justify-center px-6 py-12">
        <x-vitalia-logo class="mb-4" />

        <div class="w-full rounded-[20px] bg-white p-5 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[22px] font-bold text-slate-900">Registrate</h1>
            <p class="mt-1 text-[12px] text-slate-500">
                Por favor, completa tu informacion para el registro. Los campos con * son obligatorios.
            </p>

            <form class="mt-4 space-y-4" wire:submit.prevent="register">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Nombre completo *</label>
                    <input
                        type="text"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="Tu nombre"
                        wire:model="name"
                        autocomplete="name"
                    />
                    @error('name')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Correo electronico *</label>
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
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Telefono *</label>
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <select
                            class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 sm:w-[180px]"
                            wire:model="countryCode"
                        >
                            @foreach ($countryOptions as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }} ({{ $option['value'] }})</option>
                            @endforeach
                        </select>
                        <input
                            type="tel"
                            class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                            placeholder="(000) 000-0000"
                            wire:model="phoneLocal"
                            autocomplete="tel"
                        />
                    </div>
                    @error('phoneLocal')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Pregunta de seguridad *</label>
                    <select
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900"
                        wire:model="securityQuestion"
                    >
                        <option value="">Selecciona una pregunta</option>
                        @foreach ($securityOptions as $question)
                            <option value="{{ $question }}">{{ $question }}</option>
                        @endforeach
                    </select>
                    @error('securityQuestion')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Respuesta de seguridad *</label>
                    <input
                        type="text"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="Escribe tu respuesta"
                        wire:model="securityAnswer"
                    />
                    @error('securityAnswer')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Sexo *</label>
                        <select
                            class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900"
                            wire:model="sex"
                        >
                            <option value="">Selecciona una opcion</option>
                            @foreach ($sexOptions as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                        @error('sex')
                            <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Fecha de nacimiento *</label>
                        <input
                            type="date"
                            class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900"
                            wire:model="birthDate"
                        />
                        @error('birthDate')
                            <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Contrasena *</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="{{ $passwordVisible ? 'text' : 'password' }}"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="********"
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
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Confirmar contrasena *</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="{{ $confirmPasswordVisible ? 'text' : 'password' }}"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="********"
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

                <button
                    type="submit"
                    class="w-full rounded-[12px] bg-[#0b67c2] py-3 text-[16px] font-bold text-white transition-opacity disabled:opacity-70"
                    wire:loading.attr="disabled"
                    wire:target="register"
                >
                    <span wire:loading.remove wire:target="register">Registrarse</span>
                    <span wire:loading wire:target="register">Registrando...</span>
                </button>
            </form>

            @if ($errors->has('form'))
                <p class="mt-3 text-center text-[12px] text-red-600">{{ $errors->first('form') }}</p>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-[12px] font-semibold text-[#2f7ac9]">
                    <- Volver al inicio de sesion
                </a>
            </div>
        </div>
    </div>
</main>
