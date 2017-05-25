<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests;
use App\Routine;
use App\User;
use Validator;
use Input;
use Crypt;

class RoutineController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    /* returns list of routine */
    public function index(){
    	$routine = Routine::where('user_id', '=', \Auth::user()->id)->get();
    	return view('routine.routine', compact('routine'));
    }

    /* returns view for creating a routine */
    public function addRoutine(){
    	return view('routine.add-routine');
    }

    /* function to store a routine */
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

    /* returns view for editing routine */
    public function editRoutine($id){
        try{
        $decryptTask = Crypt::decrypt($id);
        $routine = Routine::findOrFail($decryptTask);
            return view('routine.edit-routine', compact('routine'));
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    /* function to update a routine */
    public function updateRoutine(Request $request, $id){
        try{
            $decryptTask = Crypt::decrypt($id);
            $routine = Routine::findOrFail($decryptTask);

         $validator = Validator::make($request->all(), [
            'routineName' => 'required',
        ]);

         if ($validator->fails()) {
             return redirect('/routine/'. $decryptTask.'/edit')
            ->withInput()
            ->withErrors($validator)
            ->with('message', 'Error');
        } 

        $updateRoutine = Routine::updateRoutine($decryptTask, $request->routineName);
        
        $check = $request->routineName;

        if($routine->routine_name == $check){
            return redirect('/routine/' . $id . '/task')->with(compact('routine'))->with('message', 'No changes has been made.');
        }else{
            return redirect('/routine/' . $id . '/task')->with(compact('routine'))->with('message', 'Your changes has been saved!');       
        }
        }catch(DecryptException $e){
            return view('errors.404');
        }
        
    }

    /* function to delete a routine */
    public function deleteRoutine($id){
        try{
            $decryptTask = Crypt::decrypt($id);
            $routine = Routine::findOrFail($decryptTask);
            $deleteRoutine = Routine::deleteRoutine($decryptTask);
        }catch(DecryptException $e){
            return view('errors.404');
        }
        return redirect('/routine')->with(compact('routine'))->with('message', 'Routine "' . $routine->routine_name .  '" has been successfully deleted!');
    }
}

