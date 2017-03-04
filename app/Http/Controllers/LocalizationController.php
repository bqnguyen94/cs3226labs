<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller {
   public function index(){
      //set’s application’s locale
      app()->setLocale('zh');
      
      return app('App\Http\Controllers\StudentController')->index();;
   }

   public function create(){
      //set’s application’s locale
      app()->setLocale('zh');
      
      return app('App\Http\Controllers\StudentController')->create();;
   }

   public function batch(){
      //set’s application’s locale
      app()->setLocale('zh');
      
      return app('App\Http\Controllers\StudentController')->batch();;
   }

   public function updateuser(){
      //set’s application’s locale
      app()->setLocale('zh');
      
      return app('App\Http\Controllers\UserController')->updateuser();;
   }
}