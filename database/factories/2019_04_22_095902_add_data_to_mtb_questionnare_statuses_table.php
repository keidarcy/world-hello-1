<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToMtbQuestionnareStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert(
          "insert into mtb_questionnare_statuses (id, value, rank)
          values (:id, :value, :rank)",
          array(
            "id" => 1,
            "value" => "編集中",
            "rank" => 1
          )
        );

        DB::insert(
          "insert into mtb_questionnare_statuses (id, value, rank)
          values (:id, :value, :rank)",
          array(
            "id" => 2,
            "value" => "回答中",
            "rank" => 2
          )
        );

        DB::insert(
          "insert into mtb_questionnare_statuses (id, value, rank)
          values (:id, :value, :rank)",
          array(
            "id" => 3,
            "value" => "回答済",
            "rank" => 3
          )
        );
      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         DB::delete("delete from mtb_questionnare_statuses");
     }
}
