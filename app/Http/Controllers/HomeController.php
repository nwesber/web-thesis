<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use Hash;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /* function to logout an account */
    public function logout(){
        auth()->logout();
        return view('auth.login');
    }

    /* returns view to change password */
    public function changePass(){
    	return view('auth.passwords.change-pass');
    }

    /* function to update password */
    public function postUpdatePassword(Request $request) {

        $user = Auth::user();
     
        $password = $request->only([
            'current_password', 'new_password', 'password_confirmation'
        ]);
        $validator = Validator::make($password, [
            'current_password' => 'required|current_password_match',
            'new_password'     => 'required|min:6',
            'password_confirmation' => 'required|same:new_password'
        ]);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();

       $updated = $user->update([ 'password' => bcrypt($password['new_password']) ]);

        if($updated){
            return back()->with('message', 'Successfully Changed Password');
        }

    }

}
