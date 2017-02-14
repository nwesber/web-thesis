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

		/*
		$dateStart = '2017-02-11';
		$dateEnd = '2017-02-12';
		$timeStart = '0800';
		$timeEnd = '1100';
		$start = $dateStart . 'T' .$timeStart;
		$end = $dateEnd . 'T' .$timeEnd;
		*/


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
		dd($request);
		$fullDay = "";
		$userId = \Auth::user()->id;

		if ($request->has('fullDay')) {
    	$fullDay = true;
		}else{
			$fullDay = false;
		}


		/*
		create 2 DB

		Event DB
		Event Details

		Event Coloumns
			id
			user_id
			timestamps
		Event Details Coloumns
			id
			event_id
			event_title
			event_description
			location
			full_day
			time_start
			time_end
			color
		*/

		/*

		//loop for finding day in a given date range
		$format = "N, Y-m-d";
		$start = new DateTime($request->eventStartDate);
		$end = new DateTime($request->eventEndDate);

		$interval = new DateInterval('P1D'); // 1 Day
		$dateRange = new DatePeriod($start, $interval, $end);

		$range = [];
	  foreach ($dateRange as $date) {
	    if($date->format('N') == 1){
	    	$range[] = $date->format($format);
	    }
	  }

	  dd($range);
		*/

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
}
