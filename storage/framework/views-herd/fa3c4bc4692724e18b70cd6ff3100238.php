<div class="relative min-h-screen bg-white">
    <main class="mx-auto flex min-h-screen w-full max-w-lg flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8 lg:px-8">
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

            <div>
                <div class="flex items-center gap-2">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="text-slate-900">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <h1 class="text-[22px] font-bold text-slate-900">Editar usuario</h1>
                </div>
                <p class="ml-8 mt-1 text-[12px] text-slate-400">Solo puedes modificar el rol del usuario</p>
            </div>

            <div class="rounded-[24px] bg-[#f4f5f7] p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <?php
                        $parts = explode(' ', $user->name);
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                    ?>
                    <div class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-full bg-[#dcdedf]">
                        <span class="text-[28px] font-bold text-[#0b67c2]"><?php echo e($initials); ?></span>
                    </div>
                    <div>
                        <h2 class="text-[15px] font-bold text-slate-900"><?php echo e($user->email); ?></h2>
                        <p class="text-[13px] text-slate-500"><span class="font-bold text-slate-900">Rol:</span> <?php echo e($user->getRoleNames()->first() ?? 'Paciente'); ?></p>
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    <div class="flex items-center justify-between border-b border-white pb-3">
                        <span class="text-[15px] font-bold text-slate-900">Nombre</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400"><?php echo e($user->name); ?></span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between border-b border-white pb-3">
                        <span class="text-[15px] font-bold text-slate-900">Email</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400"><?php echo e($user->email); ?></span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pb-2">
                        <span class="text-[15px] font-bold text-slate-900">Teléfono</span>
                        <div class="flex items-center gap-3">
                            <span class="text-[14px] text-slate-400"><?php echo e($user->phone ?? '—'); ?></span>
                            <i class="fa-solid fa-lock text-[13px] text-slate-400"></i>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-[16px] bg-white p-5 shadow-sm">
                    <label class="mb-2 block text-[15px] font-bold text-[#0b67c2]">Editar rol</label>
                    <select wire:model="role" class="w-full appearance-none rounded-[12px] border border-[#0b67c2] bg-white px-4 py-2.5 text-[14px] text-slate-500 outline-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M7%2010L12%2015L17%2010%22%20stroke%3D%22%23000%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E')] bg-[length:24px_24px] bg-[right_12px_center] bg-no-repeat pr-10">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="mt-4 flex flex-col sm:flex-row items-center gap-4">
                <a href="<?php echo e(route('admin.users.index')); ?>" class="w-full sm:flex-1 rounded-[12px] bg-[#f1f3f5] py-3.5 text-center text-[15px] font-bold text-slate-900 transition-opacity hover:opacity-80">
                    Cancelar
                </a>
                <button type="button" wire:click="save" class="w-full sm:flex-1 rounded-[12px] bg-[#0b67c2] py-3.5 text-center text-[15px] font-bold text-white transition-opacity hover:opacity-90">
                    Guardar cambios
                </button>
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
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/admin/user-edit.blade.php ENDPATH**/ ?>