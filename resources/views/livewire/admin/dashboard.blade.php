@php
	$adminName = auth()->user()?->name ?: 'Administrador';

	$cards = [
		[
			'title' => 'Gestión de usuarios',
			'description' => 'Revisa médicos y farmacéuticos recién registrados y valida su cédula profesional.',
			'icon' => 'users',
			'href' => '#',
		],
		[
			'title' => 'Bandeja de validación',
			'description' => 'Bloquea cuentas o da de baja perfiles por mal uso.',
			'icon' => 'document-check',
			'href' => '#',
		],
	];

	$icon = function (string $type): string {
		return match ($type) {
			'users' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-9 sm:w-9"><circle cx="8" cy="8" r="2.4" stroke="currentColor" stroke-width="2"/><circle cx="16" cy="8" r="2.4" stroke="currentColor" stroke-width="2"/><path d="M4.5 18c.6-2.6 2.8-4.5 5.5-4.5s4.9 1.9 5.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M13 18c.5-2.1 2.2-3.6 4.3-3.6 2 0 3.6 1.3 4.2 3.2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="2.2" stroke="currentColor" stroke-width="2"/></svg>',
			'document-check' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-9 sm:w-9"><path d="M7 3.75h6.5L18.5 8.75V20.25H7V3.75Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M13.5 3.75v5h5" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9.25 14h3.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M9.25 17h2.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M15.5 16.5l1.2 1.2 2.3-2.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16.5" cy="17" r="3.25" stroke="currentColor" stroke-width="2"/></svg>',
			default => '',
		};
	};

	$chevron = '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 shrink-0 text-slate-900 transition-transform group-hover:translate-x-0.5"><path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp

<div class="relative min-h-screen bg-[linear-gradient(180deg,#f8fafc_0%,#f3f6f8_100%)]">
	<main class="mx-auto flex min-h-screen w-full max-w-4xl flex-col px-4 pb-[calc(7.5rem+env(safe-area-inset-bottom))] pt-5 sm:px-6 sm:pt-7 lg:px-8">
		<div class="mx-auto flex w-full max-w-3xl flex-col gap-6 sm:gap-7">
			<div class="flex flex-col items-center gap-4 text-center sm:gap-5">
				<x-vitalia-logo class="scale-[0.44] sm:scale-[0.52] md:scale-[0.6]" />

				<div class="space-y-1">
					<h1 class="text-[28px] font-semibold leading-none tracking-tight text-slate-950 sm:text-[32px] md:text-[36px]">
						Hola, {{ $adminName }}
					</h1>
					<p class="text-[15px] font-medium text-slate-400 sm:text-[16px]">
						Administra y valida a los usuarios.
					</p>
				</div>
			</div>

			<section class="grid grid-cols-1 gap-4 sm:gap-5 md:grid-cols-2">
				@foreach ($cards as $card)
					<a
						href="{{ $card['href'] }}"
						class="group flex min-h-[178px] items-center gap-4 rounded-[26px] bg-[#eff2f5] px-4 py-4 shadow-[0_1px_0_rgba(15,23,42,0.03)] transition-transform hover:scale-[1.01] sm:min-h-[188px] sm:px-5"
					>
						<div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#e1e6eb] text-[#0b67c2] sm:h-20 sm:w-20">
							{!! $icon($card['icon']) !!}
						</div>

						<div class="min-w-0 flex-1 text-left">
							<h2 class="text-[18px] font-bold leading-tight text-slate-950 sm:text-[19px]">
								{{ $card['title'] }}
							</h2>
							<p class="mt-2 max-w-[28ch] text-[14px] leading-5 text-slate-400 sm:text-[15px]">
								{{ $card['description'] }}
							</p>
						</div>

						{!! $chevron !!}
					</a>
				@endforeach
			</section>

			<form method="POST" action="{{ route('logout') }}" class="hidden">
				@csrf
				<button type="submit">Cerrar sesión</button>
			</form>
		</div>
	</main>

	<x-vitalia-bottom-nav active="home" />
</div>
