<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
use App\Questionnaire;

class QuestionController extends Controller
{
  public function add(Request $request)
  {

        $questionnaire = Questionnaire::find($request->questionnaire_id);

        $question = new Question();

        if($request->mtb_question_type_id==1 || $request->mtb_question_type_id==2 || $request->mtb_question_type_id==3)
         {
                $question->questionnaire_id = $request->questionnaire_id;
                $question->question = $request->question;
                $question->number = $request->number;
                $question->mtb_question_type_id = $request->mtb_question_type_id;
                $question->must_flg = $request->must_flg;
                $question->others_flg = $request->others_flg;

                $question->save();

                foreach ($request->choice as $key => $one_choice) {

                  $choice = new Choice();

                  $choice->question_id = $question->id;
                  $choice->choice = $one_choice;
                  $choice->number = ($key+1);
                  $choice->save();

                }

                if($request->others_flg)
                {
                  $choice = new Choice();
                  $choice->question_id = $question->id;
                  $choice->choice = "その他";
                  $choice->number = count($request->choice)+1;
                  $choice->save();

                }


        } else {

            $question->questionnaire_id = $request->questionnaire_id;
            $question->question = $request->question;
            $question->number = $request->number;
            $question->mtb_question_type_id = $request->mtb_question_type_id;
            $question->must_flg = $request->must_flg;

            $question->limited_words_number = $request->limited_words_number;


            $question->save();


          }

          return redirect()->route('get_questionnaire_detail', array('id' => $request->questionnaire_id));
  }


        public function edit(Request $request, $id, $type="default", $questionId,
         $action)
        {
          if($request->isMethod("get")) {

            $question = Question::find($questionId);
            $questionnaire = Questionnaire::find($id);

            return view('questionnaire.detail', array( "questionnaire" => $questionnaire, "type" => $type, "question" => $question, 'action' => $action));
        } else {

              $question = Question::find($questionId);
              $questionnaire = Questionnaire::find($id);


              if($request->mtb_question_type_id==1 || $request->mtb_question_type_id==2 || $request->mtb_question_type_id==3)
              {

                  $question->questionnaire_id = $request->questionnaire_id;
                  $question->question = $request->question;
                  $question->number = $request->number;
                  $question->must_flg = $request->must_flg;
                  $question->others_flg = $request->others_flg;

                  $question->limited_words_number = $request->limited_words_number;

                  $question->save();

                  foreach($question->choices as $one_choice_old)
                  {
                    $one_choice_old->delete();
                  }

                  foreach($request->choice as $key => $once_choice_new)
                  {

                    $choice = new Choice();
                    $choice->question_id = $question->id;
                    $choice->choice = $once_choice_new;
                    $choice->number = ($key+1);
                    $choice->save();
                  }

                  if($request->others_flg)
                  {
                    $choice = new Choice();
                    $choice->question_id = $question->id;
                    $choice->choice = "その他";
                    $choice->number = count($request->choice)+1;
                    $choice->save();

                  }
                  
                  return view('questionnaire.detail', array( "questionnaire" => $questionnaire, "type" => $type, "question" => $question, 'action' => 'default'));

          } else {

              $question->questionnaire_id = $request->questionnaire_id;
              $question->question = $request->question;
              $question->number = $request->number;
              $question->mtb_question_type_id = $request->mtb_question_type_id;
              $question->must_flg = $request->must_flg;
              $question->limited_words_number = $request->limited_words_number;


              $question->save();

              return view('questionnaire.detail', array( "questionnaire" => $questionnaire, "question" => $question));

            }


        }
      }


        public function delete(Request $request, $id, $type="default", $questionId, $action)
        {
          $question = Question::find($questionId);
          $question->delete();
          $questionnaire = Questionnaire::find($id);
          return view('questionnaire.detail', array( "questionnaire" => $questionnaire, "type" => $type, "action"=>$action));



        }
}
