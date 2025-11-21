<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_data_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftarans');
            $table->string('nik', 20);
            $table->string('nisn', 20);
            $table->string('nama', 120);
            $table->enum('jk', ['L', 'P']);
            $table->string('tmp_lahir', 60);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->char('village_id', 10)->nullable()->references('id')->on('villages');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_data_siswa');
    }
};