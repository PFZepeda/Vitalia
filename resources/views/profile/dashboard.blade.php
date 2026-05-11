<div class="relative min-h-screen bg-slate-50">
    <main
        class="mx-auto flex min-h-screen w-full max-w-2xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
        <div class="mx-auto flex w-full max-w-xl flex-col items-stretch gap-6 sm:gap-8">
            <section class="flex flex-col items-center text-center">
                <x-vitalia-logo class="scale-[0.48] sm:scale-[0.58] md:scale-[0.66]" />

                <div class="mt-4 space-y-2">
                    <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Mi
                        perfil</h1>
                    <p class="mx-auto max-w-lg text-[16px] leading-6 text-slate-400 sm:text-[18px]">
                        Aquí se encuentran los ajustes principales de la cuenta.
                    </p>
                </div>
            </section>

            <section class="flex flex-col items-center gap-4 sm:gap-5">
                <div class="relative">
                    @if ($this->profilePhotoUrl)
                        <img src="{{ $this->profilePhotoUrl }}" alt="Foto de perfil de {{ $ownerName }}"
                            class="h-44 w-44 rounded-full object-cover ring-4 ring-white shadow-[0_14px_40px_rgba(15,23,42,0.08)] sm:h-52 sm:w-52 md:h-56 md:w-56" />
                    @else
                        <div
                            class="flex h-44 w-44 items-center justify-center rounded-full bg-slate-200 text-[74px] font-semibold text-[#0b67c2] ring-4 ring-white shadow-[0_14px_40px_rgba(15,23,42,0.08)] sm:h-52 sm:w-52 sm:text-[88px] md:h-56 md:w-56 md:text-[94px]">
                            {{ $this->initials }}
                        </div>
                    @endif

                    <label for="profile-photo"
                        class="absolute right-0 bottom-3 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-4 border-white bg-white text-slate-700 shadow-[0_10px_22px_rgba(15,23,42,0.16)] transition hover:scale-105">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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

                    <p class="mt-3 text-[12px] text-slate-400 sm:text-[13px]">La foto es opcional. Toca el botón + para
                        subir una nueva.</p>
                </div>
            </section>

            @php
                $user = auth()->user();
                $isCaregiver = $user?->hasRole(\App\Support\RoleNames::CAREGIVER) ?? false;
                $isPatient = $user?->hasRole(\App\Support\RoleNames::PATIENT) ?? false;
                $isDoctor = $user?->hasRole(\App\Support\RoleNames::DOCTOR) ?? false;
                $isPharmacist = $user?->hasRole(\App\Support\RoleNames::PHARMACIST) ?? false;
                $isAdmin = $user?->hasRole(\App\Support\RoleNames::ADMIN) ?? false;
            @endphp

            <section class="grid grid-cols-1 gap-4 sm:gap-5">
                @if ($isCaregiver || $isPatient || $isDoctor || $isPharmacist || $isAdmin)
                    <a href="{{ route('profile.information') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2" />
                                <path d="M7 12H9L10.5 9L13 15L14.5 12H17" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Mi biometría</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Actualiza tu información
                                médica.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                @if ($isCaregiver)
                    <a href="{{ route('profile.view-patients') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" />
                                <path d="M4 20C4 16.686 6.686 14 10 14H14C17.314 14 20 16.686 20 20"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Pacientes Vinculados</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Verifica el estado de
                                los pacientes y poder ver sus estadísticas.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>

                    <a href="{{ route('profile.be-patient') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">

                            <i class="fa-solid fa-user-injured text-[40px]" aria-hidden="true"></i>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Volverse Paciente</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Registrar tu cuenta como
                                paciente y acceder a sus beneficios.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                @if ($isPatient)
                    <a href="{{ route('profile.be-caregiver') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <circle cx="9.5" cy="8.5" r="3" stroke="currentColor"
                                    stroke-width="2" />
                                <path d="M3.5 19C3.5 16.2 6.2 14 9.5 14C12.8 14 15.5 16.2 15.5 19"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M17.2 9.2C17.7 8.3 18.9 8.1 19.7 8.7C20.6 9.4 20.7 10.7 20 11.6L17.2 14.2L14.4 11.6C13.7 10.7 13.8 9.4 14.7 8.7C15.5 8.1 16.7 8.3 17.2 9.2Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Volverse Cuidador</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Vuélvete cuidador de un
                                paciente y poder ver sus estadísticas.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                @if ($isDoctor)
                    <a href="{{ route('profile.professional-data') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <rect x="4" y="6" width="16" height="12" rx="2" stroke="currentColor"
                                    stroke-width="2" />
                                <circle cx="9" cy="11" r="2" stroke="currentColor"
                                    stroke-width="2" />
                                <path d="M7 16C7.4 14.8 8.6 14 10 14C11.4 14 12.6 14.8 13 16" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" />
                                <path d="M14.5 10H18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                                <path d="M14.5 13H18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Perfil Profesional</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Administra tu
                                informacion profesional.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                @if ($isPharmacist)
                    <a href="{{ route('profile.professional-data') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <rect x="4" y="6" width="16" height="12" rx="2" stroke="currentColor"
                                    stroke-width="2" />
                                <circle cx="9" cy="11" r="2" stroke="currentColor"
                                    stroke-width="2" />
                                <path d="M7 16C7.4 14.8 8.6 14 10 14C11.4 14 12.6 14.8 13 16" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" />
                                <path d="M14.5 10H18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                                <path d="M14.5 13H18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Perfil Profesional</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Administra tus datos
                                profesionales.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                @if ($isPatient)
                    <a href="{{ route('profile.view-doctors') }}"
                        class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <path d="M7 4H14L18 8V20H7V4Z" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M14 4V8H18" stroke="currentColor" stroke-width="2"
                                    stroke-linejoin="round" />
                                <path d="M12 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M9 14H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Mis Médicos</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Gestiona tus médicos.
                            </p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif

                <a href="{{ route('profile.security') }}"
                    class="flex h-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                    <div
                        class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-10 w-10">
                            <rect x="6" y="11" width="12" height="9" rx="2" stroke="currentColor"
                                stroke-width="2" />
                            <path d="M9 11V8C9 6.343 10.343 5 12 5C13.657 5 15 6.343 15 8V11" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" />
                            <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 text-left">
                        <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Seguridad</h2>
                        <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Actualiza tus contraseñas o
                            tus preguntas de seguridad.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex h-full w-full items-center gap-4 rounded-3xl bg-white px-4 py-4 shadow-[0_6px_20px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div
                            class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#fdecea] text-[#c0392b] sm:h-20 sm:w-24">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <path d="M10 4H6C4.895 4 4 4.895 4 6V18C4 19.105 4.895 20 6 20H10"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M14 16L18 12L14 8" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 12H18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Cerrar sesión</h2>
                            <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Cerrar tu sesión de la
                                aplicación.</p>
                        </div>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 shrink-0 text-slate-950 sm:h-9 sm:w-9">
                            <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </section>
        </div>
    </main>

    <x-vitalia-bottom-nav active="profile" />
</div>
