<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Seguradora;

class SeguradoraController extends Controller
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
  public function index(){
    $data = Seguradora::get();
    return view('seguradora/home', compact('data'));
  }

  public function inserir(Request $request){
    $seguradora = new Seguradora;
    $seguradora->name = $request->name;
    $seguradora->save();
    return $seguradora;
  }

  public function deletar($id){
    $seguradora = Seguradora::find($id);
    $seguradora->delete();
    return $seguradora;
  }

  public function atualizar(Request $request, $id){
    $seguradora = Seguradora::find($id);
    $seguradora->name = $request->name;
    $seguradora->save();
    return $seguradora;
  }

}
