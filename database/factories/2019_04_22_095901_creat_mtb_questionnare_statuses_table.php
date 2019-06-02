<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatMtbQuestionnareStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('mtb_questionnare_statuses', function (Blueprint $table) {
           $table->Increments('id');
           $table->string('value');
           $table->integer('rank');
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('mtb_questionnare_statuses');
    }
}
