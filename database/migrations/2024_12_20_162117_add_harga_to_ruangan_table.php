<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->decimal('harga', 10, 2)->after('kapasitas_ruangan');
        });
    }

    public function down() {
        Schema::table('ruangan', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }

};
