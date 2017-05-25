<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Routine extends Model
{
  use SoftDeletes;
  /* recognize the deleted_at column from the table for softdelete  */
  protected $dates = ['deleted_at'];
  /* returns the table name where to save the data */
  public $table = "routine";

  	var $data = array();

    protected $fillable = [
         'user_id',
    ];

    /* function to delete routine */
    public static function deleteRoutine($id){
    $query = Routine::where('id', $id)->delete();
    return $query;
  }

  /* function to update routine */
  public static function updateRoutine($id, $routineName){
     $query = Routine::where('id', $id)
        ->update([
          'routine_name' => $routineName,
        ]);

    return $query;
  }

}
