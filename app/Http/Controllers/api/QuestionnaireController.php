<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Questionnaire;



class QuestionnaireController extends Controller
{
    public function answer_number(Request $request, $id)
    {

      $questionnaires = Questionnaire::find($id);

      $question_id = [];
      $result = [];

      foreach($questionnaires->answers as $answer)
      {
        $question_id[] = $answer['question_id'];
      }
      $number_max_people = array_count_values($question_id);
      rsort($number_max_people);
      if(isset($number_max_people[0])) {
        $result['number'] = $number_max_people[0];
      } else {
        $result['number'] = 0;
      }
      return $result;
    }

    public function left_time($id)
    {
        $user = User::find($id);

        $left_time = [];

        foreach($user->questionnaires as $questionnaire)
        {

            $diff = date_diff(date_create(date("Y-m-d H:i:s")),date_create($questionnaire->answering_end_time));
            $month = $diff->m;
            $day = $diff->d;
            $hour = $diff->h;
            $minute = $diff->i;
            $second = $diff->s;


            if($month >1){
              $left_time[$questionnaire->id] = $month.'月'.$day.'日'.$hour.'時'.$minute.'分'.$second.'秒';
            } elseif($day > 1){
              $left_time[$questionnaire->id] = $day.'日'.$hour.'時'.$minute.'分'.$second.'秒';
            } elseif ($hour > 1){
              $left_time[$questionnaire->id] = $hour.'時'.$minute.'分'.$second.'秒';
            }elseif($minute > 1){
              $left_time[$questionnaire->id] = $minute.'分'.$second.'秒';
            }elseif($second > 1){
              $left_time[$questionnaire->id] = $second.'秒';
            }else {
              $left_time[$questionnaire->id] = "今";
            }

        }

        return $left_time;


    }
}
