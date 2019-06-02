<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\Answer;

class AnswerController extends Controller
{
    public function add(Request $request)
    {

          $questionnaire = Questionnaire::find($request->questionnaire_id);
          foreach($questionnaire->questions as $question)
          {
            $question_id = $question->id;

            $answer = new Answer;



          if($question->mtb_question_type_id == 1)
          {
              if(is_array($request->input($question_id)))
              {

                  $question->other_answer = $request->answer_for_multi;
                  $question->save();

                  $choice_answers = [];

                  foreach($request->input($question_id) as $choice_answer)
                  {
                      $choice_answers[] = $choice_answer;

                  }
                  $answer_for_multi = implode(",",$choice_answers);

                  $answer->question_id = $question_id;
                  $answer->answer = $answer_for_multi;
                  $answer->submitted_time = date('Y-m-d H:i:s');
                  $answer->save();


              }
          }

          if($question->mtb_question_type_id == 2)
          {
                  $question->other_answer = $request->answer_for_single;
                  $question->save();
                  
                  $answer->question_id = $question_id;
                  $answer->answer = $request->input($question_id);
                  $answer->submitted_time = date('Y-m-d H:i:s');
                  $answer->save();



          }

          if($question->mtb_question_type_id == 3)
          {
              $answer->question_id = $question_id;
              $answer->answer = $request->input($question_id);
              $answer->submitted_time = date('Y-m-d H:i:s');
              $answer->save();
          }

          if($question->mtb_question_type_id == 4)
          {
              $answer->question_id = $question_id;
              $answer->answer = $request->input($question_id);
              $answer->submitted_time = date('Y-m-d H:i:s');
              $answer->save();
          }

          if($question->mtb_question_type_id == 5)
          {
              $answer->question_id = $question_id;
              $answer->answer = $request->input($question_id);
              $answer->submitted_time = date('Y-m-d H:i:s');
              $answer->save();
          }
        }

        if($request->session()->get('questionnaire_id'))
        {
            $request->session()->forget('questionnaire_id');
        }

        return view('questionnaire.thanks');

    }

    public function detail(Request $request, $id)
    {

      $questionnaire = Questionnaire::find($id);
      $questions = $questionnaire->questions;

      return view('questionnaire.result', ['questionnaire'=>$questionnaire, 'questions'=>$questions]);

    }
}
