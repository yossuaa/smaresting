<!DOCTYPE html>
<html lang="en">
<head>
    <title>Smaresting Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="theme-card backdrop-blur-xl rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 shadow-xl shadow-emerald-500/5">
            <div class="inline-flex items-center gap-2 lg:gap-3 theme-soft border px-4 lg:px-5 py-2 rounded-full text-[12px] lg:text-[17px] font-semibold mb-4">
                <span id="systemDot" class="w-2.5 h-2.5 lg:w-3 lg:h-3 rounded-full bg-emerald-400 animate-pulse"></span>
                Smart Residential Street Lighting
            </div>
            <h1 class="theme-title text-[30px] lg:text-[50px] font-bold tracking-tight leading-tight">
                Dashboard Monitoring
            </h1>
            <p class="theme-muted text-[16px] lg:text-[24px] mt-2 leading-relaxed">
                Real-time monitoring untuk sistem penerangan jalan perumahan.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Status Sistem</p>
                <div class="flex items-center gap-3 mt-3">
                    <div id="statusSistemDot" class="w-3 h-3 lg:w-4 lg:h-4 bg-emerald-400 rounded-full animate-pulse"></div>
                    <span id="statusSistemText" class="text-emerald-400 text-[18px] lg:text-[24px] font-semibold">-</span>
                </div>
                <p id="statusSistemDetail" class="theme-muted text-[13px] lg:text-[15px] mt-2">
                    Mengecek ESP32...
                </p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Waktu Sistem</p>
                <p id="tanggal" class="theme-title text-[15px] lg:text-[24px] font-semibold mt-3">-</p>
                <p id="jam" class="theme-muted text-[14px] lg:text-[20px] mt-1">-</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-5 mt-6">
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Total Lampu</p>
                <h1 id="totalLampu" class="text-[28px] lg:text-[48px] font-bold mt-3 theme-title tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">Titik aktif sistem</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Lampu Terang</p>
                <h1 id="lampuTerang" class="text-[28px] lg:text-[48px] font-bold mt-3 text-green-400 tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">ON-Terang</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Lampu Redup</p>
                <h1 id="lampuRedup" class="text-[28px] lg:text-[48px] font-bold mt-3 text-yellow-400 tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">ON-Redup</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Gerakan</p>
                <h1 id="gerakanCount" class="text-[28px] lg:text-[48px] font-bold mt-3 text-blue-400 tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">Deteksi PIR</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Data Sensor</p>
                <h1 id="sensorCount" class="text-[28px] lg:text-[48px] font-bold mt-3 theme-title tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">Log terbaru</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[30px] p-5 lg:p-6">
                <p class="theme-muted text-[14px] lg:text-[18px]">Cahaya</p>
                <h1 id="lastLux" class="text-[28px] lg:text-[48px] font-bold mt-3 text-orange-400 tracking-tight">0</h1>
                <p class="theme-muted text-[13px] lg:text-[15px] mt-2">Lux terbaru</p>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div id="kondisiCard" class="relative overflow-hidden bg-emerald-500 rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 text-white shadow-xl shadow-emerald-500/20">
                <div class="absolute -top-20 -right-20 w-60 h-60 bg-white/20 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <p class="text-emerald-50 text-[14px] lg:text-[20px]">Kondisi Sistem Saat Ini</p>
                    <h2 id="kondisiSistem" class="text-[28px] lg:text-[42px] font-bold mt-4 tracking-tight">-</h2>
                    <p id="kondisiDetail" class="text-emerald-50 text-[14px] lg:text-[20px] mt-3">Menunggu data sensor...</p>
                </div>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <p class="theme-muted text-[14px] lg:text-[20px]">Mode Sistem</p>
                <h2 id="modeAktif" class="text-[28px] lg:text-[42px] font-bold mt-4 theme-title tracking-tight">-</h2>
                <p class="theme-muted text-[13px] lg:text-[18px] mt-3">AUTO / MANUAL</p>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <p class="theme-muted text-[14px] lg:text-[20px]">Update Terakhir</p>
                <h2 id="lastUpdate" class="text-[20px] lg:text-[32px] font-bold mt-4 theme-title tracking-tight">-</h2>
                <p class="theme-muted text-[13px] lg:text-[18px] mt-3">Data terbaru dari ESP32</p>
            </div>
        </div>
        <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 mt-6">
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-7">
                <div>
                    <h2 class="theme-title text-[24px] lg:text-[38px] font-bold tracking-tight">Monitoring 4 Titik Lampu</h2>
                    <p class="theme-muted text-[14px] lg:text-[20px] mt-1">
                        ON-Terang hijau, ON-Redup kuning, OFF merah, OFFLINE abu-abu.
                    </p>
                </div>
            </div>
            <div id="lampuContainer" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5"></div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
            <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <h2 class="theme-title text-[24px] lg:text-[32px] font-bold tracking-tight">Grafik Intensitas Cahaya</h2>
                <p class="theme-muted text-[13px] lg:text-[18px] mt-1">Seluruh data LDR yang tercatat di database.</p>
                <div class="mt-6 h-[260px] lg:h-[330px] theme-card rounded-[26px] p-5">
                    <canvas id="chartCahaya"></canvas>
                </div>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <h2 class="theme-title text-[24px] lg:text-[32px] font-bold tracking-tight">Grafik Deteksi Gerakan</h2>
                <p class="theme-muted text-[13px] lg:text-[18px] mt-1">Seluruh data PIR yang tercatat di database.</p>
                <div class="mt-6 h-[260px] lg:h-[330px] theme-card rounded-[26px] p-5">
                    <canvas id="chartGerakan"></canvas>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6 mb-10">
            <div class="xl:col-span-2 theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <div class="mb-7">
                    <h2 class="theme-title text-[24px] lg:text-[36px] font-bold tracking-tight">Data Sensor Terbaru</h2>
                    <p class="theme-muted text-[14px] lg:text-[20px] mt-1">Log sensor sistem dari LDR dan PIR.</p>
                </div>
                <div class="overflow-x-auto theme-card rounded-[26px]">
                    <table class="w-full min-w-[900px]">
                        <thead>
                            <tr class="border-b" style="border-color: var(--border)">
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">ID</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Sistem</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Cahaya</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Gerakan</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Status</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Mode</th>
                                <th class="text-left py-5 px-5 theme-muted text-[17px]">Waktu</th>
                            </tr>
                        </thead>
                        <tbody id="tableData" class="divide-y"></tbody>
                    </table>
                </div>
            </div>
            <div class="theme-card rounded-[24px] lg:rounded-[34px] p-5 lg:p-8">
                <h2 class="theme-title text-[24px] lg:text-[32px] font-bold tracking-tight">Aktivitas Terbaru</h2>
                <p class="theme-muted text-[13px] lg:text-[18px] mt-1">Riwayat kondisi sistem.</p>
                <div id="activityList" class="mt-6 space-y-4"></div>
            </div>
        </div>
    </main>
</div>
<script>
const ESP_TIMEOUT_SECONDS = 15;
let chartCahaya;
let chartGerakan;
function updateClock() {
    const now = new Date();
    document.getElementById('tanggal').innerText =
        now.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    document.getElementById('jam').innerText = now.toLocaleTimeString('id-ID');
}
setInterval(updateClock, 1000);
updateClock();
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
function statusText(status) {
    if (status === 'ON-Terang') return 'Lampu Menyala Terang';
    if (status === 'ON-Redup') return 'Lampu Menyala Redup';
    if (status === 'OFF') return 'Lampu Mati';
    return 'Sistem Offline';
}
function statusBadge(status) {
    if (status === 'ON-Terang') return 'bg-green-500/15 text-green-300 border border-green-500/30';
    if (status === 'ON-Redup') return 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/30';
    if (status === 'OFF') return 'bg-red-500/15 text-red-300 border border-red-500/30';
    return 'bg-slate-500/15 text-slate-300 border border-slate-500/30';
}
function statusDot(status) {
    if (status === 'ON-Terang') return 'bg-green-400 shadow-lg shadow-green-400/40';
    if (status === 'ON-Redup') return 'bg-yellow-400 shadow-lg shadow-yellow-400/40';
    if (status === 'OFF') return 'bg-red-400 shadow-lg shadow-red-400/40';
    return 'bg-slate-400';
}
function cardBorderColor(status) {
    if (status === 'ON-Terang') return 'border-green-500/60 shadow-green-500/10';
    if (status === 'ON-Redup') return 'border-yellow-500/60 shadow-yellow-500/10';
    if (status === 'OFF') return 'border-red-500/60 shadow-red-500/10';
    return 'border-slate-700 shadow-slate-500/10';
}
function kondisiCardColor(status) {
    if (status === 'ON-Terang') return 'relative overflow-hidden bg-green-500 rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 text-white shadow-xl shadow-green-500/20';
    if (status === 'ON-Redup') return 'relative overflow-hidden bg-yellow-500 rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 text-white shadow-xl shadow-yellow-500/20';
    if (status === 'OFF') return 'relative overflow-hidden bg-red-500 rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 text-white shadow-xl shadow-red-500/20';
    return 'relative overflow-hidden bg-slate-600 rounded-[24px] lg:rounded-[34px] p-5 lg:p-8 text-white shadow-xl shadow-slate-500/20';
}
function gerakanLabel(value) {
    return value == 1 || value === 'ADA' ? 'ADA' : 'TIDAK ADA';
}
function gerakanBadge(value) {
    return value == 1 || value === 'ADA'
        ? 'bg-blue-500/15 text-blue-300 border border-blue-500/30'
        : 'bg-slate-500/15 text-slate-300 border border-slate-500/30';
}
function kondisiCahaya(value) {
    return Number(value) > 4000 ? 'GELAP' : 'TERANG';
}
function setSystemStatus(isOnline, diffSeconds) {
    const text = document.getElementById('statusSistemText');
    const dot = document.getElementById('statusSistemDot');
    const detail = document.getElementById('statusSistemDetail');
    text.innerText = isOnline ? 'Online' : 'Offline';
    text.className = isOnline
        ? 'text-emerald-400 text-[18px] lg:text-[24px] font-semibold'
        : 'text-red-400 text-[18px] lg:text-[24px] font-semibold';
    dot.className = isOnline
        ? 'w-3 h-3 lg:w-4 lg:h-4 bg-emerald-400 rounded-full animate-pulse'
        : 'w-3 h-3 lg:w-4 lg:h-4 bg-red-400 rounded-full animate-pulse';
    detail.innerText = isOnline
        ? `Update ${diffSeconds} detik lalu`
        : `Data terakhir ${diffSeconds} detik lalu`;
}
function initCharts() {
    Chart.defaults.color = '#CBD5E1';
    Chart.defaults.borderColor = '#334155';
    Chart.defaults.font.family = 'Space Grotesk';
    chartCahaya = new Chart(document.getElementById('chartCahaya'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Cahaya',
                data: [],
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                borderColor: '#34D399',
                backgroundColor: 'rgba(52, 211, 153, 0.12)',
                pointBackgroundColor: '#34D399',
                pointRadius: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: { y: { beginAtZero: true } }
        }
    });
    chartGerakan = new Chart(document.getElementById('chartGerakan'), {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Gerakan',
                data: [],
                borderWidth: 1,
                backgroundColor: 'rgba(96, 165, 250, 0.75)',
                borderColor: '#60A5FA'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y: { beginAtZero: true, max: 1, ticks: { stepSize: 1 } }
            }
        }
    });
}
async function loadChartKeseluruhan() {
    try {
        const res = await fetch('/analytics-data');
        const json = await res.json();
        const allData = json.data || [];
        const labels = allData.map(d => {
            return d.id ? `#${d.id}` : (d.waktu ? d.waktu.toString().slice(11, 19) : '-');
        });
        const cahayaValues = allData.map(d => Number(d.cahaya));
        const gerakanValues = allData.map(d => d.gerakan == 1 || d.gerakan === 'ADA' ? 1 : 0);
        chartCahaya.data.labels = labels;
        chartCahaya.data.datasets[0].data = cahayaValues;
        chartCahaya.update();
        chartGerakan.data.labels = labels;
        chartGerakan.data.datasets[0].data = gerakanValues;
        chartGerakan.update();
    } catch (error) {
        console.log('Gagal mengambil data keseluruhan chart:', error);
    }
}
async function loadData() {
    let res;
    let json;
    try {
        res = await fetch('/data-realtime');
        json = await res.json();
    } catch (error) {
        setSystemStatus(false, 0);
        document.getElementById('kondisiCard').className = kondisiCardColor('OFFLINE');
        document.getElementById('kondisiSistem').innerText = 'Server Offline';
        document.getElementById('kondisiDetail').innerText = 'Tidak bisa mengambil data dari Laravel.';
        return;
    }
    const lampu = json.lampu || [];
    const data = json.data || [];
    const latest = data.length > 0 ? data[0] : null;
    if (!latest) {
        setSystemStatus(false, 0);
        document.getElementById('totalLampu').innerText = lampu.length;
        document.getElementById('lampuTerang').innerText = 0;
        document.getElementById('lampuRedup').innerText = 0;
        document.getElementById('gerakanCount').innerText = 0;
        document.getElementById('sensorCount').innerText = 0;
        document.getElementById('lastLux').innerText = 0;
        document.getElementById('kondisiCard').className = kondisiCardColor('OFFLINE');
        document.getElementById('kondisiSistem').innerText = 'Belum Ada Data';
        document.getElementById('kondisiDetail').innerText = 'ESP32 belum mengirim data.';
        document.getElementById('lampuContainer').innerHTML = '';
        document.getElementById('tableData').innerHTML = '';
        document.getElementById('activityList').innerHTML = '';
        await loadChartKeseluruhan();
        return;
    }
    const diffSeconds = getDiffSeconds(latest.waktu, json.server_time);
    const isEspOnline = diffSeconds <= ESP_TIMEOUT_SECONDS;
    setSystemStatus(isEspOnline, diffSeconds);
    let statusGlobal = isEspOnline ? latest.status_lampu : 'OFFLINE';
    let modeGlobal = isEspOnline ? latest.mode : '-';
    let cahayaGlobal = isEspOnline ? latest.cahaya : 0;
    let gerakanGlobal = isEspOnline ? latest.gerakan : 0;
    document.getElementById('totalLampu').innerText = lampu.length;
    document.getElementById('sensorCount').innerText = json.totalData || data.length;
    document.getElementById('lastLux').innerText = cahayaGlobal;
    document.getElementById('lampuTerang').innerText =
        isEspOnline && statusGlobal === 'ON-Terang' ? lampu.length : 0;
    document.getElementById('lampuRedup').innerText =
        isEspOnline && statusGlobal === 'ON-Redup' ? lampu.length : 0;
    document.getElementById('gerakanCount').innerText =
        isEspOnline && (gerakanGlobal == 1 || gerakanGlobal === 'ADA') ? 1 : 0;
    document.getElementById('modeAktif').innerText = modeGlobal;
    document.getElementById('lastUpdate').innerText = latest.waktu;
    document.getElementById('kondisiCard').className = kondisiCardColor(statusGlobal);
    document.getElementById('kondisiSistem').innerText = isEspOnline ? statusText(statusGlobal) : 'Sistem Offline';
    document.getElementById('kondisiDetail').innerText = !isEspOnline
        ? `Data terakhir ${diffSeconds} detik lalu. Menunggu update ESP32.`
        : `${kondisiCahaya(cahayaGlobal)} • ${gerakanLabel(gerakanGlobal)} GERAKAN • ${modeGlobal}`;
    let lampuHTML = '';
    lampu.forEach(l => {
        lampuHTML += `
            <div class="theme-card rounded-[28px] p-6 border ${cardBorderColor(statusGlobal)} shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="theme-title text-[22px] lg:text-[26px] font-bold tracking-tight">${l.nama_lampu}</h2>
                        <p class="theme-muted text-[15px] lg:text-[17px] mt-1">${l.lokasi ?? 'Area Smart Lighting'}</p>
                    </div>
                    <div class="w-4 h-4 rounded-full ${statusDot(statusGlobal)}"></div>
                </div>
                <div class="mt-6 px-4 py-3 rounded-2xl text-center text-[18px] lg:text-[24px] font-bold ${statusBadge(statusGlobal)}">
                    ${statusGlobal}
                </div>
                <div class="grid grid-cols-2 gap-5 mt-6">
                    <div>
                        <p class="theme-muted text-[15px]">Mode</p>
                        <h3 class="theme-title text-[18px] lg:text-[22px] font-semibold mt-2">${modeGlobal}</h3>
                    </div>
                    <div>
                        <p class="theme-muted text-[15px]">Cahaya</p>
                        <h3 class="theme-title text-[18px] lg:text-[22px] font-semibold mt-2">${cahayaGlobal} Lux</h3>
                    </div>
                    <div class="col-span-2">
                        <p class="theme-muted text-[15px]">Gerakan</p>
                        <h3 class="theme-title text-[18px] lg:text-[22px] font-semibold mt-2">${isEspOnline ? gerakanLabel(gerakanGlobal) : '-'}</h3>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t" style="border-color: var(--border)">
                    <p class="theme-muted text-[15px]">Update</p>
                    <p class="theme-muted text-[15px] lg:text-[17px] mt-1">${latest.waktu}</p>
                </div>
            </div>
        `;
    });
    document.getElementById('lampuContainer').innerHTML = lampuHTML;
    let tableHTML = '';
    data.forEach(d => {
        tableHTML += `
            <tr class="hover:bg-slate-800/60 transition">
                <td class="py-5 px-5 text-[13px] lg:text-[18px] theme-title">${d.id}</td>
                <td class="py-5 px-5 text-[13px] lg:text-[18px] theme-title">Sistem Smart Lighting</td>
                <td class="py-5 px-5 text-[13px] lg:text-[18px] theme-title">${d.cahaya}</td>
                <td class="py-5 px-5">
                    <span class="px-4 py-2 rounded-xl text-[15px] font-semibold ${gerakanBadge(d.gerakan)}">
                        ${gerakanLabel(d.gerakan)}
                    </span>
                </td>
                <td class="py-5 px-5">
                    <span class="px-4 py-2 rounded-xl text-[15px] font-semibold ${statusBadge(d.status_lampu)}">
                        ${d.status_lampu}
                    </span>
                </td>
                <td class="py-5 px-5 text-[13px] lg:text-[18px] theme-title">${d.mode}</td>
                <td class="py-5 px-5 text-[13px] lg:text-[18px] theme-muted">${d.waktu}</td>
            </tr>
        `;
    });
    document.getElementById('tableData').innerHTML = tableHTML;
    let activityHTML = '';
    data.slice(0, 6).forEach(d => {
        activityHTML += `
            <div class="theme-card rounded-2xl p-4 border ${cardBorderColor(d.status_lampu)}">
                <div class="flex justify-between items-center gap-3">
                    <span class="px-3 py-1 rounded-lg text-[13px] font-semibold ${statusBadge(d.status_lampu)}">
                        ${d.status_lampu}
                    </span>
                    <span class="theme-muted text-[14px]">${d.waktu}</span>
                </div>
                <p class="theme-title text-[15px] lg:text-[17px] mt-3">
                    Cahaya ${d.cahaya} Lux, Gerakan ${gerakanLabel(d.gerakan)}, Mode ${d.mode}
                </p>
            </div>
        `;
    });
    document.getElementById('activityList').innerHTML = activityHTML;
    await loadChartKeseluruhan();
}
initCharts();
loadData();
setInterval(loadData, 500);
</script>
</body>
</html>