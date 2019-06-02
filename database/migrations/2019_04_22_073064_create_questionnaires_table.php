<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('picture')->nullable();
            $table->unsignedInteger("mtb_questionnare_status_id");
            $table->foreign('mtb_questionnare_status_id')->references('id')->on('mtb_questionnare_statuses');
            $table->string('password')->nullable();
            $table->dateTime('editing_start_time');
            $table->dateTime('answering_start_time')->nullable();
            $table->dateTime('answering_end_time')->nullable();

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
        Schema::dropIfExists('questionnaires');
    }
}
