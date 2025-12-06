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
        Schema::create('perpanjangan_medlicense', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_medlicense')->constrained('izin_medlicenses')->onDelete('cascade');
            $table->string('izin_profesi_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangan_medlicense');
    }
};
