<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Corretora;
use App\Seguradora;
use App\Intermediation;
use App\Production;
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
    $corretoras = Corretora::with('seguradoras')->get();
    $seguradoras = Seguradora::get();

    // dd($corretoras);


    return view('corretora/home', compact('corretoras', 'users', 'seguradoras'));
  }

  public function inserir(Request $request){
    $idAuth = Auth::id();
    $dateNow = Carbon::now();
    $IdSeguradoras = $request->seguradora;

    //Salva a nova corretora
    $corretora = new Corretora;
    $corretora->name = $request->name;
    $corretora->cnpj = $request->cnpj;
    $corretora->phone = $request->telefone;
    $corretora->email = $request->email;
    $corretora->address = $request->endereco;
    $corretora->save();


    //Loop nos ids das seguradoras
    foreach($IdSeguradoras as $key => $seg) {

      //Cadastrar uma nova intermediacao
      $inter = new Intermediation;
      $inter->user_id = $idAuth;
      $inter->corretora_id = $corretora->id;
      $inter->seguradora_id = $seg;
      $inter->save();

      //Cadastrar uma nova producao
      $prod = new Production;
      $prod->intermediation_id = $inter->id;
      $prod->valor = 0;
      $prod->created_at = $dateNow;
      $prod->updated_at = $dateNow;
      $prod->save();
    }
    return $corretora;
  }

  public function deletar($id){
    $corretora = Corretora::find($id);
    $corretora->delete();
    return $corretora;
  }

  public function atualizar(Request $request){
    $corretora = Corretora::find($request->id);
    $corretora->name = $request->name;
    $corretora->cnpj = $request->cnpj;
    $corretora->phone = $request->telefone;
    $corretora->email = $request->email;
    $corretora->address = $request->endereco;
    $corretora->save();
    return $corretora;
  }

}
