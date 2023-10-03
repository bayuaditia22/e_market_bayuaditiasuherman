<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang',500);
            $table->unsignedBigInteger('produk_id');
            $table->string('nama_barang',500);
            $table->string('satuan',500);
            $table->double('harga_jual');
            $table->string('stok',500);
            $table->integer('ditarik');
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
