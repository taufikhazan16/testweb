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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->integer('kapasitas_duduk');
            $table->string('warna');
            $table->string('nomor_plat');
            $table->string('bulan_plat');
            $table->integer('tahun_plat');
            $table->string('bahan_bakar');
            $table->unsignedBigInteger('merek_id');
            $table->string('model');
            $table->decimal('harga_sewa', 10, 2); // Harga sewa dalam decimal (jumlah digit total dan jumlah digit di belakang koma)
            $table->timestamps();

            // Menambahkan foreign key constraint
            // $table->foreign('merek_id')->references('id')->on('merek')->onDelete('cascade'); // assuming 'merek' is the name of the table containing car brands
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil');
    }
};
