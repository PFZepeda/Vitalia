@component('layouts.app', ['title' => 'Volver a ser paciente'])
	<div class="relative min-h-screen bg-[radial-gradient(circle_at_top,_rgba(11,103,194,0.12),_transparent_38%),linear-gradient(180deg,#f8fafc_0%,#eef4fb_100%)]">
		<main class="mx-auto flex min-h-screen w-full max-w-3xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
			<div class="mx-auto flex w-full max-w-2xl flex-col gap-6 sm:gap-8">
				<div>
					<a href="{{ route('profile.dashboard') }}"
						class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/90 px-4 py-2 text-sm font-semibold text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,0.05)] backdrop-blur transition-transform hover:scale-[1.01]">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
							<path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						Volver
					</a>
				</div>

				<section class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/90 shadow-[0_18px_60px_rgba(15,23,42,0.08)] backdrop-blur">
					<div class="grid gap-0 lg:grid-cols-[1.1fr_0.9fr]">
						<div class="flex flex-col justify-between gap-8 p-6 sm:p-8 md:p-10">
							<div class="space-y-5 text-left sm:text-center lg:text-left">
								<div class="inline-flex items-center gap-2 rounded-full bg-[#eaf2fb] px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-[#0b67c2]">
									<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
										<path d="M12 22s8-4 8-10V6l-8-3-8 3v6c0 6 8 10 8 10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
									</svg>
									Cambio de rol seguro
								</div>

								<div class="space-y-3">
									<h1 class="text-[28px] font-semibold leading-tight text-slate-950 sm:text-[34px] md:text-[40px]">
										¿Quieres dejar de ser cuidador y volver a ser paciente?
									</h1>
									<p class="max-w-xl text-[15px] leading-7 text-slate-500 sm:text-[16px]">
										Para proteger tu cuenta te pediremos confirmar tu contraseña antes de cambiar tu rol nuevamente a paciente.
									</p>
								</div>

								<div class="grid gap-3 sm:grid-cols-3">
									<div class="rounded-3xl bg-slate-50 px-4 py-4 text-left">
										<p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Paso 1</p>
										<p class="mt-2 text-sm font-semibold text-slate-900">Confirma tu contraseña</p>
									</div>
									<div class="rounded-3xl bg-slate-50 px-4 py-4 text-left">
										<p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Paso 2</p>
										<p class="mt-2 text-sm font-semibold text-slate-900">Volverás a paciente</p>
									</div>
									<div class="rounded-3xl bg-slate-50 px-4 py-4 text-left">
										<p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Paso 3</p>
										<p class="mt-2 text-sm font-semibold text-slate-900">Irás a tu dashboard</p>
									</div>
								</div>
							</div>

							<div class="flex flex-col gap-3 sm:flex-row">
								<button type="button" data-open-be-patient-modal class="inline-flex flex-1 items-center justify-center rounded-2xl bg-[#0b67c2] px-5 py-4 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.25)] transition hover:scale-[1.01] hover:bg-[#0a5cad]">
									Dejar de ser cuidador
								</button>
								<a href="{{ route('profile.dashboard') }}" class="inline-flex flex-1 items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
									Cancelar
								</a>
							</div>
						</div>

						<div class="relative hidden min-h-[320px] bg-gradient-to-br from-[#0b67c2] via-[#105fb0] to-[#062b52] p-6 lg:block">
							<div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.28),_transparent_38%),radial-gradient(circle_at_bottom_right,_rgba(255,255,255,0.14),_transparent_35%)]"></div>
							<div class="relative flex h-full flex-col justify-between rounded-[1.75rem] border border-white/15 bg-white/10 p-6 text-white shadow-[0_20px_50px_rgba(0,0,0,0.18)] backdrop-blur">
								<div class="space-y-4">
									<x-vitalia-logo class="scale-[0.55] origin-top-left brightness-0 invert" />
									<p class="max-w-sm text-[15px] leading-7 text-white/85">
										Mantén tu cuenta segura. Solo cambiaremos tu rol después de validar tu contraseña.
									</p>
								</div>

								<div class="grid gap-3">
									<div class="rounded-3xl border border-white/15 bg-white/10 px-4 py-4">
										<p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/60">Acceso</p>
										<p class="mt-2 text-sm font-medium text-white">Tu acceso de paciente seguirá listo en cuanto confirmes.</p>
									</div>
									<div class="rounded-3xl border border-white/15 bg-white/10 px-4 py-4">
										<p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/60">Seguridad</p>
										<p class="mt-2 text-sm font-medium text-white">No se modifica tu contraseña, solo tu rol principal.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_10px_28px_rgba(15,23,42,0.06)] sm:p-8">
					<div class="flex items-start gap-4">
						<div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#eaf2fb] text-[#0b67c2]">
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7">
								<path d="M12 1.75L21 5.5V12C21 17.5 16.95 21.95 12 22.25C7.05 21.95 3 17.5 3 12V5.5L12 1.75Z" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round" />
								<path d="M9.5 12.25L11 13.75L14.75 10" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="min-w-0 flex-1">
							<h2 class="text-lg font-semibold text-slate-950 sm:text-xl">Antes de continuar</h2>
							<p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 sm:text-[15px]">
								Al pulsar el botón se abrirá una ventana para confirmar tu contraseña. Si es correcta, volverás automáticamente a tu panel de paciente.
							</p>
						</div>
					</div>
				</section>
			</div>
		</main>

		<dialog id="be-patient-modal" class="w-full max-w-lg rounded-[2rem] border border-slate-200 bg-white p-0 shadow-[0_24px_70px_rgba(15,23,42,0.18)]">
			<form method="POST" action="{{ route('profile.be-patient.confirm') }}" class="flex flex-col p-6 sm:p-8">
				@csrf

				<div class="mb-5 flex items-start justify-between gap-4">
					<div class="flex-1">
						<p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#0b67c2]">Confirmar identidad</p>
						<h2 class="mt-1 text-2xl font-semibold text-slate-950">Ingresa tu contraseña</h2>
					</div>
					<button type="button" data-close-be-patient-modal class="shrink-0 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Cerrar</button>
				</div>

				<p class="mb-6 text-sm leading-6 text-slate-500">
					Esto evita cambios accidentales. Al confirmar, tu cuenta quedará con el rol de paciente.
				</p>

				<div class="mb-4">
					<label for="password" class="mb-2 block text-sm font-medium text-slate-700">Contraseña</label>
					<div class="relative">
						<input id="password" name="password" type="password" autocomplete="current-password" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-20 text-slate-900 outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
						<button type="button" data-toggle-password class="absolute inset-y-0 right-0 flex items-center px-4 text-sm font-semibold text-[#0b67c2] transition hover:text-[#0958a8]">Mostrar</button>
					</div>
					@error('password')
						<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="grid gap-3 sm:grid-cols-2">
					<button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[#0b67c2] px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.25)] transition hover:scale-[1.01] hover:bg-[#0a5cad]">
						Confirmar cambio
					</button>
					<button type="button" data-close-be-patient-modal class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
						Cancelar
					</button>
				</div>
			</form>
		</dialog>

		<style>
			#be-patient-modal::backdrop {
				background: rgba(2, 6, 23, 0.54);
			}

			#be-patient-modal {
				max-height: min(92vh, 48rem);
				overflow-y: auto;
			}

			@media (max-width: 640px) {
				#be-patient-modal {
					width: calc(100% - 1.5rem);
					border-radius: 1.5rem;
				}
			}
		</style>

		<script>
			document.addEventListener('DOMContentLoaded', () => {
				const modal = document.getElementById('be-patient-modal');
				const openButtons = document.querySelectorAll('[data-open-be-patient-modal]');
				const closeButtons = document.querySelectorAll('[data-close-be-patient-modal]');
				const passwordInput = document.getElementById('password');
				const togglePasswordButton = document.querySelector('[data-toggle-password]');

				const openModal = () => {
					if (modal && typeof modal.showModal === 'function' && ! modal.open) {
						modal.showModal();
						setTimeout(() => passwordInput?.focus(), 100);
					}
				};

				openButtons.forEach((button) => button.addEventListener('click', openModal));
				closeButtons.forEach((button) => button.addEventListener('click', () => modal?.close()));

				togglePasswordButton?.addEventListener('click', () => {
					if (! passwordInput) {
						return;
					}

					const showPassword = passwordInput.type === 'password';
					passwordInput.type = showPassword ? 'text' : 'password';
					togglePasswordButton.textContent = showPassword ? 'Ocultar' : 'Mostrar';
				});

				if ({{ session('open_be_patient_modal') ? 'true' : 'false' }}) {
					openModal();
				}
			});
		</script>

		<x-vitalia-bottom-nav active="profile" />
	</div>
@endcomponent