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

  /* return all events in the event view */
  public static function getEvents($id){
    $events = DB::table('events')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

  /*  save normal event */
  public static function saveEvent($request, $id){
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $time_start = new DateTime( $dateStart . 'T' . $timeStart);
    $time_end = new DateTime($dateEnd . 'T' . $timeEnd);
    $allDay = false;

    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }

    $event = new Events;
    $event->event_title =  $request->eventTitle;
    $event->event_description =  $request->eventDesc;
    $event->user_id = $id;
    $event->location = $request->eventLocation;
    $event->full_day = $allDay;
    $event->time_start = $time_start;
    $event->time_end = $time_end;
    $event->color = $request->eventColor;
    $event->is_shared = $request->shared;
    $event->save();
    return $event;
  }

  /*  Update Event base on Event ID */
  public static function updateEvent($request, $id, $event){
    $allDay = false;
    $start = "";
    $end = "";

    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));

    $time_start = new DateTime($dateStart . 'T' . $timeStart);
    $time_end = new DateTime($dateEnd . 'T' . $timeEnd);

    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }


/*    if($request->eventStartDate == null && !$request->eventEndDate == null){
      $start = $request->oldStart;
      $end = $request->eventEndDate;
    }else if(!$request->eventStartDate == null && $request->eventEndDate == null){
      $start = $request->eventStartDate;
      $end = $request->oldEnd;
    }else if($request->eventStartDate == null && $request->eventEndDate == null){
      $start = $request->oldStart;
      $end = $request->oldEnd;
    }else{
      $start = $request->eventStartDate;
      $end = $request->eventEndDate;
    }

    $time_start = new DateTime($start);
    $time_end = new DateTime($end);*/
    $query = Events::where('user_id', $id)
      ->where('id', $event)
      ->update([
        'event_title' => $request->eventTitle,
        'event_description' => $request->eventDesc,
        'full_day' =>  $allDay,
        'time_start' =>  $time_start,
        'time_end' => $time_end,
        'color' => $request->eventColor,
        'location' => $request->eventLocation,
        'is_shared' => $request->shared,

      ]);
  }

  /* Delete Event Base on ID */
  public static function deleteEvent($id){
    $query = Events::where('id', $id)->delete();
    return $query;
  }

}
