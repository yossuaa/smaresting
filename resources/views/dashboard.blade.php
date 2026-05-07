<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smaresting Dashboard</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font SF Pro -->
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">

    <style>

        *{
            font-family: 'SF Pro Display', sans-serif;
        }

        body{
            background: #f5f5f7;
            overflow-y: auto;
        }

        ::-webkit-scrollbar{
            width: 8px;
        }

        ::-webkit-scrollbar-thumb{
            background: #d1d5db;
            border-radius: 999px;
        }

    </style>

</head>

<body>

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-[320px] bg-white border-r border-gray-200 fixed left-0 top-0 h-screen flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="px-8 py-14 border-b border-gray-100">

                <h1 class="text-[52px] font-bold leading-none text-[#111827]">
                    Smaresting
                </h1>

                <p class="text-gray-400 text-[28px] mt-2">
                    Monitoring System
                </p>

            </div>

            <!-- MENU -->
            <div class="p-5 space-y-4">

                <!-- DASHBOARD -->
                <a href="/dashboard"
                    class="flex items-center gap-4 bg-[#0f172a] text-white px-6 py-5 rounded-2xl">

                    <div class="grid grid-cols-2 gap-1">

                        <div class="w-3 h-3 bg-white rounded-sm"></div>
                        <div class="w-3 h-3 bg-white rounded-sm"></div>
                        <div class="w-3 h-3 bg-white rounded-sm"></div>
                        <div class="w-3 h-3 bg-white rounded-sm"></div>

                    </div>

                    <span class="text-[24px] font-medium">
                        Dashboard
                    </span>

                </a>

                <!-- MONITORING -->
                <a href="/monitoring"
                    class="flex items-center gap-4 border border-gray-200 bg-white px-6 py-5 rounded-2xl hover:bg-gray-50 transition">

                    <div class="w-5 h-5 rounded border-2 border-gray-400"></div>

                    <span class="text-[24px] text-gray-600">
                        Monitoring
                    </span>

                </a>

                <!-- DATA SENSOR -->
                <a href="/data-sensor"
                    class="flex items-center gap-4 border border-gray-200 bg-white px-6 py-5 rounded-2xl hover:bg-gray-50 transition">

                    <div class="w-5 h-5 rounded-full border-2 border-gray-400"></div>

                    <span class="text-[24px] text-gray-600">
                        Data Sensor
                    </span>

                </a>

                <!-- ANALYTICS -->
                <a href="/analytics"
                    class="flex items-center gap-4 border border-gray-200 bg-white px-6 py-5 rounded-2xl hover:bg-gray-50 transition">

                    <div class="w-5 h-5 border-l-2 border-b-2 border-gray-400 rotate-45"></div>

                    <span class="text-[24px] text-gray-600">
                        Analytics
                    </span>

                </a>

                <!-- REPORT -->
                <a href="/reports"
                    class="flex items-center gap-4 border border-gray-200 bg-white px-6 py-5 rounded-2xl hover:bg-gray-50 transition">

                    <div class="w-5 h-5 rounded border-2 border-gray-400"></div>

                    <span class="text-[24px] text-gray-600">
                        Reports
                    </span>

                </a>

                <!-- SETTINGS -->
                <a href="/settings"
                    class="flex items-center gap-4 border border-gray-200 bg-white px-6 py-5 rounded-2xl hover:bg-gray-50 transition">

                    <div class="w-5 h-5 rounded-full border-2 border-gray-400"></div>

                    <span class="text-[24px] text-gray-600">
                        Settings
                    </span>

                </a>

            </div>

        </div>

        <!-- LOGOUT -->
        <div class="p-5">

            <a href="/logout"
                class="border border-red-200 text-red-500 py-5 rounded-2xl flex justify-center text-[24px] hover:bg-red-50 transition">

                Logout

            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="ml-[320px] flex-1 p-8">

        <!-- HEADER -->
        <div class="bg-white border border-gray-200 rounded-3xl p-8 flex justify-between items-center">

            <div>

                <h1 class="text-[52px] font-bold text-[#111827]">
                    Dashboard
                </h1>

                <p class="text-gray-400 text-[28px] mt-2">
                    Monitoring sistem lampu secara real-time
                </p>

            </div>

            <div class="flex gap-5">

                <!-- STATUS -->
                <div class="border border-gray-200 rounded-2xl px-8 py-5 min-w-[220px]">

                    <p class="text-gray-400 text-[18px]">
                        Status Sistem
                    </p>

                    <div class="flex items-center gap-3 mt-2">

                        <div class="w-4 h-4 bg-green-500 rounded-full"></div>

                        <span class="text-green-500 text-[26px] font-medium">
                            Online
                        </span>

                    </div>

                </div>

                <!-- DATE -->
                <div class="border border-gray-200 rounded-2xl px-8 py-5 min-w-[280px]">

                    <p class="text-[24px] text-gray-700">
                        20 Desember 2024
                    </p>

                    <p class="text-gray-400 text-[20px] mt-1">
                        09:30:45
                    </p>

                </div>

            </div>

        </div>

        <!-- STATISTIC -->
        <div class="grid grid-cols-4 gap-6 mt-6">

            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <p class="text-gray-500 text-[22px]">
                    Total Lampu
                </p>

                <h1 id="totalLampu"
                    class="text-[64px] font-bold mt-4 text-gray-800">
                    0
                </h1>

            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <p class="text-gray-500 text-[22px]">
                    Lampu Aktif
                </p>

                <h1 id="lampuAktif"
                    class="text-[64px] font-bold mt-4 text-gray-800">
                    0
                </h1>

            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <p class="text-gray-500 text-[22px]">
                    Gerakan Terdeteksi
                </p>

                <h1 id="gerakanCount"
                    class="text-[64px] font-bold mt-4 text-gray-800">
                    0
                </h1>

            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-7">

                <p class="text-gray-500 text-[22px]">
                    Total Data Sensor
                </p>

                <h1 id="sensorCount"
                    class="text-[64px] font-bold mt-4 text-gray-800">
                    0
                </h1>

            </div>

        </div>

        <!-- STATUS LAMPU -->
        <div class="bg-white border border-gray-200 rounded-3xl p-7 mt-6">

            <div class="flex justify-between items-center mb-7">

                <h2 class="text-[42px] font-bold text-gray-800">
                    Status Lampu
                </h2>

                <button class="border border-gray-200 px-6 py-3 rounded-2xl text-gray-500 hover:bg-gray-50 text-[20px]">
                    Lihat Semua
                </button>

            </div>

            <!-- CARD -->
            <div id="lampuContainer"
                class="grid grid-cols-5 gap-5">

            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white border border-gray-200 rounded-3xl p-7 mt-6 mb-10">

            <div class="flex justify-between items-center mb-7">

                <h2 class="text-[42px] font-bold text-gray-800">
                    Data Sensor Terbaru
                </h2>

                <button class="border border-gray-200 px-6 py-3 rounded-2xl text-gray-500 hover:bg-gray-50 text-[20px]">
                    Lihat Semua Data
                </button>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-gray-100">

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                ID
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Lampu
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Cahaya
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Gerakan
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Status
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Mode
                            </th>

                            <th class="text-left py-5 text-gray-400 text-[20px]">
                                Waktu
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tableData"
                        class="divide-y divide-gray-100">

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

<script>

async function loadData(){

    const res = await fetch('/data-realtime');
    const json = await res.json();

    // TOTAL
    document.getElementById('totalLampu').innerText =
        json.lampu.length;

    document.getElementById('sensorCount').innerText =
        json.data.length;

    let aktif = 0;
    let gerakan = 0;

    // CARD
    let lampuHTML = '';

    json.lampu.forEach(l => {

        let last = json.data.find(d => d.lampu_id == l.id);

        if(last && last.status_lampu == 'ON')
            aktif++;

        if(last && last.gerakan == 'ADA')
            gerakan++;

        lampuHTML += `

        <div class="border border-gray-200 rounded-2xl p-5">

            <div class="flex justify-between">

                <div>

                    <h2 class="text-[28px] font-semibold text-gray-800">
                        ${l.nama_lampu}
                    </h2>

                    <p class="text-gray-400 text-[18px] mt-1">
                        ID: ${l.id}
                    </p>

                </div>

                <div class="
                    w-4 h-4 rounded-full
                    ${last && last.status_lampu == 'ON'
                        ? 'bg-green-500'
                        : 'bg-red-500'}
                "></div>

            </div>

            <div class="grid grid-cols-2 gap-5 mt-7">

                <div>

                    <p class="text-gray-400 text-[16px]">
                        Status
                    </p>

                    <h3 class="
                        text-[24px] font-semibold mt-2
                        ${last && last.status_lampu == 'ON'
                            ? 'text-green-500'
                            : 'text-red-500'}
                    ">
                        ${last ? last.status_lampu : '-'}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-[16px]">
                        Mode
                    </p>

                    <h3 class="text-[22px] mt-2 text-gray-700">
                        ${last ? last.mode : '-'}
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-[16px]">
                        Cahaya
                    </p>

                    <h3 class="text-[22px] mt-2 text-gray-700">
                        ${last ? last.cahaya : '-'} Lux
                    </h3>

                </div>

                <div>

                    <p class="text-gray-400 text-[16px]">
                        Gerakan
                    </p>

                    <h3 class="text-[22px] mt-2 text-gray-700">
                        ${last ? last.gerakan : '-'}
                    </h3>

                </div>

            </div>

            <div class="mt-6">

                <p class="text-gray-400 text-[15px]">
                    Update
                </p>

                <p class="text-gray-500 text-[18px] mt-1">
                    ${last ? last.waktu : '-'}
                </p>

            </div>

        </div>

        `;

    });

    document.getElementById('lampuContainer').innerHTML =
        lampuHTML;

    document.getElementById('lampuAktif').innerText =
        aktif;

    document.getElementById('gerakanCount').innerText =
        gerakan;

    // TABLE
    let tableHTML = '';

    json.data.forEach(d => {

        tableHTML += `

        <tr>

            <td class="py-5 text-[20px]">
                ${d.id}
            </td>

            <td class="py-5 text-[20px]">
                ${d.lampu ? d.lampu.nama_lampu : '-'}
            </td>

            <td class="py-5 text-[20px]">
                ${d.cahaya}
            </td>

            <td class="py-5">

                <span class="
                    px-4 py-2 rounded-lg text-[16px]
                    ${d.gerakan == 'ADA'
                        ? 'bg-blue-100 text-blue-600'
                        : 'bg-gray-100 text-gray-500'}
                ">
                    ${d.gerakan}
                </span>

            </td>

            <td class="py-5">

                <span class="
                    px-4 py-2 rounded-lg text-[16px]
                    ${d.status_lampu == 'ON'
                        ? 'bg-green-100 text-green-600'
                        : 'bg-red-100 text-red-500'}
                ">
                    ${d.status_lampu}
                </span>

            </td>

            <td class="py-5 text-[20px]">
                ${d.mode}
            </td>

            <td class="py-5 text-[20px] text-gray-500">
                ${d.waktu}
            </td>

        </tr>

        `;

    });

    document.getElementById('tableData').innerHTML =
        tableHTML;

}

setInterval(loadData, 3000);

loadData();

</script>

</body>
</html>