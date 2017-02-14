<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller {

    public function authenticate(Request $request) {


        $rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:6',
	    ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', "Oi wrong email or password lah! Or both.");
            return back();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back();
        } else {
            Session::flash('error', "Oi wrong email or password lah! Or both.");
            return back();
        }
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
            Session::flash('alert-success', "Meow~~~~");
            return back();
        }
    }

}

?>
