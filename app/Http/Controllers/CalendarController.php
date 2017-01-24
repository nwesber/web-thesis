<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Requests;
use App\Events;
use DateTime;
use Calendar;
use DB;
use Crypt;

class CalendarController extends Controller
{
	public function index(){

		// create event array
	  $eventCollection = [];

	  //create variable for user id
	  $userid = \Auth::user()->id;

	  //fetch user events
	  $events = Events::getEvents($userid)->get();
	  $holidays = DB::table('holidays')->get();

	  //iterate all events where user id = logged in user then add them to the array
	  foreach ($events as $event) {
			$eventCollection[] = Calendar::event(
		    $event->event_title, //event title
		    false, //full day event?
		    $event->time_start, //start time (you can also use Carbon instead of DateTime)
		    $event->time_end, //end time (you can also use Carbon instead of DateTime)
		    $event->id, //optionally, you can specify an event ID

		    [
		    	/*========================/
		    		make event clickable
			    	pass id
			    	route = event/{id}
			    	encrypt id for security
		    	==========================*/
	        'url' => 'event/'. Crypt::encrypt($event->id) ,
	        'color' => $event->color,
 	        //any other full-calendar supported parameters
    		]
			);
		}

		//iterate all events where user id = logged in user then add them to the array
	  foreach ($holidays as $holiday) {
			$eventCollection[] = Calendar::event(
		    $holiday->event_title, //event title
		    true, //full day event?
		    $holiday->time_start, //start time (you can also use Carbon instead of DateTime)
		    $holiday->time_end, //end time (you can also use Carbon instead of DateTime)
		    $holiday->id, //optionally, you can specify an event ID

		    [
		    	/*========================/
		    		make event clickable
			    	pass id
			    	route = event/{id}
			    	encrypt id for security
		    	==========================*/

	        'color' => $holiday->color,
 	        //any other full-calendar supported parameters
    		]
			);
		}





		//add an array with addEvents
		$calendar = Calendar::addEvents($eventCollection);
		return view('events.event', compact('calendar'));
	}

	public function create(){
		return view('events.create');
	}

	public function show($id){
		//show event

		//decrypt id
		try{
			$cryptEvent = Crypt::decrypt($id);
		}catch(DecryptException $e){
			return view('errors.404');
		}


		//find if event exist
		$event = Events::findOrFail($cryptEvent);


		return view('events.show', compact('event'));
	}

	public function edit($id){
		// edit view
		dd($id);
	}

	public function store(Request $request){
		// store event

		// declare variables
		$fullDay = "";
		$userId = \Auth::user()->id;

		// check if fullDay is true
		if ($request->has('fullDay')) {
    	$fullDay = true;
		}else{
			$fullDay = false;
		}

		//create new event object and store
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

	public function update(Request $request, $id){
		// update event
		dd($request);
	}

	public function destroy($id){
		//delete event
		dd($id);
	}
}
