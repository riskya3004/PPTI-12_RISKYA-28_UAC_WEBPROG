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
        Schema::create('field_of_works', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Kolom untuk menyimpan nama bidang pekerjaan
            $table->text('description')->nullable(); // Kolom untuk menyimpan deskripsi bidang pekerjaan (boleh kosong)
            $table->string('salary_range')->nullable(); // Kolom untuk menyimpan rentang gaji bidang pekerjaan (boleh kosong)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_of_works');
    }
};
