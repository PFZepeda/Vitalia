<div class="relative min-h-screen bg-slate-100">
    <main class="mx-auto min-h-screen w-full max-w-[430px] px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-4 sm:max-w-3xl sm:px-6 sm:pt-6">

        <div class="mx-auto flex w-full flex-col gap-6">
            <!-- Header -->
            <div class="flex flex-col items-center">
                <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'scale-[0.58] sm:scale-[0.68] md:scale-75']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'scale-[0.58] sm:scale-[0.68] md:scale-75']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1)): ?>
<?php $attributes = $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1; ?>
<?php unset($__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1)): ?>
<?php $component = $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1; ?>
<?php unset($__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1); ?>
<?php endif; ?>

                <div class="mt-2 flex w-full items-center gap-4">
                    <a href="<?php echo e(route('patient.dashboard')); ?>"
                       class="inline-flex shrink-0 items-center justify-center text-slate-700 transition hover:text-slate-900">
                        <i class="fa-solid fa-chevron-left text-[24px] sm:text-3xl"></i>
                    </a>

                    <h1 class="text-[26px] font-bold leading-tight text-slate-950 sm:text-[34px] md:text-[38px]">
                        Mis tomas
                    </h1>
                </div>
            </div>

            <!-- Lista de tomas -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($doses && $doses->isNotEmpty()): ?>
                <div class="flex flex-col gap-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $doses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dose): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $status = $dose->status;
                            $prescription = $dose->prescription;
                            $cardTone = $status === 'taken'
                                ? 'bg-[#d1fae5]'
                                : ($status === 'missed' ? 'bg-[#fee2e2]' : 'bg-[#e9ebed]');
                            $now = \Carbon\Carbon::now();
                            $canInteract = $status === 'pending'
                                && $dose->scheduled_at
                                && $now->between($dose->scheduled_at->copy()->subMinutes(15), $dose->scheduled_at->copy()->addMinutes(30));
                        ?>
                        <div class="rounded-[22px] <?php echo e($cardTone); ?> px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:px-5 sm:py-5">
                            <div class="grid grid-cols-[minmax(0,1fr)_auto] items-start gap-3">
                                <div class="min-w-0">
                                    <h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[22px]">
                                        <?php echo e($prescription?->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                                    </h2>
                                    <p class="mt-5 text-[13px] font-semibold text-slate-500 sm:text-[15px]">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription?->dose !== null && $prescription?->dose_unit): ?>
                                            Dosis: <?php echo e($prescription->dose + 0); ?> <?php echo e($prescription->dose_unit); ?>

                                        <?php else: ?>
                                            Dosis por confirmar
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription?->pill_count): ?>
                                        <p class="mt-2 text-[12px] font-semibold text-slate-500 sm:text-[14px]">Pastillas: <?php echo e($prescription->pill_count); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription?->frequency_hours): ?>
                                        <p class="mt-1 text-[12px] font-semibold text-slate-500 sm:text-[14px]">Frecuencia: Cada <?php echo e($prescription->frequency_hours); ?> horas</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'taken' && $dose->taken_at): ?>
                                        <p class="mt-2 text-[12px] font-semibold text-emerald-700 sm:text-[14px]">Pastilla tomada a las <?php echo e($dose->taken_at->format('h:i a')); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'missed'): ?>
                                        <?php
                                            $missReason = $dose->miss_reason === 'Otro' && $dose->miss_other
                                                ? $dose->miss_other
                                                : $dose->miss_reason;
                                            $missReason = $missReason ?: 'No especificado';
                                        ?>
                                        <p class="mt-2 text-[12px] font-semibold text-red-700 sm:text-[14px]">Toma omitida. Motivo: <?php echo e($missReason); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="text-right">
                                    <p class="text-[14px] font-bold text-slate-950 sm:text-[18px]">
                                        Hora de toma
                                    </p>
                                    <p class="mt-5 text-[14px] font-bold text-slate-500 sm:text-[18px]">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dose->scheduled_at): ?>
                                            <?php echo e($dose->scheduled_at->format('h:i A')); ?>

                                        <?php else: ?>
                                            Sin hora
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canInteract): ?>
                                <div class="mt-6 grid grid-cols-2 gap-4">
                                    <button wire:click="openTakeModal(<?php echo e($dose->id); ?>)"
                                        class="rounded-2xl bg-[#2f67c7] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#2557ab] sm:text-[15px]">
                                        Registra toma
                                    </button>

                                    <button wire:click="openOmitModal(<?php echo e($dose->id); ?>)"
                                        class="rounded-2xl bg-[#b91c1c] px-3 py-3 text-[13px] font-bold text-white transition hover:bg-[#991b1b] sm:text-[15px]">
                                        Registra omisión
                                    </button>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </main>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showTakeModal && $this->selectedDose): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div class="w-full max-w-sm rounded-[28px] border-4 border-[#2f67c7] bg-white p-6 shadow-2xl">
                <h3 class="text-[20px] font-bold text-slate-950">
                    <?php echo e($this->selectedDose->prescription?->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit): ?>
                        <?php echo e($this->selectedDose->prescription->dose + 0); ?><?php echo e($this->selectedDose->prescription->dose_unit); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h3>

                <div class="mt-4 space-y-2 text-[14px] font-semibold text-slate-600">
                    <p>Toma: <span class="text-slate-900"><?php echo e($actionTime ? \Carbon\Carbon::parse($actionTime)->format('h:i a') : '—'); ?></span></p>
                    <p>Dosis: <span class="text-slate-900"><?php echo e($this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit ? ($this->selectedDose->prescription->dose + 0) . ' ' . $this->selectedDose->prescription->dose_unit : 'Sin dosis'); ?></span></p>
                    <p>Pastillas: <span class="text-slate-900"><?php echo e($this->selectedDose->prescription?->pill_count ?? '—'); ?></span></p>
                    <p>Frecuencia: <span class="text-slate-900"><?php echo e($this->selectedDose->prescription?->frequency_hours ? 'Cada ' . $this->selectedDose->prescription->frequency_hours . ' horas' : 'Sin frecuencia'); ?></span></p>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showOmitModal && $this->selectedDose): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div class="w-full max-w-md rounded-[28px] border-4 border-[#2f67c7] bg-white p-6 shadow-2xl">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-[20px] font-bold text-slate-950">
                            <?php echo e($this->selectedDose->prescription?->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedDose->prescription?->dose !== null && $this->selectedDose->prescription?->dose_unit): ?>
                                <?php echo e($this->selectedDose->prescription->dose + 0); ?><?php echo e($this->selectedDose->prescription->dose_unit); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </h3>
                        <p class="mt-1 text-[13px] font-semibold text-slate-500">
                            <?php echo e($this->selectedDose->prescription?->pill_count ?? '—'); ?> pastilla
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedDose->prescription?->frequency_hours): ?>
                                * cada <?php echo e($this->selectedDose->prescription->frequency_hours); ?> horas
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>
                    <div class="text-right text-[13px] font-semibold text-slate-500">
                        Hora de omisión:
                        <div class="text-slate-900"><?php echo e($actionTime ? \Carbon\Carbon::parse($actionTime)->format('h:i a') : '—'); ?></div>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-[14px] font-bold text-slate-900">Razón de omisión</p>
                    <?php
                        $reasons = [
                            'Olvido' => 'fa-regular fa-clock',
                            'Efecto adverso' => 'fa-regular fa-face-frown',
                            'No tenia medicamento' => 'fa-solid fa-pills',
                            'Otro' => 'fa-solid fa-ellipsis',
                        ];
                    ?>
                    <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $selected = $omissionReason === $reason;
                                $dimmed = $omissionReason && ! $selected;
                                $classes = $selected
                                    ? 'bg-[#2f67c7] text-white border-[#2f67c7]'
                                    : ($dimmed ? 'bg-slate-200 text-slate-400 border-slate-200' : 'bg-slate-100 text-slate-700 border-slate-200');
                            ?>
                            <button type="button" wire:click="selectOmissionReason('<?php echo e($reason); ?>')"
                                class="relative flex flex-col items-center justify-center gap-2 rounded-[16px] border px-3 py-4 text-center text-[12px] font-semibold transition <?php echo e($classes); ?>">
                                <span class="absolute left-2 top-2 h-3 w-3 rounded-full border border-slate-700 <?php echo e($selected ? 'bg-black border-black' : 'bg-white'); ?>"></span>
                                <i class="<?php echo e($icon); ?> text-[18px]"></i>
                                <span><?php echo e($reason); ?></span>
                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['omissionReason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="mt-2 block text-[11px] font-semibold text-red-600"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($omissionReason === 'Otro'): ?>
                    <div class="mt-6">
                        <div class="flex items-center justify-between">
                            <label class="text-[14px] font-bold text-slate-900">Otro</label>
                            <span class="text-[11px] text-slate-500"><?php echo e(strlen($omissionOther ?? '')); ?>/250</span>
                        </div>
                        <textarea wire:model.live="omissionOther" maxlength="250" rows="3"
                            class="mt-2 w-full rounded-[16px] border border-slate-200 bg-slate-100 px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#2f67c7] focus:ring-1 focus:ring-[#2f67c7]"
                            placeholder="Escribe el motivo"></textarea>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['omissionOther'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="mt-2 block text-[11px] font-semibold text-red-600"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal36aa088aadd7276f1a1850953ba55642 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36aa088aadd7276f1a1850953ba55642 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-bottom-nav','data' => ['active' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-bottom-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'home']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36aa088aadd7276f1a1850953ba55642)): ?>
<?php $attributes = $__attributesOriginal36aa088aadd7276f1a1850953ba55642; ?>
<?php unset($__attributesOriginal36aa088aadd7276f1a1850953ba55642); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36aa088aadd7276f1a1850953ba55642)): ?>
<?php $component = $__componentOriginal36aa088aadd7276f1a1850953ba55642; ?>
<?php unset($__componentOriginal36aa088aadd7276f1a1850953ba55642); ?>
<?php endif; ?>
</div><?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/patient/medicamentos.blade.php ENDPATH**/ ?>