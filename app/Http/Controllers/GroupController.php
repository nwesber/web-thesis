<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Group;
use Input;
use App\User;
use App\GroupMember;
use DB;


class GroupController extends Controller
{
    public function index(){
    	$group = Group::where('leave_group', '=', 0)->get();
    	return view('group.group', compact('group'));
    }

    public function addGroup(){
    	return view('group.add-group');
    }

    public function storeGroup(Request $request){

    	$group = new Group();
    	$group->group_name = $request->groupName;
        $group->user_id = \Auth::user()->id;
        $group->is_owner = 1;
    	/*if(Group::where('user_id', '=', \Auth::user()->id) && Group::where('group_name', '=', Input::get('groupName'))->exists()){
    		return redirect('/group/add-group')->with('message', 'Group Name already exist!');	
    	}else{*/
            $group->leave_group = 0;
    		$group->save();
		// }

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

    public function groupDetails($id){
        $group = Group::findOrFail($id);

        return view('group.group-details', compact('group'));
    }

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
        // $newMember = implode(',', Input::get('addMember'));
        // $member = new GroupMember();
        $now = \Carbon\Carbon::now();
        $grpId = $group->id;
        $userId = Input::get('addMember');

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
        $users = GroupMember::where('group_id', '=', $group->id)->where('user_id', '=', $getMember)->where('is_removed', '=', 0)->update(array('is_removed' => 1));
        return redirect('/group')->with(compact('group', 'users'))->with('message', 'Successfully Removed Member(s)');
    }

    public function viewMember($id){
        $group = Group::findOrFail($id);
        $users = GroupMember::where('group_id', '=', $id)->where('is_removed', '=', 0)->get();

        return view('group.view-members', compact('users', 'group'));
    }

    public function leaveGroup($id){
        $group = Group::findOrFail($id);
        $group->leave_group = 1;
        $group->save();

        return redirect('/group')->with(compact('group'))->with('message', 'You have left '.$group->group_name.' group');
    }
}
