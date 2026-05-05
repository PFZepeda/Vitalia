<div class="relative min-h-screen bg-slate-50">
<main class="mx-auto flex min-h-screen w-full max-w-6xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-8">
        <div class="flex flex-col items-center gap-5 text-center md:items-start md:text-left">
            <x-vitalia-logo class="scale-[0.58] sm:scale-[0.68] md:scale-75" />

            <div class="self-stretch space-y-1 pt-2 text-left">
                <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Hola, {{ $ownerName }}</h1>
                <p class="text-[16px] font-medium text-slate-400 sm:text-[18px]">Revisa tus apartados de hoy</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-2">
            <a href="#" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                    <path d="M7 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="7" cy="5" r="1.6" fill="currentColor"/>
                    <circle cx="7" cy="12" r="1.6" fill="currentColor"/>
                    <circle cx="7" cy="19" r="1.6" fill="currentColor"/>
                    <circle cx="16.5" cy="11.5" r="4.5" stroke="currentColor" stroke-width="2"/>
                    <path d="M16.5 9.5V11.8L18 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1 text-left">
                <h2 class="text-[18px] font-bold text-slate-950">Linea del tiempo de hoy</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Consulta tus tomas del dia y marca cada una de ellas.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

            <a href="#" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                    <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2" stroke-dasharray="32 8" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1 text-left">
                <h2 class="text-[18px] font-bold text-slate-950">Anillo de progreso</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Visualiza tu avance diario.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>

            <a href="#" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                    <path d="M7 4H14L18 8V20H7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M14 4V8H18" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M9 13H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M9 16H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M19 18L21.5 21H16.5L19 18Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1 text-left">
                <h2 class="text-[18px] font-bold text-slate-950">Alertas de Stock</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Recibe avisos de un medicamento está por terminarse.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>

            <a href="#" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                    <path d="M8 4H16L20 8V20H8V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M16 4V8H20" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M10 12H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M10 16H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1 text-left">
                <h2 class="text-[18px] font-bold text-slate-950">Recordatorio del médico</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Revisa notas del médico o nuevas preinscripciones digitales.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
            <button type="submit">Cerrar sesion</button>
        </form>
    </div>
</main>

<x-vitalia-bottom-nav active="home" />
</div>
