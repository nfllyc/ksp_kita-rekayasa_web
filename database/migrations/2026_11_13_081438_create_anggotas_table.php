<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()
                  ->constrained('users')->cascadeOnDelete();
            $table->string('nomor_anggota')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('telepon', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};