<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests;
use App\Group;
use Input;
use App\User;
use App\GroupMember;
use DB;
use App\Events;
use DateTime;
use Calendar;
use Crypt;
use App\SharedEvent;
use App\RepeatEvent;
use App\GroupEvents;
use Validator;


class GroupEventController extends Controller
{
  public function create($id){
    try{
        $decrypt = Crypt::decrypt($id);
        $group = Group::findOrFail($decrypt);
          return view('group_event.create-group-event', compact('group'));
        }catch(DecryptException $e){
          return view('errors.404');
        }
  }

  public function show($id){
    try{
      $cryptEvent = Crypt::decrypt($id);
      $event = Events::findOrFail($cryptEvent);
      $user = User::findOrFail($event->user_id);

      return view('group_event.show', compact('event', 'user'));
    }catch(DecryptException $e){
      return view('errors.404');
    }
  }

  public function showGroupEvent($id){
    try{
      $cryptEvent = Crypt::decrypt($id);
      $groupEvent = GroupEvents::findOrFail($cryptEvent);
      $user = User::findOrFail($groupEvent->user_id);
      $group = Group::findOrFail($groupEvent->group_id);

      return view('group_event.show-group-event', compact('groupEvent', 'user', 'group'));
    }catch(DecryptException $e){
      return view('errors.404');
    }
  }

  public function store(Request $request, $id){
    try{
        $decrypt = Crypt::decrypt($id);
        $group = Group::findOrFail($decrypt);
        $userId = \Auth::user()->id;
        $group_events = new GroupEvents();
        $repeatEvent = new RepeatEvent();
        $timestampStart = strtotime( $request->eventStartDate );
        $timestampEnd = strtotime( $request->eventEndDate );
        $userWeekStart = $dw = date( "w", $timestampStart );
        $userWeekEnd = $dw = date( "w", $timestampEnd );
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
              $repeatEvent->repeatYear( $request, $userId, $decrypt );
            break;
            case 'month':
              $repeatEvent->repeatMonth( $request, $userId, $decrypt );
            break;
            case 'week':
              $repeatEvent->repeatWeek( $request, $userId, $decrypt, $userWeekStart, $userWeekEnd );
            break;
          }
        }
      else{
        $group_events->saveGroupEvent( $request, $userId, $decrypt );
      }
      return redirect('/group/' . $id);
          }catch(DecryptException $e){
              return view('errors.404');
          }
    }

  public function edit($id){
   try{
      $cryptEvent = Crypt::decrypt( $id );
      $groupEvent = GroupEvents::findOrFail( $cryptEvent );
      return view('group_event.edit-group-event', compact( 'groupEvent' ));
    }catch(DecryptException $e){
      return view('errors.404');
    }
  }

  public function updateGroupEvent(Request $request, $id){
    try{
      $cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
    $groupEvent = GroupEvents::findOrFail($cryptEvent);
    $eventId = $groupEvent->id;
    $userId = \Auth::user()->id;
    $updateEvent = GroupEvents::updateGroupEvent($request, $userId, $eventId);
    return redirect('/group/groupEvent/' . $id);
  }

  public function deleteGroupEvent($id){
    try{
      $cryptEvent = Crypt::decrypt($id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
    $groupEvent = GroupEvents::findOrFail($cryptEvent);
    $deleteEvent = GroupEvents::deleteGroupEvent($cryptEvent);
    return redirect('/group/' . $id);
  }

}
