<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events;
use DateTime;
use Calendar;
use DB;

class CalendarController extends Controller
{
	public function index(){

		// create event array
	  $eventCollection = [];

	  //create variable for user id
	  $userid = \Auth::user()->id;

	  //fetch user events
	  $events = DB::table('events')
	  ->where('user_id', '=', $userid)
	  ->get();

	  //iterate all events where user id = logged in user then add them to the array
	  foreach ($events as $event) {
			$eventCollection[] = Calendar::event(
		    $event->event_title, //event title
		    false, //full day event?
		    $event->time_start, //start time (you can also use Carbon instead of DateTime)
		    $event->time_end, //end time (you can also use Carbon instead of DateTime)
		    $event->id, //optionally, you can specify an event ID
		    [
		    	//make event clickable
		    	//pass id
		    	//route event/{id}/myevent
	        'url' => 'event/'. $event->id ,
	        'description' => $event->event_description,
 	        //any other full-calendar supported parameters
    		]
			);
		}

		//add an array with addEvents
		$calendar = Calendar::addEvents($eventCollection);
		return view('events.event', compact('calendar'));
	}

	public function create(){
		//create view
	}

	public function show($id){
		//show event
		$event = Events::findOrFail($id);
		dd($event);
	}

	public function edit($id){
		// edit view
		dd($id);
	}

	public function store(Request $request){
		// store event
		dd($request);
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
