<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests;
use DB;
use App\Task;
use App\User;
use Validator;
use App\Routine;
use Input;
use Crypt;

class taskController extends Controller
{
    public function task($id){
      try{
        $decryptTask = Crypt::decrypt($id);
        $routine = Routine::findOrFail($decryptTask);

        $taskDay1 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Sunday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay2 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Monday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay3 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Tuesday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay4 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Wednesday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay5 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Thursday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay6 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Friday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();

        $taskDay7 =  DB::table('task')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->where('task_day', 'LIKE', '%Saturday%')
        ->orWhere('task_day', '=', 'All Day')
        ->where('deleted_at', '=', null)
        ->where('user_id', \Auth::user()->id)
        ->where('routine_id', '=', $decryptTask )
        ->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")
        ->get();


        return view('task.task', compact('taskDay1', 'taskDay2', 'taskDay3', 'taskDay4', 'taskDay5', 'taskDay6', 'taskDay7', 'routine'));
      }catch(DecryptException $e){
        return view('errors.404');
      }
    }


    public function addTask($id){
      try{
        $decryptTask = Crypt::decrypt($id);
        $routine = Routine::findOrFail($decryptTask);
        return view('task.add-task', compact('routine'));
      }catch(DecryptException $e){
        return view('errors.404');
      }
    }

    public function taskDetails($id, $id2){
      try{
        $decryptTask = Crypt::decrypt($id);
        $decryptTask2 = Crypt::decrypt($id2);
        $routine = Routine::findOrFail($decryptTask);
        $task = Task::findOrFail($decryptTask2);
          return view('task.task-details', compact('task', 'routine'));
        }catch(DecryptException $e){
          return view('errors.404');
      }
    }

    public function storeTask(Request $request, $id){
      try{
        $decryptTask = Crypt::decrypt($id);
        $routine = Routine::findOrFail($decryptTask);

        $taskDay = implode(',', Input::get('taskDay'));

      if($taskDay == 'Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday'){
          $taskDay = 'All Day';
      }

      $task = new Task();
      $task->user_id = \Auth::user()->id;
      $task->routine_id = $routine->id;
      $task->task_title = $request->taskTitle;
      $task->task_description = $request->taskDesc;
      $task->due_date = $request->taskDue;
      $task->priority = $request->taskPrio;
      $task->task_day = $taskDay;
      $task->time_start = $request->timeStart;
      $task->save();

      return redirect('/routine/'. $id. '/task');
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function taskEdit($id, $id2){
      try{
        $decryptTask = Crypt::decrypt($id);
        $decryptTask2 = Crypt::decrypt($id2);
        $routine = Routine::findOrFail($decryptTask);
        $task = Task::findOrFail($decryptTask2);
      return view('task.edit-task', compact('task', 'routine'));
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function updateTask(Request $request, $id, $id2){
       try{
        $decryptTask = Crypt::decrypt($id);
        $decryptTask2 = Crypt::decrypt($id2);
        $routine = Routine::findOrFail($decryptTask);
        $task = Task::findOrFail($decryptTask2);

        $validator = Validator::make($request->all(), [
            'taskTitle' => 'required|max:255',
            'taskDesc' => 'required|max:255',
            'taskDue' => 'required',
            'taskPrio' => 'required',
            'timeStart' => 'required',
        ]);
          if(Input::get('taskDay') == null){
            $request->taskDay = Input::get('oldTaskDay');
          }
          if($request->taskDay == array('Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday')){
              $request->taskDay = 'All Day';
          }
         if ($validator->fails()) {
             return redirect('/routine/'. $id.'/task/task-details/'. $id2 . '/edit')
          ->withInput()
            ->withErrors($validator)
            ->with('message', 'Error');
        }else{
      $updateTask = Task::updateTask($decryptTask2, $request->taskTitle, $request->taskDesc, $request->taskDue, $request->taskPrio, $request->taskDay, $request->timeStart);
      }
      if($request->taskTitle == $task->task_title && $request->taskDesc == $task->task_description && $request->taskDue == $task->due_date && $request->taskDay == $task->task_day && 
        $request->taskPrio == $task->priority && $request->timeStart == $task->time_start){
        return redirect('/routine/'. $id.'/task/task-details/'. $id2)->with(compact('task', 'routine'))->with('message', 'No changes has been made.');
      }else{
       return redirect('/routine/'. $id.'/task/task-details/'. $id2)->with(compact('task', 'routine'))->with('message', 'Your changes has been saved!');
      }
        }catch(DecryptException $e){
            return view('errors.404');
        }
    }

    public function taskDelete($id, $id2){
      try{
           $decryptTask = Crypt::decrypt($id);
           $decryptTask2 = Crypt::decrypt($id2);
           $routine = Routine::findOrFail($decryptTask);
           $task = Task::findOrFail($decryptTask2);
           $deletetask = Task::deleteTask($decryptTask2);

           return redirect('/routine/'. $id. '/task')->with(compact('task', 'routine'))->with('message', 'Successfully deleted task: ' . $task->task_title);

        }catch(DecryptException $e){
            return view('errors.404');
        }
    }
}
