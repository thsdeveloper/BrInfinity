<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class UserController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
    $users = User::get();
    return view('usuarios/index', compact('users'));
  }

  public function getUser($id){
    return Auth::user()->name;
  }
  
}
