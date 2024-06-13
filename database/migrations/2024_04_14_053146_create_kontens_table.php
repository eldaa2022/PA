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
        Schema::create('kontens', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis_konten');
            $table->string('deskripsi');
            $table->string('tags');
            $table->boolean('status');
            $table->date('tggl_publish');
            $table->string('lampiran');
            $table->timestamps();
            $table->unsignedBigInteger('admin_id');   // foreign key dari tabel admin

            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontens');
    }
};
