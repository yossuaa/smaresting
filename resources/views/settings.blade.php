<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan - Smaresting</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Space Grotesk', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #020617;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 999px;
        }

        input,
        select {
            outline: none;
        }
    </style>

    @include('theme')
</head>

<body>

<div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="absolute -top-40 right-0 w-[650px] h-[650px] bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-[300px] w-[650px] h-[650px] bg-cyan-500/10 rounded-full blur-3xl"></div>
</div>

<div class="relative z-10 flex min-h-screen">
    @include('sidebar')

    <main class="lg:ml-[300px] flex-1 p-4 lg:p-8 pt-20 lg:pt-8">

        <div class="theme-card backdrop-blur-xl rounded-[34px] p-8 shadow-xl shadow-emerald-500/5">
            <div class="inline-flex items-center gap-3 theme-soft border px-5 py-2 rounded-full text-[17px] font-semibold mb-4">
                <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse shadow-lg shadow-emerald-400/50"></span>
                System Configuration
            </div>

            <h1 class="theme-title text-[50px] font-bold tracking-tight">
                Pengaturan
            </h1>

            <p class="theme-muted text-[24px] mt-2">
                Konfigurasi user, sistem, dashboard, sensor, keamanan, dan reset data.
            </p>
        </div>

        @if(session('success'))
            <div class="mt-6 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 px-6 py-4 rounded-2xl text-[18px]">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <!-- PROFIL USER -->
            <div class="theme-card rounded-[34px] p-8 hover:border-emerald-500/40 transition-all duration-300">
                <div>
                    <h2 class="theme-title text-[34px] font-bold tracking-tight">Profil User</h2>
                    <p class="theme-muted text-[18px] mt-1">Informasi akun yang sedang login.</p>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <label class="theme-muted text-[18px]">Username</label>
                        <input value="{{ session('user_name') ?? 'User' }}" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Email</label>
                        <input value="{{ session('user_email') ?? '-' }}" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Role</label>
                        <input value="Administrator" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>
                </div>
            </div>

            <!-- PROFIL SISTEM -->
            <div class="theme-card rounded-[34px] p-8 hover:border-emerald-500/40 transition-all duration-300">
                <div>
                    <h2 class="theme-title text-[34px] font-bold tracking-tight">Profil Sistem</h2>
                    <p class="theme-muted text-[18px] mt-1">Identitas aplikasi monitoring.</p>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <label class="theme-muted text-[18px]">Nama Sistem</label>
                        <input value="Smart Residential Street Lighting System" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Versi</label>
                        <input value="v1.0" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Status Deployment</label>
                        <input value="Local / VPS Production" readonly
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] cursor-not-allowed opacity-80">
                    </div>
                </div>
            </div>

            <!-- PENGATURAN DASHBOARD -->
            <div class="theme-card rounded-[34px] p-8 hover:border-emerald-500/40 transition-all duration-300">
                <div>
                    <h2 class="theme-title text-[34px] font-bold tracking-tight">Pengaturan Dashboard</h2>
                    <p class="theme-muted text-[18px] mt-1">Kontrol tampilan dan refresh data.</p>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <label class="theme-muted text-[18px]">Refresh Data</label>
                        <select class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] transition">
                            <option>1 Detik</option>
                            <option selected>3 Detik</option>
                            <option>5 Detik</option>
                        </select>
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Tema Dashboard</label>
                        <select id="themeSelector"
                                class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] transition">
                            <option value="dark">Mode Gelap - Malam</option>
                            <option value="light">Mode Terang - Siang</option>
                        </select>

                        <p class="theme-muted text-[15px] mt-2">
                            Tema tersimpan otomatis di browser.
                        </p>
                    </div>
                </div>
            </div>

            <!-- PENGATURAN SENSOR -->
            <div class="theme-card rounded-[34px] p-8 hover:border-emerald-500/40 transition-all duration-300">
                <div>
                    <h2 class="theme-title text-[34px] font-bold tracking-tight">Pengaturan Sensor</h2>
                    <p class="theme-muted text-[18px] mt-1">Konfigurasi threshold dan brightness.</p>
                </div>

                <div class="mt-6 space-y-5">
                    <div>
                        <label class="theme-muted text-[18px]">Threshold Gelap</label>
                        <input value="4000"
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] transition">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Brightness Redup</label>
                        <input value="80"
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] transition">
                    </div>

                    <div>
                        <label class="theme-muted text-[18px]">Brightness Terang</label>
                        <input value="255"
                               class="theme-input w-full mt-2 rounded-2xl px-5 py-4 text-[18px] transition">
                    </div>
                </div>
            </div>

            <!-- STATUS SISTEM REALTIME -->
            <div class="col-span-1 lg:col-span-1 lg:col-span-1 lg:col-span-2 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
                <div class="theme-card rounded-[30px] p-6">
                    <p class="theme-muted text-[18px]">ESP32</p>
                    <h3 id="espStatus" class="text-slate-400 text-[32px] font-bold mt-3 tracking-tight">-</h3>
                    <p id="espDetail" class="theme-muted text-[15px] mt-2">Mengecek device...</p>
                </div>

                <div class="theme-card rounded-[30px] p-6">
                    <p class="theme-muted text-[18px]">API Laravel</p>
                    <h3 id="apiStatus" class="text-slate-400 text-[32px] font-bold mt-3 tracking-tight">-</h3>
                    <p id="apiDetail" class="theme-muted text-[15px] mt-2">Mengecek endpoint...</p>
                </div>

                <div class="theme-card rounded-[30px] p-6">
                    <p class="theme-muted text-[18px]">Database</p>
                    <h3 id="dbStatus" class="text-slate-400 text-[32px] font-bold mt-3 tracking-tight">-</h3>
                    <p id="dbDetail" class="theme-muted text-[15px] mt-2">Mengecek data...</p>
                </div>

                <div class="theme-card rounded-[30px] p-6">
                    <p class="theme-muted text-[18px]">Mode</p>
                    <h3 id="modeStatus" class="text-cyan-400 text-[32px] font-bold mt-3 tracking-tight">-</h3>
                    <p id="modeDetail" class="theme-muted text-[15px] mt-2">Mode terbaru</p>
                </div>
            </div>

            @if(session('user_name') == 'kelompoksatu')
            @php
                $control = \App\Models\SystemControl::first();
                $loggingStatus = $control->data_logging_status ?? 'RUNNING';
            @endphp

<div class="col-span-1 lg:col-span-1 lg:col-span-1 lg:col-span-2 theme-card rounded-[34px] p-8 border border-yellow-500/40 hover:border-yellow-500/70 transition-all duration-300">

    <div class="flex justify-between items-center">

        <div>
            <h2 class="theme-title text-[34px] font-bold tracking-tight">
                Kontrol Pengiriman Data
            </h2>

            <p class="theme-muted text-[20px] mt-2">
                Mengatur apakah data dari ESP32 disimpan ke database atau dihentikan sementara.
            </p>

            <p class="mt-4 text-[20px] font-semibold
                {{ $loggingStatus === 'RUNNING'
                    ? 'text-emerald-400'
                    : 'text-red-400' }}">

                Status :
                {{ $loggingStatus === 'RUNNING'
                    ? 'Berjalan'
                    : 'Dihentikan' }}

            </p>
        </div>

    </div>

    <form method="POST"
          action="/toggle-data-logging"
          class="mt-6">

        @csrf

        @if($loggingStatus === 'RUNNING')

            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-4 rounded-2xl text-[18px] font-semibold transition shadow-lg shadow-red-500/20">

                Stop Kirim Data

            </button>

        @else

            <button type="submit"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-4 rounded-2xl text-[18px] font-semibold transition shadow-lg shadow-emerald-500/20">

                Lanjut Kirim Data

            </button>

        @endif

    </form>

</div>

            <!-- RESET DATA SENSOR -->
            <div class="col-span-1 lg:col-span-1 lg:col-span-1 lg:col-span-2 theme-card rounded-[34px] p-8 border border-red-500/40 hover:border-red-500/70 transition-all duration-300">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="theme-title text-[34px] font-bold tracking-tight">
                            Reset Data Sensor
                        </h2>

                        <p class="theme-muted text-[20px] mt-2">
                            Menghapus seluruh data sensor dari database. Dashboard, monitoring, riwayat sensor, dan analytics akan kembali kosong.
                        </p>

                        <p class="text-red-300 text-[17px] mt-3">
                            Tindakan ini tidak bisa dibatalkan.
                        </p>
                    </div>

                </div>

                <form method="POST"
                      action="/reset-data-sensor"
                      class="mt-6"
                      onsubmit="return confirm('Yakin ingin menghapus semua data sensor? Data tidak bisa dikembalikan.');">
                    @csrf

                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-6 py-4 rounded-2xl text-[18px] font-semibold transition shadow-lg shadow-red-500/20">
                        Reset Semua Data
                    </button>
                </form>
            </div>
            @endif
            <!-- KEAMANAN -->
            <div class="col-span-1 lg:col-span-1 lg:col-span-1 lg:col-span-2 relative overflow-hidden bg-emerald-500 rounded-[34px] p-8 text-white shadow-xl shadow-emerald-500/20">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h2 class="text-[34px] font-bold tracking-tight">Keamanan</h2>
                    <p class="text-emerald-50 text-[20px] mt-2">
                        Pengaturan keamanan akun dan sesi login.
                    </p>

                    <div class="flex gap-5 mt-6">
                        <a href="/change-password"
                           class="bg-white text-emerald-700 px-6 py-4 rounded-2xl text-[18px] font-semibold hover:bg-emerald-50 transition">
                            Ganti Password
                        </a>

                        <a href="/logout"
                           class="border border-red-200 text-red-100 px-6 py-4 rounded-2xl text-[18px] font-semibold hover:bg-red-500 hover:border-red-500 hover:text-white transition">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<script>
const ESP_TIMEOUT_SECONDS = 15;

function parseWaktu(waktu) {
    if (!waktu) return null;
    return new Date(waktu.toString().replace(' ', 'T'));
}

function getDiffSeconds(waktu, serverTime = null) {
    const lastTime = parseWaktu(waktu);
    const nowTime = serverTime ? parseWaktu(serverTime) : new Date();

    if (!lastTime || !nowTime || isNaN(lastTime.getTime()) || isNaN(nowTime.getTime())) {
        return 999999;
    }

    return Math.floor((nowTime - lastTime) / 1000);
}

function setText(id, text, className = null) {
    const el = document.getElementById(id);
    if (!el) return;

    el.innerText = text;

    if (className) {
        el.className = className;
    }
}

async function loadSystemStatus() {
    let res;
    let json;

    try {
        res = await fetch('/data-realtime');
        json = await res.json();

        setText(
            'apiStatus',
            'Connected',
            'text-emerald-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('apiDetail', 'Endpoint /data-realtime aktif');

    } catch (error) {
        setText(
            'apiStatus',
            'Disconnected',
            'text-red-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('apiDetail', 'Endpoint tidak merespons');

        setText(
            'espStatus',
            'Offline',
            'text-red-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('espDetail', 'Tidak bisa membaca data ESP32');

        setText(
            'dbStatus',
            'Unknown',
            'text-yellow-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('dbDetail', 'Data tidak dapat dibaca');

        setText('modeStatus', '-');
        setText('modeDetail', 'Tidak ada data');

        return;
    }

    const data = json.data || [];
    const latest = data.length > 0 ? data[0] : null;

    if (!latest) {
        setText(
            'espStatus',
            'Offline',
            'text-red-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('espDetail', 'Belum ada data dari ESP32');

        setText(
            'dbStatus',
            'Empty',
            'text-yellow-400 text-[32px] font-bold mt-3 tracking-tight'
        );
        setText('dbDetail', 'Database belum punya data sensor');

        setText('modeStatus', '-');
        setText('modeDetail', 'Belum ada mode sistem');

        return;
    }

    const diffSeconds = getDiffSeconds(latest.waktu, json.server_time);
    const isEspOnline = diffSeconds <= ESP_TIMEOUT_SECONDS;

    setText(
        'espStatus',
        isEspOnline ? 'Online' : 'Offline',
        isEspOnline
            ? 'text-emerald-400 text-[32px] font-bold mt-3 tracking-tight'
            : 'text-red-400 text-[32px] font-bold mt-3 tracking-tight'
    );

    setText(
        'espDetail',
        isEspOnline
            ? `Update ${diffSeconds} detik lalu`
            : `Data terakhir ${diffSeconds} detik lalu`
    );

    setText(
        'dbStatus',
        'Active',
        'text-emerald-400 text-[32px] font-bold mt-3 tracking-tight'
    );

    setText('dbDetail', `${json.totalData || data.length} data sensor tercatat`);

    setText(
        'modeStatus',
        isEspOnline ? latest.mode : '-',
        isEspOnline
            ? 'text-cyan-400 text-[32px] font-bold mt-3 tracking-tight'
            : 'text-slate-400 text-[32px] font-bold mt-3 tracking-tight'
    );

    setText(
        'modeDetail',
        isEspOnline
            ? `Status lampu: ${latest.status_lampu}`
            : 'Menunggu update terbaru ESP32'
    );
}

loadSystemStatus();
setInterval(loadSystemStatus, 3000);
</script>

</body>
</html>