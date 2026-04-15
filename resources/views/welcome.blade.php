@php
    $images = [
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Genshin_Impact_wordmark.svg',
        'heroBg' => 'https://static.wikia.nocookie.net/gensin-impact/images/2/2f/Inazuma.png/revision/latest?cb=20230818202755',
        'heroCharacter' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303',
        'bannerBg' => 'https://static.wikia.nocookie.net/gensin-impact/images/b/b9/Mondstadt.png/revision/latest?cb=20230818202148',
    ];

    $teams = [
        ['label' => 'Pyro Team Compositions', 'name' => 'Arlecchino Vaporize', 'members' => ['Neuvillette', 'Yae Miko', 'Furina', 'Raiden']],
        ['label' => 'Electro Team Compositions', 'name' => 'Raiden Overload', 'members' => ['Raiden', 'Yae Miko', 'Neuvillette', 'Furina']],
        ['label' => 'Geo Team Compositions', 'name' => 'Navia Crystallization', 'members' => ['Furina', 'Neuvillette', 'Raiden', 'Yae Miko']],
        ['label' => 'Hydro Team Compositions', 'name' => 'Furina Hyperbloom', 'members' => ['Furina', 'Neuvillette', 'Yae Miko', 'Raiden']],
    ];

    $memberImages = [
        'Yae Miko' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303',
        'Raiden' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003',
        'Neuvillette' => 'https://static.wikia.nocookie.net/gensin-impact/images/5/5e/Character_Neuvillette_Full_Wish.png/revision/latest?cb=20230814030603',
        'Furina' => 'https://static.wikia.nocookie.net/gensin-impact/images/9/94/Character_Furina_Full_Wish.png/revision/latest?cb=20231021031756',
    ];

    $teamMembers = [
        'Mark Ian D. Dela Cruz',
        'Khen Matondo',
        'Renle M. Carpentero',
        'Joshua D. Mirano',
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
        <title>Genshin Impact - Character Hub</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Oxanium:wght@500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root { color-scheme: dark; }
            body { font-family: "Outfit", sans-serif; background: #111214; }
            .title-font { font-family: "Oxanium", sans-serif; }
            .thin-border { border-color: rgba(255, 255, 255, 0.18); }
            .element-dot { width: .65rem; height: .65rem; border-radius: 9999px; display: inline-block; }
        </style>
    </head>
    <body class="text-slate-100 antialiased">
        <div class="w-full pb-10">
            <header class="sticky top-0 z-50 border-b border-white/20 bg-[#111214]/95 backdrop-blur">
                <div class="mx-auto flex h-16 max-w-[1180px] items-center justify-between gap-4 px-4 md:px-6">
                    <a href="#top" class="flex items-center">
                        <img src="{{ $images['logo'] }}" alt="Genshin Impact logo" class="h-7 w-auto">
                    </a>

                    <nav class="hidden items-center gap-8 text-[13px] text-white/80 md:flex">
                        <a href="#characters" class="hover:text-white">Characters</a>
                        <a href="#builds" class="hover:text-white">Builds</a>
                        <a href="#teams" class="hover:text-white">Team List</a>
                        <a href="#about-team" class="hover:text-white">About Team</a>
                        <a href="#database" class="hover:text-white">Database</a>
                    </nav>

                    <div class="flex items-center gap-2">
                        <div class="hidden items-center rounded-full border border-white/40 bg-[#0f1012] px-3 py-1.5 text-xs text-white/70 md:flex">Search</div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-full border border-emerald-200/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-emerald-100 transition hover:bg-emerald-200/10">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full border border-cyan-200/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-cyan-100 transition hover:bg-cyan-200/10">Login</a>
                        @endauth
                    </div>
                </div>
            </header>

            <main id="top" class="space-y-0">
                <section class="relative overflow-hidden border-x border-b thin-border">
                    <img src="{{ $images['heroBg'] }}" alt="Hero background" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#f28e5f]/35 via-[#7f4654]/30 to-[#111214]/85"></div>

                    <div class="relative mx-auto min-h-[620px] max-w-[1180px] px-4 md:px-6">
                        <h1 class="title-font pt-10 text-center text-5xl font-extrabold tracking-[0.08em] text-white md:text-8xl">YAE MIKO</h1>
                        <img src="{{ $images['heroCharacter'] }}" alt="Yae Miko" class="pointer-events-none mx-auto mt-2 h-[460px] w-auto max-w-none md:h-[540px]">

                        <div class="absolute left-6 top-1/2 hidden -translate-y-1/2 text-sm md:block">
                            <p class="mb-2 text-white/70">Element</p>
                            <p class="font-semibold text-fuchsia-300">Electro</p>
                            <p class="mb-2 mt-6 text-white/70">Weapon</p>
                            <p class="font-semibold text-white">Catalyst</p>
                        </div>

                        <div class="absolute right-6 top-1/2 hidden -translate-y-1/2 text-right text-sm md:block">
                            <p class="mb-2 text-white/70">Type</p>
                            <p class="font-semibold text-white">Sub DPS</p>
                            <p class="mb-2 mt-6 text-white/70">Rarity</p>
                            <p class="font-semibold tracking-[0.22em] text-amber-300">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>
                </section>

                <section id="characters" class="border-x border-b thin-border bg-[#17181b]">
                    <div class="mx-auto max-w-[1180px]">
                        <div class="grid grid-cols-1 border-b thin-border md:grid-cols-[1.2fr_1.8fr]">
                            <div class="border-b px-6 py-6 thin-border md:border-b-0 md:border-r">
                                <p class="text-sm text-white/70">Genshin Impact</p>
                                <h2 class="title-font text-4xl font-bold">Characters List</h2>
                            </div>
                            <div class="flex items-center justify-center gap-4 px-6 py-6">
                                <span class="element-dot bg-emerald-300"></span>
                                <span class="element-dot bg-cyan-300"></span>
                                <span class="element-dot bg-violet-300"></span>
                                <span class="element-dot bg-lime-300"></span>
                                <span class="element-dot bg-amber-300"></span>
                                <span class="element-dot bg-sky-300"></span>
                                <span class="element-dot bg-orange-300"></span>
                            </div>
                        </div>

                        <div class="px-6 py-8">
                            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-6">
                                @foreach ($characters as $character)
                                    <article class="group rounded-2xl border thin-border bg-[#111214] p-2 transition hover:-translate-y-0.5 hover:border-white/40">
                                        <div class="aspect-square overflow-hidden rounded-xl bg-[#1d1f23]">
                                            <img src="{{ $character['image'] }}" alt="{{ $character['name'] }}" class="h-full w-full object-cover object-top">
                                        </div>
                                        <p class="mt-2 truncate text-center text-xs font-medium text-white/90">{{ $character['name'] }}</p>
                                        <span class="mx-auto mt-1 block w-fit rounded-full px-2 py-0.5 text-[10px] font-semibold {{ $elementClasses[$character['element']] ?? 'bg-slate-300 text-slate-900' }}">
                                            {{ $character['element'] }}
                                        </span>
                                    </article>
                                @endforeach
                            </div>
                            <div class="mt-8 text-center">
                                <button class="rounded-full border thin-border px-5 py-2 text-sm text-white/80 transition hover:border-white/40 hover:text-white">View more</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="builds" class="relative overflow-hidden border-x border-b thin-border">
                    <img src="{{ $images['bannerBg'] }}" alt="Banner background" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-[#1f1115]/55 backdrop-blur-[2px]"></div>
                    <div class="relative mx-auto max-w-[1180px] px-6 py-20 md:py-24">
                        <p class="text-sm text-white/70">v5.2</p>
                        <h2 class="title-font max-w-xl text-5xl font-extrabold leading-tight md:text-6xl">Tapestry of<br>Spirit and Flame</h2>
                        <div class="mt-8 flex gap-3">
                            <button class="rounded-full border border-white/70 px-5 py-2 text-sm text-white">Cloud Play</button>
                            <button class="rounded-full border border-white/70 bg-white/10 px-5 py-2 text-sm text-white">PC Download</button>
                        </div>
                    </div>
                </section>

                <section id="teams" class="border-x border-b thin-border bg-[#17181b]">
                    <div class="mx-auto max-w-[1180px]">
                        <div class="grid grid-cols-1 border-b thin-border md:grid-cols-[1.2fr_1.8fr]">
                            <div class="border-b px-6 py-6 thin-border md:border-b-0 md:border-r">
                                <p class="text-sm text-white/70">Genshin Impact</p>
                                <h2 class="title-font text-4xl font-bold">Team Compositions</h2>
                            </div>
                            <div class="flex items-center justify-center gap-4 px-6 py-6">
                                <span class="element-dot bg-emerald-300"></span>
                                <span class="element-dot bg-cyan-300"></span>
                                <span class="element-dot bg-violet-300"></span>
                                <span class="element-dot bg-lime-300"></span>
                                <span class="element-dot bg-amber-300"></span>
                                <span class="element-dot bg-sky-300"></span>
                                <span class="element-dot bg-orange-300"></span>
                            </div>
                        </div>

                        <div class="space-y-4 px-6 py-8">
                            @foreach ($teams as $team)
                                <article class="grid grid-cols-1 overflow-hidden rounded-2xl border thin-border bg-[#111214] lg:grid-cols-[1.2fr_2fr]">
                                    <div class="border-b px-5 py-4 thin-border lg:border-b-0 lg:border-r">
                                        <p class="text-xs uppercase tracking-[0.16em] text-white/60">{{ $team['label'] }}</p>
                                        <h3 class="title-font mt-2 text-3xl font-bold">{{ $team['name'] }}</h3>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 px-5 py-4 sm:grid-cols-4">
                                        @foreach ($team['members'] as $member)
                                            <div class="text-center">
                                                <div class="mx-auto aspect-square w-16 overflow-hidden rounded-xl border thin-border bg-[#1d1f23]">
                                                    <img src="{{ $memberImages[$member] }}" alt="{{ $member }}" class="h-full w-full object-cover object-top">
                                                </div>
                                                <p class="mt-2 text-xs text-white/90">{{ $member }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            @endforeach

                            <div class="pt-2 text-center">
                                <button class="rounded-full border thin-border px-5 py-2 text-sm text-white/80 transition hover:border-white/40 hover:text-white">View more</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="about-team" class="border-x border-b thin-border bg-[#141519]">
                    <div class="mx-auto max-w-[1180px] px-6 py-10">
                        <p class="text-sm text-white/70">Project Team</p>
                        <h2 class="title-font mt-1 text-4xl font-bold">About Our Team</h2>
                        <p class="mt-2 max-w-2xl text-sm text-white/70">
                            This project was designed and developed by our team as part of our Genshin-themed marketplace and UI system.
                        </p>

                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($teamMembers as $member)
                                <article class="rounded-xl border thin-border bg-[#111214] p-4">
                                    <p class="text-xs uppercase tracking-[0.16em] text-cyan-200/90">Member</p>
                                    <h3 class="mt-2 text-base font-semibold leading-snug text-white">{{ $member }}</h3>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            </main>

            <footer id="database" class="border-x border-b thin-border bg-[#17181b]">
                <div class="mx-auto grid max-w-[1180px] gap-10 px-6 py-12 md:grid-cols-4">
                    <div>
                        <img src="{{ $images['logo'] }}" alt="Genshin Impact logo" class="h-8 w-auto">
                        <p class="mt-4 text-sm text-white/70">Send your tips, trends & updates.</p>
                        <div class="mt-4 rounded-full border thin-border px-4 py-2 text-sm text-white/60">Your Email</div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Games</h4>
                        <ul class="mt-3 space-y-2 text-sm text-white/70">
                            <li>Cloud Play</li>
                            <li>PC Download</li>
                            <li>News</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Discover</h4>
                        <ul class="mt-3 space-y-2 text-sm text-white/70">
                            <li>Characters</li>
                            <li>Builds</li>
                            <li>Teams</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">About</h4>
                        <ul class="mt-3 space-y-2 text-sm text-white/70">
                            <li>Authors</li>
                            <li>Contact</li>
                            <li>Policy</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
