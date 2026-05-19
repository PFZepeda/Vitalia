<div class="min-h-screen bg-white flex flex-col font-sans">
    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full max-w-3xl mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'scale-[0.45] sm:scale-[0.55]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'scale-[0.45] sm:scale-[0.55]']); ?>
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
        <div class="flex items-center mb-8">
            <a href="<?php echo e(route('pharmaceutical.patients.list')); ?>" class="text-gray-700 hover:text-gray-900 transition mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Medicamentos Actuales</h1>
        </div>
        
        <!-- List -->
        <main class="space-y-4 mb-24">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $medId = $prescription->prescription_item_id;
                    $stockCount = $stocks[$medId]->current_pills ?? 0;
                    $isLowStock = $stockCount <= 3;
                ?>
                <div class="bg-[#f4f4f5] rounded-2xl p-4 sm:p-5 relative">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-[17px] sm:text-lg font-bold text-black"><?php echo e($prescription->medication->medication_name); ?></h2>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLowStock && $stockCount > 0): ?>
                                <span class="inline-flex items-center gap-1 bg-[#ff8a8a] text-black text-[10px] font-bold px-2 py-0.5 rounded-full mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                    Stock bajo
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('pharmaceutical.medications.stock', ['patient' => $patient->id, 'item' => $medId])); ?>" class="text-[#0b67c2] hover:text-blue-800 transition ml-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-black text-sm sm:text-base">Dosis:</span>
                            <span class="text-gray-400 font-semibold text-sm sm:text-base"><?php echo e($prescription->dose); ?> <?php echo e($prescription->dose_unit); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-black text-sm sm:text-base">Stock actual:</span>
                            <span class="<?php echo e($isLowStock ? 'text-red-500' : 'text-gray-400'); ?> font-semibold text-sm sm:text-base"><?php echo e($stockCount); ?> pastillas</span>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="bg-yellow-100 rounded-full p-6 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-yellow-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-400">Sin medicamentos recetados</h3>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </main>
    </div>
</div>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/pharmaceutical/current-medications.blade.php ENDPATH**/ ?>