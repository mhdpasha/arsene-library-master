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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('kategori_id');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->text('deskripsi');
            $table->text('image')->nullable()->default('https://cdn3d.iconscout.com/3d/premium/thumb/book-5596349-4665465.png');
            $table->text('uuid');
            $table->integer('stok')->nullable()->default(5);
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
        Schema::dropIfExists('bukus');
    }
};
