<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public $table = "group";

  var $data = array();

  public static function updateGroup($id, $groupName){
  	$query = Group::where('id', $id)
  		->update([
  			'group_name' => $groupName,
  		]);
  	return $query;	
  }

}
