<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Sensor - Smaresting</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Space Grotesk', sans-serif;
        }

        body {
            background: #020617;
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

    <main class="lg:ml-[300px] ml-0 flex-1 p-4 lg:p-8">

        <div class="theme-card backdrop-blur-xl rounded-[34px] p-8 shadow-xl shadow-emerald-500/5">
            <div class="inline-flex items-center gap-3 theme-soft border px-5 py-2 rounded-full text-[17px] font-semibold mb-4">
                <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse shadow-lg shadow-emerald-400/50"></span>
                Sensor History Center
            </div>
            
            <h1 class="theme-title text-[50px] font-bold tracking-tight">
                Riwayat Sensor
            </h1>

            <p class="theme-muted text-[24px] mt-2">
                Data historis sensor LDR, PIR, status lampu, mode sistem, tanggal, dan waktu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mt-6">
            <div class="theme-card rounded-[30px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Total Data</p>
                <h2 id="totalData" class="text-[46px] font-bold mt-3 theme-title tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Berdasarkan ID terakhir</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Gerakan</p>
                <h2 id="totalGerakan" class="text-[46px] font-bold mt-3 text-blue-400 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Deteksi PIR pada data tampil</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-orange-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Rata-rata Cahaya</p>
                <h2 id="avgCahaya" class="text-[46px] font-bold mt-3 text-orange-400 tracking-tight">0</h2>
                <p class="theme-muted text-[15px] mt-2">Nilai rata-rata Lux</p>
            </div>

            <div class="theme-card rounded-[30px] p-6 hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300">
                <p class="theme-muted text-[18px]">Export</p>
                <button onclick="exportCSV()"
                        class="mt-4 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-[18px] font-semibold transition shadow-lg shadow-emerald-500/20">
                    Download CSV
                </button>
                <p class="theme-muted text-[15px] mt-3">Export data terfilter</p>
            </div>
        </div>

        <div class="theme-card rounded-[34px] p-8 mt-6">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="theme-title text-[34px] font-bold tracking-tight">
                        Tabel Riwayat Sensor
                    </h2>
                    <p class="theme-muted text-[18px] mt-1">
                        Data otomatis update setiap 2 detik.
                    </p>
                </div>

                <div class="flex items-center gap-3 theme-card rounded-2xl px-5 py-3 text-[18px] theme-muted">
                    <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></span>
                    Realtime 2 Detik
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
                <input id="searchInput"
                       type="text"
                       placeholder="Cari status/mode..."
                       class="theme-input rounded-2xl px-5 py-4 text-[18px] placeholder:text-slate-500 transition">

                <div class="relative">
    <input id="dateInput"
           type="date"
           onclick="this.showPicker && this.showPicker()"
           class="theme-input w-full rounded-2xl px-5 py-4 text-[18px] transition cursor-pointer">
</div>
                <button onclick="loadSensor()"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl text-[18px] font-semibold transition shadow-lg shadow-emerald-500/20">
                    Filter Data
                </button>

                <button onclick="resetFilter()"
                        class="theme-card rounded-2xl text-[18px] font-semibold transition hover:border-emerald-500/50">
                    Reset Filter
                </button>
            </div>

            <div class="overflow-x-auto theme-card rounded-[26px]">
                <table class="w-full min-w-[1100px]">
                    <thead>
                        <tr class="border-b" style="border-color: var(--border)">
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">ID</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Tanggal</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Jam</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Cahaya</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Gerakan</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Status</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Mode</th>
                            <th class="text-left py-5 px-5 theme-muted text-[17px]">Waktu Lengkap</th>
                        </tr>
                    </thead>

                    <tbody id="tableSensor" class="divide-y"></tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script>
let currentData = [];

function badgeStatus(status){
    if(status === 'ON-Terang') {
        return 'bg-green-500/15 text-green-300 border border-green-500/30';
    }

    if(status === 'ON-Redup') {
        return 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/30';
    }

    if(status === 'OFF') {
        return 'bg-red-500/15 text-red-300 border border-red-500/30';
    }

    return 'bg-slate-500/15 text-slate-300 border border-slate-500/30';
}

function gerakanLabel(v){
    return v == 1 || v === 'ADA' ? 'ADA' : 'TIDAK ADA';
}

function gerakanBadge(v){
    return v == 1 || v === 'ADA'
        ? 'bg-blue-500/15 text-blue-300 border border-blue-500/30'
        : 'bg-slate-500/15 text-slate-300 border border-slate-500/30';
}

function getTanggal(waktu){
    if(!waktu) return '-';
    return waktu.toString().slice(0, 10);
}

function getJam(waktu){
    if(!waktu) return '-';
    return waktu.toString().slice(11, 19);
}

function formatTanggalIndonesia(waktu){
    if(!waktu) return '-';

    const tanggal = getTanggal(waktu);
    const parts = tanggal.split('-');

    if(parts.length !== 3) return tanggal;

    return `${parts[2]}/${parts[1]}/${parts[0]}`;
}

function csvSafe(value){
    if(value === null || value === undefined) return '';
    return `"${String(value).replace(/"/g, '""')}"`;
}

async function loadSensor(){
    const res = await fetch('/data-realtime');
    const json = await res.json();

    let data = json.data || [];

    const search = document.getElementById('searchInput').value.toLowerCase();
    const date = document.getElementById('dateInput').value;

    if(search){
        data = data.filter(d =>
            (d.status_lampu && d.status_lampu.toLowerCase().includes(search)) ||
            (d.mode && d.mode.toLowerCase().includes(search))
        );
    }

    if(date){
        data = data.filter(d => d.waktu && d.waktu.startsWith(date));
    }

    currentData = data;

    document.getElementById('totalData').innerText = json.totalData || 0;

    document.getElementById('totalGerakan').innerText =
        data.filter(d => d.gerakan == 1 || d.gerakan === 'ADA').length;

    let avg = data.length
        ? Math.round(data.reduce((a,b) => a + Number(b.cahaya), 0) / data.length)
        : 0;

    document.getElementById('avgCahaya').innerText = avg;

    let html = '';

    if(data.length === 0){
        html = `
            <tr>
                <td colspan="8" class="py-8 px-5 text-center theme-muted text-[18px]">
                    Tidak ada data yang cocok dengan filter.
                </td>
            </tr>
        `;
    }

    data.forEach(d => {
        html += `
            <tr class="hover:bg-slate-800/60 transition">
                <td class="py-5 px-5 text-[18px] theme-title">${d.id}</td>

                <td class="py-5 px-5 text-[18px] theme-title">
                    ${formatTanggalIndonesia(d.waktu)}
                </td>

                <td class="py-5 px-5 text-[18px] theme-muted">
                    ${getJam(d.waktu)}
                </td>

                <td class="py-5 px-5 text-[18px] text-orange-300 font-semibold">
                    ${d.cahaya} Lux
                </td>

                <td class="py-5 px-5">
                    <span class="px-4 py-2 rounded-xl text-[15px] font-semibold ${gerakanBadge(d.gerakan)}">
                        ${gerakanLabel(d.gerakan)}
                    </span>
                </td>

                <td class="py-5 px-5">
                    <span class="px-4 py-2 rounded-xl text-[15px] font-semibold ${badgeStatus(d.status_lampu)}">
                        ${d.status_lampu}
                    </span>
                </td>

                <td class="py-5 px-5 text-[18px] theme-title">${d.mode}</td>

                <td class="py-5 px-5 text-[18px] theme-muted">${d.waktu}</td>
            </tr>
        `;
    });

    document.getElementById('tableSensor').innerHTML = html;
}

function resetFilter(){
    document.getElementById('searchInput').value = '';
    document.getElementById('dateInput').value = '';
    loadSensor();
}

function exportCSV(){
    let csv = "ID,Tanggal,Jam,Cahaya,Gerakan,Status,Mode,Waktu Lengkap\n";

    currentData.forEach(d => {
        csv += [
            csvSafe(d.id),
            csvSafe(formatTanggalIndonesia(d.waktu)),
            csvSafe(getJam(d.waktu)),
            csvSafe(d.cahaya),
            csvSafe(gerakanLabel(d.gerakan)),
            csvSafe(d.status_lampu),
            csvSafe(d.mode),
            csvSafe(d.waktu)
        ].join(",") + "\n";
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);

    const filterDate = document.getElementById('dateInput').value;
    const fileName = filterDate
        ? `riwayat-sensor-${filterDate}.csv`
        : 'riwayat-sensor-semua-data.csv';

    const a = document.createElement('a');
    a.href = url;
    a.download = fileName;
    a.click();

    window.URL.revokeObjectURL(url);
}

loadSensor();
setInterval(loadSensor, 2000);
</script>

</body>
</html>