<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Task;
use App\User;
use Validator;
use App\Routine;
use Input;

class taskController extends Controller
{
    public function task($id){
        $routine = Routine::findOrFail($id);

          $taskDay1 =  DB::table('task')->where('task_day', 'LIKE', '%Sunday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();


          $taskDay2 =  DB::table('task')->where('task_day', 'LIKE', '%Monday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();
 

          $taskDay3 =  DB::table('task')->where('task_day', 'LIKE', '%Tuesday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();

          $taskDay4 =  DB::table('task')->where('task_day', 'LIKE', '%Wednesday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();


          $taskDay5 =  DB::table('task')->where('task_day', 'LIKE', '%Thursday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();


          $taskDay6 =  DB::table('task')->where('task_day', 'LIKE', '%Friday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();


          $taskDay7 =  DB::table('task')->where('task_day', 'LIKE', '%Saturday%')->where('user_id', \Auth::user()->id)->where('deleted_at', '=', null)->get();



        return view('task.task', compact('taskDay1', 'taskDay2', 'taskDay3', 'taskDay4', 'taskDay5', 'taskDay6', 'taskDay7', 'routine'));
    }


    public function addTask($id){
      $routine = Routine::findOrFail($id);
    	return view('task.add-task', compact('routine'));
    }

    public function taskDetails($id, $id2){
      $routine = Routine::findOrFail($id);
    	$task = Task::findOrFail($id2);
    	return view('task.task-details', compact('task', 'routine'));
    }

    public function storeTask(Request $request, $id){
      $routine = Routine::findOrFail($id);
      
      $taskDay = implode(',', Input::get('taskDay'));
      
    	$task = new Task();
      $task->user_id = \Auth::user()->id;
      $task->routine_id = $routine->id;
      $task->task_title = $request->taskTitle;
      $task->task_description = $request->taskDesc;
      $task->due_date = $request->taskDue;
      $task->priority = $request->taskPrio;
      $task->task_day = $taskDay;
      $task->time_start = $request->timeStart;
      $task->is_completed = 0;
    	$task->save();


    	return redirect('/routine/'. $id. '/task');
    }

    public function taskEdit($id, $id2){
      $routine = Routine::findOrFail($id);
      $task = Task::findOrFail($id2);
      return view('task.edit-task', compact('task', 'routine'));
    }

    public function updateTask(Request $request, $id, $id2){
      $routine = Routine::findOrFail($id);
      $task = Task::findOrFail($id2);

       $validator = Validator::make($request->all(), [
            'taskTitle' => 'required',
            'taskDesc' => 'required|max:255',
            'taskDue' => 'required|max:255',
            'taskPrio' => 'required|max:255',
            'taskDay' => 'required|max:255',
            'timeStart' => 'required|max:255',
        ]);

         if ($validator->fails()) {
             return redirect('/routine/'. $id.'/task/task-details/'. $id2 . '/edit')
            ->withInput()
            ->withErrors($validator)
            ->with('message', 'Error');
        } 
      $updateTask = Task::updateTask($id2, $request->taskTitle, $request->taskDesc, $request->taskDue, $request->taskPrio, $request->taskDay, $request->timeStart);

      if($request->taskTitle == 'taskTitle' && $request->taskDesc == 'taskDesc' && $request->taskDue == 'taskDue' && $request->taskDay == 'taskDay' && $request->taskPrio == 'taskPrio' && $request->timeStart == 'timeStart'){
        return redirect('/routine/'. $id.'/task/task-details/'. $id2)->with(compact('task', 'routine'))->with('message', 'No changes has been made.');
      }else{
       return redirect('/routine/'. $id.'/task/task-details/'. $id2)->with(compact('task', 'routine'))->with('message', 'Your changes has been saved.');
      }
    }

    public function taskDelete($id, $id2){
      $routine = Routine::findOrFail($id);
      $task = Task::findOrFail($id2);
      $deletetask = Task::deleteTask($id2);

      return redirect('/routine/'. $id. '/task')->with(compact('task', 'routine'))->with('message', 'Success');
    }
}   
