<!DOCTYPE html>
<html>
<head>
    <title>Ganti Password - Smaresting</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Space Grotesk', sans-serif;
        }

        body{
            background:#020617;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-[700px] bg-slate-900 border border-slate-700 rounded-[32px] p-10">

    <div class="mb-8">
        <h1 class="text-white text-[42px] font-bold">
            Ganti Password
        </h1>

        <p class="text-slate-400 text-[20px] mt-2">
            Perbarui password akun Anda.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 p-4 rounded-2xl mb-5">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/15 border border-red-500/30 text-red-300 p-4 rounded-2xl mb-5">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/change-password">

        @csrf

        <div class="mb-5">
            <label class="text-slate-300 block mb-2">
                Password Lama
            </label>

            <input
                type="password"
                name="old_password"
                class="w-full h-[65px] px-5 rounded-2xl bg-slate-950 border border-slate-700 text-white"
            >
        </div>

        <div class="mb-5">
            <label class="text-slate-300 block mb-2">
                Password Baru
            </label>

            <input
                type="password"
                name="new_password"
                class="w-full h-[65px] px-5 rounded-2xl bg-slate-950 border border-slate-700 text-white"
            >
        </div>

        <div class="mb-8">
            <label class="text-slate-300 block mb-2">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="new_password_confirmation"
                class="w-full h-[65px] px-5 rounded-2xl bg-slate-950 border border-slate-700 text-white"
            >
        </div>

        <div class="flex gap-4">

            <button
                type="submit"
                class="bg-emerald-500 text-white px-6 py-4 rounded-2xl text-[18px] font-semibold hover:bg-emerald-600 transition">

                Simpan Password

            </button>

            <a href="/settings"
               class="border border-slate-600 text-slate-300 px-6 py-4 rounded-2xl text-[18px] font-semibold hover:bg-slate-800 transition">

                Kembali

            </a>

        </div>

    </form>

</div>

</body>
</html>