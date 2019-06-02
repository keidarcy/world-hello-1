<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("hello", "HelloController@index");

Route::get("/questionnaire", "QuestionnaireController@index")->name('get_questionnaire_index')->middleware("auth");

Route::get("/questionnaire/add", "QuestionnaireController@add")->name('get_questionnaire_add')->middleware("auth");
Route::post("/questionnaire/add", "QuestionnaireController@add")->name('post_questionnaire_add')->middleware("auth");

Route::get("/questionnaire/{id}/edit", "QuestionnaireController@edit")->name('get_questionnaire_edit')->middleware("auth");
Route::post("/questionnaire/{id}/edit", "QuestionnaireController@edit")->name('post_questionnaire_edit')->middleware("auth");

Route::get("/questionnaire/{id}/remove_picture", "QuestionnaireController@remove_picture")->name('get_questionnaire_remove_picture')->middleware("auth");


Route::get("/questionnaire/{id}/delete", "QuestionnaireController@delete")->name('get_questionnaire_delete')->middleware("auth");
Route::post("/questionnaire/{id}/delete", "QuestionnaireController@delete")->name('post_questionnaire_delete')->middleware("auth");

Route::get("/questionnaire/{id}/detail/{type?}/{action?}", "QuestionnaireController@detail")->name("get_questionnaire_detail")->middleware("auth");

Route::post("/question/{action?}/add", "QuestionController@add")->name("post_question_add")->middleware("auth");

Route::get("/questionnaire/{id}/detail/{type?}/{questionId}/{action?}/delete", "QuestionController@delete")->name('get_question_delete')->middleware("auth");

Route::get("/questionnaire/{id}/detail/{type?}/{questionId}/{action?}/edit", "QuestionController@edit")->name('get_question_edit')->middleware("auth");
Route::post("/questionnaire/{id}/detail/{type?}/{questionId}/{action?}/edit", "QuestionController@edit")->name('post_question_edit')->middleware("auth");

Route::get("/questionnaire/{id}/show", "QuestionnaireController@show")->name("get_questionnaire_show");

Route::get("/questionnaire/{id}/open", "QuestionnaireController@open")->name("get_questionnaire_open");

Route::post("/answer/add", "AnswerController@add")->name('post_answer_add');

Route::get("/answer/add/{id}", "AnswerController@detail")->name('get_answer_detail');

Route::get("/questionnaire/{id}/input_password", "QuestionnaireController@input_password")->name('get_questionnaire_password');
Route::post("/questionnaire/{id}/input_password", "QuestionnaireController@input_password")->name('post_questionnaire_password');
