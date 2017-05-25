<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{	
   /* returns the table name where to save the data */
   public $table = "group_members";

   /* function to update the status of a member */
   public static function updateMember($group_id, $user_id){
     $query = GroupMember::where('group_id', $group_id)
     ->where('user_id', $user_id)
        ->update([
          'is_removed' => 1,
        ]);

    return $query;
  }

}
