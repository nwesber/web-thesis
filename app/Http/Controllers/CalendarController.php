<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Requests;
use App\Events;
use App\RepeatEvent;
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
	  $repeatEvent = RepeatEvent::getEvents($userid)->get();

	  foreach ($repeatEvent as $repeat) {
			$eventCollection[] = Calendar::event(
		    $repeat->event_title,
		    false,
		    $repeat->time_start,
		    $repeat->time_end,
		    $repeat->id,

		    [

	        'url' => 'repeatEvent/'. Crypt::encrypt($repeat->id) ,
	        'color' => $repeat->color,
    		]
			);
		}

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

	public function showRepeatEvent($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
      $event = RepeatEvent::findOrFail($cryptEvent);
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

		if($request->chkRepeat == 'repeatEvent'){
			switch($request->repeat){
				/* ======================== Repeat Yearly ============================= */

				case 'year':
					if($request->has('endsOn')){
						$repeatOption = $request->endsOn;

						if($repeatOption == 'endsOn'){
							/* =========== Save Event Ends On============== */
							$interval = 'P1Y';
							$endOn = $request->modalEnd;
					  	$result = $this->yearlyRepeatOn($dateStart, $dateEnd, $endOn, $interval);
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

							/* =================== END ====================== */
						}

						else{
							/* =========== Save Event Never ============== */
							$interval = 'P1Y';
							$result = $this->yearlyRepeatNever($dateStart, $dateEnd, $interval);
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

							/* =================== END ====================== */
						}


					}else{
						dd('no ends on');
					}
				break;

				/* ======================== Repeat Monthly ============================= */

				case 'month':
					if($request->has('endsOn')){
						$repeatOption = $request->endsOn;

						if($repeatOption == 'endsOn'){
							$endOn = $request->modalEnd;
							$interval = 'P1M';
					  	$result = $this->yearlyRepeatOn($dateStart, $dateEnd, $endOn, $interval);
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

						}
						else{
							$interval = 'P1M';
							$result = $this->yearlyRepeatNever($dateStart, $dateEnd, $interval);
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
						}
					}else{
						dd('no ends on');
					}

				break;

				/* ======================== Repeat Weekly ============================= */
				case 'week':
					if($request->has('endsOn')){
						$repeatOption = $request->endsOn;

						if($repeatOption == 'endsOn'){
								$endOn = $request->modalEnd;
								$week = $request->weeklyRepeat;
								$result = $this->weeklyRepeat($dateStart, $dateEnd, $endOn, $week);
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
						}

						else{
							dd('never');
						}
					}else{
						dd('no ends on');
					}

				break;
			}
		}else{
			$time_start = new DateTime($dateStart . 'T' . $timeStart);
			$time_end = new DateTime($dateEnd . 'T' . $timeEnd);
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
		}

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

	public function yearlyRepeatNever($dateStart, $dateEnd, $dateInterval){
		$format = "Y-m-d";
		$start = new DateTime($dateStart);
		$end = new DateTime($dateEnd);
		$maxDate = new DateTime('2051-01-01');
		$interval = new DateInterval($dateInterval); // 1 year
		$dateRangeStart = new DatePeriod($start, $interval, $maxDate);
		$dateRangeEnd = new DatePeriod($end, $interval, $maxDate);

		$rangeStart = [];
		$rangeEnd = [];
		$mergeRange = [];
		$range = [];

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

	public function yearlyRepeatOn($dateStart, $dateEnd, $repeatOn, $dateInterval){
		$format = "Y-m-d";
		$rangeStart = [];
		$rangeEnd = [];
		$mergeRange = [];
		$range = [];
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

	public function weeklyRepeat($dateStart, $dateEnd, $week){
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
