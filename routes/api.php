<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/questionnaire/{id}/answer_number", "api\QuestionnaireController@answer_number")->name('get_questionnaire_answer_number');

Route::get("/user/{id}/left_time", "api\QuestionnaireController@left_time")->name('get_questionnaire_left_time');
