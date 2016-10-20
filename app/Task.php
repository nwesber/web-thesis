<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Routine;
use Input;

class Task extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "task";

  var $data = array();

  public function getSundayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Sunday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getMondayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Monday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getTuesdayTask($id){
    $this->data= DB::table('task')->where('task_day', 'LIKE', '%Tuesday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getWednesdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Wednesday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getThursdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Thursday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getFridayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Friday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  public function getSaturdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Saturday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

	public static function updateTask($id, $taskTitle, $taskDesc, $taskDue, $taskPrio, $taskDay, $timeStart){
    $taskDay = implode(',', Input::get('taskDay'));
      if($taskDay == 'Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday'){
          $taskDay = 'All Day';
      }
     $query = Task::where('id', $id)
        ->update([
          'task_title' => $taskTitle,
          'task_description' => $taskDesc,
          'task_day' => $taskDay,
          'due_date' => $taskDue,
          'priority' => $taskPrio,
          'time_start' => $timeStart,
        ]);

    return $query;
  }

   public static function deleteTask($id){
    $query = Task::where('id', $id)->delete();
    return $query;
  }
}