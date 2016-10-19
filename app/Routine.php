<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Routine extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $table = "routine";

  	var $data = array();

    protected $fillable = [
         'user_id',
    ];
/*
    public function getUserRoutine($id){
    $this->data = DB::table('users')
                 ->join('routine', 'users.id', '=', 'routine.user_id')
                 ->select('users.id as u_id' ,'routine.id as routine_id','users.*','routine.*')
                 ->where('user_id', '=', \Auth::user()->id)
                 ->select('routine.*')
                 ->get();
    return $this->data;
    }*/




    public static function deleteRoutine($id){
    $query = Routine::where('id', $id)->delete();
    return $query;
  }

  public static function updateRoutine($id, $routineName){
     $query = Routine::where('id', $id)
        ->update([
          'routine_name' => $routineName,
        ]);

    return $query;
  }

}
