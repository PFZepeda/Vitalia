<div class="relative min-h-screen bg-white pb-[calc(8rem+env(safe-area-inset-bottom))]">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.opacity.duration.500ms
            class="fixed top-5 right-5 z-[150] flex items-center gap-2 rounded-lg bg-[#10b981] px-4 py-3 font-semibold text-white shadow-lg">
            <i class="fa-solid fa-circle-check text-white"></i>
            <span class="text-[14px]"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <main class="mx-auto flex w-full max-w-lg flex-col px-4 pt-6 sm:px-6 sm:pt-8 lg:px-8">
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
                <a href="<?php echo e(route('doctor.patients.index')); ?>" class="text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <h1 class="text-[22px] font-bold text-slate-900">Crear Receta</h1>
            </div>

            <div class="rounded-[24px] bg-[#f4f5f7] p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-[14px] font-bold text-slate-900 mb-2"><?php echo e($patient->name); ?></h2>

                        <!-- Height block -->
                        <div class="mb-1.5 flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Altura:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient->height): ?>
                                    <span class="text-[13px] text-slate-400 font-medium"><?php echo e($patient->height); ?> m</span>
                                <?php else: ?>
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <button type="button" wire:click="$set('showEditModal', 'height')"
                                class="cursor-pointer text-[#0b67c2] hover:opacity-70 transition-colors"><i
                                    class="fas fa-edit cursor-pointer text-[16px]"></i></button>
                        </div>

                        <!-- Weight block -->
                        <div class="flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Peso:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient->weight): ?>
                                    <span class="text-[13px] text-slate-400 font-medium"><?php echo e($patient->weight); ?>

                                        kg</span>
                                <?php else: ?>
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <button type="button" wire:click="$set('showEditModal', 'weight')"
                                class="cursor-pointer text-[#0b67c2] hover:opacity-70 transition-colors"><i
                                    class="fas fa-edit text-[16px]"></i></button>
                        </div>

                        <!-- Age block -->
                        <div class="mt-1.5 flex min-h-[24px] items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-[13px] text-slate-900">Edad:</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->age): ?>
                                    <span class="text-[13px] text-slate-400 font-medium"><?php echo e($this->age); ?> años</span>
                                <?php else: ?>
                                    <span class="text-[13px] font-medium text-red-500">Dato Faltante</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col items-end gap-1">
                        <span class="text-[12px] font-bold text-[#0b67c2]">Modo hospitalario</span>
                        <div
                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer items-center rounded-full bg-slate-300 transition-colors duration-200 ease-in-out">
                            <span
                                class="inline-block h-4 w-4 translate-x-1 transform rounded-full bg-white transition duration-200 ease-in-out"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex rounded-full bg-[#f4f5f7] p-1.5 shadow-sm">
                <button type="button" wire:click="$set('activeTab', 'receta')"
                    class="cursor-pointer w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors <?php echo e($activeTab === 'receta' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]'); ?>">
                    Receta
                </button>
                <button type="button" wire:click="$set('activeTab', 'historial')"
                    class="cursor-pointer w-1/2 rounded-full py-2 text-center text-[14px] font-bold transition-colors <?php echo e($activeTab === 'historial' ? 'bg-[#aeb3bb] text-white' : 'text-[#0b67c2]'); ?>">
                    Historial
                </button>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'receta'): ?>
                <!-- Lista de Medicamentos agregados -->
                <div class="flex flex-col gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->myPrescriptionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm relative">
                            <h3 class="text-[14px] font-bold text-[#0b67c2] mb-1.5">
                                <?php echo e($prescription->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                                <?php echo e($prescription->dose + 0); ?> <?php echo e($prescription->dose_unit); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->observations): ?>
                                <p class="text-[13px] text-slate-900 font-bold max-w-[85%]">Observaciones: <span
                                        class="text-slate-700 font-medium"><?php echo e($prescription->observations); ?></span></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->start_date && $prescription->end_date): ?>
                                <div class="mt-2 text-[12px] text-slate-600 max-w-[85%]">
                                    <p><span class="font-bold">📅 Fechas:</span>
                                        <?php echo e($prescription->start_date->format('d/m/Y')); ?> -
                                        <?php echo e($prescription->end_date->format('d/m/Y')); ?></p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->administration_time): ?>
                                        <p><span class="font-bold">⏰ Hora de inicio:</span>
                                            <?php echo e(Carbon\Carbon::parse($prescription->administration_time)->format('h:i a')); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->weekdays): ?>
                                        <p><span class="font-bold">📅 Días:</span> <?php echo e($prescription->weekdays); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="mt-2 text-[12px] text-amber-600 max-w-[85%]">
                                    <p>⚠️ Sin fechas configuradas</p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="absolute right-4 top-1/2 -translate-y-1/2 flex gap-3">
                                <button type="button" wire:click="editItem(<?php echo e($prescription->id); ?>)"
                                    class="text-[#0b67c2] cursor-pointer hover:opacity-70"><i
                                        class="fa-regular fa-pen-to-square text-[15px]"></i></button>
                                <button type="button" wire:click="confirmDeleteItem(<?php echo e($prescription->id); ?>)"
                                    class="text-red-500 cursor-pointer hover:opacity-70"><i
                                        class="fa-regular fa-trash-can text-[15px]"></i></button>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-center text-[13px] text-slate-400">No hay medicamentos en la receta actual.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <button type="button" wire:click="openMedicationModal"
                        class="cursor-pointer w-[120px] rounded-full bg-[#aeb3bb] py-2 text-center text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                        Agregar
                    </button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'historial'): ?>
                <div class="flex items-center rounded-[8px] bg-[#f1f3f5] px-3 py-2.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Buscar historial..."
                        class="w-full bg-transparent px-2 text-[13px] text-slate-900 focus:outline-none placeholder:text-slate-400">
                </div>

                <div class="flex flex-col gap-4 mt-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->allPrescriptionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="rounded-[16px] bg-[#f4f5f7] p-4 shadow-sm">
                            <p class="text-[13px] font-bold text-[#0b67c2] mb-1.5">
                                <?php echo e($prescription->created_at->format('d/m/Y')); ?></p>
                            <p class="text-[13px] text-slate-900 mb-0.5"><span
                                    class="font-bold text-[#0b67c2]">Medicamento:</span> <span
                                    class="text-[#f78b31] font-bold"><?php echo e($prescription->medication?->medication_name ?? 'Medicamento sin asignar'); ?>

                                    <?php echo e($prescription->dose + 0); ?> <?php echo e($prescription->dose_unit); ?></span></p>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->observations): ?>
                                <p class="text-[13px] text-slate-900 font-bold mt-2">Observaciones: <span
                                        class="font-medium text-slate-700"><?php echo e($prescription->observations); ?></span>
                                </p>
                            <?php else: ?>
                                <p class="text-[13px] text-[#0b67c2] font-bold mt-2">Observaciones:<br><span
                                        class="font-medium text-slate-900">Ninguna</span></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->start_date && $prescription->end_date): ?>
                                <div class="mt-2 text-[12px] text-slate-600 max-w-[85%]">
                                    <p><span class="font-bold">📅 Fechas:</span>
                                        <?php echo e($prescription->start_date->format('d/m/Y')); ?> -
                                        <?php echo e($prescription->end_date->format('d/m/Y')); ?></p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->administration_time): ?>
                                        <p><span class="font-bold">⏰ Hora de inicio:</span>
                                            <?php echo e(Carbon\Carbon::parse($prescription->administration_time)->format('h:i a')); ?>

                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prescription->weekdays): ?>
                                        <p><span class="font-bold">📅 Días:</span> <?php echo e($prescription->weekdays); ?></p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-center text-[13px] text-slate-400">El historial está vacío.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </main>

    <!-- Modal Agregar Medicamento -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showMedicationModal): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div
                class="relative w-full max-w-sm max-h-[85vh] overflow-y-auto rounded-[24px] bg-[#f4f5f7] p-5 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showMedicationModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-4 pr-6 text-center text-[16px] font-bold text-slate-900">
                    <?php echo e($editItemId ? 'Editar medicamento' : 'Agrega el medicamento'); ?></h3>

                <!-- 1. Medicamento -->
                <div class="mb-4 relative" x-data="{ open: false }">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">1.- Medicamento</label>
                    <div class="relative" @click.outside="open = false">
                        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" wire:model.live.debounce.300ms="searchMedication" @focus="open = true"
                            @click="open = true"
                            class="w-full rounded-[12px] border border-white bg-white py-2 pl-9 pr-8 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2]"
                            placeholder="Buscar medicamento...">
                        <button type="button" @click="open = !open"
                            class="absolute right-0 top-0 flex h-full items-center px-3 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" style="display: none;"
                            class="absolute left-0 top-full z-10 mt-1 max-h-44 w-full overflow-y-auto rounded-xl bg-white p-2 shadow-lg border border-slate-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->filteredMedications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button type="button"
                                    wire:click="selectMedication('<?php echo e($med); ?>'); open = false"
                                    class="block w-full rounded-lg px-3 py-2 text-left text-[13px] hover:bg-[#dcdedf]">
                                    <?php echo e($med); ?>

                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <div class="px-3 py-2 text-[13px] text-slate-500">Sin resultados</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedMedication): ?>
                        <div
                            class="mt-2 inline-flex items-center rounded-[12px] bg-[#dcdedf] px-3 py-1.5 text-[13px] font-bold text-slate-900 shadow-sm">
                            <?php echo e($selectedMedication); ?>

                            <button type="button" wire:click="$set('selectedMedication', '')"
                                class="ml-2 text-slate-500 hover:text-slate-800"><i
                                    class="fa-solid fa-xmark"></i></button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['selectedMedication'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-[11px] text-red-500 mt-1"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- 2. Dosis -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">2.- Dosis</label>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($calculatedDosis): ?>
                        <div class="space-y-3">
                            <!-- Método de cálculo -->
                            <div class="rounded-[12px] bg-[#dcdedf] px-3 py-2.5">
                                <p class="text-[12px] text-slate-600 font-medium"><?php echo e($calculatedDosis['method']); ?></p>
                            </div>

                            <!-- Presentación del medicamento -->
                            <div class="rounded-[12px] bg-[#e0f2fe] px-3 py-2.5">
                                <p class="text-[11px] text-slate-700"><span class="font-bold">Presentación:</span>
                                    <?php echo e($calculatedDosis['presentation_unit']); ?></p>

                                <p class="text-[11px] mt-3 text-slate-600"><i class="fa-solid fa-info-circle"></i>
                                    Recuerda que la dósis puede variar según el paciente, como médico te recomendamos tu
                                    criterio clínico para el buen uso de la dósis de médicamentos.</p>
                            </div>

                            <!-- Dosis calculada con unidad automática (no editable) -->
                            <div class="flex items-center gap-2">
                                <input type="number" step="0.01" wire:model="dose"
                                    class="flex-1 rounded-[12px] bg-white border border-[#0b67c2] px-3 py-2 text-[13px] text-slate-900 font-bold outline-none focus:ring-2 focus:ring-[#0b67c2]"
                                    placeholder="0">

                                <!-- Unidad (deshabilitada) -->
                                <div
                                    class="rounded-[12px] border border-slate-300 bg-slate-100 px-3 py-2 text-[13px] font-bold text-slate-900 min-w-fit">
                                    <?php echo e($doseUnit); ?>

                                </div>
                            </div>

                            <!-- Información de dosis máxima -->
                            <div class="rounded-[12px] bg-[#f1f3f5] px-3 py-2">
                                <p class="text-[11px] text-slate-600">Máximo recomendado: <span
                                        class="font-bold text-slate-900"><?php echo e($calculatedDosis['max_dose']); ?>

                                        <?php echo e($calculatedDosis['unit']); ?></span></p>
                            </div>

                            <!-- Observaciones -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($calculatedDosis['observations'])): ?>
                                <div class="space-y-1.5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $calculatedDosis['observations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="rounded-[12px] bg-[#fef3c7] px-3 py-2">
                                            <p class="text-[11px] text-slate-800"><?php echo e($obs); ?></p>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <div
                                    class="flex-1 rounded-[12px] bg-slate-100 px-3 py-2 text-center text-[13px] text-slate-700 font-medium">
                                    —
                                </div>
                                <div
                                    class="rounded-[12px] border border-slate-300 bg-slate-100 px-3 py-2 text-[13px] font-bold text-slate-900 min-w-fit">
                                    —
                                </div>
                            </div>
                            <p class="text-[12px] text-slate-400">Selecciona un medicamento para calcular la dosis</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- 3. Definir Fechas -->
                <div class="mb-4">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">3.- Horarios de toma</label>
                    <button type="button" wire:click="openDatesModal"
                        class="flex items-center gap-2 rounded-[12px] bg-[#0b67c2] px-4 py-2 text-[13px] font-bold text-white w-full justify-center hover:opacity-90 transition-opacity cursor-pointer">
                        <i class="fa-solid fa-calendar"></i>
                        Definir Fechas
                    </button>
                </div>

                <!-- 4. Observaciones -->
                <div class="mb-6">
                    <label class="mb-1 block text-[13px] font-bold text-slate-900">4.- Observaciones (opcional)</label>
                    <textarea wire:model="observations" rows="2"
                        class="w-full rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none"></textarea>
                </div>

                <!-- Footer -->
                <div class="flex justify-end mt-2">
                    <button type="button" wire:click="savePrescriptionItem"
                        class="cursor-pointer rounded-[10px] bg-[#0b67c2] px-6 py-2.5 text-[14px] font-bold text-white transition-opacity hover:opacity-90">Guardar</button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Modal Editar Datos del Paciente -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEditModal): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div class="relative w-full max-w-sm rounded-[24px] bg-[#f4f5f7] p-5 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showEditModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-6 pr-6 text-center text-[16px] font-bold text-slate-900">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEditModal === 'height'): ?>
                        Editar Altura
                    <?php elseif($showEditModal === 'weight'): ?>
                        Editar Peso
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h3>

                <!-- Height Edit Form -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEditModal === 'height'): ?>
                    <div class="mb-6">
                        <label class="mb-2 block text-[13px] font-bold text-slate-900">Altura (metros)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" step="0.01" min="0.5" max="3" wire:model="height"
                                class="flex-1 rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none focus:ring-2 focus:ring-[#0b67c2]"
                                placeholder="Ej. 1.75">
                            <span class="text-[13px] font-bold text-slate-900">m</span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['height'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-2"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Weight Edit Form -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEditModal === 'weight'): ?>
                    <div class="mb-6">
                        <label class="mb-2 block text-[13px] font-bold text-slate-900">Peso (kilogramos)</label>
                        <div class="flex items-center gap-2">
                            <input type="number" step="0.1" min="0" max="300" wire:model="weight"
                                class="flex-1 rounded-[12px] border-none bg-white px-3 py-2 text-[13px] outline-none focus:ring-2 focus:ring-[#0b67c2]"
                                placeholder="Ej. 70">
                            <span class="text-[13px] font-bold text-slate-900">kg</span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-2"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Footer -->
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="rounded-[10px] bg-slate-300 px-4 py-2 text-[14px] font-bold text-slate-900 transition-opacity hover:opacity-90">Cancelar</button>
                    <button type="button" <?php if($showEditModal === 'height'): ?> wire:click="saveHeight" <?php endif; ?>
                        <?php if($showEditModal === 'weight'): ?> wire:click="saveWeight" <?php endif; ?>
                        class="rounded-[10px] bg-[#0b67c2] px-6 py-2 text-[14px] font-bold text-white transition-opacity hover:opacity-90 cursor-pointer">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Modal Confirmar Eliminación de Medicamento -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDeleteConfirmModal): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div class="relative w-full max-w-sm rounded-[24px] bg-white p-6 shadow-2xl border border-slate-200">
                <div class="flex flex-col items-center text-center">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#0b67c2] mb-6">
                        <i class="fa-solid fa-info text-[48px] text-white"></i>
                    </div>

                    <h3 class="mb-4 text-[18px] font-bold text-slate-900">¿Estás seguro de Eliminar el Medicamento?
                    </h3>

                    <div class="flex w-full gap-3 justify-center">
                        <button type="button" wire:click="finalizeDeleteItem"
                            class="flex-1 rounded-full bg-[#ef4444] px-6 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                            Si
                        </button>
                        <button type="button" wire:click="cancelDeleteItem"
                            class="flex-1 rounded-full bg-[#10b981] px-6 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Modal Definir Fechas -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDatesModal ?? false): ?>
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 px-4 py-8 backdrop-blur-sm">
            <div
                class="relative w-full max-w-md max-h-[90vh] overflow-y-auto rounded-[24px] bg-white p-6 shadow-xl border border-slate-200">
                <button type="button" wire:click="$set('showDatesModal', false)"
                    class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition-colors hover:bg-slate-200 hover:text-slate-700">
                    <i class="fa-solid fa-xmark text-[18px]"></i>
                </button>

                <h3 class="mb-6 pr-6 text-center text-[18px] font-bold text-slate-900">Definir fechas de la receta</h3>

                <!-- Inicio de toma -->
                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Inicio de toma</h4>

                    <!-- Fecha de inicio -->
                    <div class="mb-4">
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Fecha de inicio</label>
                        <input type="date" wire:model="startDate" min="<?php echo e(date('Y-m-d')); ?>"
                            max="<?php echo e(date('Y-m-d', strtotime('+3 days'))); ?>"
                            class="w-full rounded-[12px] border border-slate-200 bg-white px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['startDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-1"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Hora -->
                    <div>
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Hora de toma</label>
                        <div
                            class="flex items-center justify-between rounded-[12px] border border-slate-200 bg-white px-4 py-3 shadow-sm">
                            <div class="flex-1">
                                <div class="text-center text-[24px] font-bold text-slate-900">
                                    <span
                                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'hour-'.e($startHour).'-minute-'.e($startMinute).''; ?>wire:key="hour-<?php echo e($startHour); ?>-minute-<?php echo e($startMinute); ?>"><?php echo e(str_pad($startHour, 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad($startMinute, 2, '0', STR_PAD_LEFT)); ?></span>
                                    <span class="text-[16px]"><?php echo e($startTimeFormat ?? 'a.m.'); ?></span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <button type="button" wire:click="incrementHour"
                                    class="cursor-pointer flex h-6 w-6 items-center justify-center rounded text-slate-400 hover:bg-slate-100 hover:text-[#0b67c2] transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 15l7-7 7 7"></path>
                                    </svg>
                                </button>
                                <button type="button" wire:click="toggleTimeFormat"
                                    class="cursor-pointer flex h-8 w-8 items-center justify-center rounded-lg border-2 transition-all duration-300 shadow-sm hover:shadow-md <?php echo e($isPm ? 'bg-[#0b67c2]/10 border-[#0b67c2] text-[#0b67c2]' : 'bg-amber-50 border-amber-200 text-amber-600 hover:bg-amber-100'); ?>"
                                    title="<?php echo e($isPm ? 'Cambiar a AM' : 'Cambiar a PM'); ?>">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPm): ?>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="5"></circle>
                                            <line x1="12" y1="1" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="12" y1="21" x2="12" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="1" y1="12" x2="3" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="21" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round"></line>
                                        </svg>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </button>
                                <button type="button" wire:click="decrementHour"
                                    class="cursor-pointer flex h-6 w-6 items-center justify-center rounded text-slate-400 hover:bg-slate-100 hover:text-[#0b67c2] transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pastHourError): ?>
                            <span class="block text-[11px] text-red-500 mt-2"><?php echo e($pastHourError); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['startHour'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-1"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Días de Toma Específicos</h4>

                    <!-- Selector de días de la semana -->
                    <div>
                        <label class="mb-3 block text-[13px] font-bold text-slate-500">Selecciona los días</label>
                        <div class="grid grid-cols-4 gap-2">
                            <?php
                                $weekdays = [
                                    'Lunes' => 'Lun',
                                    'Martes' => 'Mar',
                                    'Miercoles' => 'Mie',
                                    'Jueves' => 'Jue',
                                    'Viernes' => 'Vie',
                                    'Sábado' => 'Sab',
                                    'Domingo' => 'Dom',
                                ];
                                $selectedDays = explode(', ', $selectedDaysString ?? '');
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayName => $dayLetter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <button type="button" wire:click="toggleWeekday('<?php echo e($dayName); ?>')"
                                    class="flex flex-col items-center justify-center py-3 px-2 rounded-[12px] font-bold text-[14px] transition-all border-2 <?php echo e(in_array($dayName, $selectedDays) ? 'bg-[#0b67c2] border-[#0b67c2] text-white' : 'bg-white border-slate-200 text-slate-900 hover:border-[#0b67c2]'); ?>">
                                    <span class="text-[16px]"><?php echo e($dayLetter); ?></span>
                                    <span class="text-[10px] mt-1"><?php echo e(substr($dayName, 0, 3)); ?></span>
                                </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedDaysString): ?>
                            <div
                                class="mt-3 inline-flex items-center rounded-[12px] bg-[#0b67c2]/10 px-3 py-2 text-[12px] font-bold text-[#0b67c2]">
                                <i class="fa-solid fa-check mr-2"></i>
                                <?php echo e($selectedDaysString); ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['selectedDaysString'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-2"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Fin de toma -->
                <div class="mb-8">
                    <h4 class="text-[16px] font-bold text-slate-900 mb-4">Fin de toma</h4>

                    <!-- Fecha de termino -->
                    <div>
                        <label class="mb-2 block text-[13px] font-bold text-slate-500">Fecha de termino</label>
                        <input type="date" wire:model="endDate" min="<?php echo e(date('Y-m-d')); ?>"
                            max="<?php echo e(date('Y-m-d', strtotime('+1 year'))); ?>"
                            class="w-full rounded-[12px] border border-slate-200 bg-white px-4 py-3 text-[13px] text-slate-900 outline-none focus:border-[#0b67c2] focus:ring-1 focus:ring-[#0b67c2]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['endDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="block text-[11px] text-red-500 mt-1"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end">
                    <button type="button" wire:click="saveDates"
                        class="rounded-[12px] bg-[#0b67c2] px-8 py-3 text-[14px] font-bold text-white transition-opacity hover:opacity-90 cursor-pointer">
                        Guardar
                    </button>
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
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/doctors/patient-info.blade.php ENDPATH**/ ?>