<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSynonymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synonyms', function (Blueprint $table) {
            $table->unsignedBigInteger('word_id');
            $table->unsignedBigInteger('synonym_id');
            $table->string('similarity', 100);

            $table->foreign('word_id')->references('id')->on('words')->cascadeOnDelete();
            $table->foreign('synonym_id')->references('id')->on('words')->cascadeOnDelete();

            $table->primary(['word_id', 'synonym_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synonyms');
    }
}
