<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_checkpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_cp', 50)->unique();
            $table->string('nama_cp', 50);
            $table->string('desc_cp', 100);
            $table->string('lokasi_cp', 50);
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_checkpoints');
    }
};