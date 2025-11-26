<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('jumlah')->default(0);
            $table->string('satuan')->nullable();
            $table->integer('kondisi_bagus')->default(0);
            $table->integer('kondisi_rusak')->default(0);
            $table->integer('total')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
