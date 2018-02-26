<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

class HomeController extends Controller
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

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('home');
  }

  public function listaEmails($type){
    $data = User::get()->toArray();
    return Excel::create('lista-emails-corretoras', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
      {
        $sheet->fromArray($data);
      });
    })->download($type);
  }
}
