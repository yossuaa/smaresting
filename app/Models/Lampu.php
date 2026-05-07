<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampu extends Model
{
    protected $table = 'lampu';

    protected $fillable = [
        'nama_lampu',
        'lokasi',
        'deskripsi'
    ];

    public function sensorData()
    {
        return $this->hasMany(SensorData::class);
    }
}
