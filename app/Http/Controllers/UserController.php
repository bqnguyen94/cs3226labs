<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
	public function changeRoles(){
		$users = User::all();
		return view('change-roles',compact('users'));
	}
}
