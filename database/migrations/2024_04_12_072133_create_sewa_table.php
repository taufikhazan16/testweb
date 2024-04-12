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
        Schema::create('sewa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->date('tanggal_selesai');
            $table->decimal('biaya_sewa', 10, 2);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('pengguna_id');
            $table->string('status_sewa')->default('ongoing');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('mobil_id')->references('id')->on('mobil')->onDelete('cascade');
            // $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa');
    }
};
