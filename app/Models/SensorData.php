<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $table = 'sensor_data';

    protected $fillable = [
        'lampu_id',
        'user_id',
        'cahaya',
        'gerakan',
        'status_lampu',
        'mode',
        'waktu'
    ];

    public $timestamps = false;

    public function lampu()
    {
        return $this->belongsTo(Lampu::class);
    }
}
