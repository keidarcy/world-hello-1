<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Answer extends Model
{
  use SoftDeletes;

  protected $table = "answers";

  public function question() {

    return $this->belongsto("App\question", "question_id");
  }
}
