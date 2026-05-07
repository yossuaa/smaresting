<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Smart Lamp</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT SF PRO -->
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">

    <style>

        *{
            font-family: 'SF Pro Display', sans-serif;
        }

        body{
            background: #f5f5f7;
        }

    </style>

</head>

<body class="min-h-screen flex items-center justify-center px-6">

    <!-- CONTAINER -->
    <div class="w-full max-w-[1200px] bg-white rounded-[40px] shadow-sm border border-gray-200 overflow-hidden grid grid-cols-2">

        <!-- LEFT -->
        <div class="bg-[#111827] text-white p-16 flex flex-col justify-center">

            <h1 class="text-[72px] font-bold leading-none">
                Smaresting
            </h1>

            <p class="text-[28px] text-gray-300 mt-6 leading-relaxed">
                Monitoring system lampu otomatis berbasis IoT di area perumahan.
            </p>

            <div class="mt-12 space-y-5">

                <div class="bg-white/10 rounded-2xl p-5">
                    <h3 class="text-[24px] font-semibold">
                        Real-time Monitoring
                    </h3>

                    <p class="text-gray-300 text-[18px] mt-2">
                        Pantau status lampu secara langsung.
                    </p>
                </div>

                <div class="bg-white/10 rounded-2xl p-5">
                    <h3 class="text-[24px] font-semibold">
                        Smart Detection
                    </h3>

                    <p class="text-gray-300 text-[18px] mt-2">
                        Sensor cahaya dan gerakan otomatis.
                    </p>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="p-16 flex flex-col justify-center">

            <div class="mb-12">

                <h1 class="text-[56px] font-bold text-gray-800">
                    Login
                </h1>

                <p class="text-gray-400 text-[24px] mt-3">
                    Masuk ke dashboard Smart Lamp
                </p>

            </div>

            <!-- FORM -->
            <form method="POST" action="/login">

                @csrf

                <!-- USERNAME -->
                <div class="mb-8">

                    <label class="block text-[22px] text-gray-600 mb-3">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
                        class="w-full h-[80px] px-6 rounded-2xl border border-gray-300 bg-gray-50 text-[22px] outline-none focus:border-[#111827] focus:bg-white transition"
                    >

                </div>

                <!-- PASSWORD -->
                <div class="mb-10">

                    <label class="block text-[22px] text-gray-600 mb-3">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="w-full h-[80px] px-6 rounded-2xl border border-gray-300 bg-gray-50 text-[22px] outline-none focus:border-[#111827] focus:bg-white transition"
                    >

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full h-[80px] rounded-2xl bg-[#111827] text-white text-[24px] font-medium hover:opacity-90 transition">

                    Login

                </button>

            </form>

        </div>

    </div>

</body>
</html>