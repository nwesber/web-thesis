<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Group;
use Input;

class GroupController extends Controller
{
    public function index(){
    	$group = Group::all();
    	return view('group.group', compact('group'));
    }

    public function addGroup(){
    	return view('group.add-group');
    }

    public function storeGroup(Request $request){

    	$group = new Group();
    	$group->group_name = $request->groupName;
    	if(Group::where('user_id', '=', \Auth::user()->id) && Group::where('group_name', '=', Input::get('groupName'))->exists()){
    		return redirect('/group/add-group')->with('message', 'Group Name already exist!');	
    	}else{
    		$group->save();
		}

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

    public function deleteGroup($id){

    	return redirect('/group');
    }

}
