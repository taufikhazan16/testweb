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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sewa_id');
            $table->date('tanggal_pengembalian');
            $table->integer('durasi_sewa_jam'); // Durasi sewa dalam jam
            $table->enum('status_sewa', ['selesai', 'ongoing'])->default('selesai'); // Status sewa: selesai atau ongoing
            $table->decimal('denda_sewa', 10, 2)->nullable();
            $table->decimal('total_sewa', 10, 2);
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('sewa_id')->references('id')->on('sewa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
};
