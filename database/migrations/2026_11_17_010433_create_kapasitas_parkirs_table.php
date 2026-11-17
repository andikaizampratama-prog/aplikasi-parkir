
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kapasitas_parkirs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis')->unique();
            $table->unsignedInteger('kapasitas');
            $table->timestamps();
        });

        DB::table('kapasitas_parkirs')->insert([
            [
                'jenis' => 'motor',
                'kapasitas' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis' => 'mobil',
                'kapasitas' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kapasitas_parkirs');
    }
};
