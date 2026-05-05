<div class="relative min-h-screen bg-slate-50">
    <main class="mx-auto flex min-h-screen w-full max-w-2xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
        <div class="mx-auto flex w-full max-w-xl flex-col items-stretch gap-6 sm:gap-8">
            <section class="flex flex-col items-center text-center">
                <x-vitalia-logo class="scale-[0.48] sm:scale-[0.58] md:scale-[0.66]" />

                <div class="mt-4 space-y-2">
                    <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Mi perfil</h1>
                    <p class="mx-auto max-w-lg text-[16px] leading-6 text-slate-400 sm:text-[18px]">
                        Aquí se encuentran los ajustes principales de la cuenta.
                    </p>
                </div>
            </section>

            <section class="flex flex-col items-center gap-4 sm:gap-5">
                <div class="relative">
                    @if ($this->profilePhotoUrl)
                        <img src="{{ $this->profilePhotoUrl }}" alt="Foto de perfil de {{ $ownerName }}" class="h-44 w-44 rounded-full object-cover ring-4 ring-white shadow-[0_14px_40px_rgba(15,23,42,0.08)] sm:h-52 sm:w-52 md:h-56 md:w-56" />
                    @else
                        <div class="flex h-44 w-44 items-center justify-center rounded-full bg-slate-200 text-[74px] font-semibold text-[#0b67c2] ring-4 ring-white shadow-[0_14px_40px_rgba(15,23,42,0.08)] sm:h-52 sm:w-52 sm:text-[88px] md:h-56 md:w-56 md:text-[94px]">
                            {{ $this->initials }}
                        </div>
                    @endif

                    <label for="profile-photo" class="absolute right-0 bottom-3 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-4 border-white bg-white text-slate-700 shadow-[0_10px_22px_rgba(15,23,42,0.16)] transition hover:scale-105">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </label>
                </div>

                <div class="text-center">
                    <p class="text-[18px] font-semibold text-slate-950 sm:text-[20px]">{{ $ownerName }}</p>
                    <p class="mt-1 text-[14px] text-slate-500 sm:text-[15px]">{{ $email }}</p>

                    <input id="profile-photo" type="file" class="hidden" wire:model="photo" accept="image/*" />

                    @error('photo')
                        <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if ($statusMessage)
                        <p class="mt-3 text-sm text-emerald-600">{{ $statusMessage }}</p>
                    @endif

                    <p class="mt-3 text-[12px] text-slate-400 sm:text-[13px]">La foto es opcional. Toca el botón + para subir una nueva.</p>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 sm:gap-5">
                <a href="{{ route('profile.information') }}" class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2" stroke-dasharray="32 8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Mi biometría</h2>
                        <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Actualiza tu información médica.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <a href="#" class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <path d="M4 19C4 15.134 7.13401 12 11 12C14.866 12 18 15.134 18 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="11" cy="8" r="4" stroke="currentColor" stroke-width="2"/>
                            <path d="M18.5 10.5L20.2 12.1L23 9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Volverse Cuidador</h2>
                        <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Vuélvete cuidador de un paciente y poder ver sus estadísticas.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <a href="#" class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <path d="M7 4H14L18 8V20H7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M14 4V8H18" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M9 13H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M9 16H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Mis Médicos</h2>
                        <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Gestiona tus médicos.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <a href="{{ route('profile.security') }}" class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                    <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                            <path d="M8 10V8C8 5.79086 9.79086 4 12 4C14.2091 4 16 5.79086 16 8V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Seguridad</h2>
                        <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Actualiza tus contraseñas o tus preguntas de seguridad.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex h-full w-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#fdecea] text-[#c0392b] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                                <path d="M16 13V11H8V8L4 12L8 16V13H16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Cerrar sesión</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Cerrar tu sesión de la aplicación.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </section>
        </div>
    </main>

    <x-vitalia-bottom-nav active="profile" />
</div>