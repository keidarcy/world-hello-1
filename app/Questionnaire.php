<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Questionnaire extends Model
{

    protected $table = "questionnaires";

    use SoftDeletes;

    // public function questions() {
    //   return $this->hasMany("App/Question", "questionnaire_id")->orderby("number");
    // }

      public function user()
    {
      return $this->belongsTo("App\User", "user_id");
    }

      public function questions()
    {
      return $this->hasMany("App\Question", "questionnaire_id")->orderBy('number');
    }

      public function answers()
    {
      return $this->hasManyThrough(
        "App\Answer",
        "App\Question",
        "questionnaire_id",
        "question_id",
        'id',
        'id');
    }

      public function count_max_people()
    {


        $question_id = [];
        foreach($this->answers as $answer)
        {
          $question_id[] = $answer['question_id'];
        }
        $number_max_people = array_count_values($question_id);
        rsort($number_max_people);
        if(isset($number_max_people[0])) {
          return $number_max_people[0];
        } else {
          return 0;
        }
    }

      public function count_people_for_multi()
      {
        foreach($this->questions as $question)
        {
          if($question->mtb_question_type_id==1)
          {
            $answer_p = [];
            foreach($question->answers as $answer)
            {
                  $answer_p[] = $answer['answer'];

            }
            extract($answer_p, EXTR_PREFIX_ALL, "answer");

            $answer_0 = $answer_0 ?? null ;
            $a = explode("," , $answer_0);

            $answer_1 = $answer_1 ?? null ;
            $b = explode("," , $answer_1);

            $answer_2 = $answer_2 ?? null ;
            $c = explode("," , $answer_2);

            $answer_3 = $answer_3 ?? null ;
            $d = explode("," , $answer_3);

            $answer_4 = $answer_4 ?? null ;
            $e = explode("," , $answer_4);

            $answer_5 = $answer_5 ?? null ;
            $f = explode("," , $answer_5);

            $g = array_merge($a, $b, $c, $d, $e, $f);
            $number_people = array_count_values($g);
            return $number_people;
          }
        }
      }

      public function count_people_for_single()
      {
        foreach($this->questions as $question)
        {
          if($question->mtb_question_type_id==2)
          {
              $answer_people = [];

                foreach($question->answers as $answer)
                {

                      $answer_people[] = $answer['answer'];

                }
              $number_people = array_count_values($answer_people);
              return $number_people;
          }
        }
      }

      public function count_people_for_select()
      {
        foreach($this->questions as $question)
        {
          if($question->mtb_question_type_id==3)
          {
              $answer_people = [];

                foreach($question->answers as $answer)
                {

                      $answer_people[] = $answer['answer'];

                }
              $number_people = array_count_values($answer_people);
              return $number_people;
          }
        }
      }



      public function time_to_finish($time)
      {
          $diff = date_diff(date_create(date("Y-m-d H:i:s")),date_create($time));
          $month = $diff->m;
          $day = $diff->d;
          $hour = $diff->h;
          $minute = $diff->i;
          $second = $diff->s;

          if($month >1){
            return $month.'月'.$day.'日'.$hour.'時'.$minute.'分'.$second.'秒';
          } elseif($day > 1){
            return $day.'日'.$hour.'時'.$minute.'分'.$second.'秒';
          } elseif ($hour > 1){
            return $hour.'時'.$minute.'分'.$second.'秒';
          }elseif($minute > 1){
            return $minute.'分'.$second.'秒';
          }elseif($second > 1){
            return $second.'秒';
          }else {
            return "今";
          }

      }









}
