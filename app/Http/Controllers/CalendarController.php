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
use Validator;

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
		    $repeat->full_day,
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
		$userId = \Auth::user()->id;
		$events = new Events();
		$repeatEvent = new RepeatEvent();
		$timestamp = strtotime($request->eventStartDate);
		$userWeek = $dw = date( "w", $timestamp);

    $validator = Validator::make($request->all(), [
      'eventTitle' => 'required',
      'eventStartDate' => 'required',
      'eventEndDate' => 'required',
      'eventTimeStart' => 'required',
      'eventTimeEnd' => 'required'
    ]);

     if ($validator->fails()) {
        return redirect('/event/create')
        ->withErrors($validator)
        ->withInput();
      }

		if($request->chkRepeat == 'repeatEvent'){
			switch($request->repeat){
				case 'year':
					$repeatEvent->repeatYear( $request, $userId );
				break;

				case 'month':
					$repeatEvent->repeatMonth( $request, $userId );
				break;

				case 'week':
					if($request->weeklyRepeat == $userWeek){
						$repeatEvent->repeatWeek( $request, $userId );
					}else{
						return redirect('/event/create')->withInput()->withErrors(['Date Start and Repeat Week Chosen does not match.']);
					}
				break;
			}
		}

		else{
			$events->saveEvent( $request, $userId );
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
}
