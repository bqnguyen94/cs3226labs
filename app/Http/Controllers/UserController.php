<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    //
	public function changeRoles(){
		//$users = User::all();
		//return view('change-roles',compact('users'));
		return view('change');
	}
}
