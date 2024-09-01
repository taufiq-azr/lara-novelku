<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id('chapter_id');
            $table->unsignedBigInteger('novel_id');
            $table->string('title', 255);
            $table->text('content');
            $table->integer('chapter_number');
            $table->timestamps();

            $table->foreign('novel_id')->references('novel_id')->on('novels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
