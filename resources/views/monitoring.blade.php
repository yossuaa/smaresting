<!DOCTYPE html>
<html>
<head>
    <title>Monitoring - Smaresting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Space Grotesk', sans-serif; }
        body { background: #020617; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 999px; }
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
                <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></span>
                Realtime Monitoring Center
            </div>

            <h1 class="theme-title text-[50px] font-bold tracking-tight">Monitoring Realtime</h1>
            <p class="theme-muted text-[24px] mt-2">Pemantauan langsung sensor, lampu, dan koneksi sistem.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mt-6">
            <div class="theme-card rounded-[30px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">ESP32</p>
                <h2 id="espStatus" class="text-[34px] font-bold mt-3 tracking-tight text-slate-300">-</h2>
                <p id="espDetail" class="theme-muted text-[15px] mt-2">Mengecek device...</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">API Laravel</p>
                <h2 id="apiStatus" class="text-[34px] font-bold mt-3 tracking-tight text-slate-300">-</h2>
                <p id="apiDetail" class="theme-muted text-[15px] mt-2">Mengecek server...</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Sensor PIR</p>
                <h2 id="pirStatus" class="text-[30px] font-bold mt-3 text-slate-300 tracking-tight">-</h2>
                <p class="theme-muted text-[15px] mt-2">Deteksi gerakan</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Sensor LDR</p>
                <h2 id="ldrValue" class="text-[34px] font-bold mt-3 text-orange-400 tracking-tight">-</h2>
                <p class="theme-muted text-[15px] mt-2">Intensitas cahaya</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
            <div id="liveCard" class="relative overflow-hidden bg-emerald-500 rounded-[34px] p-8 text-white shadow-xl shadow-emerald-500/20">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <p class="text-emerald-50 text-[22px]">Live Data Sensor</p>
                    <h2 id="liveStatus" class="text-[48px] font-bold mt-5 tracking-tight">-</h2>
                    <p id="liveDetail" class="text-emerald-50 text-[22px] mt-3">Menunggu data...</p>
                </div>
            </div>

            <div class="theme-card rounded-[34px] p-8">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="theme-muted text-[22px]">System Log</p>
                        <h2 class="theme-title text-[32px] font-bold mt-1 tracking-tight">Aktivitas Sensor</h2>
                    </div>

                    <div class="theme-card rounded-2xl px-5 py-3 text-[17px] theme-muted">
                        Update 2 detik
                    </div>
                </div>

                <div id="systemLog" class="mt-5 space-y-3 max-h-[260px] overflow-y-auto pr-2"></div>
            </div>
        </div>

      <div class="theme-card rounded-[34px] p-8 mt-6">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="theme-title text-[38px] font-bold tracking-tight">
                Live Lamp Status
            </h2>

            <p class="theme-muted text-[20px] mt-1">
                Status realtime setiap titik lampu.
            </p>
        </div>

        <div class="theme-card rounded-2xl px-5 py-3 text-[18px] theme-muted">
            Smart Lighting Area
        </div>
    </div>

    <div id="lampuContainer"
         class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-6">
    </div>

</div>

<div class="theme-card rounded-[34px] p-8 mt-6 mb-10">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="theme-title text-[38px] font-bold tracking-tight">
                Rekap Durasi Status Lampu
            </h2>

            <p class="theme-muted text-[20px] mt-1">
                Durasi OFF, ON-Redup, dan ON-Terang berdasarkan perubahan status lampu.
            </p>
        </div>

        <div class="theme-card rounded-2xl px-5 py-3 text-[18px] theme-muted">
            Update realtime 3 detik
        </div>
    </div>

    <div class="overflow-x-auto theme-card rounded-[26px]">
        <table class="w-full">
            <thead>
                <tr class="border-b" style="border-color: var(--border)">
                    <th class="text-left py-5 px-5 theme-muted text-[17px]">Status</th>
                    <th class="text-left py-5 px-5 theme-muted text-[17px]">Mulai</th>
                    <th class="text-left py-5 px-5 theme-muted text-[17px]">Selesai</th>
                    <th class="text-left py-5 px-5 theme-muted text-[17px]">Durasi</th>
                    <th class="text-left py-5 px-5 theme-muted text-[17px]">Keterangan</th>
                </tr>
            </thead>

            <tbody id="tableDurasiStatus" class="divide-y"></tbody>
        </table>
    </div>
</div>
    </main>
</div>

<script>
const ESP_TIMEOUT_SECONDS = 15;

function statusColor(status){
    if(status === 'ON-Terang') return 'text-green-300 bg-green-500/15 border-green-500/30';
    if(status === 'ON-Redup') return 'text-yellow-300 bg-yellow-500/15 border-yellow-500/30';
    if(status === 'OFF') return 'text-red-300 bg-red-500/15 border-red-500/30';
    return 'text-slate-300 bg-slate-500/15 border-slate-500/30';
}

function statusDot(status){
    if(status === 'ON-Terang') return 'bg-green-400 shadow-lg shadow-green-400/40';
    if(status === 'ON-Redup') return 'bg-yellow-400 shadow-lg shadow-yellow-400/40';
    if(status === 'OFF') return 'bg-red-400 shadow-lg shadow-red-400/40';
    return 'bg-slate-400';
}

function statusText(status){
    if(status === 'ON-Terang') return 'Lampu Terang';
    if(status === 'ON-Redup') return 'Lampu Redup';
    if(status === 'OFF') return 'Lampu Mati';
    return 'Sistem Offline';
}

function gerakanLabel(v){
    return v == 1 || v === 'ADA' ? 'ADA GERAKAN' : 'TIDAK ADA GERAKAN';
}

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

function setApiStatus(isConnected) {
    document.getElementById('apiStatus').innerText = isConnected ? 'Connected' : 'Disconnected';
    document.getElementById('apiStatus').className = isConnected
        ? 'text-emerald-400 text-[34px] font-bold mt-3 tracking-tight'
        : 'text-red-400 text-[34px] font-bold mt-3 tracking-tight';

    document.getElementById('apiDetail').innerText = isConnected
        ? 'Server Laravel aktif'
        : 'Server Laravel tidak merespons';
}

function setEspStatus(isOnline, diffSeconds) {
    document.getElementById('espStatus').innerText = isOnline ? 'Online' : 'Offline';
    document.getElementById('espStatus').className = isOnline
        ? 'text-emerald-400 text-[34px] font-bold mt-3 tracking-tight'
        : 'text-red-400 text-[34px] font-bold mt-3 tracking-tight';

    document.getElementById('espDetail').innerText = isOnline
        ? `Update ${diffSeconds} detik lalu`
        : `Data terakhir ${diffSeconds} detik lalu`;
}

async function loadMonitoring(){
    let res;
    let json;

    try {
        res = await fetch('/data-realtime');
        json = await res.json();
        setApiStatus(true);
    } catch (error) {
        setApiStatus(false);
        setEspStatus(false, 0);

        document.getElementById('pirStatus').innerText = '-';
        document.getElementById('ldrValue').innerText = '-';
        document.getElementById('liveStatus').innerText = 'Sistem Offline';
        document.getElementById('liveDetail').innerText = 'Tidak bisa membaca data dari server.';
        document.getElementById('lampuContainer').innerHTML = '';
        document.getElementById('systemLog').innerHTML = '';

        return;
    }

    const data = json.data || [];
    const lampu = json.lampu || [];
    const latest = data[0];

    if(!latest) {
        setEspStatus(false, 0);

        document.getElementById('pirStatus').innerText = '-';
        document.getElementById('ldrValue').innerText = '-';
        document.getElementById('liveStatus').innerText = 'Belum Ada Data';
        document.getElementById('liveDetail').innerText = 'ESP32 belum mengirim data sensor.';
        document.getElementById('lampuContainer').innerHTML = '';
        document.getElementById('systemLog').innerHTML = '';

        return;
    }

    const diffSeconds = getDiffSeconds(latest.waktu, json.server_time);
    const isEspOnline = diffSeconds <= ESP_TIMEOUT_SECONDS;

    setEspStatus(isEspOnline, diffSeconds);

    document.getElementById('pirStatus').innerText = isEspOnline ? gerakanLabel(latest.gerakan) : '-';
    document.getElementById('pirStatus').className = isEspOnline && (latest.gerakan == 1 || latest.gerakan === 'ADA')
        ? 'text-blue-400 text-[30px] font-bold mt-3 tracking-tight'
        : 'text-slate-400 text-[30px] font-bold mt-3 tracking-tight';

    document.getElementById('ldrValue').innerText = isEspOnline ? latest.cahaya + ' Lux' : '-';

    document.getElementById('liveStatus').innerText = isEspOnline
        ? statusText(latest.status_lampu)
        : 'Sistem Offline';

    document.getElementById('liveDetail').innerText = isEspOnline
        ? `Mode ${latest.mode} • ${gerakanLabel(latest.gerakan)} • Cahaya ${latest.cahaya} Lux • ${latest.status_lampu}`
        : `Data terakhir ${diffSeconds} detik lalu. Menunggu update ESP32.`;

    let lampHTML = '';

    lampu.forEach(l => {
        const displayStatus = isEspOnline ? latest.status_lampu : 'OFFLINE';

        lampHTML += `
            <div class="theme-card rounded-[28px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="theme-title text-[26px] font-bold tracking-tight">${l.nama_lampu}</h3>
                        <p class="theme-muted text-[17px] mt-1">${l.lokasi ?? 'Area Smart Lighting'}</p>
                    </div>

                    <div class="w-4 h-4 rounded-full ${isEspOnline ? statusDot(latest.status_lampu) : 'bg-slate-500'}"></div>
                </div>

                <div class="mt-6 px-4 py-3 rounded-2xl border text-center text-[24px] font-bold ${isEspOnline ? statusColor(latest.status_lampu) : 'text-slate-300 bg-slate-500/15 border-slate-500/30'}">
                    ${displayStatus}
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div>
                        <p class="theme-muted text-[15px]">Mode</p>
                        <p class="theme-title text-[20px] font-semibold mt-1">${isEspOnline ? latest.mode : '-'}</p>
                    </div>

                    <div>
                        <p class="theme-muted text-[15px]">Cahaya</p>
                        <p class="theme-title text-[20px] font-semibold mt-1">${isEspOnline ? latest.cahaya + ' Lux' : '-'}</p>
                    </div>

                    <div class="col-span-2">
                        <p class="theme-muted text-[15px]">Gerakan</p>
                        <p class="theme-title text-[20px] font-semibold mt-1">${isEspOnline ? gerakanLabel(latest.gerakan) : '-'}</p>
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t" style="border-color: var(--border)">
                    <p class="theme-muted text-[15px]">Update</p>
                    <p class="theme-muted text-[17px] mt-1">${latest.waktu}</p>
                </div>
            </div>
        `;
    });

    document.getElementById('lampuContainer').innerHTML = lampHTML;

    let logHTML = '';

    data.slice(0, 8).forEach(d => {
        logHTML += `
            <div class="theme-card rounded-2xl p-4">
                <div class="flex justify-between items-center gap-3">
                    <span class="px-3 py-1 rounded-lg text-[13px] font-semibold border ${statusColor(d.status_lampu)}">
                        ${d.status_lampu}
                    </span>

                    <span class="theme-muted text-[14px]">${d.waktu}</span>
                </div>

                <p class="theme-title text-[17px] mt-3">
                    ${gerakanLabel(d.gerakan)} • ${d.cahaya} Lux • ${statusText(d.status_lampu)}
                </p>
            </div>
        `;
    });

    document.getElementById('systemLog').innerHTML = logHTML;
}

loadMonitoring();
loadDurasiStatus();
setInterval(loadMonitoring, 2000);
setInterval(loadDurasiStatus, 3000);

function formatDurasi(seconds) {
    if (!seconds || seconds <= 0) return '00:00:00';

    seconds = Number(seconds);

    const jam = Math.floor(seconds / 3600);
    const menit = Math.floor((seconds % 3600) / 60);
    const detik = seconds % 60;

    return `${String(jam).padStart(2, '0')}:${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;
}

async function loadDurasiStatus() {
    try {
        const res = await fetch('/durasi-status');
        const json = await res.json();

        const durasi = json.durasi || [];

        let html = '';

        if (durasi.length === 0) {
            html = `
                <tr>
                    <td colspan="5" class="py-8 px-5 text-center theme-muted text-[18px]">
                        Belum ada data durasi status lampu.
                    </td>
                </tr>
            `;
        }

        durasi.slice(0, 20).forEach(d => {
            html += `
                <tr class="hover:bg-slate-800/60 transition">
                    <td class="py-5 px-5">
                        <span class="px-4 py-2 rounded-xl text-[15px] font-semibold ${statusColor(d.status)}">
                            ${d.status}
                        </span>
                    </td>

                    <td class="py-5 px-5 text-[18px] theme-title">
                        ${d.waktu_mulai}
                    </td>

                    <td class="py-5 px-5 text-[18px] theme-muted">
                        ${d.waktu_selesai}
                    </td>

                    <td class="py-5 px-5 text-[18px] text-cyan-300 font-semibold">
                        ${formatDurasi(d.durasi)}
                    </td>

                    <td class="py-5 px-5 text-[18px] ${
                        d.sedang_berjalan ? 'text-emerald-400' : 'theme-muted'
                    }">
                        ${d.sedang_berjalan ? 'Sedang berjalan' : 'Selesai'}
                    </td>
                </tr>
            `;
        });

        document.getElementById('tableDurasiStatus').innerHTML = html;

    } catch (error) {
        console.log('Gagal mengambil durasi status:', error);
    }
}
</script>

</body>
</html>

