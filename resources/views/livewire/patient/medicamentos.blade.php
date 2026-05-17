<div class="relative min-h-screen bg-slate-100">
    <main class="mx-auto min-h-screen w-full max-w-[430px] px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-4 sm:max-w-3xl sm:px-6 sm:pt-6">

        <div class="mx-auto flex w-full flex-col gap-6">
            <!-- Header -->
            <div class="flex flex-col items-center">
                <x-vitalia-logo class="scale-[0.58] sm:scale-[0.68] md:scale-75" />

                <div class="mt-2 flex w-full items-center gap-4">
                    <a href="{{ route('patient.dashboard') }}"
                       class="inline-flex shrink-0 items-center justify-center text-slate-700 transition hover:text-slate-900">
                        <i class="fa-solid fa-chevron-left text-[24px] sm:text-3xl"></i>
                    </a>

                    <h1 class="text-[26px] font-bold leading-tight text-slate-950 sm:text-[34px] md:text-[38px]">
                        Recetas del Médico
                    </h1>
                </div>
            </div>

            <!-- Lista de tomas -->
            <div class="flex flex-col gap-5">

                <!-- Card 1 -->
                <div class="rounded-[22px] bg-[#e9ebed] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                        <div class="min-w-0">
                            <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                Ibuprofeno 400mg
                            </h2>
                            <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                1 pastilla * cada 6 horas
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                Hora de toma
                            </p>
                            <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                8:00 AM
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                            Registra toma
                        </button>

                        <button class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                            Registra omisión
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-[22px] bg-[#e9ebed] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                        <div class="min-w-0">
                            <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                Tramadol 50mg
                            </h2>
                            <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                1 pastilla * cada 6 horas
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                Hora de toma
                            </p>
                            <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                9:00 AM
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                            Registra toma
                        </button>

                        <button class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                            Registra omisión
                        </button>
                    </div>
                </div>

                <!-- Card 3 destacada -->
                <div class="rounded-[22px] border-[4px] border-[#3b82f6] bg-[#e9ebed] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                        <div class="min-w-0">
                            <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                Naproxeno 250mg
                            </h2>
                            <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                1 pastilla * cada 6 horas
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                Hora de toma
                            </p>
                            <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                10:00 AM
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                            Registra toma
                        </button>

                        <button class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                            Registra omisión
                        </button>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="rounded-[22px] bg-[#e9ebed] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                        <div class="min-w-0">
                            <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                Prednisona 5mg
                            </h2>
                            <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                1 pastilla * cada 6 horas
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                Hora de toma
                            </p>
                            <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                11:00 AM
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <button class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                            Registra toma
                        </button>

                        <button class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                            Registra omisión
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-vitalia-bottom-nav active="home" />
</div>