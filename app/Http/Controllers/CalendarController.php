<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Events;
use DateTime;
use Calendar;
use DB;
use Crypt;
use App\SharedEvent;
use App\Group;

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
	  // dd($holidays);

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
		$cryptEvent = Crypt::decrypt($id);

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
		/*$groupId = Group::where('user_id', '=', \Auth::user()->id)->pluck('id');
		dd($groupId);
		$groupIds = implode(',', $groupId);
		dd($groupIds);*/
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
		$event->full_day = $fullDay;
		$event->location = $request->location;
		$event->is_shared = 0;
		if($request->isShared == true){
			$event->is_shared = 1;
		}
		$event->time_start = $request->eventStartDate;
		$event->time_end = $request->eventEndDate;
		$event->color = $request->eventColor;
		$event->save();

		/*$group = new SharedEvent;
		$group->event_title = $request->eventTitle;
		$group->event_description = $request->eventDesc;
		$group->group_id = $groupId;
		$group->user_id = $userId;
		$group->full_day = $fullDay;
		$group->location = "Makati";
		$group->is_shared = 0;
		if($request->isShared == true){
			$event->is_shared = 1;
		}
		$group->time_start = $request->eventStartDate;
		$group->time_end = $request->eventEndDate;
		$group->color = $request->eventColor;
		dd($group);
		$group->save();*/

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
	

