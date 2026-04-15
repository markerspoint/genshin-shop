@php
    $images = [
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Genshin_Impact_wordmark.svg',
        'mondstadt' => 'https://static.wikia.nocookie.net/gensin-impact/images/b/b9/Mondstadt.png/revision/latest?cb=20230818202148',
        'inazuma' => 'https://static.wikia.nocookie.net/gensin-impact/images/2/2f/Inazuma.png/revision/latest?cb=20230818202755',
        'inazumaMap' => 'https://static.wikia.nocookie.net/gensin-impact/images/0/04/Inazuma_Map.png/revision/latest?cb=20221121040501',
        'inazumaEmblem' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a5/Inazuma_Emblem_Night.png/revision/latest?cb=20231103102405',
        'raiden' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003',
    ];

    $packs = [
        ['name' => 'Welkin Starter', 'crystals' => '300 + 30 bonus', 'price' => '$4.99'],
        ['name' => 'Explorer Bundle', 'crystals' => '980 + 110 bonus', 'price' => '$14.99'],
        ['name' => 'Archon Bundle', 'crystals' => '1,980 + 260 bonus', 'price' => '$29.99'],
        ['name' => 'Legend Bundle', 'crystals' => '3,280 + 600 bonus', 'price' => '$49.99'],
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Genshin Impact Top-Up</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                color-scheme: dark;
            }

            body {
                font-family: "Rajdhani", sans-serif;
            }

            .title-font {
                font-family: "Cinzel", serif;
            }

            #h-scroll {
                scrollbar-width: thin;
                scrollbar-color: #a5d8ff #041126;
            }

            #h-scroll::-webkit-scrollbar {
                height: 10px;
            }

            #h-scroll::-webkit-scrollbar-track {
                background: #041126;
            }

            #h-scroll::-webkit-scrollbar-thumb {
                background: linear-gradient(90deg, #60a5fa, #93c5fd);
                border-radius: 9999px;
            }

            .nav-link[aria-current="true"] {
                border-color: #a5f3fc;
                background: rgba(14, 165, 233, 0.25);
                color: #f8fafc;
            }

            .panel-dot[aria-current="true"] {
                width: 2.25rem;
                border-color: #a5f3fc;
                background: rgba(125, 211, 252, 0.85);
            }

            .panel-layer {
                will-change: transform, opacity;
                --edge-fade: 0%;
                -webkit-mask-image: linear-gradient(
                    to right,
                    transparent 0%,
                    #000 var(--edge-fade),
                    #000 calc(100% - var(--edge-fade)),
                    transparent 100%
                );
                mask-image: linear-gradient(
                    to right,
                    transparent 0%,
                    #000 var(--edge-fade),
                    #000 calc(100% - var(--edge-fade)),
                    transparent 100%
                );
            }
        </style>
    </head>
    <body class="overflow-x-hidden bg-slate-950 text-slate-100 antialiased">
        <div class="pointer-events-none fixed inset-x-0 top-0 z-40 h-28 bg-gradient-to-b from-slate-950/95 to-transparent"></div>

        <header class="fixed left-0 top-0 z-50 flex w-full items-center justify-between px-4 pb-2 pt-4 md:px-8">
            <div class="flex items-center gap-3">
                <img src="{{ $images['logo'] }}" alt="Genshin Impact logo" class="h-8 w-auto md:h-10">
                <div class="hidden text-[11px] uppercase tracking-[0.3em] text-cyan-100/90 md:block">Top-Up Portal</div>
            </div>

            <nav class="hidden items-center gap-2 md:flex">
                <button class="nav-link rounded-full border border-white/30 px-3 py-1.5 text-[11px] uppercase tracking-[0.3em] text-white/80 transition hover:border-cyan-200 hover:text-white" data-panel="0" aria-current="true">Intro</button>
                <button class="nav-link rounded-full border border-white/30 px-3 py-1.5 text-[11px] uppercase tracking-[0.3em] text-white/80 transition hover:border-cyan-200 hover:text-white" data-panel="1">Packs</button>
                <button class="nav-link rounded-full border border-white/30 px-3 py-1.5 text-[11px] uppercase tracking-[0.3em] text-white/80 transition hover:border-cyan-200 hover:text-white" data-panel="2">Bonus</button>
                <button class="nav-link rounded-full border border-white/30 px-3 py-1.5 text-[11px] uppercase tracking-[0.3em] text-white/80 transition hover:border-cyan-200 hover:text-white" data-panel="3">Featured</button>
                <button class="nav-link rounded-full border border-white/30 px-3 py-1.5 text-[11px] uppercase tracking-[0.3em] text-white/80 transition hover:border-cyan-200 hover:text-white" data-panel="4">Checkout</button>
            </nav>
        </header>

        <div id="scroll-shell" class="relative h-[500vh]">
            <main id="h-scroll" class="sticky top-0 h-screen w-screen overflow-hidden">
                <div class="relative h-full w-full">
                <section class="panel-layer absolute inset-0 overflow-hidden" data-snap-panel>
                    <img src="{{ $images['mondstadt'] }}" alt="Mondstadt landscape" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/65 to-indigo-950/50"></div>
                    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col justify-center gap-8 px-6 pt-20 md:px-10 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-5">
                            <p class="text-xs uppercase tracking-[0.45em] text-cyan-200">Official Style Top-Up Mockup</p>
                            <h1 class="title-font text-4xl leading-tight text-white sm:text-5xl lg:text-6xl">
                                Recharge Genesis Crystals,
                                <span class="text-amber-200">Summon Your Next 5-Star.</span>
                            </h1>
                            <p class="max-w-xl text-lg text-slate-200/95 sm:text-xl">
                                Horizontal storefront for fast Genshin Impact top-ups. Swipe on mobile, or use mouse wheel on desktop.
                            </p>
                            <div class="flex flex-wrap items-center gap-3">
                                <button data-panel="1" class="rounded-full bg-cyan-300 px-6 py-3 text-sm font-bold uppercase tracking-[0.2em] text-slate-950 transition hover:bg-cyan-200">Browse Packs</button>
                                <button data-panel="4" class="rounded-full border border-cyan-100/70 px-6 py-3 text-sm font-bold uppercase tracking-[0.2em] text-cyan-50 transition hover:border-cyan-200 hover:bg-cyan-200/10">Top Up Now</button>
                            </div>
                        </div>

                        <div class="w-full max-w-md rounded-3xl border border-cyan-200/30 bg-slate-900/65 p-6 shadow-2xl shadow-cyan-500/20 backdrop-blur-md">
                            <p class="text-xs uppercase tracking-[0.35em] text-cyan-200/90">Flash Deal</p>
                            <h2 class="title-font mt-2 text-3xl text-white">First Purchase Bonus</h2>
                            <p class="mt-2 text-slate-200">Get up to 2x crystals on your first recharge of each tier.</p>
                            <div class="mt-5 space-y-3">
                                <div class="flex items-center justify-between rounded-xl border border-white/15 bg-white/5 px-4 py-3">
                                    <span class="text-lg font-semibold">300 + 300</span>
                                    <span class="text-cyan-200">$4.99</span>
                                </div>
                                <div class="flex items-center justify-between rounded-xl border border-white/15 bg-white/5 px-4 py-3">
                                    <span class="text-lg font-semibold">980 + 980</span>
                                    <span class="text-cyan-200">$14.99</span>
                                </div>
                                <div class="flex items-center justify-between rounded-xl border border-white/15 bg-white/5 px-4 py-3">
                                    <span class="text-lg font-semibold">1,980 + 1,980</span>
                                    <span class="text-cyan-200">$29.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel-layer absolute inset-0 overflow-hidden" data-snap-panel>
                    <img src="{{ $images['inazuma'] }}" alt="Inazuma landscape" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#06091d]/90 via-[#10143d]/80 to-[#1f1249]/70"></div>
                    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col justify-center px-6 pt-20 md:px-10">
                        <div class="mb-6 flex flex-col gap-2">
                            <p class="text-xs uppercase tracking-[0.4em] text-violet-200/90">Crystal Packages</p>
                            <h2 class="title-font text-4xl text-white sm:text-5xl">Choose Your Top-Up Amount</h2>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach ($packs as $pack)
                                <article class="group rounded-2xl border border-white/15 bg-slate-950/45 p-5 backdrop-blur-sm transition hover:-translate-y-1 hover:border-cyan-200/70 hover:bg-slate-900/60">
                                    <p class="text-xs uppercase tracking-[0.35em] text-cyan-200/80">{{ $pack['name'] }}</p>
                                    <p class="title-font mt-4 text-3xl text-amber-200">{{ $pack['price'] }}</p>
                                    <p class="mt-3 text-2xl font-semibold text-white">{{ $pack['crystals'] }}</p>
                                    <button class="mt-6 w-full rounded-xl bg-cyan-300 px-4 py-2.5 text-sm font-bold uppercase tracking-[0.15em] text-slate-950 transition group-hover:bg-cyan-200">
                                        Buy Now
                                    </button>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="panel-layer absolute inset-0 overflow-hidden" data-snap-panel>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,#1e3a8a_0%,#0f172a_45%,#020617_100%)]"></div>
                    <img src="{{ $images['inazumaMap'] }}" alt="Inazuma map" class="absolute -right-32 top-1/2 h-[82vh] -translate-y-1/2 opacity-35 blur-[1px]">
                    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col justify-center gap-8 px-6 pt-20 md:px-10 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-sky-200">Event Bonus</p>
                            <h2 class="title-font text-4xl leading-tight sm:text-5xl">Inazuma Storm Surge Bonus Week</h2>
                            <p class="text-lg text-slate-200/90">
                                Recharge any package and receive extra Primogems with bonus Mora and Hero's Wit. Rewards scale by top-up tier.
                            </p>
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                <div class="rounded-xl border border-sky-100/20 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-sky-200/90">Bonus Primogems</p>
                                    <p class="mt-2 text-3xl font-bold text-white">+1,600</p>
                                </div>
                                <div class="rounded-xl border border-sky-100/20 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.3em] text-sky-200/90">Reward Window</p>
                                    <p class="mt-2 text-3xl font-bold text-white">72 Hours</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full max-w-sm rounded-3xl border border-sky-100/20 bg-slate-950/45 p-8 text-center backdrop-blur-md">
                            <img src="{{ $images['inazumaEmblem'] }}" alt="Inazuma emblem" class="mx-auto mb-4 h-20 w-20">
                            <p class="text-xs uppercase tracking-[0.35em] text-sky-200">Region Buff</p>
                            <p class="title-font mt-2 text-3xl text-white">Thunder's Favor</p>
                            <p class="mt-3 text-slate-300">Spend 3,280 crystals and claim an extra weapon ascension material chest.</p>
                            <button class="mt-6 w-full rounded-xl border border-sky-100/50 px-4 py-2.5 text-sm font-bold uppercase tracking-[0.2em] text-sky-100 transition hover:bg-sky-200/10">
                                Activate Bonus
                            </button>
                        </div>
                    </div>
                </section>

                <section class="panel-layer absolute inset-0 overflow-hidden" data-snap-panel>
                    <div class="absolute inset-0 bg-gradient-to-br from-[#10002b] via-[#18013f] to-[#030014]"></div>
                    <img src="{{ $images['raiden'] }}" alt="Raiden Shogun artwork" class="absolute -right-40 bottom-0 h-[90vh] max-w-none opacity-90 md:right-0 md:h-[95vh]">
                    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col justify-center px-6 pt-20 md:px-10">
                        <div class="max-w-2xl space-y-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-violet-200">Featured Wish Prep</p>
                            <h2 class="title-font text-4xl text-white sm:text-5xl lg:text-6xl">Ready for Raiden Rerun?</h2>
                            <p class="max-w-xl text-lg text-violet-100/90">
                                Recharge once, convert to Primogems, and stack enough pulls before the banner timer ends.
                            </p>
                            <div class="grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-3">
                                <div class="rounded-xl border border-violet-100/20 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-violet-200">Step 1</p>
                                    <p class="mt-2 font-semibold">Top Up</p>
                                </div>
                                <div class="rounded-xl border border-violet-100/20 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-violet-200">Step 2</p>
                                    <p class="mt-2 font-semibold">Convert</p>
                                </div>
                                <div class="rounded-xl border border-violet-100/20 bg-white/5 p-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-violet-200">Step 3</p>
                                    <p class="mt-2 font-semibold">Wish</p>
                                </div>
                            </div>
                            <button data-panel="4" class="rounded-full bg-violet-300 px-7 py-3 text-sm font-bold uppercase tracking-[0.2em] text-[#19003f] transition hover:bg-violet-200">
                                Go to Checkout
                            </button>
                        </div>
                    </div>
                </section>

                <section class="panel-layer absolute inset-0 overflow-hidden" data-snap-panel>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,#14532d_0%,#0f172a_50%,#020617_100%)]"></div>
                    <div class="relative mx-auto flex h-full w-full max-w-7xl flex-col justify-center gap-8 px-6 pt-20 md:px-10 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-4">
                            <p class="text-xs uppercase tracking-[0.35em] text-emerald-200">Secure Checkout</p>
                            <h2 class="title-font text-4xl sm:text-5xl">Complete Your Top-Up</h2>
                            <p class="text-lg text-slate-200/90">
                                Enter your UID, pick a package, choose payment method, and instantly receive Genesis Crystals.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <span class="rounded-full border border-emerald-100/30 bg-white/5 px-4 py-1.5 text-xs uppercase tracking-[0.2em]">GCash</span>
                                <span class="rounded-full border border-emerald-100/30 bg-white/5 px-4 py-1.5 text-xs uppercase tracking-[0.2em]">Maya</span>
                                <span class="rounded-full border border-emerald-100/30 bg-white/5 px-4 py-1.5 text-xs uppercase tracking-[0.2em]">Cards</span>
                                <span class="rounded-full border border-emerald-100/30 bg-white/5 px-4 py-1.5 text-xs uppercase tracking-[0.2em]">PayPal</span>
                            </div>
                        </div>

                        <form class="w-full max-w-md space-y-4 rounded-3xl border border-white/15 bg-slate-950/55 p-6 backdrop-blur-md">
                            <div>
                                <label class="mb-1.5 block text-xs uppercase tracking-[0.22em] text-emerald-200">Player UID</label>
                                <input type="text" placeholder="800123456" class="w-full rounded-xl border border-white/20 bg-slate-900/60 px-4 py-3 text-base text-white placeholder:text-slate-400 focus:border-emerald-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs uppercase tracking-[0.22em] text-emerald-200">Select Package</label>
                                <select class="w-full rounded-xl border border-white/20 bg-slate-900/60 px-4 py-3 text-base text-white focus:border-emerald-200 focus:outline-none">
                                    <option>300 + 30 bonus</option>
                                    <option>980 + 110 bonus</option>
                                    <option>1,980 + 260 bonus</option>
                                    <option>3,280 + 600 bonus</option>
                                </select>
                            </div>
                            <button type="button" class="w-full rounded-xl bg-emerald-300 px-5 py-3 text-sm font-bold uppercase tracking-[0.22em] text-slate-950 transition hover:bg-emerald-200">
                                Pay and Deliver
                            </button>
                            <p class="text-xs text-slate-300/80">Fan-made UI demo for layout practice. Not an official payment page.</p>
                        </form>
                    </div>
                </section>
                </div>
            </main>
        </div>

        <div class="fixed bottom-4 left-1/2 z-50 flex -translate-x-1/2 items-center gap-2 rounded-full border border-white/20 bg-slate-950/60 px-3 py-2 backdrop-blur md:bottom-6">
            <button class="panel-dot h-2 w-4 rounded-full border border-white/40 bg-white/30 transition-all" data-panel="0" aria-current="true"></button>
            <button class="panel-dot h-2 w-4 rounded-full border border-white/40 bg-white/30 transition-all" data-panel="1"></button>
            <button class="panel-dot h-2 w-4 rounded-full border border-white/40 bg-white/30 transition-all" data-panel="2"></button>
            <button class="panel-dot h-2 w-4 rounded-full border border-white/40 bg-white/30 transition-all" data-panel="3"></button>
            <button class="panel-dot h-2 w-4 rounded-full border border-white/40 bg-white/30 transition-all" data-panel="4"></button>
        </div>

        <script>
            const scroller = document.getElementById('h-scroll');
            const panels = Array.from(document.querySelectorAll('[data-snap-panel]'));
            const navButtons = Array.from(document.querySelectorAll('[data-panel]'));
            const scrollShell = document.getElementById('scroll-shell');
            const panelCount = panels.length;
            const totalSteps = Math.max(panelCount - 1, 1);

            function activatePanel(index) {
                navButtons.forEach((button) => {
                    const isActive = Number(button.dataset.panel) === index;
                    button.setAttribute('aria-current', isActive ? 'true' : 'false');
                });
            }

            function goToPanel(index) {
                const maxVerticalScroll = scrollShell.offsetHeight - window.innerHeight;
                const targetProgress = Math.min(Math.max(index / totalSteps, 0), 1);
                const targetTop = scrollShell.offsetTop + (maxVerticalScroll * targetProgress);

                window.scrollTo({
                    top: targetTop,
                    behavior: 'auto',
                });
                activatePanel(index);
            }

            navButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    goToPanel(Number(button.dataset.panel));
                });
            });

            function renderPanelsFromProgress(progress) {
                const virtualIndex = progress * totalSteps;
                panels.forEach((panel, index) => {
                    const delta = index - virtualIndex;
                    const distance = Math.abs(delta);
                    const shift = delta * 96;
                    const edgeFade = 6;

                    panel.style.opacity = '1';
                    panel.style.transform = `translate3d(${shift}vw, 0, 0)`;
                    panel.style.zIndex = String(100 - Math.round(distance * 10));
                    panel.style.setProperty('--edge-fade', `${edgeFade.toFixed(2)}%`);
                    panel.style.pointerEvents = distance < 0.6 ? 'auto' : 'none';
                });

                const activeIndex = Math.round(virtualIndex);
                activatePanel(activeIndex);
            }

            function syncHorizontalFromVertical() {
                const maxVerticalScroll = scrollShell.offsetHeight - window.innerHeight;
                if (maxVerticalScroll <= 0) {
                    renderPanelsFromProgress(0);
                    return;
                }

                const currentVertical = Math.min(
                    Math.max(window.scrollY - scrollShell.offsetTop, 0),
                    maxVerticalScroll
                );

                const progress = currentVertical / maxVerticalScroll;
                renderPanelsFromProgress(progress);
            }

            window.addEventListener('scroll', syncHorizontalFromVertical, { passive: true });
            window.addEventListener('resize', syncHorizontalFromVertical);
            window.addEventListener('load', syncHorizontalFromVertical);
        </script>
    </body>
</html>
