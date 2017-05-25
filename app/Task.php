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
  /* recognize the deleted_at column from the table for softdelete */
  protected $dates = ['deleted_at'];
  /* returns the table name where to save the data */
  public $table = "task";

  var $data = array();

  /* returns task for Sunday */
  public function getSundayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Sunday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Monday */
  public function getMondayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Monday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Tuesday */
  public function getTuesdayTask($id){
    $this->data= DB::table('task')->where('task_day', 'LIKE', '%Tuesday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Wednesday */
  public function getWednesdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Wednesday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Thursday */
  public function getThursdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Thursday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Friday */
  public function getFridayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Friday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* returns task for Saturday */
  public function getSaturdayTask($id){
    $this->data = DB::table('task')->where('task_day', 'LIKE', '%Saturday%')
                ->orWhere('task_day', '=', 'All Day')
                ->where('user_id', \Auth::user()->id)
                ->where('routine_id', $id)
                ->where('deleted_at', '=', null)
                ->get();
    return $this->data;
  }

  /* function to update task */
	public static function updateTask($id, $taskTitle, $taskDesc, $taskDue, $taskPrio, $taskDay, $timeStart){
      if(Input::get('taskDay') == null){
        $taskDay = Input::get('oldTaskDay');
      }else{
        $taskDay = implode(',', Input::get('taskDay'));
      }
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

  /* function to delete task */
   public static function deleteTask($id){
    $query = Task::where('id', $id)->delete();
    return $query;
  }
}