<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use DateTime;
use DateInterval;
use DatePeriod;
class RepeatEvent extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "repeat_event";

  /* Get ALl Event  */
  public static function getEvents($id){
    $events = DB::table('repeat_event')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

  /*  Repeat An Event Yearly */
  public static function repeatYear($request, $id){
    $yearlyInterval = 'P1Y';
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $allDay = false;

    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }


    if($request->has('endsOn')){
      $repeatOption = $request->endsOn;

      if($repeatOption == 'endsOn'){
        $endOn = $request->modalEnd;
        $format = "Y-m-d";
        $result = RepeatEvent::repeatOn($dateStart, $dateEnd, $endOn, $yearlyInterval);
        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'year';
            $event->ends_on = $endOn;
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }

      }

      else{
        $result = RepeatEvent::repeatNever($dateStart, $dateEnd, $yearlyInterval);
        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'year';
            $event->ends_on = '2051-01-01';
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }
      }
    }
  }

  /*  Update Repeat Event */
  public static function updateRepeat($request, $repeatId, $id){

    $repeat = RepeatEvent::where([
      ['user_id' , '=', $id],
      ['repeat_id' , '=', $repeatId]
    ])->take(1)->get();

    foreach ($repeat as $rep) {
      switch($rep->repeat_type){
        case 'month':
          $monthlyInterval = 'P1M';
          $type = 'month';
          RepeatEvent::updateRepeatEvent($monthlyInterval, $request, $id, $type, $rep);
          RepeatEvent::destroyEvent($repeatId, $id);
        break;
        case 'year':
          $yearlyInterval = 'P1Y';
          $type = 'year';
          RepeatEvent::updateRepeatEvent($yearlyInterval, $request, $id, $type, $rep);
          RepeatEvent::destroyEvent($repeatId, $id);
        break;
        case 'week':
          $type = 'year';
          RepeatEvent::updateWeeklyRepeatEvent($request, $id, $rep, $type);
          RepeatEvent::destroyEvent($repeatId, $id);
        break;
      }
    }
  }

  /*  Update Weekly Event */

  public static function updateWeeklyRepeatEvent($request, $id, $rep, $type){
    $endOn = $rep->ends_on;
    $timestampStart = strtotime( $request->eventStartDate );
    $timestampEnd = strtotime( $request->eventEndDate );
    $userWeekStart = $dw = date( "w", $timestampStart );
    $userWeekEnd = $dw = date( "w", $timestampEnd );
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $allDay = false;

    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }

    $result = RepeatEvent::weeklyRepeat($dateStart, $dateEnd, $endOn, $userWeekStart, $userWeekEnd);
    $newarray = array_chunk($result, 2);
    $repeatId = random_int(0,1000);
    foreach($newarray as $arr){
      foreach($arr as $a){
        $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
        $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
        $event = new RepeatEvent;
        $event->event_title =  $request->eventTitle;
        $event->event_description =  $request->eventDesc;
        $event->repeat_id = $repeatId;
        $event->repeat_type = 'week';
        $event->ends_on = $endOn;
        $event->user_id = $id;
        $event->location = $request->eventLocation;
        $event->full_day = $allDay;
        $event->time_start = $time_start;
        $event->time_end = $time_end;
        $event->color = $request->eventColor;
        $event->is_shared = $request->shared;
        $event->save();
        break;
      }
    }

  }

  /*  Update Event */
  public static function updateRepeatEvent($interval, $request, $id, $type, $rep){
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $endOn = $rep->ends_on;
    if($endOn = '2051-01-01'){
      $result = RepeatEvent::repeatNever($dateStart, $dateEnd, $interval);
    }else{
      $result = RepeatEvent::repeatOn($dateStart, $dateEnd, $endOn, $interval);
    }
    $newarray = array_chunk($result, 2);
    $repid = random_int(0,1000);
    $allDay = false;
    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }

    foreach($newarray as $arr){
      foreach($arr as $a){
        $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
        $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
        $event = new RepeatEvent;
        $event->event_title =  $request->eventTitle;
        $event->event_description =  $request->eventDesc;
        $event->repeat_id = $repid;
        $event->repeat_type = $type;
        $event->ends_on = $endOn;
        $event->user_id = $id;
        $event->location = $request->eventLocation;
        $event->full_day = $allDay;
        $event->time_start = $time_start;
        $event->time_end = $time_end;
        $event->color = $request->eventColor;
        $event->is_shared = $request->shared;
        $event->save();
        break;
      }
    }
  }


  /*  Create Monthly Event */
  public static function repeatMonth($request, $id){
    $monthlyInterval = 'P1M';
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));

    $allDay = false;

    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }

    if($request->has('endsOn')){
      $repeatOption = $request->endsOn;

      if($repeatOption == 'endsOn'){
        $endOn = $request->modalEnd;
        $result = RepeatEvent::repeatOn($dateStart, $dateEnd, $endOn, $monthlyInterval);
        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'month';
            $event->ends_on = $endOn;
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }

      }
      else{
        $result = RepeatEvent::repeatNever($dateStart, $dateEnd, $monthlyInterval);
        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        /* ===== Looping Dates ===== */
        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'month';
            $$event->ends_on = '2051-01-01';
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }
      }
    }
  }


  /*  Create Weekly Event */
  public static function repeatWeek($request, $id, $userWeekStart, $userWeekEnd){
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    $allDay = false;



    if($request->has('allDay')){
      $allDay = true;
    }else{
      $allDay = false;
    }
    if($request->has('endsOn')){
      $repeatOption = $request->endsOn;

      if($repeatOption == 'endsOn'){
        $endOn = $request->modalEnd;
        $week = $request->weeklyRepeat;
        $result = RepeatEvent::weeklyRepeat($dateStart, $dateEnd, $endOn, $userWeekStart, $userWeekEnd);

        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        /* ===== Looping Dates ===== */
        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'week';
            $event->ends_on = $endOn;
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }
      }

      else{
        $week = $request->weeklyRepeat;
        $result = RepeatEvent::weeklyRepeatNever($dateStart, $dateEnd, $userWeekStart, $userWeekEnd);
        $newarray = array_chunk($result, 2);
        $repeatId = random_int(0,1000);

        /* ===== Looping Dates ===== */
        foreach($newarray as $arr){
          foreach($arr as $a){
            $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
            $time_end = new DateTime(end($arr) . 'T' . $timeEnd);
            $event = new RepeatEvent;
            $event->event_title =  $request->eventTitle;
            $event->event_description =  $request->eventDesc;
            $event->repeat_id = $repeatId;
            $event->repeat_type = 'week';
            $$event->ends_on = '2051-01-01';
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = $allDay;
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = $request->shared;
            $event->save();
            break;
          }
        }

      }
    }
  }

  /*  Repeat Never Ends on 2051 */
  public static function repeatNever($dateStart, $dateEnd, $dateInterval){
    $rangeStart = [];
    $rangeEnd = [];
    $mergeRange = [];
    $range = [];

    $format = "Y-m-d";
    $start = new DateTime($dateStart);
    $end = new DateTime($dateEnd);
    $maxDate = new DateTime('2051-01-01');
    $interval = new DateInterval($dateInterval); // 1 year
    $dateRangeStart = new DatePeriod($start, $interval, $maxDate);
    $dateRangeEnd = new DatePeriod($end, $interval, $maxDate);

    foreach ($dateRangeStart as $date) {
      $rangeStart[] = $date->format($format);
    }

    foreach ($dateRangeEnd as $date) {
      $rangeEnd[] = $date->format($format);
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);
    return $range;
  }

  /*  Repeat On Function  */
  public static function repeatOn($dateStart, $dateEnd, $repeatOn, $dateInterval){
    $rangeStart = [];
    $rangeEnd = [];
    $mergeRange = [];
    $range = [];

    $format = "Y-m-d";
    $startDate = new DateTime($dateStart);
    $endDate = new DateTime($dateEnd);
    $maxDate = new DateTime($repeatOn);

    $interval = new DateInterval($dateInterval); // 1 year
    $startDateRange = new DatePeriod($startDate, $interval, $maxDate);
    $endDateRange = new DatePeriod($endDate, $interval, $maxDate);

    foreach ($startDateRange as $start) {
      $rangeStart[] = $start->format($format);
    }

    foreach ($endDateRange as $end) {
      $rangeEnd[] = $end->format($format);
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);

    return $range;
  }

  /* Weekly Repeat Never Ends on 2051 */
  public static function weeklyRepeatNever($dateStart, $dateEnd, $userWeekStart, $userWeekEnd){
    $rangeStart = [];
    $rangeEnd = [];
    $mergeRange = [];
    $range = [];

    $format = "Y-m-d";
    $interval = new DateInterval('P1W'); // 1 Day
    $startDate = new DateTime($dateStart);
    $endDate = new DateTime($dateEnd);
    $maxDate = new DateTime('2051-01-01');
    $startDateRange = new DatePeriod($startDate, $interval, $maxDate);
    $endDateRange = new DatePeriod($endDate, $interval, $maxDate);


    foreach ($startDateRange as $start) {
      if($start->format('N') == $userWeekStart){
        $rangeStart[] = $start->format($format);
      }
    }

    foreach ($endDateRange as $end) {
      if($end->format('N') == $userWeekEnd){
        $rangeEnd[] = $end->format($format);
      }
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);

    return $range;

  }

  /* Weekly Repeat Never Ends on 2051 */
  public static function weeklyRepeat($dateStart, $dateEnd, $repeatOn, $userWeekStart, $userWeekEnd){
    $rangeStart = [];
    $rangeEnd = [];
    $mergeRange = [];
    $range = [];

    $format = "Y-m-d";
    $interval = new DateInterval('P1W'); // 1 Day
    $startDate = new DateTime($dateStart);
    $endDate = new DateTime($dateEnd);
    $maxDate = new DateTime($repeatOn);
    $startDateRange = new DatePeriod($startDate, $interval, $maxDate);
    $endDateRange = new DatePeriod($endDate, $interval, $maxDate);

    foreach ($startDateRange as $start) {
      if($start->format('N') == $userWeekStart){
        $rangeStart[] = $start->format($format);
      }
    }

    foreach ($endDateRange as $end) {
      if($end->format('N') == $userWeekEnd){
        $rangeEnd[] = $end->format($format);
      }
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);

    return $range;
  }

  /* Destroy Weekly Event */
  public static function destroyEvent($repeatId, $userId){
    $query = RepeatEvent::where('user_id', $userId)->where('repeat_id', $repeatId)->delete();
    return $query;
  }

}
