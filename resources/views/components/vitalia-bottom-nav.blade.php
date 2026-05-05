@props([
    'active' => 'home',
    'items' => null,
])

@php
    $defaultItems = [
        [
            'key' => 'home',
            'label' => 'Inicio',
            'href' => route('dashboard'),
            'icon' => 'home',
        ],
        [
            'key' => 'profile',
            'label' => 'Mi perfil',
            'href' => route('profile.dashboard'),
            'icon' => 'profile',
        ],
    ];

    $navigationItems = $items ?? $defaultItems;

    $icon = function (string $type, bool $isActive): string {
        $stroke = $isActive ? '#0b67c2' : '#111111';

        return match ($type) {
            'home' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"><path d="M4 10.5L12 4L20 10.5V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V10.5Z" stroke="' . $stroke . '" stroke-width="2" stroke-linejoin="round"/><path d="M9 21V14H15V21" stroke="' . $stroke . '" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'profile' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"><path d="M20 21C20 18.2386 17.3137 16 14 16H10C6.68629 16 4 18.2386 4 21" stroke="' . $stroke . '" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="8" r="4" stroke="' . $stroke . '" stroke-width="2"/></svg>',
            default => '',
        };
    };
@endphp

<nav class="fixed inset-x-0 bottom-0 z-50 px-3 pb-[calc(0.75rem+env(safe-area-inset-bottom))] sm:px-4">
    <div class="mx-auto max-w-md rounded-t-[22px] border border-slate-200/70 bg-white/95 px-3 py-3 shadow-[0_-8px_30px_rgba(15,23,42,0.08)] backdrop-blur sm:max-w-lg md:max-w-xl lg:max-w-2xl">
        <div class="grid grid-cols-2 gap-2">
            @foreach ($navigationItems as $item)
                @php
                    $isActive = $active === ($item['key'] ?? null);
                @endphp

                <a
                    href="{{ $item['href'] ?? '#' }}"
                    class="flex flex-col items-center justify-center rounded-[18px] px-2 py-2 transition-colors {{ $isActive ? 'bg-[#eef6fd] text-[#0b67c2]' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700' }}"
                    @if ($isActive) aria-current="page" @endif
                >
                    <span class="flex h-11 w-11 items-center justify-center">
                        {!! $icon($item['icon'] ?? 'home', $isActive) !!}
                    </span>
                    <span class="mt-1 text-[11px] font-semibold leading-none">{{ $item['label'] ?? '' }}</span>
                </a>
            @endforeach
        </div>
    </div>
</nav>