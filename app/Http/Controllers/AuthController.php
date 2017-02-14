<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller {

    public function authenticate(Request $request) {


        $rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:6',
	    ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('error', "Oi wrong email or password lah. Or both.");
            return Redirect::back()->withInput(['email']);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back();
        } else {
            return back();
        }
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
            return back();
        }
    }

}

?>
