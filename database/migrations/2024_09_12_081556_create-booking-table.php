<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')->constrained('ruangan');
            $table->string('nama_pengunjung');
            $table->string('kontak_pengunjung');
            $table->date('tanggal');
            $table->time('waktu_pemakaian_awal');
            $table->time('waktu_pemakaian_akhir');
            $table->enum('status', ['pending', 'booked', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};

