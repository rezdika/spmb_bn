<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran', 20);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('jurusan_id')->constrained('jurusans');
            $table->foreignId('gelombang_id')->constrained('gelombangs');
            $table->enum('status', ['DRAFT', 'SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID']);
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas']);
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->datetime('tanggal_verifikasi')->nullable();
            $table->string('user_verifikasi_adm', 100)->nullable();
            $table->string('user_verifikasi_payment', 100)->nullable();
            $table->datetime('tgl_verifikasi_payment')->nullable();
            $table->datetime('tanggal_daftar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};