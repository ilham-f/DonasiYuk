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
        Schema::create('pencairan_danas', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('tujuan');
            $table->dateTime('tglcair')->nullable();
            $table->string('bukti')->nullable();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
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
        Schema::dropIfExists('pencairan_danas');
    }
};
