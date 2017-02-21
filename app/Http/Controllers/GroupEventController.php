<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Group;
use Input;
use App\User;
use App\GroupMember;
use DB;
use App\Events;
use DateTime;
use Calendar;
use Crypt;
use App\SharedEvent;


class GroupEventController extends Controller
{
  public function show($id){
    try{
      $cryptEvent = Crypt::decrypt($id);
      $event = Events::findOrFail($cryptEvent);
      $user = User::findOrFail($event->user_id);
    }catch(DecryptException $e){
      return view('errors.404');
    }
    return view('group_event.show', compact('event', 'user'));
  }
}
