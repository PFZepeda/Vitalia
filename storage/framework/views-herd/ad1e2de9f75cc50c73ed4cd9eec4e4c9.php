<div class="relative min-h-screen bg-[#fafbfd]">
    <main
        class="mx-auto flex min-h-screen w-full max-w-5xl flex-col px-6 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-8 sm:px-6 sm:pt-10 lg:px-8">
        <div class="w-full space-y-8">
            <!-- Logo -->
            <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'scale-[0.48] sm:scale-[0.58] md:scale-[0.66]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'scale-[0.48] sm:scale-[0.58] md:scale-[0.66]']); ?>
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

            <!-- Header -->
            <div class="space-y-2 pt-2">
                <h1 class="text-[34px] font-extrabold text-slate-900 sm:text-[40px] md:text-[44px]">
                    Hola, <?php echo e(optional(auth()->user())->name ?? 'Doctor'); ?>

                </h1>
                <p class="text-[15px] font-medium text-slate-500 sm:text-[16px]">
                    Gestiona y monitorea a tus pacientes
                </p>
            </div>


            <!-- Main Actions Grid -->
            <div class="space-y-5 sm:space-y-6">
                <?php
                    $cardBg = 'bg-[#eef2f4]';
                    $iconBg = 'bg-[#e6eef6]';
                ?>

                <!-- Panel de Alertas -->
                <a href="#"
                    class="group flex items-center gap-4 rounded-2xl <?php echo e($cardBg); ?> p-5 shadow-sm transition-all hover:shadow-md">
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg <?php echo e($iconBg); ?> text-[#0b67c2] sm:h-18 sm:w-18">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                            <circle cx="12" cy="12" r="9" fill="#0b67c2" />
                            <path d="M12 7v6" stroke="#fff" stroke-width="1.6" stroke-linecap="round" />
                            <path d="M12 15h.01" stroke="#fff" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Panel de alertas</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Visualiza primero los pacientes que
                            requieren atención inmediata.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Lista Rápida de Pacientes -->
                <a href="<?php echo e(route('doctor.my-patients.index')); ?>"
                    class="group flex items-center gap-4 rounded-2xl <?php echo e($cardBg); ?> p-5 shadow-sm transition-all hover:shadow-md">
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg <?php echo e($iconBg); ?> text-[#0b67c2] sm:h-18 sm:w-18">
                        <i class="fa-solid fa-list text-[28px]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Lista rápida de pacientes</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Consulta nombre, tratamiento activo y
                            porcentaje de adherencia actual.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

                <!-- Gestión de Pacientes -->
                <a href="<?php echo e(route('doctor.patients.index')); ?>"
                    class="group flex items-center gap-4 rounded-2xl <?php echo e($cardBg); ?> p-5 shadow-sm transition-all hover:shadow-md">
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg <?php echo e($iconBg); ?> text-[#0b67c2] sm:h-18 sm:w-18">
                        <i class="fa-solid fa-user-plus text-[26px]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[18px] font-bold text-slate-900">Gestión de pacientes</h3>
                        <p class="mt-1 text-[14px] leading-5 text-slate-500">Agrega, edita y elimina registros de
                            pacientes.</p>
                    </div>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 text-slate-400 transition-transform group-hover:translate-x-1">
                        <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

            </div>
        </div>
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
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/doctors/dashboard.blade.php ENDPATH**/ ?>