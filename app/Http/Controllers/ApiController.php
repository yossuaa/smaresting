<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        SensorData::create([
            'lampu_id' => $request->lampu_id,
            'cahaya' => $request->cahaya,
            'gerakan' => $request->gerakan,
            'status_lampu' => $request->status_lampu,
            'mode' => $request->mode,
            'waktu' => now()
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
