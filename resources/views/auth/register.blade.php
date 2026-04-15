@php
    $images = [
        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Genshin_Impact_wordmark.svg',
        'bg' => 'https://static.wikia.nocookie.net/gensin-impact/images/b/b9/Mondstadt.png/revision/latest?cb=20230818202148',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register | Genshin Impact</title>
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
        <div class="w-full min-h-screen pb-8">
            <header class="sticky top-0 z-50 border-b border-white/20 bg-[#111214]/95 backdrop-blur">
                <div class="mx-auto flex h-16 max-w-[1180px] items-center justify-between gap-4 px-4 md:px-6">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ $images['logo'] }}" alt="Genshin Impact logo" class="h-7 w-auto">
                    </a>
                    <div class="hidden items-center gap-8 text-[13px] text-white/80 md:flex">
                        <a href="{{ route('home') }}#characters" class="hover:text-white">Characters</a>
                        <a href="{{ route('home') }}#teams" class="hover:text-white">Team List</a>
                        <a href="{{ route('home') }}#database" class="hover:text-white">Database</a>
                    </div>
                    <a href="{{ route('login') }}" class="rounded-full border border-cyan-200/70 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.22em] text-cyan-100 transition hover:bg-cyan-200/10">
                        Login
                    </a>
                </div>
            </header>

            <main class="mx-auto mt-6 max-w-[1180px] border-x border-b thin-border bg-[#17181b]">
                <section class="grid min-h-[calc(100vh-7.5rem)] grid-cols-1 lg:grid-cols-[1.05fr_.95fr]">
                    <div class="relative hidden overflow-hidden border-r thin-border lg:block">
                        <img src="{{ $images['bg'] }}" alt="Mondstadt background" class="absolute inset-0 h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-b from-[#62b5ff]/20 via-[#2a5376]/25 to-[#111214]/85"></div>
                        <div class="relative flex h-full flex-col justify-end p-8">
                            <p class="text-xs uppercase tracking-[0.28em] text-violet-200/90">New Traveler</p>
                            <h1 class="title-font mt-3 text-5xl font-bold leading-tight text-white">Register</h1>
                            <p class="mt-3 max-w-sm text-sm text-white/80">Create your account to save team compositions and access updates.</p>
                            <div class="mt-6 flex gap-3">
                                <span class="element-dot bg-emerald-300"></span>
                                <span class="element-dot bg-cyan-300"></span>
                                <span class="element-dot bg-violet-300"></span>
                                <span class="element-dot bg-lime-300"></span>
                                <span class="element-dot bg-amber-300"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-5 py-8 sm:px-8">
                        <div class="w-full max-w-sm rounded-2xl border thin-border bg-[#111214] p-6">
                            <p class="text-xs uppercase tracking-[0.3em] text-violet-200/90">Account</p>
                            <h2 class="title-font mt-2 text-3xl font-bold">Create Profile</h2>

                            @if ($errors->any())
                                <div class="mt-4 rounded-xl border border-rose-300/30 bg-rose-500/10 px-3 py-2 text-sm text-rose-100">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.store') }}" class="mt-5 space-y-3">
                                @csrf
                                <div>
                                    <label for="name" class="mb-1.5 block text-xs uppercase tracking-[0.2em] text-slate-300">Name</label>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="w-full rounded-lg border border-white/20 bg-[#17181b] px-3 py-2.5 text-sm text-white placeholder:text-slate-400 focus:border-violet-200 focus:outline-none">
                                </div>
                                <div>
                                    <label for="email" class="mb-1.5 block text-xs uppercase tracking-[0.2em] text-slate-300">Email</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-white/20 bg-[#17181b] px-3 py-2.5 text-sm text-white placeholder:text-slate-400 focus:border-violet-200 focus:outline-none">
                                </div>
                                <div>
                                    <label for="password" class="mb-1.5 block text-xs uppercase tracking-[0.2em] text-slate-300">Password</label>
                                    <input id="password" name="password" type="password" required class="w-full rounded-lg border border-white/20 bg-[#17181b] px-3 py-2.5 text-sm text-white placeholder:text-slate-400 focus:border-violet-200 focus:outline-none">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="mb-1.5 block text-xs uppercase tracking-[0.2em] text-slate-300">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-lg border border-white/20 bg-[#17181b] px-3 py-2.5 text-sm text-white placeholder:text-slate-400 focus:border-violet-200 focus:outline-none">
                                </div>
                                <button type="submit" class="w-full rounded-lg bg-violet-300 px-4 py-2.5 text-sm font-bold uppercase tracking-[0.2em] text-[#22003f] transition hover:bg-violet-200">
                                    Create Account
                                </button>
                            </form>

                            <div class="mt-4 flex items-center justify-between text-xs text-slate-300">
                                <a href="{{ route('login') }}" class="hover:text-violet-200">Already have an account?</a>
                                <a href="{{ route('home') }}" class="hover:text-violet-200">Back to landing</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
