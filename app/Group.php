<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  /* returns the table name where to save data */
  public $table = "group";

  var $data = array();

  /* function to rename a group */
  public static function updateGroup($id, $groupName){
  	$query = Group::where('id', $id)
  		->update([
  			'group_name' => $groupName,
  		]);
  	return $query;	
  }

}
