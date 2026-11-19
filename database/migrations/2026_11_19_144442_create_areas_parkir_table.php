<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas_parkir', function (Blueprint $table) {
            $table->id();
            $table->string('nama_area', 100);
            $table->enum('jenis_kendaraan', ['motor', 'mobil']);
            $table->unsignedInteger('kapasitas');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas_parkir');
    }
};