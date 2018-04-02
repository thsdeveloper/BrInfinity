<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Corretora;
use App\Seguradora;
use App\User;

class CorretoraController extends Controller
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
    $data = Corretora::get();
    $users = User::get();
    $seguradoras = Seguradora::get();


    return view('corretora/home', compact('data', 'users', 'seguradoras'));
  }

  public function inserir(Request $request){
    $corretora = new Corretora;
    $corretora->name = $request->name;
    $corretora->cnpj = $request->cnpj;
    $corretora->phone = $request->telefone;
    $corretora->email = $request->email;
    $corretora->address = $request->endereco;
    $corretora->save();
    return $corretora;
  }

  public function deletar($id){
    $corretora = Corretora::find($id);
    $corretora->delete();
    return $corretora;
  }

  public function atualizar(Request $request, $id){
    $corretora = Corretora::find($id);
    $corretora->name = $request->name;
    $corretora->cnpj = $request->cnpj;
    $corretora->phone = $request->telefone;
    $corretora->email = $request->email;
    $corretora->address = $request->endereco;
    $corretora->save();
    return $corretora;
  }

}
