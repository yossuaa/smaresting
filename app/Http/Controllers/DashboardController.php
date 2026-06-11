<?php

namespace App\Http\Controllers;

use App\Models\Lampu;
use App\Models\SensorData;
use App\Models\SystemControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\SensorUpdated;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    private function getLoggingStatus()
    {
        $control = SystemControl::where('id', 1)->first();

        if (!$control) {
            $control = SystemControl::create([
                'id' => 1,
                'data_logging_status' => 'RUNNING',
            ]);
        }

        return $control->data_logging_status;
    }

    public function realtime()
    {
        $lampu = Lampu::all();

        $data = SensorData::with('lampu')
            ->orderBy('id', 'desc')
            ->limit(100)
            ->get();

        return response()->json([
            'lampu' => $lampu,
            'data' => $data,
            'totalData' => SensorData::max('id') ?? 0,
            'logging_status' => $this->getLoggingStatus(),
            'server_time' => now()->format('Y-m-d H:i:s'),
        ]);
    }

    public function analyticsData()
    {
        $data = SensorData::orderBy('id', 'asc')->get();

        return response()->json([
            'data' => $data,
            'totalData' => SensorData::max('id') ?? 0,
            'logging_status' => $this->getLoggingStatus(),
            'server_time' => now()->format('Y-m-d H:i:s'),
        ]);
    }

    public function storeSensor(Request $request)
    {
        $request->validate([
            'cahaya' => 'required',
            'gerakan' => 'required',
            'status_lampu' => 'required',
            'mode' => 'required',
        ]);

        $loggingStatus = DB::table('system_controls')
            ->where('id', 1)
            ->value('data_logging_status');

        if ($loggingStatus === 'STOPPED') {
            return response()->json([
                'success' => false,
                'logging_status' => 'STOPPED',
                'message' => 'Data logging sedang dihentikan. Data tidak disimpan.',
            ], 200);
        }

        $statusBaru = $request->status_lampu;
        $sekarang = now();

        $dataTerakhir = SensorData::orderBy('id', 'desc')->first();

        $waktuMulai = null;
        $waktuSelesai = null;
        $durasi = null;

        if ($statusBaru !== 'OFF') {
            if (!$dataTerakhir || $dataTerakhir->status_lampu === 'OFF') {
                $waktuMulai = $sekarang;
            } else {
                $waktuMulai = $dataTerakhir->waktu_mulai;
            }
        }

        if ($statusBaru === 'OFF') {
            if ($dataTerakhir && $dataTerakhir->status_lampu !== 'OFF') {
                $waktuMulai = $dataTerakhir->waktu_mulai;
                $waktuSelesai = $sekarang;

                if ($waktuMulai) {
                    $durasi = Carbon::parse($waktuMulai)->diffInSeconds($waktuSelesai);
                }
            }
        }

        $sensor = SensorData::create([
            'lampu_id' => $request->lampu_id ?? 1,
            'user_id' => $request->user_id ?? 1,
            'cahaya' => $request->cahaya,
            'gerakan' => $request->gerakan,
            'status_lampu' => $statusBaru,
            'mode' => $request->mode,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'durasi' => $durasi,
            'waktu' => $sekarang,
        ]);

        broadcast(new SensorUpdated($sensor));

        return response()->json([
            'success' => true,
            'logging_status' => 'RUNNING',
            'message' => 'Data sensor berhasil disimpan',
        ]);
    }


    public function resetDataSensor()
    {
        if (session('user_name') !== 'kelompoksatu') {
            return redirect('/settings')
                ->with('error', 'Hanya akun kelompoksatu yang dapat mereset data.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        SensorData::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect('/settings')
            ->with('success', 'Semua data sensor berhasil direset.');
    }

    public function toggleDataLogging()
    {
        if (session('user_name') !== 'kelompoksatu') {
            return redirect('/settings')
                ->with('error', 'Hanya akun kelompoksatu yang dapat mengubah logging.');
        }

        $control = SystemControl::where('id', 1)->first();

        if (!$control) {
            $control = SystemControl::create([
                'id' => 1,
                'data_logging_status' => 'RUNNING',
            ]);
        }

        $control->data_logging_status =
            $control->data_logging_status === 'RUNNING'
            ? 'STOPPED'
            : 'RUNNING';

        $control->save();

        return redirect('/settings')->with(
            'success',
            $control->data_logging_status === 'RUNNING'
                ? 'Pengiriman data sensor dilanjutkan.'
                : 'Pengiriman data sensor dihentikan.'
        );
    }
    public function durasiStatus()
    {
        $data = SensorData::orderBy('waktu', 'asc')->get();

        $hasil = [];

        if ($data->isEmpty()) {
            return response()->json([
                'durasi' => []
            ]);
        }

        $statusAktif = $data[0]->status_lampu;
        $waktuMulai = $data[0]->waktu;

        for ($i = 1; $i < count($data); $i++) {
            $item = $data[$i];

            if ($item->status_lampu !== $statusAktif) {
                $waktuSelesai = $item->waktu;

                $durasi = \Carbon\Carbon::parse($waktuMulai)
                    ->diffInSeconds(\Carbon\Carbon::parse($waktuSelesai));

                $hasil[] = [
                    'status' => $statusAktif,
                    'waktu_mulai' => $waktuMulai,
                    'waktu_selesai' => $waktuSelesai,
                    'durasi' => $durasi,
                    'sedang_berjalan' => false,
                ];

                $statusAktif = $item->status_lampu;
                $waktuMulai = $item->waktu;
            }
        }

        $durasiBerjalan = \Carbon\Carbon::parse($waktuMulai)
            ->diffInSeconds(now());

        $hasil[] = [
            'status' => $statusAktif,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => now()->format('Y-m-d H:i:s'),
            'durasi' => $durasiBerjalan,
            'sedang_berjalan' => true,
        ];

        return response()->json([
            'durasi' => array_reverse($hasil)
        ]);
    }
}
