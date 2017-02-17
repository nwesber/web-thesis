<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;
use DateTime;



class Events extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "events";


  public static function getEvents($id){
    $events = DB::table('events')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

  public static function saveEvent($request, $id){
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $time_start = new DateTime( $dateStart . 'T' . $timeStart);
    $time_end = new DateTime($dateEnd . 'T' . $timeEnd);
    $event = new Events;
    $event->event_title =  $request->eventTitle;
    $event->event_description =  $request->eventDesc;
    $event->user_id = $id;
    $event->location = $request->eventLocation;
    $event->full_day = '0';
    $event->time_start = $time_start;
    $event->time_end = $time_end;
    $event->color = $request->eventColor;
    $event->is_shared = '0';
    $event->save();
    return $event;
  }


}
