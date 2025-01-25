<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('penulis', 255);
            $table->string('penerbit', 255)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('isbn', 20)->unique()->nullable();
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia');
            $table->integer('stok')->default(0);
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}