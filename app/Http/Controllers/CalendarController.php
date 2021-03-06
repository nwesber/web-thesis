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
use Input;

class CalendarController extends Controller
{
	public function __construct()
    {
      $this->middleware('auth');
    }

  /* Home page Calendar */
	public function home(){
		$eventCollection = [];
    $repeatEventCollection = [];
    $userEventCollection = [];
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

		$calendar = Calendar::addEvents($eventCollection)
			->setOptions([
				'header' => [
          'right' => 'listMonth prev,next',
      	],
      	'views' =>[
          'listMonth' => [
            'buttonText' => 'Month View'
          ]
       ],
      'height' => 300,
      'defaultView' => 'listMonth'
		]);

		$greet = "Welcome";
		$now = \Carbon\Carbon::now('Asia/Manila');
		if ($now->hour >= 20) {
		    $greet = "Good Night";
		} elseif ($now->hour > 17) {
		   $greet = "Good Evening";
		} elseif ($now->hour > 11) {
		    $greet = "Good Afternoon";
		} elseif ($now->hour < 12) {
		   $greet = "Good Morning";
		}

		return view('home', compact('calendar', 'greet'));
	}

   /* Event Index */
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

  /* Create View */
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

  /* Show Repeate Event Index */
	public function showRepeatEvent($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
      $event = RepeatEvent::findOrFail($cryptEvent);
		}catch(DecryptException $e){
			return view('errors.404');
		}
		return view('events.showRepeat', compact('event'));
	}

    /* Edit Repeate Event Index */
	public function editRepeatEvent($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
      $event = RepeatEvent::findOrFail($cryptEvent);
		}catch(DecryptException $e){
			return view('errors.404');
		}
		return view('events.editRepeat', compact('event'));
	}

    /* Create Event Index */
	public function store(Request $request){
		$userId = \Auth::user()->id;
		$events = new Events();
		$repeatEvent = new RepeatEvent();
		$timestampStart = strtotime( $request->eventStartDate );
		$timestampEnd = strtotime( $request->eventEndDate );
		$userWeekStart = date( "w", $timestampStart );
		$userWeekEnd = date( "w", $timestampEnd );

	    $validator = Validator::make($request->all(), [
	      'eventTitle' => 'required',
	      'eventStartDate' => 'required',
	      'eventEndDate' => 'required'
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
					$repeatEvent->repeatWeek( $request, $userId, $userWeekStart, $userWeekEnd );
				break;
			}
		}
		else{
			$events->saveEvent( $request, $userId );
		}
		return redirect('/event');
	}

    /* Edit View */
  public function edit($id){
   try{
      $cryptEvent = Crypt::decrypt( $id );
      $event = Events::findOrFail( $cryptEvent );
      return view('events.update', compact( 'event' ));
    }catch(DecryptException $e){
      return view('errors.404');
    }
  }

    /* Update Repeate Event Index */
  public function updateRepeatEvent(Request $request, $id){
		try{
			$cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }

    $event = RepeatEvent::findOrFail($cryptEvent);
    $userId = \Auth::user()->id;
    $repeatId = $event->repeat_id;
    $repeatEvent = new RepeatEvent();
    $timestampStart = strtotime( $request->eventStartDate );
    $timestampEnd = strtotime( $request->eventEndDate );
    $userWeekStart = date( "w", $timestampStart );
    $userWeekEnd = date( "w", $timestampEnd );

    if($request->chkRepeat == 'repeatEvent'){
      switch($request->repeat){
        case 'year':
          $repeatEvent->repeatYear( $request, $userId );
          $deleteEvent = RepeatEvent::destroyEvent($repeatId, $userId);
        break;
        case 'month':
          $repeatEvent->repeatMonth( $request, $userId );
          $deleteEvent = RepeatEvent::destroyEvent($repeatId, $userId);
        break;
        case 'week':
          $repeatEvent->repeatWeek( $request, $userId, $userWeekStart, $userWeekEnd );
          $deleteEvent = RepeatEvent::destroyEvent($repeatId, $userId);
        break;
      }
    }else{
      $updateEvent = RepeatEvent::updateRepeat($request, $repeatId, $userId);
    }

		return redirect('/event');
	}

    /* Update Event Index */
	public function update(Request $request, $id){
		try{
			$cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
    $event = Events::findOrFail($cryptEvent);
   	$eventId = $event->id;
    $userId = \Auth::user()->id;


    if($request->chkRepeat == 'repeatEvent'){
      $repeatEvent = new RepeatEvent();
      $timestampStart = strtotime( $request->eventStartDate );
      $timestampEnd = strtotime( $request->eventEndDate );
      $userWeekStart = date( "w", $timestampStart );
      $userWeekEnd = date( "w", $timestampEnd );
      switch($request->repeat){
        case 'year':
          $repeatEvent->repeatYear( $request, $userId );
          $deleteEvent = Events::deleteEvent($cryptEvent);
        break;
        case 'month':
          $repeatEvent->repeatMonth( $request, $userId );
          $deleteEvent = Events::deleteEvent($cryptEvent);
        break;
        case 'week':
          $repeatEvent->repeatWeek( $request, $userId, $userWeekStart, $userWeekEnd );
          $deleteEvent = Events::deleteEvent($cryptEvent);
        break;
      }
    }else{
      $updateEvent = Events::updateEvent($request, $userId, $eventId);
    }

    return redirect('/event');
	}

    /* Destroy Event Index */
	public function destroy($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
		$event = Events::findOrFail($cryptEvent);
		$deleteEvent = Events::deleteEvent($cryptEvent);
		return redirect('/event');
	}

    /*Destroy Repeat Event Index */
	public function destroyRepeat($id){
		try{
			$cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
    $event = RepeatEvent::findOrFail($cryptEvent);
    $repeatId = $event->repeat_id;
    $userId = \Auth::user()->id;
    $deleteEvent = RepeatEvent::destroyEvent($repeatId, $userId);
    return redirect('/event');
	}

    /* Generates Random Array */
  public function randomArrayVar($array){
    if (!is_array($array)){
      return $array;
    }

    return $array[array_rand($array)];
  }

}
