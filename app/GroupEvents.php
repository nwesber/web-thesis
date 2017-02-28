<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;
use DateTime;

class GroupEvents extends Model
{
	use SoftDeletes;
  	protected $dates = ['deleted_at'];
    public $table = "group_events";


    public static function getGroupEvents($id){
    $events = DB::table('group_events')
    ->where('user_id', '=', \Auth::user()->id)
    ->where('group_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

  public static function saveGroupEvent($request, $id, $id2){
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

    $group_event = new GroupEvents;
    $group_event->event_title =  $request->eventTitle;
    $group_event->event_description =  $request->eventDesc;
    $group_event->user_id = $id;
    $group_event->group_id = $id2;
    $group_event->location = $request->eventLocation;
    $group_event->full_day = $allDay;
    $group_event->time_start = $time_start;
    $group_event->time_end = $time_end;
    $group_event->color = $request->eventColor;
    $group_event->save();
    return $group_event;
  }

  public static function updateGroupEvent($request, $id, $event){
    $allDay = false;
    $start = "";
    $end = "";


    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }


    if($request->eventStartDate == null && $request->eventEndDate == null){
      $start = $request->oldStart;
      $end = $request->oldEnd;
    }else{
      $start = $request->eventStartDate;
      $end = $request->eventEndDate;
    }

    $time_start = new DateTime($start);
    $time_end = new DateTime($end);
    $query = GroupEvents::where('user_id', $id)
      ->where('id', $event)
      ->update([
        'event_title' => $request->eventTitle,
        'event_description' => $request->eventDesc,
        'full_day' =>  $allDay,
        'time_start' =>  $time_start,
        'time_end' => $time_end,
        'color' => $request->eventColor,
        'location' => $request->eventLocation,
      ]);
  }

  public static function deleteGroupEvent($id){
    $query = GroupEvents::where('id', $id)->delete();
    return $query;
  }
}
