@php
    $adminName = auth()->user()?->name ?: 'Administrador';

    $cards = [
        [
            'title' => 'Gestion de usuarios',
            'description' => 'Revisa medicos y farmaceuticos recien registrados y valida su cedula profesional para activar la cuenta.',
            'icon' => 'users',
            'href' => '#',
        ],
        [
            'title' => 'Bandeja de validacion',
            'description' => 'Bloquea cuentas, o da de baja perfiles por mal uso.',
            'icon' => 'document-check',
            'href' => '#',
        ],
    ];

    $icon = function (string $type): string {
        return match ($type) {
            'users' => '<i class="fa-solid fa-users text-[28px]" ></i>',
            'document-check' => '<i class="fa-solid fa-file-circle-exclamation text-[28px]"></i>',
            default => '',
        };
    };

    $chevron = '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 shrink-0 text-slate-900"><path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp

<div class="relative min-h-screen bg-slate-50">
    <main class="mx-auto flex min-h-screen w-full max-w-5xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full max-w-4xl flex-col gap-8">
            <div class="flex flex-col items-center gap-5 text-center md:items-start md:text-left">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.68] md:scale-75" />

                <div class="self-stretch space-y-1 pt-2 text-left">
                    <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Hola, {{ $adminName }}</h1>
                    <p class="text-[16px] font-medium text-slate-400 sm:text-[18px]">Administra y valida a los usuarios.</p>
                </div>
            </div>

            <section class="grid grid-cols-1 gap-6">
                @foreach ($cards as $card)
                    <a href="{{ $card['href'] }}" class="group flex items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-5 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01] sm:px-5">
                        <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                            {!! $icon($card['icon']) !!}
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <h2 class="text-[18px] font-bold text-slate-950">{{ $card['title'] }}</h2>
                            <p class="mt-1 text-[15px] leading-5 text-slate-400">{{ $card['description'] }}</p>
                        </div>
                        {!! $chevron !!}
                    </a>
                @endforeach
            </section>

            <form method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
                <button type="submit">Cerrar sesion</button>
            </form>
        </div>
    </main>

    <x-vitalia-bottom-nav active="home" />
</div>
