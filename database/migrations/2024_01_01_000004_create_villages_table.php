<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->char('id', 10)->primary();
            $table->char('district_id', 7);
            $table->string('name', 100);
            
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};