<main class="mx-auto flex min-h-screen w-full max-w-5xl flex-col gap-6 px-6 py-12">
    <header class="flex flex-col gap-4">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-slate-500">Vitalia</p>
                <h1 class="text-3xl font-semibold text-slate-900">Dashboard</h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="rounded-[12px] border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                >
                    Cerrar sesion
                </button>
            </form>
        </div>
        <p class="max-w-2xl text-base text-slate-600">
            Aqui inicia la experiencia web. Puedes reemplazar este contenido con las pantallas del repo.
        </p>
    </header>
</main>
