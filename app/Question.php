<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = "questions";

    public function choices() {
      return $this->hasMany("App\Choice", "question_id");
    }

    public function questionnaire() {

      return $this->belongsto("App\questionnaire", "questionnaire_id");
    }

    public function answers() {
      return $this->hasMany("App\Answer", "question_id");
    }



}
