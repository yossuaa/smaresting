<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_controls', function (Blueprint $table) {
            $table->id();
            $table->string('data_logging_status')->default('RUNNING');
            $table->timestamps();
        });

        DB::table('system_controls')->insert([
            'data_logging_status' => 'RUNNING',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('system_controls');
    }
};
