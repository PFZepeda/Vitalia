<main class="min-h-screen" wire:poll.1s>
    <div class="mx-auto flex min-h-screen w-full max-w-lg flex-col items-center justify-center px-6 py-12">
        <x-vitalia-logo class="mb-4" />

        <div class="w-full rounded-[22px] bg-white p-6 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[20px] font-bold text-slate-900">Validar Codigo</h1>
            <p class="mt-1 text-[12px] text-slate-500">
                Ingresa el codigo de recuperacion enviado a tu correo.
            </p>

            <form class="mt-4 space-y-4" wire:submit.prevent="verifyCode">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Codigo</label>
                    <input
                        type="text"
                        inputmode="numeric"
                        maxlength="6"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="Ingresa tu codigo"
                        wire:model.defer="code"
                    />
                    @error('code')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button
                        type="submit"
                        class="flex-1 rounded-[12px] bg-[#0b67c2] py-3 text-[14px] font-bold text-white transition-opacity disabled:opacity-70"
                        wire:loading.attr="disabled"
                        wire:target="verifyCode"
                    >
                        <span wire:loading.remove wire:target="verifyCode">Continuar</span>
                        <span wire:loading wire:target="verifyCode">Validando...</span>
                    </button>

                    @php($cooldown = $this->cooldownRemaining)
                    <button
                        type="button"
                        class="flex-1 rounded-[12px] bg-slate-200 py-3 text-[14px] font-semibold text-slate-600 transition-opacity disabled:opacity-70"
                        wire:click="resendCode"
                        @disabled($cooldown > 0)
                    >
                        {{ $cooldown > 0 ? "Solicitar Codigo ({$cooldown}s)" : 'Solicitar Codigo' }}
                    </button>
                </div>
            </form>

            @if ($statusMessage)
                <p class="mt-3 text-center text-[12px] text-emerald-600">{{ $statusMessage }}</p>
            @endif

            @if ($errorMessage)
                <p class="mt-3 text-center text-[12px] text-red-600">{{ $errorMessage }}</p>
            @endif

            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-[12px] font-semibold text-[#2f7ac9]">
                    Volver
                </a>
            </div>
        </div>
    </div>
</main>
