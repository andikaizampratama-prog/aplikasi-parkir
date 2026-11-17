
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('validasis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaksi_id')
                ->nullable()
                ->constrained('transaksis')
                ->nullOnDelete();

            $table->foreignId('validator_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak'
            ])->default('menunggu');

            $table->text('catatan')->nullable();
            $table->dateTime('tanggal_validasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('validasis');
    }
};
