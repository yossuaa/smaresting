<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smaresting</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Space Grotesk', sans-serif;
        }

        body {
            background: #020617;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-8 text-white">

<div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="absolute -top-40 right-0 w-[650px] h-[650px] bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[650px] h-[650px] bg-cyan-500/10 rounded-full blur-3xl"></div>
</div>

<div class="relative z-10 w-[86%] max-w-[360px] lg:w-full lg:max-w-[1200px] bg-slate-900/80 border border-slate-700 rounded-[32px] lg:rounded-[40px] overflow-hidden grid grid-cols-1 lg:grid-cols-2 shadow-2xl shadow-emerald-500/10">

    <div class="hidden lg:flex relative overflow-hidden bg-slate-950 p-16 flex-col justify-center border-r border-slate-700">
        <div class="absolute -top-28 -left-28 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="w-20 h-20 rounded-2xl bg-emerald-500 flex items-center justify-center shadow-lg shadow-emerald-600/30 mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Smaresting" class="w-14 h-14 object-contain"/>
            </div>

            <h1 class="text-[72px] font-bold leading-none tracking-tight">
                Smaresting
            </h1>

            <p class="text-[26px] text-slate-400 mt-6 leading-relaxed">
                Monitoring system lampu otomatis berbasis IoT di area perumahan.
            </p>

            <div class="mt-12 space-y-5">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="text-[24px] font-semibold text-white">Real-time Monitoring</h3>
                    <p class="text-slate-400 text-[18px] mt-2">Pantau status lampu secara langsung.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="text-[24px] font-semibold text-white">Smart Detection</h3>
                    <p class="text-slate-400 text-[18px] mt-2">Sensor cahaya dan gerakan otomatis.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="p-7 lg:p-16 flex flex-col justify-center bg-slate-900/80">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 px-4 py-2 rounded-full text-[13px] lg:text-[16px] font-semibold mb-5">
                <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></span>
                Smart Lighting Access
            </div>

            <h1 class="text-[36px] lg:text-[56px] font-bold tracking-tight text-white">
                Login
            </h1>

            <p class="text-slate-400 text-[15px] lg:text-[23px] mt-3 leading-relaxed">
                Masuk ke dashboard Smaresting.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-5 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 px-4 py-3 rounded-2xl text-[14px] lg:text-[18px]">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 bg-red-500/15 border border-red-500/30 text-red-300 px-4 py-3 rounded-2xl text-[14px] lg:text-[18px]">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-5">
                <label class="block text-[15px] lg:text-[20px] text-slate-300 mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    class="w-full h-[52px] lg:h-[72px] px-5 lg:px-6 rounded-2xl border border-slate-700 bg-slate-950/70 text-white placeholder:text-slate-500 text-[15px] lg:text-[20px] outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
                >

                @error('username')
                    <p class="text-red-300 text-[13px] lg:text-[15px] mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-7">
                <label class="block text-[15px] lg:text-[20px] text-slate-300 mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full h-[52px] lg:h-[72px] px-5 lg:px-6 rounded-2xl border border-slate-700 bg-slate-950/70 text-white placeholder:text-slate-500 text-[15px] lg:text-[20px] outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
                >

                @error('password')
                    <p class="text-red-300 text-[13px] lg:text-[15px] mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full h-[54px] lg:h-[72px] rounded-2xl bg-emerald-500 text-white text-[18px] lg:text-[22px] font-semibold hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/20">
                Login
            </button>

            <div class="mt-6 text-center">
                <p class="text-slate-400 text-[14px] lg:text-[19px]">
                    Belum punya akun?
                    <a href="/register" class="text-emerald-400 font-semibold hover:underline">
                        Register di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

</body>
</html>