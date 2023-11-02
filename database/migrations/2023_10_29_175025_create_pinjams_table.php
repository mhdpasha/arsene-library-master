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
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained();
            $table->foreignId('user_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_setor')->nullable();
            $table->text('message')->nullable();
            $table->text('uuid')->nullable();
            $table->integer('denda')->nullable();
            $table->enum('status', ['accepted', 'rejected', 'returned'])->nullable();
            $table->boolean('history')->nullable();
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
        Schema::dropIfExists('pinjams');
    }
};
