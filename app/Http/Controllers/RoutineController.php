<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Routine;
use App\User;
use Validator;
use Input;

class RoutineController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$routine = Routine::where('user_id', '=', \Auth::user()->id)->get();
    	return view('routine.routine', compact('routine'));
    }

    public function addRoutine(){
    	return view('routine.add-routine');
    }

    public function storeRoutine(Request $request){
    	$routine = new Routine();
      	$routine->user_id = \Auth::user()->id;
    	$routine->routine_name = $request->routineName;
        if(Routine::where('user_id', '=', \Auth::user()->id)->where('routine_name', '=', Input::get('routineName'))->exists()){
            return redirect('routine/add-routine')->with('message', 'Routine Name already exist!');
        }else{
            $routine->save();
        }
    	return redirect('/routine');
    }

    public function editRoutine($id){
        $routine = Routine::findOrFail($id);
        return view('routine.edit-routine', compact('routine'));
    }

    public function updateRoutine(Request $request, $id){
        $routine = Routine::findOrFail($id);

        $updateRoutine = Routine::updateRoutine($id, $request->routineName);

        return redirect('/')->with(compact('routine'));
    }

    public function deleteRoutine($id){
        $routine = Routine::findOrFail($id);
        $deleteRoutine = Routine::deleteRoutine($id);

        return redirect('/routine')->with(compact('routine'), 'message', 'Success!');
    }
}

