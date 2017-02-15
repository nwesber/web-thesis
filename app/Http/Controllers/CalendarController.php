<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Requests;
use App\Events;
use DateTime;
use Calendar;
use DB;
use DateInterval;
use DatePeriod;
use Crypt;

class CalendarController extends Controller
{
	public function index(){
	  $eventCollection = [];

	  $userid = \Auth::user()->id;

	  $events = Events::getEvents($userid)->get();
	  $holidays = DB::table('holidays')->get();

	  foreach ($events as $event) {
			$eventCollection[] = Calendar::event(
		    $event->event_title,
		    false,
		    $event->time_start,
		    $event->time_end,
		    $event->id,

		    [

	        'url' => 'event/'. Crypt::encrypt($event->id) ,
	        'color' => $event->color,
    		]
			);
		}

	  foreach ($holidays as $holiday) {
			$eventCollection[] = Calendar::event(
		    $holiday->event_title,
		    true,
		    $holiday->time_start,
		    $holiday->time_end,
		    $holiday->id,

		    [
	        'color' => $holiday->color,
    		]
			);
		}

		$calendar = Calendar::addEvents($eventCollection);
		return view('events.event', compact('calendar'));
	}

	public function create(){
		return view('events.create');
	}

	public function show($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
      $event = Events::findOrFail($cryptEvent);
		}catch(DecryptException $e){
			return view('errors.404');
		}
		return view('events.show', compact('event'));
	}

	public function store(Request $request){
		/* P1Y = 1 year , P1M = 1 Month , PT1M = 1 minute , P1W = 1 Week */

		$userId = \Auth::user()->id;
		$dateStart = $request->eventStartDate;
		$dateEnd = $request->eventEndDate;
		$timeStart = date("Hi", strtotime($request->eventTimeStart));
		$timeEnd = date("Hi", strtotime($request->eventTimeEnd));

	  if($request->has('endsNever')){
	  	$result = $this->yearlyRepeatNever($dateStart);
	  	dd($result);
	  }else if($request->has('endsAfter')){
	  	$occurences = $request->occurrences;
	  	$result = $this->yearlyOccurences($occurences, $dateStart);
	  	dd($result);
	  }else if($request->has('endsOn')){
	  	$endOn = $request->modalEnd;
	  	$result = $this->yearlyRepeatOn($dateStart, $dateEnd, $endOn);
			$newarray = array_chunk($result, 2);
			foreach($newarray as $arr){
			  foreach($arr as $a){
				  $time_start = new DateTime(reset($arr) . 'T' . $timeStart);
					$time_end = new DateTime(end($arr) . 'T' . $timeEnd);

		  		$event = new Events;
					$event->event_title =  $request->eventTitle;
					$event->event_description =  $request->eventDesc;
					$event->user_id = $userId;
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

	  }else{

	  }


		/*
			$event = new Events;
			$event->event_title = $request->eventTitle;
			$event->event_description = $request->eventDesc;
			$event->user_id = $userId;
			$event->location = $request->eventLocation;
			$event->full_day = $fullDay;
			$event->time_start = $request->eventStartDate;
			$event->time_end = $request->eventEndDate;
			$event->color = $request->eventColor;
			$event->is_shared = 0;
			$event->save();
		*/

		return redirect('/event');
	}

  public function edit($id){
   try{
      $cryptEvent = Crypt::decrypt($id);
      $event = Events::findOrFail($cryptEvent);
      return view('events.update', compact('event'));
    }catch(DecryptException $e){
      return view('errors.404');
    }
  }

	public function update(Request $request, $id){
		dd($request);
	}

	public function destroy($id){
		dd($id);
	}

	public function yearlyOccurences($occurences, $dateStart){
	  $format = "Y-m-d";
		$start = new DateTime($dateStart);
		$end = new DateTime('2025-12-31');
		$interval = new DateInterval('P1Y'); // 1 year
		$dateRange = new DatePeriod($start, $interval, $end);

		$range = [];

		//occurences
	  foreach ($dateRange as $date) {
	  	$result = count($range);
	  	if($result == $occurences) {
	  		break;
	  	}else{
	  		$range[] = $date->format($format);
	  	}
	  }

	  return $range;
	}

	public function yearlyRepeatNever($dateStart){
		$format = "Y-m-d";
		$start = new DateTime($dateStart);
		$maxDate = new DateTime('2050-01-01');
		$interval = new DateInterval('P1Y'); // 1 year
		$dateRange = new DatePeriod($start, $interval, $maxDate);

		$range = [];
		foreach ($dateRange as $date) {
			$range[] = $date->format($format);
	  }

		return $range;
	}

	public function yearlyRepeatOn($dateStart, $dateEnd, $repeatOn){
		$format = "Y-m-d";
		$rangeStart = [];
		$rangeEnd = [];
		$mergeRange = [];
		$range = [];
		$startDate = new DateTime($dateStart);
		$endDate = new DateTime($dateEnd);
		$maxDate = new DateTime($repeatOn);

		$interval = new DateInterval('P1Y'); // 1 year
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
}
