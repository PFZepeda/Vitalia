<?php
    $securityQuestion = auth()->user()?->security_question;
    $securityQuestionOptions = [
        '¿Cuál es el nombre de tu primera mascota?',
        '¿En qué ciudad naciste?',
        '¿Cuál es el nombre de tu padre o madre?',
        '¿Cuál fue tu nombre de la escuela donde estudiaste?',
        '¿Cuál es tu comida favorita?',
    ];
    $selectedSecurityQuestion = $securityQuestion ?: $securityQuestionOptions[0] ?? '';

    $translateValidation = function ($field) use ($errors) {
        if (!$errors->has($field)) {
            return null;
        }
        $msg = $errors->first($field);
        $s = mb_strtolower($msg);
        if (
            strpos($s, 'required') !== false ||
            strpos($s, 'obligatorio') !== false ||
            strpos($s, 'is required') !== false
        ) {
            return 'Este campo es obligatorio.';
        }
        if (
            strpos($s, 'confirmed') !== false ||
            strpos($s, 'does not match') !== false ||
            strpos($s, 'no coincide') !== false
        ) {
            return 'No coinciden.';
        }
        if (strpos($s, 'min') !== false || strpos($s, 'too short') !== false) {
            return 'El valor es demasiado corto.';
        }
        if (strpos($s, 'invalid') !== false || strpos($s, 'incorrect') !== false) {
            return 'Valor inválido.';
        }
        return $msg;
    };
?>

<?php $__env->startComponent('layouts.app', ['title' => 'Seguridad']); ?>
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
                        <h1 class="text-[30px] font-semibold leading-none text-slate-950 sm:text-[34px] md:text-[38px]">
                            Seguridad</h1>
                        <p class="mx-auto max-w-lg text-[16px] leading-6 text-slate-400 sm:text-[18px]">
                            Aquí podrás ver las opciones de seguridad de tu cuenta.
                        </p>
                    </div>
                </section>

                <section class="rounded-3xl bg-white p-6 shadow-[0_6px_20px_rgba(15,23,42,0.05)] sm:p-7">
                    <div class="space-y-3">
                        <p class="text-sm font-medium uppercase tracking-[0.18em] text-slate-400">Acciones disponibles</p>
                        <h2 class="text-2xl font-semibold text-slate-950">Gestiona tu acceso</h2>
                        <p class="max-w-xl text-[15px] leading-6 text-slate-500 sm:text-[16px]">
                            Estas acciones todavía no tienen funcionalidad activa; por ahora solo están preparadas para que
                            puedas ver su diseño.
                        </p>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                        <div
                            class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm leading-6 text-emerald-800">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-6 grid grid-cols-1 gap-4">
                        <button type="button" data-change-password-open
                            class="group flex w-full items-center gap-4 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-left shadow-[0_6px_18px_rgba(15,23,42,0.04)] transition-transform hover:scale-[1.01] sm:px-5">
                            <div
                                class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2] sm:h-20 sm:w-24">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-10 w-10">
                                    <path d="M8 10V8C8 5.79086 9.79086 4 12 4C14.2091 4 16 5.79086 16 8V10"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor"
                                        stroke-width="2" />
                                    <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Cambiar contraseña</h3>
                                <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Actualiza tu acceso con
                                    una nueva contraseña segura.</p>
                            </div>
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-slate-950 shadow-[0_10px_22px_rgba(15,23,42,0.10)]">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                    <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>

                        <button type="button" data-change-security-open
                            class="group flex w-full items-center gap-4 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-4 text-left shadow-[0_6px_18px_rgba(15,23,42,0.04)] transition-transform hover:scale-[1.01] sm:px-5">
                            <div
                                class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 sm:h-20 sm:w-24">
                                <i class="fa-solid fa-circle-question text-[32px]" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-[16px] font-bold text-slate-950 sm:text-[18px]">Cambiar pregunta de
                                    seguridad</h3>
                                <p class="mt-1 text-[13px] leading-5 text-slate-400 sm:text-[15px]">Modifica la pregunta de
                                    seguridad cuando quieras reforzar tu cuenta.</p>
                            </div>
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-emerald-700 shadow-[0_10px_22px_rgba(15,23,42,0.10)]">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                                    <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>

                        <div
                            class="rounded-3xl border border-rose-200 bg-rose-50 p-4 shadow-[0_6px_18px_rgba(15,23,42,0.04)] sm:p-5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-16 w-20 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-600 sm:h-20 sm:w-24">
                                    <i class="fa-solid fa-trash-can text-[32px]" aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-[16px] font-bold text-rose-700 sm:text-[18px]">Borrar cuenta</h3>
                                    <p class="mt-1 text-[13px] leading-5 text-rose-500 sm:text-[15px]">Requiere confirmación
                                        con contraseña antes de eliminar definitivamente tu cuenta.</p>
                                </div>
                            </div>

                            <button type="button" data-delete-account-open
                                class="mt-5 inline-flex items-center justify-center rounded-full bg-rose-600 px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(225,29,72,0.18)] transition-transform hover:scale-[1.01] hover:bg-rose-700">
                                Borrar cuenta
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-4 py-4">
                        <p class="text-sm text-slate-500">Más adelante aquí podrás conectar las acciones reales sin cambiar
                            esta presentación.</p>
                    </div>
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

        <div id="changePasswordModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6">
            <div data-change-password-backdrop class="absolute inset-0 bg-slate-950/55 backdrop-blur-[2px]"></div>
            <div role="dialog" aria-modal="true" aria-labelledby="changePasswordTitle"
                class="relative z-10 w-full max-w-2xl rounded-4xl bg-white p-5 shadow-[0_30px_90px_rgba(15,23,42,0.22)] sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                                <path d="M8 10V8C8 5.79086 9.79086 4 12 4C14.2091 4 16 5.79086 16 8V10"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor"
                                    stroke-width="2" />
                                <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 id="changePasswordTitle" class="text-xl font-semibold text-slate-950">Cambiar contraseña
                            </h3>
                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">Confirma tu respuesta de seguridad
                                para crear una nueva contraseña.</p>
                        </div>
                    </div>
                    <button type="button" data-change-password-close
                        class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Cerrar modal">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <form id="changePasswordForm" method="POST" action="<?php echo e(route('profile.security.password')); ?>"
                    class="mt-6 grid grid-cols-1 gap-4">
                    <?php echo csrf_field(); ?>

                    <div
                        class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-600">
                        Pregunta asociada: <span
                            class="font-semibold text-slate-900"><?php echo e($securityQuestion ?? 'Sin pregunta de seguridad configurada'); ?></span>
                    </div>

                    <div>
                        <label for="security_answer" class="mb-2 block text-sm font-medium text-slate-700">Respuesta de
                            seguridad</label>
                        <p data-error="security_answer" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <input id="security_answer" name="security_answer" type="text" autocomplete="off"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('security_answer')): ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($translateValidation('security_answer')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <label for="new_password" class="mb-2 block text-sm font-medium text-slate-700">Nueva contraseña
                            *</label>
                        <p data-error="new_password" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="new_password" name="new_password" type="password" autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
                            <button type="button" data-password-toggle="new_password"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar nueva contraseña">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('new_password')): ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($translateValidation('new_password')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <label for="new_password_confirmation"
                            class="mb-2 block text-sm font-medium text-slate-700">Confirmar nueva contraseña *</label>
                        <p data-error="new_password_confirmation" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                                autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
                            <button type="button" data-password-toggle="new_password_confirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar confirmación de nueva contraseña">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('new_password_confirmation')): ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($translateValidation('new_password_confirmation')); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm leading-6 text-slate-500">Tu nueva contraseña se guardará solo si la respuesta de
                            seguridad es correcta.</p>
                        <div class="flex items-center gap-3 sm:justify-end">
                            <button type="button" data-change-password-close
                                class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-[#0b67c2] px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.20)] transition-transform hover:scale-[1.01] hover:bg-[#0958a8]">
                                Guardar cambio
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Verify current password modal (for changing security question) -->
        <div id="verifyPasswordModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6">
            <div data-verify-password-backdrop class="absolute inset-0 bg-slate-950/55 backdrop-blur-[2px]"></div>
            <div role="dialog" aria-modal="true" aria-labelledby="verifyPasswordTitle"
                class="relative z-10 w-full max-w-2xl rounded-4xl bg-white p-5 shadow-[0_30px_90px_rgba(15,23,42,0.22)] sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10">
                                <path d="M8 10V8C8 5.79086 9.79086 4 12 4C14.2091 4 16 5.79086 16 8V10"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor"
                                    stroke-width="2" />
                                <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 id="verifyPasswordTitle" class="text-xl font-semibold text-slate-950">Verificar contraseña
                            </h3>
                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">Confirma tu contraseña actual para
                                poder cambiar la pregunta de seguridad.</p>
                        </div>
                    </div>
                    <button type="button" data-verify-password-close
                        class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Cerrar modal">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <form id="verifyPasswordForm" class="mt-6 grid grid-cols-1 gap-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="current_password" class="mb-2 block text-sm font-medium text-slate-700">Contraseña
                            actual *</label>
                        <p data-error="current_password" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="current_password" name="current_password" type="password"
                                autocomplete="current-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900" />
                            <button type="button" data-password-toggle="current_password"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar contraseña actual">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <label for="current_password_confirmation"
                            class="mb-2 block text-sm font-medium text-slate-700">Confirmar contraseña *</label>
                        <p data-error="current_password_confirmation" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="current_password_confirmation" name="current_password_confirmation"
                                type="password" autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900" />
                            <button type="button" data-password-toggle="current_password_confirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar confirmación de contraseña">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mt-4">
                        <button type="button" data-verify-password-close
                            class="mb-3 inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700">Cancelar</button>
                        <button type="submit"
                            class="w-full rounded-full bg-[#0b67c2] px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.20)]">Verificar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change security question modal -->
        <div id="changeQuestionModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6">
            <div data-change-question-backdrop class="absolute inset-0 bg-slate-950/55 backdrop-blur-[2px]"></div>
            <div role="dialog" aria-modal="true" aria-labelledby="changeQuestionTitle"
                class="relative z-10 w-full max-w-2xl rounded-4xl bg-white p-5 shadow-[0_30px_90px_rgba(15,23,42,0.22)] sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#e2e5e9] text-[#0b67c2]">
                            <i class="fa-solid fa-circle-question text-[28px]" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 id="changeQuestionTitle" class="text-xl font-semibold text-slate-950">Cambiar pregunta de
                                seguridad</h3>
                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">Selecciona una pregunta y proporciona
                                la respuesta que usarás en adelante.</p>
                        </div>
                    </div>
                    <button type="button" data-change-question-close
                        class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Cerrar modal">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <form id="changeQuestionForm" method="POST" action="<?php echo e(route('profile.security.question')); ?>"
                    class="mt-6 grid grid-cols-1 gap-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="security_question"
                            class="mb-2 block text-sm font-medium text-slate-700">Pregunta</label>
                        <p data-error="security_question" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <select id="security_question" name="security_question"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $securityQuestionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($option); ?>" <?php if(($securityQuestion ?? $securityQuestionOptions[0]) === $option): echo 'selected'; endif; ?>><?php echo e($option); ?>

                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label for="security_answer" class="mb-2 block text-sm font-medium text-slate-700">Respuesta
                            *</label>
                        <p data-error="security_answer" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <input id="security_answer_new" name="security_answer" type="text" autocomplete="off"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('security_answer')): ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($translateValidation('security_answer')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <label for="security_answer_confirmation"
                            class="mb-2 block text-sm font-medium text-slate-700">Confirmar respuesta *</label>
                        <p data-error="security_answer_confirmation" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <input id="security_answer_confirmation" name="security_answer_confirmation" type="text"
                            autocomplete="off"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900" />
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('security_answer_confirmation')): ?>
                            <p class="mt-2 text-sm text-rose-600">
                                <?php echo e($translateValidation('security_answer_confirmation')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mt-4">
                        <button type="button" data-change-question-close
                            class="mb-3 inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700">Cancelar</button>
                        <button type="submit"
                            class="w-full rounded-full bg-[#0b67c2] px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.20)]">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="deleteAccountModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6">
            <div data-delete-account-backdrop class="absolute inset-0 bg-slate-950/55 backdrop-blur-[2px]"></div>
            <div role="dialog" aria-modal="true" aria-labelledby="deleteAccountTitle"
                class="relative z-10 w-full max-w-2xl rounded-4xl bg-white p-5 shadow-[0_30px_90px_rgba(15,23,42,0.22)] sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                            <i class="fa-solid fa-trash-can text-[28px]" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h3 id="deleteAccountTitle" class="text-xl font-semibold text-slate-950">Borrar cuenta</h3>
                            <p class="mt-1 max-w-xl text-sm leading-6 text-slate-500">Esta acción elimina tu acceso y no se
                                puede deshacer. Confirma tu contraseña para continuar.</p>
                        </div>
                    </div>
                    <button type="button" data-delete-account-close
                        class="rounded-full p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Cerrar modal">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <form id="deleteAccountForm" method="POST" action="<?php echo e(route('profile.security.destroy')); ?>"
                    class="mt-6 grid grid-cols-1 gap-4">
                    <?php echo csrf_field(); ?>

                    <div
                        class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-6 text-amber-900">
                        Antes de borrar la cuenta, escribe tu contraseña actual dos veces para evitar eliminaciones
                        accidentales.
                    </div>

                    <div>
                        <label for="delete_password" class="mb-2 block text-sm font-medium text-slate-700">Contraseña
                            actual *</label>
                        <p data-error="delete_password" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="delete_password" name="delete_password" type="password"
                                autocomplete="current-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-rose-400 focus:ring-2 focus:ring-rose-200" />
                            <button type="button" data-password-toggle="delete_password"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar contraseña actual">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('delete_password')): ?>
                            <p class="mt-2 text-sm text-rose-600"><?php echo e($translateValidation('delete_password')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div>
                        <label for="delete_password_confirmation"
                            class="mb-2 block text-sm font-medium text-slate-700">Confirmar contraseña *</label>
                        <p data-error="delete_password_confirmation" class="mt-2 text-sm text-rose-600 hidden"></p>
                        <div class="relative">
                            <input id="delete_password_confirmation" name="delete_password_confirmation" type="password"
                                autocomplete="new-password"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-rose-400 focus:ring-2 focus:ring-rose-200" />
                            <button type="button" data-password-toggle="delete_password_confirmation"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-[#0b67c2] font-semibold"
                                aria-label="Mostrar u ocultar confirmación de contraseña">Mostrar</button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($translateValidation('delete_password_confirmation')): ?>
                            <p class="mt-2 text-sm text-rose-600">
                                <?php echo e($translateValidation('delete_password_confirmation')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm leading-6 text-slate-500">Si continúas, se cerrará tu sesión y se eliminarán tus
                            datos de acceso.</p>
                        <div class="flex items-center gap-3 sm:justify-end">
                            <button type="button" data-delete-account-close
                                class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-rose-600 px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(225,29,72,0.18)] transition-transform hover:scale-[1.01] hover:bg-rose-700">
                                Borrar cuenta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const changePasswordModal = document.getElementById('changePasswordModal');
        const deleteAccountModal = document.getElementById('deleteAccountModal');

        const openModal = (modalElement) => {
            if (!modalElement) {
                return;
            }

            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        };

        const closeModal = (modalElement) => {
            if (!modalElement) {
                return;
            }

            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        };

        const openChangePasswordModal = () => openModal(changePasswordModal);
        const closeChangePasswordModal = () => closeModal(changePasswordModal);
        const openDeleteAccountModal = () => openModal(deleteAccountModal);
        const closeDeleteAccountModal = () => closeModal(deleteAccountModal);

        const verifyPasswordModal = document.getElementById('verifyPasswordModal');
        const changeQuestionModal = document.getElementById('changeQuestionModal');

        const openVerifyPasswordModal = () => openModal(verifyPasswordModal);
        const closeVerifyPasswordModal = () => closeModal(verifyPasswordModal);
        const openChangeQuestionModal = () => openModal(changeQuestionModal);
        const closeChangeQuestionModal = () => closeModal(changeQuestionModal);

        document.querySelectorAll('[data-change-password-open]').forEach((button) => {
            button.addEventListener('click', openChangePasswordModal);
        });

        document.querySelectorAll('[data-change-password-close]').forEach((button) => {
            button.addEventListener('click', closeChangePasswordModal);
        });

        document.querySelectorAll('[data-change-password-backdrop]').forEach((backdrop) => {
            backdrop.addEventListener('click', closeChangePasswordModal);
        });

        document.querySelectorAll('[data-delete-account-open]').forEach((button) => {
            button.addEventListener('click', openDeleteAccountModal);
        });

        document.querySelectorAll('[data-delete-account-close]').forEach((button) => {
            button.addEventListener('click', closeDeleteAccountModal);
        });

        document.querySelectorAll('[data-delete-account-backdrop]').forEach((backdrop) => {
            backdrop.addEventListener('click', closeDeleteAccountModal);
        });

        // Open verify-password modal (triggered from "Cambiar pregunta de seguridad" button)
        document.querySelectorAll('[data-change-security-open]').forEach((button) => {
            button.addEventListener('click', openVerifyPasswordModal);
        });

        // Verify-password modal controls
        document.querySelectorAll('[data-verify-password-close]').forEach((button) => {
            button.addEventListener('click', closeVerifyPasswordModal);
        });

        document.querySelectorAll('[data-verify-password-backdrop]').forEach((backdrop) => {
            backdrop.addEventListener('click', closeVerifyPasswordModal);
        });

        // Change-question modal controls
        document.querySelectorAll('[data-change-question-close]').forEach((button) => {
            button.addEventListener('click', closeChangeQuestionModal);
        });

        document.querySelectorAll('[data-change-question-backdrop]').forEach((backdrop) => {
            backdrop.addEventListener('click', closeChangeQuestionModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeChangePasswordModal();
                closeDeleteAccountModal();
                closeVerifyPasswordModal();
                closeChangeQuestionModal();
            }
        });

        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const inputId = button.getAttribute('data-password-toggle');
                const input = document.getElementById(inputId);
                const hiddenIcon = button.querySelector('[data-password-icon="hidden"]');
                const visibleIcon = button.querySelector('[data-password-icon="visible"]');

                if (!input) {
                    return;
                }

                const showPassword = input.type === 'password';
                input.type = showPassword ? 'text' : 'password';

                // If SVG icons exist, toggle them (existing pattern)
                if (hiddenIcon && visibleIcon) {
                    hiddenIcon.classList.toggle('hidden', showPassword);
                    visibleIcon.classList.toggle('hidden', !showPassword);
                    return;
                }

                // Otherwise assume the toggle is text-based (e.g., "Mostrar"/"Ocultar")
                const currentText = button.textContent?.trim() || '';
                button.textContent = showPassword ? 'Ocultar' : 'Mostrar';
                button.setAttribute('aria-label', showPassword ? 'Ocultar contraseña' :
                    'Mostrar contraseña');
            });
        });

        <?php if($errors->has('new_password') || $errors->has('new_password_confirmation') || $errors->has('security_answer')): ?>
            openChangePasswordModal();
        <?php endif; ?>

        <?php if($errors->has('delete_password') || $errors->has('delete_password_confirmation')): ?>
            openDeleteAccountModal();
        <?php endif; ?>

        <?php if(
            $errors->has('security_question') ||
                $errors->has('security_answer') ||
                $errors->has('security_answer_confirmation')): ?>
            openChangeQuestionModal();
        <?php endif; ?>

        // CSRF token for AJAX
        const _csrf = '<?php echo e(csrf_token()); ?>';

        // Generic client-side validator: ensures listed fields are non-empty and shows inline errors
        function validateRequiredFields(formEl, fieldIds) {
            let valid = true;
            fieldIds.forEach((id) => {
                const input = formEl.querySelector(`#${id}`) || formEl.querySelector(`[name="${id}"]`);
                const errEl = formEl.querySelector(`[data-error="${id}"]`);
                const value = input ? (input.value || '').trim() : '';
                if (!value) {
                    valid = false;
                    if (errEl) {
                        errEl.textContent = 'Este campo es obligatorio.';
                        errEl.classList.remove('hidden');
                    }
                }
            });
            return valid;
        }

        // Attach client-side validators to non-AJAX forms
        const changePasswordForm = document.getElementById('changePasswordForm');
        if (changePasswordForm) {
            changePasswordForm.addEventListener('submit', (ev) => {
                ev.preventDefault();
                changePasswordForm.querySelectorAll('[data-error]').forEach((el) => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });
                if (validateRequiredFields(changePasswordForm, ['security_answer', 'new_password',
                        'new_password_confirmation'
                    ])) {
                    changePasswordForm.submit();
                }
            });
        }

        const changeQuestionForm = document.getElementById('changeQuestionForm');
        if (changeQuestionForm) {
            changeQuestionForm.addEventListener('submit', (ev) => {
                ev.preventDefault();
                changeQuestionForm.querySelectorAll('[data-error]').forEach((el) => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });
                if (validateRequiredFields(changeQuestionForm, ['security_question', 'security_answer',
                        'security_answer_confirmation'
                    ])) {
                    const answer = (changeQuestionForm.querySelector('#security_answer_new')?.value || '').trim();
                    const answerConfirmation = (changeQuestionForm.querySelector('#security_answer_confirmation')
                        ?.value || '').trim();
                    if (answer !== answerConfirmation) {
                        const errEl = changeQuestionForm.querySelector(
                            '[data-error="security_answer_confirmation"]');
                        if (errEl) {
                            errEl.textContent = 'Las respuestas no coinciden.';
                            errEl.classList.remove('hidden');
                        }
                        return;
                    }
                    changeQuestionForm.submit();
                }
            });
        }

        const deleteAccountForm = document.getElementById('deleteAccountForm');
        if (deleteAccountForm) {
            deleteAccountForm.addEventListener('submit', (ev) => {
                ev.preventDefault();
                deleteAccountForm.querySelectorAll('[data-error]').forEach((el) => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });
                if (validateRequiredFields(deleteAccountForm, ['delete_password',
                    'delete_password_confirmation'])) {
                    deleteAccountForm.submit();
                }
            });
        }

        // Handle verify password form via AJAX. On success, open the change question modal.
        const verifyForm = document.getElementById('verifyPasswordForm');
        if (verifyForm) {
            verifyForm.addEventListener('submit', async (ev) => {
                ev.preventDefault();
                // Clear any previous inline errors before submitting
                verifyForm.querySelectorAll('[data-error]').forEach((el) => {
                    el.textContent = '';
                    el.classList.add('hidden');
                });
                // Client-side required check
                if (!validateRequiredFields(verifyForm, ['current_password',
                    'current_password_confirmation'])) {
                    return;
                }
                const formData = new FormData(verifyForm);

                try {
                    const res = await fetch("<?php echo e(route('profile.security.verify-password')); ?>", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': _csrf,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    if (res.ok) {
                        closeVerifyPasswordModal();
                        openChangeQuestionModal();
                        return;
                    }

                    if (res.status === 422) {
                        const data = await res.json();
                        const errors = data.errors || {};
                        // Populate inline field errors
                        Object.entries(errors).forEach(([field, arr]) => {
                            const rawMsg = Array.isArray(arr) && arr.length ? arr[0] : '';
                            const msg = (function(fieldName, serverMsg) {
                                if (fieldName.endsWith('_confirmation')) {
                                    if (fieldName.includes('password'))
                                    return 'Las contraseñas no coinciden.';
                                    if (fieldName.includes('answer'))
                                    return 'Las respuestas no coinciden.';
                                    return 'Los campos no coinciden.';
                                }
                                if (fieldName.includes('password')) {
                                    return 'Contraseña incorrecta.';
                                }
                                if (fieldName.includes('security_answer') || fieldName.includes(
                                        'answer')) {
                                    return 'Respuesta incorrecta.';
                                }
                                // Fallback: try to detect common English keywords and translate simply
                                const s = (serverMsg || '').toLowerCase();
                                if (s.includes('required')) return 'Este campo es obligatorio.';
                                if (s.includes('confirmed') || s.includes('does not match') || s
                                    .includes('match')) return 'No coinciden.';
                                if (s.includes('invalid') || s.includes('incorrect'))
                                return 'Valor inválido.';
                                // Default to server message (prefer Spanish if already provided) or a generic one
                                return serverMsg || 'Campo inválido.';
                            })(field, rawMsg);

                            const el = verifyForm.querySelector(`[data-error="${field}"]`);
                            if (el) {
                                el.textContent = msg;
                                el.classList.remove('hidden');
                            }
                        });
                        return;
                    }

                    alert('Ocurrió un error. Intenta de nuevo.');
                } catch (err) {
                    console.error(err);
                    alert('Error de red. Revisa tu conexión.');
                }
            });
        }
    </script>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\pablo\vitalia-api\resources\views/profile/security-account.blade.php ENDPATH**/ ?>