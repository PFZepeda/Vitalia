@php
    use Carbon\Carbon;
    $user = auth()->user();
    $age = $user && $user->birth_date ? Carbon::parse($user->birth_date)->age : null;
@endphp

@component('layouts.app', ['title' => 'Mi información'])
    <div class="relative min-h-screen bg-slate-50">
        <main
            class="mx-auto flex min-h-screen w-full max-w-2xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
            <div class="mx-auto flex w-full max-w-xl flex-col items-stretch gap-6 sm:gap-8">
                <div>
                    <a href="{{ route('profile.dashboard') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01]">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Regresar
                    </a>
                </div>

                <section class="flex flex-col items-center text-center">
                    <x-vitalia-logo class="scale-[0.48] sm:scale-[0.58] md:scale-[0.66]" />

                    <div class="mt-4 space-y-2">
                        <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Mi
                            información</h1>
                        <p class="mx-auto max-w-lg text-[16px] leading-6 text-slate-400 sm:text-[18px]">
                            Aquí puedes ver tus datos principales de perfil.
                        </p>
                    </div>
                </section>

                <section class="mt-6 rounded-3xl bg-white p-6 shadow-[0_6px_20px_rgba(15,23,42,0.05)]">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm text-slate-400">Nombre completo</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $user->name ?? '—' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Correo</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $user->email ?? '—' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Teléfono</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $user->phone ?? '—' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Fecha de nacimiento</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">
                                {{ $user->birth_date ? Carbon::parse($user->birth_date)->format('d/m/Y') : '—' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Edad</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $age !== null ? $age . ' años' : '—' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Peso</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $user->weight ?? '—' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Altura</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $user->height ?? '—' }}</dd>
                        </div>
                    </dl>
                </section>
            </div>
        </main>

        <x-vitalia-bottom-nav active="profile" />
    </div>
@endcomponent
