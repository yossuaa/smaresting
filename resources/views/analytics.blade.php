<!DOCTYPE html>
<html>
<head>
    <title>Analytics - Smaresting</title>
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

        <div class="theme-card backdrop-blur-xl rounded-[34px] p-8 shadow-xl shadow-emerald-500/5">
            <div class="inline-flex items-center gap-3 theme-soft border px-5 py-2 rounded-full text-[17px] font-semibold mb-4">
                <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse shadow-lg shadow-emerald-400/50"></span>
                Smart Lighting Analytics Center
            </div>

            <h1 class="theme-title text-[50px] font-bold tracking-tight">
                Analytics
            </h1>

            <p class="theme-muted text-[24px] mt-2">
                Analisis seluruh data sensor yang tercatat di database.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5 mt-6">
            <div class="theme-card rounded-[30px] p-6 hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Total Data</p>
                <h2 id="totalData" class="text-[44px] font-bold theme-title mt-3 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Berdasarkan ID terakhir</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Total Gerakan</p>
                <h2 id="totalGerakan" class="text-[44px] font-bold text-blue-400 mt-3 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Deteksi PIR</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Rata-rata Cahaya</p>
                <h2 id="avgCahaya" class="text-[44px] font-bold text-orange-400 mt-3 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Lux rata-rata</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Status Dominan</p>
                <h2 id="statusDominan" class="text-[34px] font-bold text-emerald-400 mt-3 tracking-tight">-</h2>
                <p class="theme-muted text-[15px] mt-2">Kondisi terbanyak</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-yellow-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Peak Cahaya</p>
                <h2 id="peakCahaya" class="text-[44px] font-bold text-yellow-400 mt-3 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Lux tertinggi</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
    <div class="theme-card rounded-[34px] p-8">
        <h2 class="theme-title text-[32px] font-bold tracking-tight">
            Statistik Durasi Status Lampu
        </h2>
        <p class="theme-muted text-[18px] mt-1">
            Total durasi OFF, ON-Redup, dan ON-Terang.
        </p>

        <div class="mt-6 h-[340px] theme-card rounded-[26px] p-5">
            <canvas id="chartDurasiStatus"></canvas>
        </div>
    </div>

    <div class="theme-card rounded-[34px] p-8">
        <h2 class="theme-title text-[32px] font-bold tracking-tight">
            Persentase Durasi Lampu
        </h2>
        <p class="theme-muted text-[18px] mt-1">
            Perbandingan waktu tiap status lampu.
        </p>

        <div class="mt-6 h-[340px] theme-card rounded-[26px] p-5">
            <canvas id="chartDurasiPie"></canvas>
        </div>
    </div>
</div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div class="col-span-2 theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[32px] font-bold tracking-tight">Trend Intensitas Cahaya</h2>
                <p class="theme-muted text-[18px] mt-1">Menggunakan seluruh data yang tercatat.</p>
                <div class="mt-6 h-[340px] theme-card rounded-[26px] p-5">
                    <canvas id="chartCahaya"></canvas>
                </div>
            </div>

            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[32px] font-bold tracking-tight">Distribusi Status</h2>
                <p class="theme-muted text-[18px] mt-1">ON-Terang, ON-Redup, dan OFF.</p>
                <div class="mt-6 h-[340px] theme-card rounded-[26px] p-5">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[30px] font-bold tracking-tight">Grafik Gerakan</h2>
                <p class="theme-muted text-[17px] mt-1">Deteksi PIR seluruh data.</p>
                <div class="mt-6 h-[300px] theme-card rounded-[26px] p-5">
                    <canvas id="chartGerakan"></canvas>
                </div>
            </div>

            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[30px] font-bold tracking-tight">Status Lampu</h2>
                <p class="theme-muted text-[17px] mt-1">Chart tiang jumlah status lampu.</p>
                <div class="mt-6 h-[300px] theme-card rounded-[26px] p-5">
                    <canvas id="chartStatusBar"></canvas>
                </div>
            </div>

            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[30px] font-bold tracking-tight">Mode Sistem</h2>
                <p class="theme-muted text-[17px] mt-1">Distribusi AUTO dan MANUAL.</p>
                <div class="mt-6 h-[300px] theme-card rounded-[26px] p-5">
                    <canvas id="chartMode"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-6 mb-10">
            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[30px] font-bold tracking-tight">Perbandingan Cahaya</h2>
                <p class="theme-muted text-[17px] mt-1">Minimum, rata-rata, dan maksimum Lux.</p>
                <div class="mt-6 h-[300px] theme-card rounded-[26px] p-5">
                    <canvas id="chartCahayaCompare"></canvas>
                </div>
            </div>

            <div class="theme-card rounded-[34px] p-8">
                <h2 class="theme-title text-[30px] font-bold tracking-tight">Aktivitas Sensor</h2>
                <p class="theme-muted text-[17px] mt-1">Radar chart performa sistem.</p>
                <div class="mt-6 h-[300px] theme-card rounded-[26px] p-5">
                    <canvas id="chartRadar"></canvas>
                </div>
            </div>

            <div class="relative overflow-hidden bg-emerald-500 rounded-[34px] p-8 text-white shadow-xl shadow-emerald-500/20">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h2 class="text-[32px] font-bold tracking-tight">Insight Otomatis</h2>
                    <p class="text-emerald-50 text-[18px] mt-1">Update otomatis setiap 2 detik.</p>

                    <div id="insightList" class="mt-6 space-y-4 text-[18px] text-emerald-50"></div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
let chartCahaya;
let chartGerakan;
let chartStatus;
let chartStatusBar;
let chartMode;
let chartCahayaCompare;
let chartRadar;
let chartDurasiStatus;
let chartDurasiPie;

function getJam(waktu){
    if(!waktu) return '-';
    return waktu.toString().slice(11,19);
}

function statusCount(data, status){
    return data.filter(d => d.status_lampu === status).length;
}

function modeCount(data, mode){
    return data.filter(d => d.mode === mode).length;
}

function gerakanValue(v){
    return v == 1 || v === 'ADA' ? 1 : 0;
}

function formatDurasi(seconds) {
    seconds = Math.floor(Number(seconds) || 0);

    const jam = Math.floor(seconds / 3600);
    const menit = Math.floor((seconds % 3600) / 60);
    const detik = seconds % 60;

    return `${String(jam).padStart(2, '0')}:${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;
}

function hitungDurasiStatus(data) {
    let total = {
        'OFF': 0,
        'ON-Redup': 0,
        'ON-Terang': 0
    };

    if (!data || data.length < 2) return total;

    const sorted = [...data].sort((a, b) => {
        return new Date(a.waktu.replace(' ', 'T')) - new Date(b.waktu.replace(' ', 'T'));
    });

    for (let i = 0; i < sorted.length - 1; i++) {
        const sekarang = sorted[i];
        const berikutnya = sorted[i + 1];

        if (!sekarang.waktu || !berikutnya.waktu) continue;

        const mulai = new Date(sekarang.waktu.replace(' ', 'T'));
        const selesai = new Date(berikutnya.waktu.replace(' ', 'T'));

        if (isNaN(mulai.getTime()) || isNaN(selesai.getTime())) continue;

        const durasi = Math.max(0, Math.floor((selesai - mulai) / 1000));

        if (total[sekarang.status_lampu] !== undefined) {
            total[sekarang.status_lampu] += durasi;
        }
    }

    return total;
}

function initCharts(){
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
                tension: .35,
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
            scales: {
                y: { beginAtZero: true },
                x: { grid: { color: '#1E293B' } }
            }
        }
    });

    chartDurasiStatus = new Chart(document.getElementById('chartDurasiStatus'), {
        type: 'bar',
        data: {
            labels: ['OFF', 'ON-Redup', 'ON-Terang'],
            datasets: [{
                label: 'Durasi dalam menit',
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(248, 113, 113, 0.75)',
                    'rgba(250, 204, 21, 0.75)',
                    'rgba(52, 211, 153, 0.75)'
                ],
                borderColor: ['#F87171', '#FACC15', '#34D399'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y: { beginAtZero: true },
                x: { grid: { color: '#1E293B' } }
            }
        }
    });

    chartDurasiPie = new Chart(document.getElementById('chartDurasiPie'), {
        type: 'doughnut',
        data: {
            labels: ['OFF', 'ON-Redup', 'ON-Terang'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(248, 113, 113, 0.8)',
                    'rgba(250, 204, 21, 0.8)',
                    'rgba(52, 211, 153, 0.8)'
                ],
                borderColor: '#0F172A',
                borderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            cutout: '65%'
        }
    });

    chartGerakan = new Chart(document.getElementById('chartGerakan'), {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Gerakan',
                data: [],
                backgroundColor: 'rgba(96, 165, 250, 0.75)',
                borderColor: '#60A5FA',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y:{ beginAtZero:true, max:1, ticks:{ stepSize:1 } },
                x:{ grid:{ color:'#1E293B' } }
            }
        }
    });

    chartStatus = new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: ['ON-Terang','ON-Redup','OFF'],
            datasets: [{
                data: [0,0,0],
                backgroundColor: [
                    'rgba(52, 211, 153, 0.8)',
                    'rgba(250, 204, 21, 0.8)',
                    'rgba(248, 113, 113, 0.8)'
                ],
                borderColor: '#0F172A',
                borderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            cutout: '65%'
        }
    });

    chartStatusBar = new Chart(document.getElementById('chartStatusBar'), {
        type: 'bar',
        data: {
            labels: ['ON-Terang','ON-Redup','OFF'],
            datasets: [{
                label: 'Jumlah Status',
                data: [0,0,0],
                backgroundColor: [
                    'rgba(52, 211, 153, 0.75)',
                    'rgba(250, 204, 21, 0.75)',
                    'rgba(248, 113, 113, 0.75)'
                ],
                borderColor: ['#34D399','#FACC15','#F87171'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y:{ beginAtZero:true },
                x:{ grid:{ color:'#1E293B' } }
            }
        }
    });

    chartMode = new Chart(document.getElementById('chartMode'), {
        type: 'polarArea',
        data: {
            labels: ['AUTO','MANUAL'],
            datasets: [{
                data: [0,0],
                backgroundColor: [
                    'rgba(45, 212, 191, 0.75)',
                    'rgba(168, 85, 247, 0.75)'
                ],
                borderColor: ['#2DD4BF','#A855F7'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false
        }
    });

    chartCahayaCompare = new Chart(document.getElementById('chartCahayaCompare'), {
        type: 'bar',
        data: {
            labels: ['Minimum','Rata-rata','Maksimum'],
            datasets: [{
                label: 'Lux',
                data: [0,0,0],
                backgroundColor: [
                    'rgba(96, 165, 250, 0.75)',
                    'rgba(52, 211, 153, 0.75)',
                    'rgba(251, 146, 60, 0.75)'
                ],
                borderColor: ['#60A5FA','#34D399','#FB923C'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                y:{ beginAtZero:true },
                x:{ grid:{ color:'#1E293B' } }
            }
        }
    });

    chartRadar = new Chart(document.getElementById('chartRadar'), {
        type: 'radar',
        data: {
            labels: ['Cahaya Avg','Gerakan','Terang','Redup','OFF'],
            datasets: [{
                label: 'Aktivitas Sistem',
                data: [0,0,0,0,0],
                backgroundColor: 'rgba(52, 211, 153, 0.18)',
                borderColor: '#34D399',
                pointBackgroundColor: '#34D399',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            scales: {
                r: {
                    grid: { color: '#334155' },
                    angleLines: { color: '#334155' },
                    pointLabels: { color: '#CBD5E1' },
                    ticks: { color: '#CBD5E1', backdropColor: 'transparent' }
                }
            }
        }
    });
}

async function loadAnalytics(){
    const res = await fetch('/analytics-data');
    const json = await res.json();

    const data = json.data || [];

    const onTerang = statusCount(data, 'ON-Terang');
    const onRedup = statusCount(data, 'ON-Redup');
    const off = statusCount(data, 'OFF');

    const auto = modeCount(data, 'AUTO');
    const manual = modeCount(data, 'MANUAL');

    const totalGerakan = data.filter(d => gerakanValue(d.gerakan) === 1).length;
    const cahayaAll = data.map(d => Number(d.cahaya)).filter(v => !isNaN(v));

    const avg = cahayaAll.length
        ? Math.round(cahayaAll.reduce((a,b) => a + b, 0) / cahayaAll.length)
        : 0;

    const minLux = cahayaAll.length ? Math.min(...cahayaAll) : 0;
    const maxLux = cahayaAll.length ? Math.max(...cahayaAll) : 0;

    const durasiStatus = hitungDurasiStatus(data);

    document.getElementById('totalData').innerText = json.totalData || 0;
    document.getElementById('totalGerakan').innerText = totalGerakan;
    document.getElementById('avgCahaya').innerText = avg;
    document.getElementById('peakCahaya').innerText = maxLux;

    const maxStatus = [
        ['ON-Terang', onTerang],
        ['ON-Redup', onRedup],
        ['OFF', off]
    ].sort((a,b) => b[1] - a[1])[0][0];

    document.getElementById('statusDominan').innerText = maxStatus;

    const labels = data.map(d => {
        return d.id ? `#${d.id}` : getJam(d.waktu);
    });

    const cahayaValues = data.map(d => Number(d.cahaya));
    const gerakanValues = data.map(d => gerakanValue(d.gerakan));

    chartCahaya.data.labels = labels;
    chartCahaya.data.datasets[0].data = cahayaValues;
    chartCahaya.update();

    chartGerakan.data.labels = labels;
    chartGerakan.data.datasets[0].data = gerakanValues;
    chartGerakan.update();

    chartStatus.data.datasets[0].data = [onTerang, onRedup, off];
    chartStatus.update();

    chartStatusBar.data.datasets[0].data = [onTerang, onRedup, off];
    chartStatusBar.update();

    chartMode.data.datasets[0].data = [auto, manual];
    chartMode.update();

    chartCahayaCompare.data.datasets[0].data = [minLux, avg, maxLux];
    chartCahayaCompare.update();

    chartRadar.data.datasets[0].data = [
        avg,
        totalGerakan,
        onTerang,
        onRedup,
        off
    ];
    chartRadar.update();

    chartDurasiStatus.data.datasets[0].data = [
        Math.round(durasiStatus['OFF'] / 60),
        Math.round(durasiStatus['ON-Redup'] / 60),
        Math.round(durasiStatus['ON-Terang'] / 60)
    ];
    chartDurasiStatus.update();

    chartDurasiPie.data.datasets[0].data = [
        durasiStatus['OFF'],
        durasiStatus['ON-Redup'],
        durasiStatus['ON-Terang']
    ];
    chartDurasiPie.update();

    document.getElementById('insightList').innerHTML = `
        <div class="bg-white/10 border border-white/10 rounded-2xl p-4">
            Total data tercatat: <b>${json.totalData || 0}</b>.
        </div>

        <div class="bg-white/10 border border-white/10 rounded-2xl p-4">
            Status paling sering: <b>${maxStatus}</b>.
        </div>

        <div class="bg-white/10 border border-white/10 rounded-2xl p-4">
            Durasi OFF: <b>${formatDurasi(durasiStatus['OFF'])}</b>.
        </div>

        <div class="bg-white/10 border border-white/10 rounded-2xl p-4">
            Durasi Redup: <b>${formatDurasi(durasiStatus['ON-Redup'])}</b>, Durasi Terang: <b>${formatDurasi(durasiStatus['ON-Terang'])}</b>.
        </div>

        <div class="bg-white/10 border border-white/10 rounded-2xl p-4">
            Total deteksi gerakan: <b>${totalGerakan}</b>.
        </div>
    `;
}

initCharts();
loadAnalytics();
setInterval(loadAnalytics, 500);
</script>

</body>
</html>