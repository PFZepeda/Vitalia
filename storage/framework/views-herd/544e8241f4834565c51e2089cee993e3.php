<main class="min-h-screen">
    <div class="mx-auto flex min-h-screen w-full max-w-lg flex-col items-center justify-center px-6 py-12" wire:poll.1s>
        <?php if (isset($component)) { $__componentOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4a12c9b73ad7126d199a7f3a237fe5b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-logo','data' => ['class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
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

        <div class="w-full rounded-[22px] bg-white px-5 py-6 text-center shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[20px] font-bold text-slate-900">Verifique su cuenta</h1>

            <div class="mx-auto mt-4 flex h-20 w-20 items-center justify-center rounded-full bg-[#eef3f8]">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#0b67c2]">
                    <path d="M4 6H20C21.1046 6 22 6.89543 22 8V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V8C2 6.89543 2.89543 6 4 6Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M22 8L12 13L2 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <p class="mt-4 text-[12px] leading-5 text-slate-500">
                Le enviamos un enlace de verificacion a su correo electronico.
                Abra el enlace desde su bandeja de entrada para activar su cuenta.
            </p>

            <?php ($cooldown = $this->cooldownRemaining); ?>
            <button
                type="button"
                class="mt-4 w-full rounded-[12px] bg-[#0b67c2] px-6 py-3 text-[15px] font-bold text-white transition-opacity disabled:opacity-70"
                wire:click="resend"
                wire:loading.attr="disabled"
                wire:target="resend"
                <?php if($cooldown > 0): echo 'disabled'; endif; ?>
            >
                <span wire:loading.remove wire:target="resend">
                    <?php echo e($cooldown > 0 ? "Reenviar en {$cooldown}s" : 'Reenviar enlace'); ?>

                </span>
                <span wire:loading wire:target="resend">Enviando...</span>
            </button>

            <p class="mt-3 text-[11px] text-slate-400">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cooldown > 0): ?>
                    Podra intentar de nuevo en <?php echo e($cooldown); ?> segundos.
                <?php else: ?>
                    No recibio el correo? Revise su spam.
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statusMessage): ?>
                <p class="mt-2 text-[12px] text-emerald-600"><?php echo e($statusMessage); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
                <p class="mt-2 text-[12px] text-red-600"><?php echo e($errorMessage); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <button
                type="button"
                class="mt-4 text-[12px] font-semibold text-[#2f7ac9]"
                wire:click="logout"
            >
                Volver al inicio de sesion
            </button>
        </div>
    </div>
</main>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/auth/verify-email.blade.php ENDPATH**/ ?>