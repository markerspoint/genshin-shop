@php
    $images = [
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Genshin_Impact_wordmark.svg',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | Genshin Impact</title>
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

            <main class="mx-auto mt-6 max-w-[920px] border-x border-b thin-border bg-[#17181b] p-4 md:p-5">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                    <div class="rounded-xl border thin-border bg-[#111214] p-4 md:col-span-2">
                        <p class="text-xs uppercase tracking-[0.22em] text-slate-300">Traveler Console</p>
                        <h1 class="title-font mt-2 text-2xl font-bold">Dashboard</h1>
                        <p class="mt-1 text-sm text-slate-300">{{ auth()->user()->name }} · {{ auth()->user()->email }}</p>
                    </div>
                    <div class="rounded-xl border thin-border bg-[#111214] p-4">
                        <p class="text-xs uppercase tracking-[0.18em] text-white/60">Characters</p>
                        <p class="mt-2 text-2xl font-bold text-cyan-200">{{ $characterCount ?? 'N/A' }}</p>
                        @if (is_null($characterCount))
                            <p class="mt-1 text-xs text-amber-200/85">Run `php artisan migrate`.</p>
                        @endif
                    </div>
                </div>

                <section id="characters-admin" class="mt-4 rounded-xl border thin-border bg-[#111214] p-4">
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <h2 class="title-font text-xl font-bold">Character CRUD</h2>
                        <a href="{{ route('home') }}#characters" class="rounded-full border thin-border px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.15em] text-white/80 transition hover:border-white/40 hover:text-white">
                            View Landing
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="mb-3 rounded-xl border border-emerald-300/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-100">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-3 rounded-xl border border-rose-300/30 bg-rose-500/10 px-3 py-2 text-sm text-rose-100">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (! $crudEnabled)
                        <p class="rounded-xl border border-amber-300/35 bg-amber-500/10 px-3 py-2 text-sm text-amber-100">
                            Migration missing: run <span class="font-semibold">php artisan migrate</span>.
                        </p>
                    @else
                        <form method="POST" action="{{ route('characters.store') }}" class="grid gap-2 rounded-xl border thin-border bg-[#17181b] p-3 md:grid-cols-[1fr_130px_1fr_90px_auto]">
                            @csrf
                            <input name="name" type="text" required placeholder="Name" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-cyan-200 focus:outline-none">
                            <select name="element" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                @foreach ($elements as $element)
                                    <option value="{{ $element }}">{{ $element }}</option>
                                @endforeach
                            </select>
                            <input name="image_url" type="url" required placeholder="Image URL" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-cyan-200 focus:outline-none">
                            <input name="sort_order" type="number" min="0" value="0" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-cyan-200 focus:outline-none">
                            <button type="submit" class="rounded-lg bg-cyan-300 px-3 py-2 text-xs font-bold uppercase tracking-[0.15em] text-slate-950 transition hover:bg-cyan-200">
                                Create
                            </button>
                        </form>

                        <div class="mt-3 max-h-[420px] space-y-2 overflow-y-auto pr-1">
                            @forelse ($characters as $character)
                                <div class="rounded-xl border thin-border bg-[#17181b] p-3">
                                    <form method="POST" action="{{ route('characters.update', $character->id) }}" class="grid gap-2 md:grid-cols-[1fr_130px_1fr_80px_auto]">
                                        @csrf
                                        @method('PATCH')
                                        <input name="name" type="text" value="{{ $character->name }}" required class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                        <select name="element" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                            @foreach ($elements as $element)
                                                <option value="{{ $element }}" @selected($character->element === $element)>{{ $element }}</option>
                                            @endforeach
                                        </select>
                                        <input name="image_url" type="url" value="{{ $character->image_url }}" required class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                        <input name="sort_order" type="number" min="0" value="{{ $character->sort_order }}" class="rounded-lg border border-white/20 bg-[#111214] px-3 py-2 text-sm text-white focus:border-cyan-200 focus:outline-none">
                                        <button type="submit" class="rounded-lg border border-cyan-200/60 px-3 py-2 text-xs font-bold uppercase tracking-[0.14em] text-cyan-100 transition hover:bg-cyan-200/10">
                                            Save
                                        </button>
                                    </form>
                                    <div class="mt-2 flex justify-end">
                                        <form method="POST" action="{{ route('characters.destroy', $character->id) }}" onsubmit="return confirm('Delete this character?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-rose-200/60 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.14em] text-rose-100 transition hover:bg-rose-200/10">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="rounded-xl border thin-border bg-[#17181b] px-3 py-2 text-sm text-white/70">
                                    No characters in database yet.
                                </p>
                            @endforelse
                        </div>
                    @endif
                </section>
            </main>
        </div>
    </body>
</html>
