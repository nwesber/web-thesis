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
       /* if($group = Group::where('has_member', '=', 0) == true) {
            if($group = GroupMember::where('user_id', '=', \Auth::user()->name)->where('is_removed', '=', 0) == true){
                // $group = GroupMember::where('user_id', '=', \Auth::user()->name)->get();
                return ""
            }
       }*/
/*
       $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();*/

        /*$group = DB::table('group_members')
            ->join('group', 'group_members.id', '=', 'group_members.group_id')
            ->select('group.*')
            ->where('is_removed', '=', 0)
            ->get();*/
            $group = DB::table('group')
            ->join('group_members', 'group.id', '=', 'group_members.group_id')
            ->where('group_members.user_id', '=', \Auth::user()->name)

            ->select('group_members.*', 'group.*')
            ->where('is_removed', '=', 0)

            ->get();
            // dd(Group::where('group_name')->get();
            // dd($group);
           /*
        $group = GroupMember::where('is_removed', '=', 0)->get();
        dd($group);*/

    	return view('group.group', compact('group'));
    }

    public function groupCalendar($id){
        $group = Group::findOrFail($id);
        // create event array
      $eventCollection = [];

      //create variable for user id
      $userid = \Auth::user()->id;

      //fetch user events
      $events = DB::table('shared_events')->where('is_shared', '=', '1')->get();
      $events = Events::where('is_shared', '=', '1')->where('user_id', '=', $userid)->get();


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
        return view('group.group-calendar', compact('calendar', 'group'));
    }

    public function addGroup(){
    	return view('group.add-group');
    }

    public function storeGroup(Request $request){

    	$group = new Group();
    	$group->group_name = $request->groupName;
        $group->user_id = \Auth::user()->id;
        $group->has_member = 1;
    	if(Group::where('user_id', '=', \Auth::user()->id) && Group::where('group_name', '=', Input::get('groupName'))->exists()){
    		return redirect('/group/add-group')->with('message', 'Group Name already exist!');
    	}else{
            $group->leave_group = 0;
    		$group->save();
		}
        $member = new GroupMember();
        $member->group_id = $group->id;
        $member->user_id = \Auth::user()->name;
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

    	$updateGroup = Group::updateGroup($id, $request->group_name);

    	return redirect('/group')->with(compact('group'));
    }

    /*public function groupDetails($id){
        $group = Group::findOrFail($id);

        return view('group.group-details', compact('group'));
    }*/



    public function addMember($id, Request $request){
        $users = User::where('id', '!=', \Auth::user()->id)->get();
        $group = Group::findOrFail($id);


        return view('group.add-member', compact('users', 'group'));
    }

   /* public function storeMember($id){
        $group = Group::findOrFail($id);*/
        /*$newMember = implode(',', Input::get('addMember'));*/
        /*$member = new GroupMember();
        $member->group_id = $group->id;
        $member->user_id = Input::get('addMember');
        dd($member);
        $member->save();

        return redirect('/group')->with(compact('group'));

    }*/

    public function storeMember($id){
        $group = Group::findOrFail($id);
        $now = \Carbon\Carbon::now();
        $userId = Input::get('addMember');

        foreach($userId as $key => $n ) {
            $groupMem = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $userId[$key])->where('is_removed', '=', 1)->update(array('is_removed' => 0));
        }
           /* $groupMem = DB::table('group_members')
            ->join('group', 'group.id', '=', 'group.id')
            ->select('group_members.*')
            ->where('is_removed', '=', 1)
            ->get();*/
            // dd($groupMem);
        // $newMember = implode(',', Input::get('addMember'));
        // $member = new GroupMember();


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
        $users = GroupMember::where('group_id', '=', $id)->where('is_removed', '=', 0)->get();

        return view('group.view-members', compact('users', 'group'));
    }

    public function groupShareEvent($id, Request $request){
        $group = Group::findOrFail($id);

        $userid = \Auth::user()->id;
        $events = SharedEvent::where('is_shared', '=', '0')->where('user_id', '=', $userid)->get();
        $events = Events::getEvents($userid)->where('is_shared', '=', '0')->get();
        //$events = Events::getEvents($userid)->where('is_shared', '=', '0')->get();

        return view('group.group-event-share', compact('events', 'group'));
    }

    public function performShare($id, Request $request){
        $group = Group::findOrFail($id);

        $userId = \Auth::user()->id;

        $event = Input::get('shareEvent');
      /*  foreach($event as $key => $n ) {
            $arrData[] = array(
                'event_title' => $event[$key],
                'user_id' => $userId,
                'group_id' => '$id',
                'is_shared' => 1,
            );
        }*/
        foreach($event as $key => $n ) {
            $getEvent = SharedEvent::where('group_id', '=', $id)->where('event_title', '=', $event[$key])->where('user_id', '=', $userId)->where('is_shared', '=', 0)->update(array('is_shared' => 1));
            $events = Events::getEvents($userId)->where('event_title', '=', $event[$key])->where('is_shared', '=', '0')->update(array('is_shared' => 1));
        }
        /*if(SharedEvent::where('event_title', '=', $event)->exists()){
            $shareEvent = DB::table('shared_events')->where('is_shared', '=', 0)->where('user_id', '=', $userId)->where('group_id', '=', $id)
            ->update(array('group_id' => $group->id,
                           'is_shared' => 1));
           foreach($event as $key => $n ) {
            $arrData[] = DB::table('shared_events')->update([
                'event_title' => $event[$key],
                'user_id' => $userId,
                'group_id' => $id,
                'is_shared' => 1,
               ]);
            }
        }*/

        /*$event = Input::get('shareEvent');
        foreach($event as $key => $n ) {
            DB::table('shared_events')
                ->update(array(
                'is_shared' => 1,
                ));
            }*/
        /*$shareEvent = DB::table('shared_events')->insert($arrData);*/

        return redirect('/group/' . $group->id . '/shareEvent')->with(compact('group'))->with('message', 'Successfully Shared Event(s)!');

    }

    public function leaveGroup($id){
        $group = Group::findOrFail($id);
   /*     $group->leave_group = 1;
        $group->save();*/


        $groupMem = GroupMember::where('user_id', '=', \Auth::user()->name)->update(array('is_removed' => 1));

        return redirect('/group')->with(compact('group'))->with('message', 'You have left '.$group->group_name.' group');
    }
}
