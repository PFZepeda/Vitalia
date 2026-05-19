<div class="relative min-h-screen bg-white">
    <main
        class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
        <div class="mx-auto flex w-full flex-col gap-6">
            <div class="flex flex-col items-center">
                <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'scale-[0.58] sm:scale-[0.66]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'scale-[0.58] sm:scale-[0.66]']); ?>
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
            </div>

            <div class="flex items-center gap-2">
                <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Gestión de Pacientes</h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex flex-1 items-center rounded-[8px] bg-[#f1f3f5] px-3 py-2.5">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Buscar paciente por correo"
                        class="w-full bg-transparent px-2 text-[14px] text-slate-900 focus:outline-none placeholder:text-slate-400">
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $parts = explode(' ', $patient->name);
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                        if (empty($initials)) {
                            $initials = '??';
                        }
                    ?>
                    <div class="relative flex items-center gap-4 rounded-[16px] bg-[#f4f5f7] p-5 shadow-sm">
                        <div
                            class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-full bg-[#dcdedf]">
                            <span class="text-[26px] font-bold text-[#0b67c2]"><?php echo e($initials); ?></span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-[14px] font-bold text-slate-900 mb-1.5"><?php echo e($patient->name); ?></h2>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Correo:</span> <span
                                    class="text-slate-400 font-medium"><?php echo e($patient->email); ?></span></p>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Altura:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient->height): ?>
                                    <span class="text-slate-400 font-medium"><?php echo e($patient->height); ?> m</span>
                                <?php else: ?>
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <p class="text-[13px] text-slate-500"><span class="font-bold text-slate-900">Peso:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient->weight): ?>
                                    <span class="text-slate-400 font-medium"><?php echo e($patient->weight); ?> kg</span>
                                <?php else: ?>
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                            <p class="text-[13px] text-slate-500 mb-1"><span
                                    class="font-bold text-slate-900">Edad:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient->birth_date): ?>
                                    <span
                                        class="text-slate-400 font-medium"><?php echo e(\Carbon\Carbon::parse($patient->birth_date)->age); ?>

                                        años</span>
                                <?php else: ?>
                                    <span class="font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>

                        </div>
                        <div class="absolute right-4 top-4 flex flex-col gap-2 items-end">
                            <a href="<?php echo e(route('doctor.patients.show', $patient)); ?>" class="text-[#0b67c2]">
                                <i class="fa-regular fa-pen-to-square text-[18px]"></i>
                            </a>
                            <button wire:click="openReportsModal(<?php echo e($patient->id); ?>)" class="mt-2 bg-[#0b67c2] text-white text-[10px] font-bold px-3 py-1.5 rounded-lg hover:bg-blue-700 transition shadow-sm">
                                Lista de reportes
                            </button>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <p class="text-center text-[14px] text-slate-500 py-6">No se encontraron pacientes.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Modal Lista de Reportes -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showReportsModal && $selectedPatient): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-in fade-in duration-300">
        <div class="bg-white rounded-[24px] w-full max-w-[360px] flex flex-col shadow-2xl animate-in zoom-in-95 duration-300">
            <!-- Modal Header -->
            <div class="p-6 pb-2 flex justify-between items-start">
                <div>
                    <h2 class="text-[18px] font-bold text-slate-900">Lista de reportes</h2>
                    <p class="text-[12px] text-slate-400 font-medium mt-1 leading-tight">
                        Reportes semanales de <?php echo e($selectedPatient->name); ?><br>
                        Los reportes semanales se generan cada domingo.
                    </p>
                </div>
                <button wire:click="closeReportsModal" class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark text-[20px]"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 pt-4 max-h-[400px] overflow-y-auto">
                <?php
                    $hasPrescriptions = $selectedPatient->prescriptions->isNotEmpty();
                    // Generar fechas de los últimos 4 domingos (o hoy si es domingo)
                    $reports = [];
                    if ($hasPrescriptions) {
                        for ($i = 0; $i < 4; $i++) {
                            $date = \Carbon\Carbon::now()->subWeeks($i);
                            if (!$date->isSunday()) {
                                $date = $date->previous(\Carbon\Carbon::SUNDAY);
                            }
                            // Solo mostrar si el reporte es posterior a la creación de la receta más antigua
                            if ($date->greaterThanOrEqualTo($selectedPatient->prescriptions->min('created_at')->startOfDay())) {
                                $reports[] = $date;
                            }
                        }
                    }
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex items-center justify-between py-4 border-b border-slate-50 last:border-none">
                        <span class="text-[14px] font-bold text-slate-700"><?php echo e($reportDate->format('d/m/Y')); ?></span>
                        <a href="<?php echo e(route('doctor.reports.weekly', ['patient' => $selectedPatient->id, 'date' => $reportDate->format('Y-m-d')])); ?>" class="bg-[#0b67c2] text-white text-[12px] font-bold px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                            Ver detalle <i class="fa-solid fa-chevron-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="text-center py-10">
                        <div class="bg-slate-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-file-invoice text-slate-300 text-[24px]"></i>
                        </div>
                        <p class="text-slate-400 text-[14px] font-bold">No se han encontrado reportes disponibles</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
</div>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/doctors/patient-management.blade.php ENDPATH**/ ?>