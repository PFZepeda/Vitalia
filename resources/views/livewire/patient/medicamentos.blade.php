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
                        Mis tomas
                    </h1>
                </div>
            </div>
            <!-- Alertas de interacciones -->
            @if(!empty($doseInteractions) && count($doseInteractions) > 0)
                <div class="flex flex-col gap-4">
                    @foreach($doseInteractions as $interaction)
                        @php
                            $bgColor = $interaction['severity'] === 'danger' 
                                ? 'bg-red-100 border-red-300' 
                                : 'bg-yellow-100 border-yellow-300';
                            $iconColor = $interaction['severity'] === 'danger' 
                                ? 'text-red-600' 
                                : 'text-yellow-600';
                            $textColor = $interaction['severity'] === 'danger' 
                                ? 'text-red-800' 
                                : 'text-yellow-800';
                        @endphp
                        <div class="rounded-[16px] border-2 {{ $bgColor }} px-4 py-4 shadow-sm">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 flex-shrink-0">
                                    <i class="fa-solid fa-exclamation-triangle {{ $iconColor }} text-[20px]"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold {{ $textColor }}">
                                        ⚠️ Interacción medicamentosa detectada
                                    </p>
                                    <p class="mt-2 text-[13px] font-semibold {{ $textColor }} sm:text-[14px]">
                                        <strong>{{ $interaction['medication_1'] }}</strong> + <strong>{{ $interaction['medication_2'] }}</strong>
                                    </p>
                                    <p class="mt-2 text-[12px] {{ $textColor }} sm:text-[13px]">
                                        {{ $interaction['interaction_message'] }}
                                    </p>
                                    @if($interaction['severity'] === 'danger')
                                        <p class="mt-2 text-[11px] font-bold text-red-700 sm:text-[12px]">
                                            ⚠️ Esta interacción requiere precaución. Consulte con su médico.
                                        </p>
                                    @endif
                                    <p class="mt-2 text-[11px] text-slate-600 sm:text-[12px]">
                                        Hora de toma: <strong>{{ \Carbon\Carbon::parse($interaction['scheduled_at'])->format('h:i A') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Lista de tomas -->
            @if($doses && $doses->isNotEmpty())
                <div class="flex flex-col gap-5">
                    @foreach($doses as $dose)
                        @php
                            $status = $dose->status;
                            $prescription = $dose->prescription;
                            $cardTone = $status === 'taken'
                                ? 'bg-[#d1fae5]'
                                : ($status === 'missed' ? 'bg-[#fee2e2]' : 'bg-[#e9ebed]');
                            $now = \Carbon\Carbon::now();
                            $canInteract = $status === 'pending'
                                && $dose->scheduled_at
                                && $now->between($dose->scheduled_at->copy()->subMinutes(15), $dose->scheduled_at->copy()->addMinutes(30));
                        @endphp
                        <div class="rounded-[22px] {{ $cardTone }} px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                            <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                                <div class="min-w-0">
                                    <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                        {{ $prescription?->medication?->medication_name ?? 'Medicamento sin asignar' }}
                                    </h2>
                                    <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                        @if($prescription?->dose !== null && $prescription?->dose_unit)
                                            Dosis: {{ $prescription->dose + 0 }} {{ $prescription->dose_unit }}
                                        @else
                                            Dosis por confirmar
                                        @endif
                                    </p>
                                    @if($prescription?->pill_count)
                                        <p class="mt-2 text-[12px] font-semibold text-slate-500 sm:text-[14px]">Pastillas: {{ $prescription->pill_count }}</p>
                                    @endif
                                    @if($prescription?->frequency_hours)
                                        <p class="mt-1 text-[12px] font-semibold text-slate-500 sm:text-[14px]">Frecuencia: Cada {{ $prescription->frequency_hours }} horas</p>
                                    @endif
                                    @if($status === 'taken' && $dose->taken_at)
                                        <p class="mt-2 text-[12px] font-semibold text-emerald-700 sm:text-[14px]">Pastilla tomada a las {{ $dose->taken_at->format('h:i a') }}</p>
                                    @endif
                                    @if($status === 'missed')
                                        @php
                                            $missReason = $dose->miss_reason === 'Otro' && $dose->miss_other
                                                ? $dose->miss_other
                                                : $dose->miss_reason;
                                            $missReason = $missReason ?: 'No especificado';
                                        @endphp
                                        <p class="mt-2 text-[12px] font-semibold text-red-700 sm:text-[14px]">Toma omitida. Motivo: {{ $missReason }}</p>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                        Hora de toma
                                    </p>
                                    <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                        @if($dose->scheduled_at)
                                            {{ $dose->scheduled_at->format('h:i A') }}
                                        @else
                                            Sin hora
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($canInteract)
                                <div class="mt-6 grid grid-cols-2 gap-4">
                                    <button wire:click="openTakeModal({{ $dose->id }})"
                                        class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                                        Registra toma
                                    </button>

                                    <button wire:click="openOmitModal({{ $dose->id }})"
                                        class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                                        Registra omisión
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    @if($showTakeModal && $this->selectedDose)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div class="w-full max-w-sm rounded-[28px] border-4 border-[#2f67c7] bg-white p-6 shadow-2xl">
                <h3 class="text-[20px] font-bold text-slate-950">
                    {{ $this->selectedDose->prescription?->medication?->medication_name ?? 'Medicamento sin asignar' }}
                    @if($this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit)
                        {{ $this->selectedDose->prescription->dose + 0 }}{{ $this->selectedDose->prescription->dose_unit }}
                    @endif
                </h3>

                <div class="mt-4 space-y-2 text-[14px] font-semibold text-slate-600">
                    <p>Toma: <span class="text-slate-900">{{ $actionTime ? \Carbon\Carbon::parse($actionTime)->format('h:i a') : '—' }}</span></p>
                    <p>Dosis: <span class="text-slate-900">{{ $this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit ? ($this->selectedDose->prescription->dose + 0) . ' ' . $this->selectedDose->prescription->dose_unit : 'Sin dosis' }}</span></p>
                    <p>Pastillas: <span class="text-slate-900">{{ $this->selectedDose->prescription?->pill_count ?? '—' }}</span></p>
                    <p>Frecuencia: <span class="text-slate-900">{{ $this->selectedDose->prescription?->frequency_hours ? 'Cada ' . $this->selectedDose->prescription->frequency_hours . ' horas' : 'Sin frecuencia' }}</span></p>
                </div>

                <div class="mt-8 space-y-3">
                    <button wire:click="confirmTake"
                        class="w-full rounded-full bg-[#2f67c7] px-4 py-3 text-[14px] font-bold text-white transition hover:bg-[#2557ab]">
                        Confirmar toma
                    </button>
                    <button wire:click="closeActionModal"
                        class="w-full rounded-full bg-slate-100 px-4 py-3 text-[14px] font-bold text-slate-700 transition hover:bg-slate-200">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($showOmitModal && $this->selectedDose)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div class="w-full max-w-md rounded-[28px] border-4 border-[#2f67c7] bg-white p-6 shadow-2xl">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-[20px] font-bold text-slate-950">
                            {{ $this->selectedDose->prescription?->medication?->medication_name ?? 'Medicamento sin asignar' }}
                            @if($this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit)
                                {{ $this->selectedDose->prescription->dose + 0 }}{{ $this->selectedDose->prescription->dose_unit }}
                            @endif
                        </h3>
                        <p class="mt-1 text-[13px] font-semibold text-slate-500">
                            {{ $this->selectedDose->prescription?->pill_count ?? '—' }} pastilla
                            @if($this->selectedDose->prescription?->frequency_hours)
                                * cada {{ $this->selectedDose->prescription->frequency_hours }} horas
                            @endif
                        </p>
                    </div>
                    <div class="text-right text-[13px] font-semibold text-slate-500">
                        Hora de omisión:
                        <div class="text-slate-900">{{ $actionTime ? \Carbon\Carbon::parse($actionTime)->format('h:i a') : '—' }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-[14px] font-bold text-slate-900">Razón de omisión</p>
                    @php
                        $reasons = [
                            'Olvido' => 'fa-regular fa-clock',
                            'Efecto adverso' => 'fa-regular fa-face-frown',
                            'No tenia medicamento' => 'fa-solid fa-pills',
                            'Otro' => 'fa-solid fa-ellipsis',
                        ];
                    @endphp
                    <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
                        @foreach($reasons as $reason => $icon)
                            @php
                                $selected = $omissionReason === $reason;
                                $dimmed = $omissionReason && ! $selected;
                                $classes = $selected
                                    ? 'bg-[#2f67c7] text-white border-[#2f67c7]'
                                    : ($dimmed ? 'bg-slate-200 text-slate-400 border-slate-200' : 'bg-slate-100 text-slate-700 border-slate-200');
                            @endphp
                            <button type="button" wire:click="selectOmissionReason('{{ $reason }}')"
                                class="relative flex flex-col items-center justify-center gap-2 rounded-[16px] border px-3 py-4 text-center text-[12px] font-semibold transition {{ $classes }}">
                                <span class="absolute left-2 top-2 h-3 w-3 rounded-full border border-slate-700 {{ $selected ? 'bg-black border-black' : 'bg-white' }}"></span>
                                <i class="{{ $icon }} text-[18px]"></i>
                                <span>{{ $reason }}</span>
                            </button>
                        @endforeach
                    </div>
                    @error('omissionReason')
                        <span class="mt-2 block text-[11px] font-semibold text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                @if($omissionReason === 'Otro')
                    <div class="mt-6">
                        <div class="flex items-center justify-between">
                            <label class="text-[14px] font-bold text-slate-900">Otro</label>
                            <span class="text-[11px] text-slate-500">{{ strlen($omissionOther ?? '') }}/250</span>
                        </div>
                        <textarea wire:model.live="omissionOther" maxlength="250" rows="3"
                            class="mt-2 w-full rounded-[16px] border border-slate-200 bg-slate-100 px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#2f67c7] focus:ring-1 focus:ring-[#2f67c7]"
                            placeholder="Escribe el motivo"></textarea>
                        @error('omissionOther')
                            <span class="mt-2 block text-[11px] font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="mt-8 space-y-3">
                    <button wire:click="confirmOmission"
                        class="w-full rounded-full bg-[#2f67c7] px-4 py-3 text-[14px] font-bold text-white transition hover:bg-[#2557ab]">
                        Confirmar omisión
                    </button>
                    <button wire:click="closeActionModal"
                        class="w-full rounded-full bg-slate-100 px-4 py-3 text-[14px] font-bold text-slate-700 transition hover:bg-slate-200">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <x-vitalia-bottom-nav active="home" />
</div>