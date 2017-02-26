<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    //
	public function changeRoles(){
		$users = User::all();
		//return view('change-roles',compact('users'));
		
		return view('change')->with('users', $users);
		//return view('change');
	}
}
