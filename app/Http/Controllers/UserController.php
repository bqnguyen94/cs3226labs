<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Validator;

class UserController extends Controller
{

	const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_MODERATOR = 3;

	public function updateUser(){
		if (Auth::check() && Auth::user()->role == User::ROLE_ADMIN) {
            $users = User::all();
			return view('updateuser')->with('users', $users);
		} else {
			Session::flash('error', "You are not authorized to do this!");
			return Redirect::to('/');
		}
	}

	public function updateUserPost(Request $request){

		if(Auth::user()->role != User::ROLE_ADMIN){
			Session::flash('error', "You are not authorized to do this!");
			return Redirect::to('/');
		}
		$user_id = $request->input('user_id');
   		$user_email = $request->input('user_email');
		$user_role = $request->input('user_role');

		$temp=User::where('id',$user_id)->first();
		if($temp==null){
			return "<p>User cannot be found</p>";
		}else{
			if($user_email != null){
				$temp->email = $user_email;
			}

			if($user_role != null){

				switch($user_role){

					case "2":
						$temp->role = USER::ROLE_ADMIN;
						break;
					case "3":
						$temp->role = USER::ROLE_MODERATOR;
						break;
					case "1":
						$temp->role = USER::ROLE_USER;
						break;

					default:
						break;
				}
			}

			$temp->save();

		}
		$users = User::all();
		return view('updateuser')->with('users',$users);
	}
}
