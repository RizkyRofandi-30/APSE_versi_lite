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
        Schema::create('perpanjangan_healthygate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_healthygate')->constrained('izin_healthygates')->onDelete('cascade');
            $table->string('izin_usaha_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangan_healthygate');
    }
};
