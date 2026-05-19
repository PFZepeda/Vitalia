<div class="min-h-screen bg-slate-50 font-sans">
    <main class="mx-auto w-full max-w-lg px-4 pb-[calc(10rem+env(safe-area-inset-bottom))] pt-6">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'scale-[0.55]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'scale-[0.55]']); ?>
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

        <!-- Header -->
        <div class="flex items-center mb-6">
            <a href="<?php echo e(route('doctor.patients.index')); ?>" class="text-slate-900 mr-4">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <h1 class="text-[22px] font-bold text-slate-900">Reporte Semanal</h1>
        </div>

        <!-- Period Info -->
        <div class="flex items-center gap-2 mb-6">
            <i class="fa-regular fa-calendar text-slate-400"></i>
            <span class="text-[14px] font-bold text-slate-700"><?php echo e($stats['period']); ?></span>
        </div>

        <!-- On Time Card -->
        <div class="bg-white rounded-[24px] p-6 mb-4 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <h3 class="text-slate-400 text-[14px] font-bold mb-2 uppercase tracking-wide">Tomas a tiempo</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-[#0b67c2] text-3xl font-extrabold"><?php echo e($stats['taken_percentage']); ?>%</span>
                        <span class="text-slate-400 text-[14px] font-bold">/ <?php echo e($stats['total']); ?> tomas</span>
                    </div>
                </div>
                
                <!-- Ring Progress Chart (Simple SVG) -->
                <div class="relative w-20 h-20">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="6" fill="transparent" class="text-slate-100" />
                        <circle cx="40" cy="40" r="34" stroke="currentColor" stroke-width="6" fill="transparent" stroke-dasharray="213.6" stroke-dashoffset="<?php echo e(213.6 - (213.6 * $stats['taken_percentage']) / 100); ?>" class="text-[#0b67c2]" stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fa-solid fa-check text-[#0b67c2] text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Missed and Delayed Row -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Omisiones -->
            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fa-regular fa-circle-xmark text-red-400 text-sm"></i>
                    <span class="text-slate-400 text-[12px] font-bold uppercase">Omisiones</span>
                </div>
                <h4 class="text-red-500 text-2xl font-extrabold mb-1"><?php echo e($stats['missed_percentage']); ?>%</h4>
                <p class="text-slate-400 text-[12px] font-bold"><?php echo e($stats['missed']); ?> Tomas</p>
            </div>

            <!-- Retrasos -->
            <div class="bg-white rounded-[24px] p-5 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fa-solid fa-clock-rotate-left text-slate-300 text-sm"></i>
                    <span class="text-slate-400 text-[12px] font-bold uppercase">Retrasos</span>
                </div>
                <h4 class="text-slate-400 text-2xl font-extrabold mb-1"><?php echo e($stats['delayed_percentage']); ?>%</h4>
                <p class="text-slate-400 text-[12px] font-bold"><?php echo e($stats['delayed']); ?> Toma</p>
            </div>
        </div>

        <!-- Reasons Card -->
        <div class="bg-white rounded-[24px] p-6 mb-8 shadow-sm">
            <h3 class="text-slate-900 text-[14px] font-bold mb-6">Razón de Omisión</h3>
            
            <div class="space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stats['reasons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-900 text-[14px] font-bold"><?php echo e($reason); ?></span>
                            <span class="text-slate-400 text-[12px] font-bold"><?php echo e($stats['reasons_percentages'][$reason]); ?>%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full transition-all duration-500" style="width: <?php echo e($stats['reasons_percentages'][$reason]); ?>%"></div>
                        </div>
                        <p class="text-slate-400 text-[11px] font-bold"><?php echo e($count); ?> <?php echo e($count == 1 ? 'toma' : 'tomas'); ?></p>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <!-- Download Button -->
        <button wire:click="downloadPdf" type="button" class="mb-4 w-full bg-[#0b67c2] hover:bg-blue-700 text-white font-bold py-4 rounded-[18px] flex items-center justify-center gap-2 shadow-lg transition shadow-blue-100">
            <i class="fa-solid fa-file-pdf"></i>
            Descargar reporte
        </button>
    </main>
    
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
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/doctors/weekly-report.blade.php ENDPATH**/ ?>