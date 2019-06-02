<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Choice extends Model
{
  use SoftDeletes;
  
  protected $table = "choices";

  public function question() {

    return $this->belongsto("App\question","question_id");
  }
}
