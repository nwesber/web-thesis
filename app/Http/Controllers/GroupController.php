<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
      $group = Group::findOrFail($id);
        // create event array
      $eventCollection = [];

      //create variable for user id
      $userid = \Auth::user()->id;

      //fetch user events
      $events = DB::table('shared_events')->where('group_id', '=', $id)->where('user_id', '=', $userid)->where('is_shared', '=', '1')->get();
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

                // comment for now will create a seperate page for this
            /*'url' => 'event/'. Crypt::encrypt($event->id) ,*/
            'color' => $event->color,
            //any other full-calendar supported parameters
            ]
            );
        }

        //add an array with addEvents
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
        $group->leave_group = 0;
		$group->save();
        $member = new GroupMember();
        $member->group_id = $group->id;
        $member->user_id = $userid;
        $member->is_removed = 0;
        $member->save();


    	return redirect('/group');
    }

    public function editGroup($id){
    	$group = Group::findOrFail($id);
    	return view('group.edit-group', compact('group'));
    }

    public function updateGroup(Request $request, $id){
    	$group = Group::findOrFail($id);

    	$updateGroup = Group::updateGroup($id, $request->groupName);

    	return redirect('/group/' . $group->id)->with(compact('group'));
    }


    public function addMember($id, Request $request){
        $userid = \Auth::user()->id;
        $users = User::where('id', '!=',  $userid)->get();
        $group = Group::findOrFail($id);
        return view('group.add-member', compact('users', 'group'));
    }

    public function storeMember($id){
        $group = Group::findOrFail($id);
        $now = \Carbon\Carbon::now();
        $userId = Input::get('addMember');

        foreach($userId as $key => $n ) {
            $groupMem = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $userId[$key])->where('is_removed', '=', 1)->update(array('is_removed' => 0));
        }

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
        return redirect('/group')->with(compact('group'))->with('message', 'Successfully Added Member(s)');

    }

    public function updateMember($id, Request $request){
        $group = Group::findOrFail($id);
        $getMember = Input::get('removeMember');
        foreach($getMember as $key => $n ) {
            $users = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $getMember[$key])->where('is_removed', '=', 0)->update(array('is_removed' => 1));
        }
        return redirect('/group')->with(compact('group', 'users'))->with('message', 'Successfully Removed Member(s)');
    }

    public function viewMember($id){
        $group = Group::findOrFail($id);

        $users = DB::table('group_members')
        ->join('users', 'group_members.user_id', '=', 'users.id')
        ->join('group', function ($join) {
            $join->on('group_members.group_id', '=', 'group.id')
                 ->where('group_members.is_removed', '=', 0);
        })
        ->get();
        return view('group.view-members', compact('users', 'group'));
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
        $group = Group::findOrFail($id);
   /*     $group->leave_group = 1;
        $group->save();*/


        $groupMem = GroupMember::where('user_id', '=', \Auth::user()->name)->update(array('is_removed' => 1));

        return redirect('/group')->with(compact('group'))->with('message', 'You have left '.$group->group_name.' group');
    }
}
