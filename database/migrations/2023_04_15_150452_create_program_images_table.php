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
        Schema::create('program_images', function (Blueprint $table) {
            $table->id();
            $table->string('namafile');
            $table->string('mainImage');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->unsignedBigInteger('kabar_terbaru_id')->nullable();
            $table->foreign('kabar_terbaru_id')->references('id')->on('kabar_terbarus')->onDelete('cascade');
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
        Schema::dropIfExists('program_images');
    }
};
