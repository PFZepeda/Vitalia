<main class="min-h-screen">
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

        <div class="w-full rounded-[20px] bg-white p-5 shadow-[0_6px_16px_rgba(0,0,0,0.08)]">
            <h1 class="text-[22px] font-bold text-slate-900">Bienvenido</h1>
            <p class="mt-1 text-[13px] text-slate-500">Por favor, ingresa tus datos para acceder.</p>

            <form class="mt-4 space-y-4" wire:submit.prevent="login">
                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Correo electronico</label>
                    <input
                        type="email"
                        class="w-full rounded-[12px] bg-[#eef1f4] px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400"
                        placeholder="correo@ejemplo.com"
                        wire:model="email"
                        autocomplete="email"
                    />
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
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

                <div>
                    <label class="mb-1 block text-[12px] font-semibold text-[#2f7ac9]">Contrasena</label>
                    <div class="flex items-center rounded-[12px] bg-[#eef1f4]">
                        <input
                            type="<?php echo e($passwordVisible ? 'text' : 'password'); ?>"
                            class="w-full flex-1 bg-transparent px-3 py-2 text-[14px] text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            placeholder="********"
                            wire:model="password"
                            autocomplete="current-password"
                        />
                        <button
                            type="button"
                            class="cursor-pointer px-3 py-2 text-[12px] font-semibold text-[#2f7ac9]"
                            wire:click="togglePasswordVisibility"
                        >
                            <?php echo e($passwordVisible ? 'Ocultar' : 'Mostrar'); ?>

                        </button>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
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

                <div class="flex justify-end">
                    <a href="<?php echo e(route('password.request')); ?>" class="text-[12px] font-semibold text-[#2f7ac9]">
                        Olvidaste tu Contrasena?
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-[12px] bg-[#0b67c2] py-3 text-[16px] font-bold text-white transition-opacity disabled:opacity-70"
                    wire:loading.attr="disabled"
                    wire:target="login"
                >
                    <span wire:loading.remove wire:target="login">Iniciar Sesion</span>
                    <span wire:loading wire:target="login">Ingresando...</span>
                </button>
            </form>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('form')): ?>
                <p class="mt-3 text-center text-[12px] text-red-600"><?php echo e($errors->first('form')); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                <p class="mt-3 text-center text-[12px] text-emerald-600"><?php echo e(session('status')); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="mt-4 text-center">
                <a href="<?php echo e(route('register')); ?>" class="text-[12px] font-semibold text-[#2f7ac9]">
                    No tienes cuenta? Registrate
                </a>
            </div>
        </div>
    </div>
</main>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>