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
	  $events = [];

	  $userid = \Auth::user()->id;

	  $events = DB::table('events')
	  ->where('user_id', '=', $userid)
	  ->get();

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
	        'url' => 'event/'. $event->id .'/myevent',
	        'description' => $event->event_description,
 	        //any other full-calendar supported parameters
    		]
			);
		}

		//add an array with addEvents
		$calendar = Calendar::addEvents($eventCollection);
		return view('events.event', compact('calendar'));
	}

	public function event($id){
		$event = Events::findOrFail($id);
		dd($event);
	}
}
