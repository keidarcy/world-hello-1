<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("questionnaire_id");
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires');
            $table->string('question');
            $table->integer('number');
            $table->unsignedInteger("mtb_question_type_id");
            $table->foreign('mtb_question_type_id')->references('id')->on('mtb_question_types');
            $table->integer('limited_words_number')->nullable();
            $table->integer('must_flg')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
}
