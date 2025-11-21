<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftar_berkas', function (Blueprint $table) {
            $table->dropColumn('valid');
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])->default('pending')->after('ukuran_kb');
            $table->text('catatan_panitia')->nullable()->after('catatan');
            $table->timestamp('verified_at')->nullable()->after('catatan_panitia');
            $table->foreignId('verified_by')->nullable()->constrained('users')->after('verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftar_berkas', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['status', 'catatan_panitia', 'verified_at', 'verified_by']);
            $table->tinyInteger('valid')->default(0)->after('ukuran_kb');
        });
    }
};