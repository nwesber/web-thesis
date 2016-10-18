<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Routine;

class Task extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "task";

  var $data = array();

  public static function getUserTask($id){
    $this->data = DB::table('routine')
                 ->join('task', 'routine.id', '=', 'task.routine_id')
                 ->select('task.*')
                 ->where('id', '=', $id)
                 ->get();
    return $this->data;
	}

	public static function updateTask($id, $taskTitle, $taskDesc, $taskDue, $taskPrio, $taskDay, $timeStart){
     $query = Task::where('id', $id)
        ->update([
          'task_title' => $taskTitle,
          'task_description' => $taskDesc,
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