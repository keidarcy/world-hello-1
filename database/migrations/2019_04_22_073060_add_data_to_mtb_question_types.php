<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDataToMtbQuestionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert(
            "insert into mtb_question_types (id, value, rank) values (:id, :value, :rank)", 
            array(
                "id" => 1,
                "value" => "マルチ問題",
                "rank" => 1
            )
        );

        DB::insert(
            "insert into mtb_question_types (id, value, rank) values (:id, :value, :rank)", 
            array(
                "id" => 2,
                "value" => "シングル問題",
                "rank" => 2
            )
        );

        DB::insert(
            "insert into mtb_question_types (id, value, rank) values (:id, :value, :rank)", 
            array(
                "id" => 3,
                "value" => "セレクト問題",
                "rank" => 3
            )
        );

        DB::insert(
            "insert into mtb_question_types (id, value, rank) values (:id, :value, :rank)", 
            array(
                "id" => 4,
                "value" => "ショット問題",
                "rank" => 4
            )
        );

        DB::insert(
            "insert into mtb_question_types (id, value, rank) values (:id, :value, :rank)", 
            array(
                "id" => 5,
                "value" => "ロング問題",
                "rank" => 5
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
        Schema::table('mtb_question_types', function (Blueprint $table) {
            //
        });
    }
}
