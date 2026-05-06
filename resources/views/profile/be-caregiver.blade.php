@component('layouts.app', ['title' => 'Volverse cuidador'])
	<div class="relative min-h-screen bg-slate-50">
		<main class="mx-auto flex min-h-screen w-full max-w-2xl flex-col px-4 pb-[calc(8rem+env(safe-area-inset-bottom))] pt-6 sm:px-6 sm:pt-8">
			<div class="mx-auto flex w-full max-w-xl flex-col items-stretch gap-6 sm:gap-8">
				<div>
					<a href="{{ route('profile.dashboard') }}"
						class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,0.05)] transition-transform hover:scale-[1.01]">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
							<path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
						Volver
					</a>
				</div>

				<section class="flex flex-col items-center text-center">
					<x-vitalia-logo class="scale-[0.48] sm:scale-[0.58] md:scale-[0.66]" />

					<div class="mt-4 space-y-2">
						<h1 class="text-[26px] font-semibold leading-tight text-slate-950 sm:text-[30px] md:text-[34px]">
							¿Quieres volverte cuidador de un paciente?
						</h1>
						<p class="mx-auto max-w-lg text-[15px] leading-6 text-slate-400 sm:text-[17px]">
							Ingresa el correo electronico del paciente para enviarle una solicitud.
						</p>
					</div>
				</section>

				<section class="rounded-3xl bg-white p-6 shadow-[0_6px_20px_rgba(15,23,42,0.05)] sm:p-7">
					@if (session('status'))
						<div
							class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm leading-6 text-emerald-800">
							{{ session('status') }}
						</div>
					@endif

					@php($cooldownUntil = (int) session('caregiver_request_resend_available_at', 0))
					@php($cooldownRemaining = max(0, $cooldownUntil - now()->timestamp))

					<form method="POST" action="{{ route('profile.be-caregiver.request') }}" class="grid grid-cols-1 gap-4">
						@csrf

						<div>
							<label for="patient_email" class="mb-2 block text-sm font-medium text-slate-700">Correo del
								paciente</label>
							<input id="patient_email" name="patient_email" type="email" autocomplete="email"
								value="{{ old('patient_email') }}"
								class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-[0_6px_18px_rgba(15,23,42,0.04)] outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
							@error('patient_email')
								<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
							@enderror
						</div>

						<button type="submit"
							id="send-caregiver-request-button"
							data-cooldown-until="{{ $cooldownUntil }}"
							class="inline-flex w-full items-center justify-center rounded-2xl bg-[#0b67c2] px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.25)] transition hover:scale-[1.01] hover:bg-[#0a5cad] disabled:cursor-not-allowed disabled:opacity-70"
							@disabled($cooldownRemaining > 0)>
							<span data-caregiver-request-button-label>
								{{ $cooldownRemaining > 0 ? "Enviar solicitud ({$cooldownRemaining}s)" : 'Enviar solicitud' }}
							</span>
						</button>

						@if (session('status'))
							<p class="text-sm leading-6 text-emerald-700">El codigo ya fue enviado. Si cerraste el modal, puedes volver a abrirlo.</p>
						@endif

						<button type="button"
							data-open-caregiver-code-modal
							class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-[0_6px_18px_rgba(15,23,42,0.05)] transition hover:scale-[1.01] hover:bg-slate-50">
							Ya Tengo Codigo
						</button>
					</form>

					<dialog id="caregiver-request-code-modal" class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white shadow-[0_24px_60px_rgba(15,23,42,0.18)]">
						<form method="POST" action="{{ route('profile.be-caregiver.verify') }}" class="flex flex-col p-6 sm:p-8">
							@csrf
							<div class="flex items-start justify-between gap-4 mb-4">
								<div class="flex-1">
									<p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#0b67c2]">Ingresa el código</p>
									<h2 class="mt-1 text-xl font-semibold text-slate-950 sm:text-2xl">Ingresa el código de confirmación</h2>
								</div>
								<button type="button" data-close-caregiver-code-modal class="shrink-0 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">Cerrar</button>
							</div>

							<p class="text-sm leading-6 text-slate-600 mb-6">Le enviamos un código de 6 dígitos a la cuenta del paciente. Pídele al paciente que te comparta el código para confirmar que acepta vincularte como su cuidador.</p>

							<div class="flex justify-center mb-6">
								<div id="code-inputs" class="flex gap-2 sm:gap-3">
									@for ($i = 0; $i < 6; $i++)
										<input inputmode="numeric" maxlength="1" pattern="[0-9]*" class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg border-2 border-slate-200 bg-slate-50 text-center text-lg sm:text-xl font-semibold text-slate-900 outline-none transition focus:border-[#0b67c2] focus:ring-2 focus:ring-[#0b67c2]/15" />
									@endfor
								</div>
							</div>

							<input type="hidden" name="code" id="caregiver_code_input" />

							@if ($errors->has('code'))
								<p class="text-center text-[13px] text-red-600 font-medium mb-4" id="caregiver-code-error">{{ $errors->first('code') }}</p>
							@else
								<p class="text-center text-[13px] text-slate-500 mb-6">¿No recibieron el código? Pídele al paciente que revise su correo, notificaciones o bandeja de SPAM.</p>
							@endif

							<div class="grid grid-cols-1 gap-3">
								<button type="submit" id="verify-caregiver-code-button" disabled class="w-full rounded-2xl bg-[#0b67c2] py-3 text-sm font-semibold text-white shadow-[0_10px_22px_rgba(11,103,194,0.25)] transition hover:scale-[1.01] hover:bg-[#0a5cad] disabled:opacity-60 disabled:hover:scale-100">Verificar código</button>
								<button type="button" data-close-caregiver-code-modal class="w-full rounded-2xl border border-slate-200 bg-white py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Volver</button>
							</div>
						</form>
					</dialog>

					<style>
						/* Modal backdrop styling */
						#caregiver-request-code-modal::backdrop { 
							background: rgba(2, 6, 23, 0.5);
						}
						
						/* Position and sizing */
						#caregiver-request-code-modal {
							position: fixed;
							top: 50%;
							left: 50%;
							transform: translate(-50%, -50%);
							padding: 1rem;
							margin: 0;
							border-radius: 1.5rem;
							max-height: 90vh;
							overflow-y: auto;
						}
						
						/* Ensure modal doesn't overflow on small screens */
						@media (max-width: 640px) {
							#caregiver-request-code-modal {
								width: calc(100% - 2rem);
								padding: 0.75rem;
							}
							
							#code-inputs input {
								width: 2.5rem;
								height: 2.5rem;
								font-size: 1rem;
							}
						}
						
						/* Scrollbar styling for modal */
						#caregiver-request-code-modal::-webkit-scrollbar {
							width: 6px;
						}
						
						#caregiver-request-code-modal::-webkit-scrollbar-track {
							background: transparent;
						}
						
						#caregiver-request-code-modal::-webkit-scrollbar-thumb {
							background: rgba(2, 6, 23, 0.1);
							border-radius: 3px;
						}
					</style>

					<script>
						document.addEventListener('DOMContentLoaded', () => {
							const modal = document.getElementById('caregiver-request-code-modal');
							const openButtons = document.querySelectorAll('[data-open-caregiver-code-modal]');
							const closeButtons = document.querySelectorAll('[data-close-caregiver-code-modal]');
							const inputs = Array.from(document.querySelectorAll('#code-inputs input'));
							const hiddenInput = document.getElementById('caregiver_code_input');
							const submitButton = document.getElementById('verify-caregiver-code-button');

							const openModal = () => {
								if (modal && typeof modal.showModal === 'function' && ! modal.open) {
									modal.showModal();
									// focus first input
									setTimeout(() => inputs[0]?.focus(), 100);
								}
							};

							openButtons.forEach((el) => el.addEventListener('click', openModal));
							closeButtons.forEach((el) => el.addEventListener('click', () => modal?.close()));

							// open if session indicates
							if ({{ session('open_caregiver_code_modal') ? 'true' : 'false' }}) {
								openModal();
							}

							function updateHiddenAndState() {
								const value = inputs.map(i => i.value.trim()).join('');
								hiddenInput.value = value;
								submitButton.disabled = value.length !== 6;
							}

							inputs.forEach((input, idx) => {
								input.addEventListener('input', (e) => {
									const v = input.value.replace(/\D/g, '');
									input.value = v;
									if (v && idx < inputs.length - 1) inputs[idx + 1].focus();
									updateHiddenAndState();
								});

								input.addEventListener('keydown', (e) => {
									if (e.key === 'Backspace' && !input.value && idx > 0) {
										inputs[idx - 1].focus();
									}
								});

								// support paste
								input.addEventListener('paste', (e) => {
									e.preventDefault();
									const paste = (e.clipboardData || window.clipboardData).getData('text') || '';
									const digits = paste.replace(/\D/g, '').slice(0, 6).split('');
									digits.forEach((d, i) => { if (inputs[i]) inputs[i].value = d; });
									updateHiddenAndState();
								});
							});

							updateHiddenAndState();
						});
					</script>
          
				</section>
			</div>
		</main>

		<x-vitalia-bottom-nav active="profile" />
	</div>
@endcomponent
