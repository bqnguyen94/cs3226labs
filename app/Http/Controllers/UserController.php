<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Validator;

class UserController extends Controller
{
    
	const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_MODERATOR = 3;
	
	public function changeRoles(){
		$users = User::all();
		//return view('change-roles',compact('users'));
		
		return view('change')->with('users', $users);
		//return view('change');
	}
	
	public function updated(Request $request) {
    // ps, yeah, I 'cheat' by combining Controller and View together...
    // separate them in your actual project
    $name = $request->input('name');
    $ans = $request->input('mcq');
	$email = $request->input('email');
	
	if($ans == 10){
		
		  Session::flash('error', "THIS IS THE RIGHT ONE!");
		
		return view('change')->with('users',$users);
		
	}
		
	if($email != null){
//		 $s = User::where('email' ,'==', $email)->firstOrFail();
//  		$s->role = 2; // update the update-able field (we can't update userid)
//  	
		//return view('change')->with('users',$users);
		return "<p>".$email . "TESTING </p>";
	}
		
	$users = User::all();
    return view('change')->with('users',$users);
  }
	
	
	public function test() { return view('test'); }

  public function check(Request $request) {
    // ps, yeah, I 'cheat' by combining Controller and View together...
    // separate them in your actual project
    $name = $request->input('name');
    $ans = $request->input('mcq');
    return "<p>" . $name . ", you selected: " . $ans . "<br>" . 
           "Correct: " . ($ans == 10 ? "Y" : "N") . "<br></p>";
  }
	
	public function updateUser(){
		if(Auth::user()->role == User::ROLE_ADMIN){
			return view('updateuser');
		}else{
			Session::flash('error', "You are not authorized to do this!");
			return Redirect::to('/');
		}
	}
	
	public function updateUserPost(Request $request){
		
		
		$name = $request->input('username');
   		$email = $request->input('email');
		$role = $request->input('role');
		
		$temp=User::where('name',$name)->first();
		if($temp==null){
			return "<p>User cannot be found</p>";
		}else{
			if($email != null){
				$temp->email = $email;
			}
			
			if($role != null){
				
				switch($role){
						
					case "admin":
						$temp->role = USER::ROLE_ADMIN;
						break;
					case "moderator":
						$temp->role = USER::ROLE_MODERATOR;
						break;
					case "user":
						$temp->role = USER::ROLE_USER;
						break;
						
					default:
						break;
				}
			}
			
			$temp->save();
			
		}
		$users = User::all();
		return view('change')->with('users',$users);
	}
}
