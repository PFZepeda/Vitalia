<div class="relative min-h-screen bg-slate-50">
    <main class="mx-auto min-h-screen w-full max-w-[430px] px-3 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-3 sm:max-w-5xl sm:px-6 sm:pt-6 lg:px-8">

        <div class="mx-auto flex w-full flex-col gap-12 sm:gap-8">

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
                        Recetas del Médico
                    </h1>
                </div>
            </div>

            <!-- Lista de recetas -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescriptions && $prescriptions->isNotEmpty()): ?>
                <div class="flex flex-col gap-7 sm:gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="rounded-[18px] bg-[#f1f3f5] px-4 py-6 shadow-[0_1px_0_rgba(15,23,42,0.03)] sm:rounded-[26px] sm:p-5">
                            <div class="grid grid-cols-[34px_minmax(92px,1fr)_minmax(132px,auto)] items-center gap-2 sm:grid-cols-[70px_minmax(0,1fr)_minmax(230px,auto)] sm:gap-4">
                                <div class="flex items-center justify-center text-slate-900">
                                    <i class="fa-solid fa-capsules text-[26px] sm:text-[46px]"></i>
                                </div>

                                <div class="min-w-0">
                                    <span class="block text-[12px] font-bold leading-tight text-[#2f6edb] sm:text-[20px]">
                                        <?php echo e($prescription->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                                    </span>

                                    <p class="mt-1 text-[12px] font-bold leading-tight text-slate-600 sm:mt-2 sm:text-[18px]">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->dose !== null && $prescription->dose_unit): ?>
                                            Dosis: <?php echo e($prescription->dose + 0); ?> <?php echo e($prescription->dose_unit); ?>

                                        <?php else: ?>
                                            Dosis por confirmar
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->pill_count): ?>
                                        <p class="mt-1 text-[11px] font-semibold leading-tight text-slate-500 sm:text-[14px]">Pastillas: <?php echo e($prescription->pill_count); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->frequency_hours): ?>
                                        <p class="mt-1 text-[11px] font-semibold leading-tight text-slate-500 sm:text-[14px]">Frecuencia: Cada <?php echo e($prescription->frequency_hours); ?> horas</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php
                                        $stock = $prescription->patient->medicationStocks->where('prescription_item_id', $prescription->prescription_item_id)->first();
                                        $currentPills = $stock->current_pills ?? 0;
                                        // Calcular capacidad total (podría ser una caja sugerida o un valor fijo)
                                        $suggestedBrand = $prescription->medication->brands->where('is_suggested', true)->first();
                                        $totalCapacity = $suggestedBrand->pills_per_box ?? 10;
                                        $percentage = min(100, max(0, ($currentPills / $totalCapacity) * 100));
                                        $isLow = $percentage < 25;
                                    ?>
                                    <div class="mt-3">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-[10px] font-bold text-slate-700">Disponibilidad</span>
                                            <span class="text-[10px] font-bold <?php echo e($isLow ? 'text-red-500' : 'text-green-600'); ?>"><?php echo e($currentPills); ?> pastillas</span>
                                        </div>
                                        <div class="w-full bg-slate-300 rounded-full h-2.5 overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-500 <?php echo e($isLow ? 'bg-red-500' : 'bg-green-500'); ?>" style="width: <?php echo e($percentage); ?>%"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="min-w-0">
                                    <div class="space-y-[2px] text-[8.5px] leading-tight text-slate-700 sm:text-xs">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->start_date && $prescription->end_date): ?>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Fechas:</span>
                                                    <?php echo e($prescription->start_date->format('d/m/Y')); ?> - <?php echo e($prescription->end_date->format('d/m/Y')); ?>

                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Fechas:</span>
                                                    Sin fechas configuradas
                                                </span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->administration_time): ?>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-clock text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Hora de inicio:</span>
                                                    <?php echo e(\Carbon\Carbon::parse($prescription->administration_time)->format('h:i a')); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->weekdays): ?>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-regular fa-calendar-check text-[#8ea0d7]"></i>
                                                <span class="whitespace-nowrap">
                                                    <span class="font-bold">Días:</span>
                                                    <?php echo e($prescription->weekdays); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <button wire:click="openModal(<?php echo e($prescription->id); ?>)" class="mt-3 w-full rounded-full bg-[#0b67c2] px-3 py-2 text-[11px] font-bold text-white shadow transition hover:bg-blue-700 sm:w-auto sm:px-5 sm:text-[12px]">
                                        Observaciones de receta
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </main>

    <!-- Modal de Observaciones -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showModal): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="relative w-full max-w-sm rounded-2xl bg-[#f1f3f5] shadow-2xl">
            <!-- Botón Cerrar -->
            <button wire:click="closeModal()" class="absolute -right-2 -top-2 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-400 shadow transition hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Contenido del Modal -->
            <div class="space-y-4 p-6">
                <h2 class="text-lg font-bold text-slate-950">Observaciones de la receta</h2>
                
                <div class="min-h-32 rounded-xl bg-[#d9d9d9] p-4 text-center">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedObservations): ?>
                        <p class="text-sm text-slate-700"><?php echo e($selectedObservations); ?></p>
                    <?php else: ?>
                        <p class="text-sm text-slate-600">No cuentas con observaciones de la receta</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

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
</div><?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/patient/recetas-paciente.blade.php ENDPATH**/ ?>