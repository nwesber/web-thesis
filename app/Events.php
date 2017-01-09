<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Events extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "events";

  protected $fillable = [
    'event_title',
    'event_description',
    'color',
    'user_id',
    'full_day',
    'time_start',
    'time_end'
  ];

  public static function getEvents($id){
    $events = DB::table('events')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }
}
