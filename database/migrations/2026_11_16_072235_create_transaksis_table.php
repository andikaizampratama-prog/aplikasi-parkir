
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parkir_id')
                ->constrained('parkirs')
                ->cascadeOnDelete();

            $table->string('kode_transaksi')->unique();

            $table->decimal('total_biaya', 12, 2);

            $table->string('metode_pembayaran')->default('tunai');

            $table->enum('status_pembayaran', [
                'belum_bayar',
                'lunas'
            ])->default('belum_bayar');

            $table->dateTime('tanggal_transaksi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
