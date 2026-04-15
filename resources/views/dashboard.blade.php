@php
    $images = [
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Genshin_Impact_wordmark.svg',
    ];

    $elementClasses = [
        'Anemo' => 'bg-emerald-300 text-emerald-950',
        'Cryo' => 'bg-cyan-300 text-cyan-950',
        'Dendro' => 'bg-lime-300 text-lime-950',
        'Electro' => 'bg-violet-300 text-violet-950',
        'Geo' => 'bg-amber-300 text-amber-950',
        'Hydro' => 'bg-sky-300 text-sky-950',
        'Pyro' => 'bg-orange-300 text-orange-950',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marketplace Dashboard | Genshin Impact</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Oxanium:wght@500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root { color-scheme: dark; }
            body { font-family: "Outfit", sans-serif; background: #111214; }
            .title-font { font-family: "Oxanium", sans-serif; }
            .thin-border { border-color: rgba(255, 255, 255, 0.18); }
        </style>
    </head>
    <body class="text-slate-100 antialiased">
        <div class="w-full min-h-screen pb-8">
            <header class="sticky top-0 z-50 border-b border-white/20 bg-[#111214]/95 backdrop-blur">
                <div class="mx-auto flex h-16 max-w-[1180px] items-center justify-between gap-4 px-4 md:px-6">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ $images['logo'] }}" alt="Genshin Impact logo" class="h-7 w-auto">
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('home') }}" class="rounded-full border border-emerald-200/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-emerald-100 transition hover:bg-emerald-200/10">
                            Landing
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full border border-rose-200/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-rose-100 transition hover:bg-rose-200/10">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto mt-5 max-w-[860px] border-x border-b thin-border bg-[#17181b] p-3 md:p-4">
                <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                    <div class="rounded-xl border thin-border bg-[#111214] p-3 md:col-span-2">
                        <p class="text-xs uppercase tracking-[0.22em] text-slate-300">Market Console</p>
                        <h1 class="title-font mt-1.5 text-xl font-bold">Buy & Sell Characters</h1>
                        <p class="mt-1 text-sm text-slate-300">{{ auth()->user()->name }} &middot; {{ auth()->user()->email }}</p>
                    </div>
                    <div class="rounded-xl border thin-border bg-[#111214] p-3">
                        <p class="text-xs uppercase tracking-[0.18em] text-white/60">Live Listings</p>
                        <p class="mt-1.5 text-xl font-bold text-cyan-200">{{ $characterCount ?? 'N/A' }}</p>
                        @if (is_null($characterCount))
                            <p class="mt-1 text-xs text-amber-200/85">Run `php artisan migrate`.</p>
                        @endif
                    </div>
                </div>

                @if (session('status'))
                    <div class="mt-3 rounded-xl border border-emerald-300/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-3 rounded-xl border border-rose-300/30 bg-rose-500/10 px-3 py-2 text-sm text-rose-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (! $crudEnabled)
                    <div class="mt-3 rounded-xl border border-amber-300/35 bg-amber-500/10 px-3 py-2 text-sm text-amber-100">
                        Migration missing: run <span class="font-semibold">php artisan migrate</span>.
                    </div>
                @else
                    <section id="sell" class="mt-3 rounded-xl border thin-border bg-[#111214] p-3">
                        <h2 class="title-font text-lg font-bold">Sell Character</h2>
                        <form method="POST" action="{{ route('characters.store') }}" class="mt-2 grid gap-2 md:grid-cols-[190px_1fr_92px_auto]">
                            @csrf
                            <select name="name" id="sell-character-name" data-character-select data-preview-target="sell-character-preview" data-element-target="sell-character-element" class="rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                @foreach ($characterCatalog as $characterName => $details)
                                    <option value="{{ $characterName }}">{{ $characterName }}</option>
                                @endforeach
                            </select>
                            <div class="flex items-center gap-2 rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2">
                                <img id="sell-character-preview" src="{{ reset($characterCatalog)['image_url'] ?? '' }}" alt="Character preview" class="h-8 w-8 rounded-md object-cover object-top">
                                <div>
                                    <p class="text-[11px] text-white/60">Element</p>
                                    <p id="sell-character-element" class="text-xs font-semibold">{{ reset($characterCatalog)['element'] ?? '-' }}</p>
                                </div>
                            </div>
                            <input name="sort_order" type="number" min="1" value="500" placeholder="Price" class="rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2 text-sm text-white placeholder:text-slate-400 focus:border-cyan-200 focus:outline-none">
                            <button type="submit" class="rounded-lg bg-cyan-300 px-2.5 py-2 text-[11px] font-bold uppercase tracking-[0.12em] text-slate-950 transition hover:bg-cyan-200">
                                List
                            </button>
                        </form>
                    </section>

                    <section id="market" class="mt-3 rounded-xl border thin-border bg-[#111214] p-3">
                        <h2 class="title-font text-lg font-bold">Marketplace</h2>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @forelse ($characters as $character)
                                <article class="w-[170px] rounded-lg border thin-border bg-[#17181b] p-2">
                                    <div class="aspect-[4/3] overflow-hidden rounded-md bg-[#111214]">
                                        <img src="{{ $character->image_url }}" alt="{{ $character->name }}" class="h-full w-full object-cover object-top">
                                    </div>
                                    <div class="mt-2 flex items-start justify-between gap-2">
                                        <div>
                                            <p class="text-xs font-semibold leading-tight">{{ $character->name }}</p>
                                            <span class="mt-1 inline-flex rounded-full px-1.5 py-0.5 text-[10px] font-semibold {{ $elementClasses[$character->element] ?? 'bg-slate-300 text-slate-900' }}">
                                                {{ $character->element }}
                                            </span>
                                        </div>
                                        <p class="text-xs font-bold text-cyan-200">₱{{ number_format((int) $character->sort_order) }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('characters.buy', $character->id) }}" class="mt-2">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg border border-cyan-200/60 px-2 py-1.5 text-[11px] font-bold uppercase tracking-[0.1em] text-cyan-100 transition hover:bg-cyan-200/10">
                                            Buy
                                        </button>
                                    </form>
                                </article>
                            @empty
                                <p class="col-span-full rounded-xl border thin-border bg-[#17181b] px-3 py-2 text-sm text-white/70">
                                    No listings yet. Create your first sale above.
                                </p>
                            @endforelse
                        </div>
                    </section>

                    <section id="manage" class="mt-3 rounded-xl border thin-border bg-[#111214] p-3">
                        <h2 class="title-font text-lg font-bold">Manage Listings</h2>
                        <div class="mt-2 max-h-[300px] space-y-2 overflow-y-auto pr-1">
                            @forelse ($characters as $character)
                                <div class="rounded-lg border thin-border bg-[#17181b] p-2.5">
                                    <div class="grid gap-2 md:grid-cols-[1fr_auto] md:items-center">
                                        <div class="grid gap-2 md:grid-cols-[180px_210px_70px] md:items-center">
                                            <p class="rounded-lg border border-white/20 bg-[#111214] px-2.5 py-2 text-sm font-semibold text-white">
                                                {{ $character->name }}
                                            </p>
                                            <div class="flex items-center gap-2 rounded-lg border border-white/20 bg-[#111214] px-2.5 py-2">
                                                <img id="preview-{{ $character->id }}" src="{{ $character->image_url }}" alt="{{ $character->name }}" class="h-8 w-8 rounded-md object-cover object-top">
                                                <div>
                                                    <p class="text-[11px] text-white/60">Element</p>
                                                    <p id="element-{{ $character->id }}" class="text-xs font-semibold">{{ $character->element }}</p>
                                                </div>
                                            </div>
                                            <p class="rounded-lg border border-white/20 bg-[#111214] px-2.5 py-2 text-sm font-semibold text-white">
                                                {{ $character->sort_order }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-2 md:justify-end">
                                            <button
                                                type="button"
                                                data-edit-open
                                                data-update-url="{{ route('characters.update', $character->id) }}"
                                                data-name="{{ $character->name }}"
                                                data-sort-order="{{ $character->sort_order }}"
                                                class="rounded-lg border border-cyan-200/60 px-2.5 py-2 text-[11px] font-bold uppercase tracking-[0.1em] text-cyan-100 transition hover:bg-cyan-200/10"
                                            >
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('characters.destroy', $character->id) }}" onsubmit="return confirm('Remove this listing?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-rose-200/60 px-2.5 py-2 text-[11px] font-bold uppercase tracking-[0.1em] text-rose-100 transition hover:bg-rose-200/10">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="rounded-xl border thin-border bg-[#17181b] px-3 py-2 text-sm text-white/70">
                                    No listings to manage.
                                </p>
                            @endforelse
                        </div>
                    </section>
                @endif
            </main>
        </div>
        @if ($crudEnabled)
            <div id="edit-modal" class="fixed inset-0 z-[80] hidden items-center justify-center p-3">
                <div data-edit-close class="absolute inset-0 bg-black/75"></div>
                <div class="relative z-10 w-full max-w-md rounded-xl border thin-border bg-[#111214] p-4">
                    <div class="mb-3 flex items-center justify-between gap-2">
                        <h3 class="title-font text-lg font-bold">Edit Listing</h3>
                        <button type="button" data-edit-close class="rounded-md border border-white/30 px-2 py-1 text-xs font-semibold uppercase tracking-[0.08em] text-white/80 transition hover:bg-white/10">
                            Close
                        </button>
                    </div>
                    <form id="edit-modal-form" method="POST" class="space-y-2">
                        @csrf
                        @method('PATCH')
                        <select id="edit-modal-name" name="name" data-character-select data-preview-target="edit-modal-preview" data-element-target="edit-modal-element" class="w-full rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                            @foreach ($characterCatalog as $characterName => $details)
                                <option value="{{ $characterName }}">{{ $characterName }}</option>
                            @endforeach
                        </select>
                        <div class="flex items-center gap-2 rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2">
                            <img id="edit-modal-preview" src="{{ reset($characterCatalog)['image_url'] ?? '' }}" alt="Character preview" class="h-9 w-9 rounded-md object-cover object-top">
                            <div>
                                <p class="text-[11px] text-white/60">Element</p>
                                <p id="edit-modal-element" class="text-xs font-semibold">{{ reset($characterCatalog)['element'] ?? '-' }}</p>
                            </div>
                        </div>
                        <input id="edit-modal-sort-order" name="sort_order" type="number" min="1" placeholder="Price" class="w-full rounded-lg border border-white/20 bg-[#17181b] px-2.5 py-2 text-sm text-white placeholder:text-slate-400 focus:border-cyan-200 focus:outline-none">
                        <div class="flex items-center justify-end gap-2 pt-1">
                            <button type="button" data-edit-close class="rounded-lg border border-white/30 px-3 py-2 text-[11px] font-bold uppercase tracking-[0.1em] text-white/80 transition hover:bg-white/10">
                                Cancel
                            </button>
                            <button type="submit" class="rounded-lg border border-cyan-200/60 px-3 py-2 text-[11px] font-bold uppercase tracking-[0.1em] text-cyan-100 transition hover:bg-cyan-200/10">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                const characterCatalog = @json($characterCatalog);
                const selects = document.querySelectorAll('[data-character-select]');
                const editModal = document.getElementById('edit-modal');
                const editModalForm = document.getElementById('edit-modal-form');
                const editModalName = document.getElementById('edit-modal-name');
                const editModalSortOrder = document.getElementById('edit-modal-sort-order');
                const editOpenButtons = document.querySelectorAll('[data-edit-open]');
                const editCloseButtons = document.querySelectorAll('[data-edit-close]');

                selects.forEach((select) => {
                    const previewId = select.dataset.previewTarget;
                    const elementId = select.dataset.elementTarget;
                    const preview = document.getElementById(previewId);
                    const elementLabel = document.getElementById(elementId);

                    function applyCharacter() {
                        const selectedName = select.value;
                        const details = characterCatalog[selectedName];
                        if (!details) return;

                        if (preview) preview.src = details.image_url;
                        if (elementLabel) elementLabel.textContent = details.element;
                    }

                    select.addEventListener('change', applyCharacter);
                    applyCharacter();
                });

                function closeEditModal() {
                    if (!editModal) return;
                    editModal.classList.add('hidden');
                    editModal.classList.remove('flex');
                }

                editOpenButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        if (!editModal || !editModalForm || !editModalName || !editModalSortOrder) return;

                        editModalForm.action = button.dataset.updateUrl || '';
                        editModalName.value = button.dataset.name || '';
                        editModalSortOrder.value = button.dataset.sortOrder || '';
                        editModalName.dispatchEvent(new Event('change'));

                        editModal.classList.remove('hidden');
                        editModal.classList.add('flex');
                        editModalName.focus();
                    });
                });

                editCloseButtons.forEach((button) => {
                    button.addEventListener('click', closeEditModal);
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeEditModal();
                    }
                });

                editModalForm?.addEventListener('submit', () => {
                    if (editModal) {
                        editModal.classList.add('pointer-events-none', 'opacity-80');
                    }
                });

                window.addEventListener('pageshow', () => {
                    if (editModal) {
                        editModal.classList.remove('pointer-events-none', 'opacity-80');
                        closeEditModal();
                    }
                });

                if (editModalForm && editModalName) {
                    editModalForm.addEventListener('reset', () => {
                        setTimeout(() => {
                            editModalName.dispatchEvent(new Event('change'));
                        }, 0);
                    });
                }
            </script>
        @endif
    </body>
</html>
