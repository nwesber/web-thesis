<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SharedEvent extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "shared_events";

  protected $fillable = [
    'event_title',
    'event_description',
    'color',
    'group_id',
    'user_id',
    'full_day',
    'time_start',
    'time_end'
  ];

  public static function getSharedEvents($id){
    $shared_events = DB::table('shared_events')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $shared_events;
  }
}
