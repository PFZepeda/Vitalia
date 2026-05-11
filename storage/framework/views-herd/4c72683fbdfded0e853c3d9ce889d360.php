<main class="min-h-screen" wire:poll.1s>
    <div class="mx-auto flex min-h-screen w-full max-w-lg flex-col items-center justify-center px-6 py-12">
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

        <div class="w-full rounded-[22px] bg-white p-6 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[20px] font-bold text-slate-900">Validar Codigo</h1>
            <p class="mt-1 text-[12px] text-slate-500">
                Ingresa el codigo de recuperacion enviado a tu correo.
            </p>

            <form class="mt-4 space-y-4" wire:submit.prevent="verifyCode">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Codigo</label>
                    <input
                        type="text"
                        inputmode="numeric"
                        maxlength="6"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="Ingresa tu codigo"
                        wire:model="code"
                    />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-[12px] text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button
                        type="submit"
                        class="flex-1 rounded-[12px] bg-[#0b67c2] py-3 text-[14px] font-bold text-white transition-opacity disabled:opacity-70"
                        wire:loading.attr="disabled"
                        wire:target="verifyCode"
                    >
                        <span wire:loading.remove wire:target="verifyCode">Continuar</span>
                        <span wire:loading wire:target="verifyCode">Validando...</span>
                    </button>

                    <?php ($cooldown = $this->cooldownRemaining); ?>
                    <button
                        type="button"
                        class="flex-1 rounded-[12px] bg-slate-200 py-3 text-[14px] font-semibold text-slate-600 transition-opacity disabled:opacity-70"
                        wire:click="resendCode"
                        <?php if($cooldown > 0): echo 'disabled'; endif; ?>
                    >
                        <?php echo e($cooldown > 0 ? "Solicitar Codigo ({$cooldown}s)" : 'Solicitar Codigo'); ?>

                    </button>
                </div>
            </form>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statusMessage): ?>
                <p class="mt-3 text-center text-[12px] text-emerald-600"><?php echo e($statusMessage); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
                <p class="mt-3 text-center text-[12px] text-red-600"><?php echo e($errorMessage); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="mt-4 text-center">
                <a href="<?php echo e(route('login')); ?>" class="text-[12px] font-semibold text-[#2f7ac9]">
                    Volver
                </a>
            </div>
        </div>
    </div>
</main>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/auth/validate-code.blade.php ENDPATH**/ ?>