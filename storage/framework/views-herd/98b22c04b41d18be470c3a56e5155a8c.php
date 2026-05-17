<div class="relative min-h-screen bg-slate-50">
<main class="mx-auto flex min-h-screen w-full max-w-6xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
    <div class="mx-auto flex w-full max-w-5xl flex-col gap-8">
        <div class="flex flex-col items-center gap-5 text-center md:items-start md:text-left">
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

            <div class="self-stretch space-y-1 pt-2 text-left">
                <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Hola, <?php echo e($ownerName); ?></h1>
                <p class="text-[16px] font-medium text-slate-400 sm:text-[18px]">Revisa tus apartados de hoy</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-2">

            <a href="<?php echo e(route('patient.medicamentos')); ?>" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
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
                <h2 class="text-[18px] font-bold text-slate-950">Mis tomas</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Recibe avisos de un medicamento está por terminarse.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>

            <a href="<?php echo e(route('patient.recetas')); ?>" class="flex h-full items-center gap-4 rounded-[26px] bg-[#f1f3f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01]">
            <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10">
                    <path d="M8 4H16L20 8V20H8V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M16 4V8H20" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M10 12H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M10 16H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1 text-left">
                <h2 class="text-[18px] font-bold text-slate-950">Recetas del Medico</h2>
                <p class="mt-1 text-[15px] leading-5 text-slate-400">Revisa notas del médico o nuevas preinscripciones digitales.</p>
            </div>
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 shrink-0 text-slate-950">
                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="hidden">
            <?php echo csrf_field(); ?>
            <button type="submit">Cerrar sesion</button>
        </form>
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
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/dashboard.blade.php ENDPATH**/ ?>