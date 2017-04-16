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

class GroupController extends Controller
{
    public function index(){
        $userid = \Auth::user()->id;
        $group = DB::table('group')
        ->join('group_members', 'group.id', '=', 'group_members.group_id')
        ->where('group_members.user_id', '=',  $userid)

        ->select('group_members.*', 'group.*')
        ->where('is_removed', '=', 0)

        ->get();

    	return view('group.group', compact('group'));
    }

    public function groupCalendar($id){
      $groupId = Crypt::decrypt($id);
      $group = Group::findOrFail($groupId);
        // create event array
      $eventCollection = [];

      //create variable for user id
      $userid = \Auth::user()->id;

      //fetch user events
      $events = DB::table('events')
        ->where('user_id', '=', $userid)
        ->where('is_shared', '=', '1')
        ->get();
      $holidays = DB::table('holidays')->get();
      $repeatEvent = RepeatEvent::getEvents($userid)->get();
      $group_events = GroupEvents::getGroupEvents($groupId)->get();
      //iterate all events where user id = logged in user then add them to the array
      foreach ($events as $event) {
            $eventCollection[] = Calendar::event(
            $event->event_title, //event title
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
        foreach ($repeatEvent as $repeat) {
          $eventCollection[] = Calendar::event(
            $repeat->event_title,
            false,
            $repeat->time_start,
            $repeat->time_end,
            $repeat->id,
            [
              'url' => 'groupRepeatEvent/'. Crypt::encrypt($repeat->id) ,
              'color' => $repeat->color,
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
         foreach ($group_events as $grpEvent) {
          $eventCollection[] = Calendar::event(
            $grpEvent->event_title,
            false,
            $grpEvent->time_start,
            $grpEvent->time_end,
            $grpEvent->id,
            [
              'url' => 'groupEvent/'. Crypt::encrypt($grpEvent->id) ,
              'color' => $grpEvent->color,
            ]
          );
        }
        $calendar = Calendar::addEvents($eventCollection);
        return view('group.group-calendar', compact('calendar', 'group'));
    }

    public function addGroup(){
    	return view('group.add-group');
    }

    public function storeGroup(Request $request){
        $userid = \Auth::user()->id;
    	$group = new Group();
    	$group->group_name = $request->groupName;
        $group->user_id = $userid;
        $group->has_member = 1;
		$group->save();
        $member = new GroupMember();
        $member->group_id = $group->id;
        $member->user_id = $userid;
        $member->is_removed = 0;
        $member->save();


    	return redirect('/group');
    }

    public function editGroup($id){
        try{
            $decryptGroup = Crypt::decrypt($id);
             $group = Group::findOrFail( $decryptGroup );
            return view('group.edit-group', compact('group'));
        }catch(DecryptException $e){
            return view('errors.404');
        }

    }
    public function updateGroup(Request $request, $id){
       try{
            $decryptGroup = Crypt::decrypt($id);
            $group = Group::findOrFail( $decryptGroup );
            $updateGroup = Group::updateGroup($decryptGroup, $request->groupName);

        $check  = $request->groupName;
        if($group->group_name == $check){
            return redirect('/group/'. $id)->with(compact('group'))->with('message', 'No changes has been made.');
        }else{
            return redirect('/group/'. $id)->with(compact('group'))->with('message', 'Your changes has been saved!');
        }

        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function addMember($id, Request $request){
        try{
            $decryptGroup = Crypt::decrypt($id);
            $member = $this->viewMember($id);
            $exist = $member->users;
            $users = User::where('id', '!=', \Auth::user()->id)
            ->where('id', '!=', $exist->pluck('user_id'))
            ->get();
            $group = Group::findOrFail($decryptGroup);
            return view('group.add-member', compact('users', 'group'));
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function storeMember($id){
        try{
            $decryptGroup = Crypt::decrypt($id);
            $group = Group::findOrFail($decryptGroup);
            $now = \Carbon\Carbon::now();
            $userId = Input::get('addMember');
            if(empty($userId)){
                return redirect()->back()->with('message', 'Please select atleast 1 from the list!');
            }

        /*foreach($userId as $key => $n ) {
            $groupMem = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $userId[$key])->where('is_removed', '=', 1)->update(array('is_removed' => 0));
        }*/

        foreach($userId as $key => $n ) {
            $arrData[] = array(
                'user_id' => $userId[$key],
                'group_id' => $group->id,
                'is_removed' => 0,
                "created_at" => $now,
                "updated_at" => $now
            );
        }
        $member = DB::table('group_members')->insert($arrData);
        return redirect('/group/' . $id)->with(compact('group'))->with('message', 'Successfully Added Member(s)');

        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function updateMember($id, Request $request){
         try{
            $decryptGroup = Crypt::decrypt($id);
            $group = Group::findOrFail($decryptGroup);
            $getMember = Input::get('removeMember');
            if(empty($getMember)){
                return redirect()->back()->with('message', 'Please select atleast 1 from the list!');
            }

            foreach($getMember as $key => $n ) {
                // $users = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $getMember[$key])->where('is_removed', '=', 0)->update(array('is_removed' => 1));
                $users = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $getMember[$key])->where('is_removed', '=', 0)->delete();
                $hasMember = count(GroupMember::where('group_id', '=', $group->id)->get());
                if($hasMember == 0){
                    $deleteGroup = Group::where('id', '=', $group->id)->delete();
                    return redirect('/group')->with('message', 'Successfully Removed Member(s)');
                }else{
                    return redirect('/group/' . $id)->with(compact('group', 'users'))->with('message', 'Successfully Removed Member(s)');
                }
            }

        }catch(DecryptException $e){
            return view('errors.404');
        }

    }

    public function viewMember($id){
        try{
            $decryptGroup = Crypt::decrypt($id);
            $group = Group::findOrFail($decryptGroup);

            $users = DB::table('group_members')
                ->join('users', 'group_members.user_id', 'users.id')
                ->select('users.*', 'group_members.*')
                ->where('group_id', '=', $decryptGroup)
                ->where('is_removed', '=', 0)
                ->get();
            return view('group.view-members', compact('users', 'group'));
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function groupShareEvent($id, Request $request){
        $group = Group::findOrFail($id);

        $userid = \Auth::user()->id;
        $events = SharedEvent::where('is_shared', '=', '0')->where('user_id', '=', $userid)->get();
        $events = Events::getEvents($userid)->where('is_shared', '=', '0')->get();

        return view('group.group-event-share', compact('events', 'group'));
    }

    public function performShare($id, Request $request){
        $group = Group::findOrFail($id);

        $userId = \Auth::user()->id;
        $event = Input::get('shareEvent');

        $share = DB::table('events')
            ->where('user_id', '=', $userId)
            ->where('is_shared', '=', '0')
            ->get();

       $eventDesc = $share->pluck('event_description');
       $fullDay = $share->pluck('full_day');
       $timeStart = $share->pluck('time_start');
       $timeEnd = $share->pluck('time_end');
       $color = $share->pluck('color');
       $location = $share->pluck('location');
           // dd($location);

        foreach($event as $key => $n ) {
            $events = Events::getEvents($userId)->where('event_title', '=', $event[$key])->where('is_shared', '=', '0')->update(array('is_shared' => 1));
            $arrData[] = array(
                'event_title' => $event[$key],
                'user_id' => $userId,
                'group_id' => $id,
                'is_shared' => 1,
                'event_description' => $eventDesc[$key],
                'full_day' => $fullDay[$key],
                'time_start' => $timeStart[$key],
                'time_end' => $timeEnd[$key],
                'color' => $color[$key],
                'location' => $location[$key],
                );
        }
        // dd($arrData);
        $shareNow = DB::table('shared_events')->insert($arrData);
        // dd($shareNow);
        return redirect('/group/' . $group->id)->with(compact('group'))->with('message', 'Successfully Shared Event(s)!');

    }

    public function leaveGroup($id){
        try{
            $decryptGroup = Crypt::decrypt($id);
            $group = Group::findOrFail($decryptGroup);
            // $groupMem = GroupMember::where('group_id', '=', $decryptGroup)->where('user_id', '=', \Auth::user()->id)->update(array('is_removed' => 1));
            $groupMem = GroupMember::where('group_id', '=', $decryptGroup)->where('user_id', '=', \Auth::user()->id)->delete();
            return redirect('/group')->with(compact('group'))->with('message', 'You have left your group: '.$group->group_name);

        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function viewRepeatEvent($id){
        try{
            $repeatEvent = Crypt::decrypt($id);
            $event = RepeatEvent::findOrFail($repeatEvent);
            return view('group_event.group_repeat_event', compact('event'));

        }catch(DecryptException $e){
            return view('errors.404');
        }
    }
}
