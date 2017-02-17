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

  public static function getEvents($id){
    $events = DB::table('repeat_event')
    ->where('user_id', '=', $id)
    ->whereNull('deleted_at');
    return $events;
  }

  public static function repeatYear($request, $id){
    $yearlyInterval = 'P1Y';
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));

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
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = '0';
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = '0';
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
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = '0';
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = '0';
            $event->save();
            break;
          }
        }
      }
    }



  }


  public static function repeatMonth($request, $id){
    $monthlyInterval = 'P1M';
    $dateStart = $request->eventStartDate;
    $dateEnd = $request->eventEndDate;
    $timeStart = date("Hi", strtotime($request->eventTimeStart));
    $timeEnd = date("Hi", strtotime($request->eventTimeEnd));
    if($request->has('endsOn')){
      $repeatOption = $request->endsOn;

      if($repeatOption == 'endsOn'){
        $endOn = $request->modalEnd;
        $result = RepeatEvent::yearlyRepeatOn($dateStart, $dateEnd, $endOn, $monthlyInterval);
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
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = '0';
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = '0';
            $event->save();
            break;
          }
        }

      }
      else{
        $result = RepeatEvent::yearlyRepeatNever($dateStart, $dateEnd, $monthlyInterval);
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
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = '0';
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = '0';
            $event->save();
            break;
          }
        }
      }
    }


  }

  public static function repeatWeek($request, $id){
    if($request->has('endsOn')){
      $repeatOption = $request->endsOn;

      if($repeatOption == 'endsOn'){
        $endOn = $request->modalEnd;
        $week = $request->weeklyRepeat;
        $result = RepeatEvent::weeklyRepeat($dateStart, $dateEnd, $endOn, $week);
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
            $event->user_id = $id;
            $event->location = $request->eventLocation;
            $event->full_day = '0';
            $event->time_start = $time_start;
            $event->time_end = $time_end;
            $event->color = $request->eventColor;
            $event->is_shared = '0';
            $event->save();
            break;
          }
        }
      }

      else{
        dd('never');
      }
    }
  }

  public function repeatNever($dateStart, $dateEnd, $dateInterval){
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

  public function weeklyRepeatNever($dateStart, $dateEnd, $week){
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
      if($start->format('N') == $week){
        $rangeStart[] = $start->format($format);
      }
    }

    foreach ($endDateRange as $end) {
      if($end->format('N') == $week){
        $rangeEnd[] = $end->format($format);
      }
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);

    return $range;

  }

  public function weeklyRepeat($dateStart, $dateEnd, $repeatOn, $week){
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
      if($start->format('N') == $week){
        $rangeStart[] = $start->format($format);
      }
    }

    foreach ($endDateRange as $end) {
      if($end->format('N') == $week){
        $rangeEnd[] = $end->format($format);
      }
    }

    $mergeRange = array_merge($rangeStart, $rangeEnd);
    $range = array_sort_recursive($mergeRange);

    return $range;
  }

}
