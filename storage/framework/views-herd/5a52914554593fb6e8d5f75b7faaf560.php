<?php
    use Carbon\Carbon;
    $user = auth()->user();
    $age = $user && $user->birth_date ? Carbon::parse($user->birth_date)->age : null;
?>

<?php $__env->startComponent('layouts.app', ['title' => 'Mi información']); ?>
    <div class="relative min-h-screen bg-slate-50">
        <main
            class="mx-auto flex min-h-screen w-full max-w-2xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
            <div class="mx-auto flex w-full max-w-xl flex-col items-stretch gap-6 sm:gap-8">
                <div>
                    <a href="<?php echo e(route('profile.dashboard')); ?>"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01]">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Regresar
                    </a>
                </div>

                <section class="flex flex-col items-center text-center">
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

                    <div class="mt-4 space-y-2">
                        <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">Mi
                            información</h1>
                        <p class="mx-auto max-w-lg text-[16px] leading-6 text-slate-400 sm:text-[18px]">
                            Aquí puedes ver tus datos principales de perfil.
                        </p>
                    </div>
                </section>

                <section class="mt-6 rounded-3xl bg-white p-6 shadow-[0_6px_20px_rgba(15,23,42,0.05)]">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm text-slate-400">Nombre completo</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900"><?php echo e($user->name ?? '—'); ?></dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Correo</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900"><?php echo e($user->email ?? '—'); ?></dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Teléfono</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900"><?php echo e($user->phone ?? '—'); ?></dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Fecha de nacimiento</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">
                                <?php echo e($user->birth_date ? Carbon::parse($user->birth_date)->format('d/m/Y') : '—'); ?></dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Edad</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900"><?php echo e($age !== null ? $age . ' años' : '—'); ?>

                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm text-slate-400">Peso</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900"><?php echo e($user->weight ?? '—'); ?></dd>
                        </div>
                    </dl>
                </section>
            </div>
        </main>

        <?php if (isset($component)) { $__componentOriginal36aa088aadd7276f1a1850953ba55642 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36aa088aadd7276f1a1850953ba55642 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-bottom-nav','data' => ['active' => 'profile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-bottom-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'profile']); ?>
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
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/profile/information-account.blade.php ENDPATH**/ ?>