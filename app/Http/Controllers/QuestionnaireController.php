<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\questionnaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;



class QuestionnaireController extends Controller
{
      public function index(Request $request)
      {
          $questionnaires = questionnaire::get();
          return view("questionnaire.index", array(
            "questionnaires"=> $questionnaires
          ));
      }

      public function add(Request $request)
      {
        if($request->isMethod("get"))
        {
          return view("questionnaire.add");
        } else
        {
          $validation_rules = array(
              "title" => "required|max:255",
              "answering_end_time" => "required|after_or_equal:".now(),
              "password_input" => 'nullable|alpha_num'
          );

          $validation_messages = array(
              "title.required" => "タイトルを入力してください。",
              "title.max" => "最大255文字入力してください。",
              "answering_end_time.required" => "終了時間を入力してください。",
              "answering_end_time.after_or_equal" => "本日以降を指定してください。",
              "password_input.alpha_num" => "英文字と数字だけ入力してください。"
          );

          $this->validate($request, $validation_rules, $validation_messages);

          $user = Auth::user();


          $questionnaire = new questionnaire();
          $questionnaire->user_id = $user->id;

          if($request->file('picture')){
              $path = $request->file('picture')->store('public/questionnaires');
              $questionnaire->picture = str_replace("public", "storage", $path);
          }

          $questionnaire->mtb_questionnaire_status_id = 1;
          $questionnaire->editing_start_time = date("Y-m-d H:i:s");
          $questionnaire->title = $request->title;
          $questionnaire->answering_end_time = $request->answering_end_time;
          $questionnaire->password = $request->password_input;
          $questionnaire->save();

          return redirect()->route("get_questionnaire_index");
        }
      }


      public function edit(Request $request, $id)
      {
          if($request->isMethod("get")) {
              $questionnaire = Questionnaire::find($id);
              return view('questionnaire.edit', ["questionnaire" => $questionnaire]);
          } else {

            $validation_rules = array(
                "title" => "required|max:255",
                "answering_end_time" => "required|after_or_equal:".now(),
                "password_input" => 'nullable|alpha_num'
            );

            $validation_messages = array(
                "title.required" => "タイトルを入力してください。",
                "title.max" => "最大255文字入力してください。",
                "answering_end_time.required" => "終了時間を入力してください。",
                "answering_end_time.after_or_equal" => "本日以降を指定してください。",
                "password_input.alpha_num" => "英文字と数字だけ入力してください。"
            );

            $validator = Validator::make($request->all(),$validation_rules, $validation_messages);

            if($validator->fails()) {
                return redirect()->to(route("get_questionnaire_edit", array("id" => $id)))->withErrors($validator)->withInput();
            }


            $questionnaire = Questionnaire::find($id);

            $questionnaire->title = $request->title;
            $questionnaire->answering_end_time = $request->answering_end_time;
            $questionnaire->password = $request->password_input;
            $questionnaire->random_flg = $request->random_question;

            if($request->file("picture")) {
                $path = $request->file('picture')->store('public/questionnaires');
                $questionnaire->picture = str_replace("public", "storage", $path);
            }

            $questionnaire->save();

            return redirect()->to(route("get_questionnaire_index"));

          }
      }

      public function remove_picture(Request $request, $id)
      {
              $questionnaire = Questionnaire::find($id);
              $questionnaire->picture = null;
              $questionnaire->save();
              return view('questionnaire.edit', ["questionnaire" => $questionnaire]);

      }


      public function delete(Request $request, $id)
      {
          if($request->isMethod("get")) {
              $questionnaire = Questionnaire::find($id);
              return view('questionnaire.delete', ["questionnaire" => $questionnaire]);
          } else {
              $questionnaire = Questionnaire::find($id);
              $questionnaire->delete();
              return redirect()->route("get_questionnaire_index");
          }

      }

      public function detail(Request $request, $id, $type="default", $action="default")
      {
        $questionnaire = Questionnaire::find($id);
        return view('questionnaire.detail', array( "questionnaire" => $questionnaire, "type" => $type, "action"=>$action));
      }

      public function show(Request $request, $id)
      {
          $questionnaire = Questionnaire::find($id);
          $questionnaire->mtb_questionnaire_status_id = 2;
          $questionnaire->answering_start_time = date('Y-m-d H:i:s');
          $questionnaire->save();
          return redirect()->route('get_questionnaire_index',['questionnaire'=>$questionnaire]);
      }

      public function open(Request $request, $id)
      {
          $questionnaire = Questionnaire::find($id);

            if($questionnaire->password)
            {
              if($request->session()->get('questionnaire_id')&&
                 $request->session()->get('questionnaire_id')==$questionnaire->id)
                 {
                   return view('questionnaire.questionnaire_open', ["questionnaire" => $questionnaire]);
                 }
              return redirect()->route('get_questionnaire_password', ['id'=>$id]);
            }
      }

      public function input_password(Request $request, $id)
      {

          $questionnaire = Questionnaire::find($id);

              if(!$questionnaire)
              {
                abort(404);
              }

              if(!$questionnaire->password)
              {
                abort(404);
              }

              if($request->isMethod('post'))
              {
                if($request->input_password == $questionnaire->password)
                { 
                  $request->session()->put('questionnaire_id',$questionnaire->id);
                  return redirect()->route('get_questionnaire_open',['id'=>$id]);
                }
              }
              return view('questionnaire.input_password', ['id' => $id]);

      }




}
