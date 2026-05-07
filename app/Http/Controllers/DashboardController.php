<?php

namespace App\Http\Controllers;

use App\Models\Lampu;
use App\Models\SensorData;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    // 🔥 API untuk AJAX
    public function realtime()
    {
        $lampu = Lampu::all();

        $data = SensorData::with('lampu')
            ->orderBy('waktu', 'desc')
            ->limit(20)
            ->get();

        return response()->json([
            'lampu' => $lampu,
            'data' => $data
        ]);
    }
}
