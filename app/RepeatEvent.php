<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class RepeatEvent extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "repeat_event";

  public static function getEvents($id){
    $events = DB::table('repeat_event')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

}
