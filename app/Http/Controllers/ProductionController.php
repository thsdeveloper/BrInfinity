<?php

namespace App\Http\Controllers;

use App\User;
use App\Corretora;
use App\Seguradora;
use App\Production;
use App\Intermediation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class ProductionController extends Controller
{

  public function index(){
    $user = User::get();
    dd($user);
    return view('producoes.index', compact('corretoras'));
  }

  /**
  * Show the profile for the given user.
  *
  * @param  int  $id
  * @return Response
  */

  public function showGeral(){
    $seguradoras = Seguradora::get();
    $corretoras = Corretora::get();


    $producoes = DB::table('productions')
    ->join('intermediations', 'intermediations.id', '=', 'intermediation_id')
    ->join('users', 'users.id', '=', 'intermediations.user_id')
    ->join('corretoras', 'corretoras.id', '=', 'intermediations.corretora_id')
    ->join('seguradoras', 'seguradoras.id', '=', 'intermediations.seguradora_id')

    ->select(DB::raw('users.name as user_name, corretoras.name as corretora_name,  seguradoras.name as seguradora_name, seguradoras.id as seguradora_id, corretoras.id as corretora_id, intermediation_id, SUM(valor) as total'))
    ->groupBy(DB::raw('productions.intermediation_id, users.name, corretoras.name, seguradoras.name, seguradoras.id, corretoras.id'))
    ->orderBy(DB::raw('corretoras.name'))
    ->get();



    return view('producoes/producao', compact('corretoras', 'seguradoras', 'producoes'));
  }


  public function getProductionIntermidation(Request $request){
    $id = $request->input('id');
    $todasProducoes = Production::where('intermediation_id', $id)->get();

    return $todasProducoes;
  }


  public function insert(Request $request){

    $id = $request->input('id');
    $date = $request->input('data');
    $value = $request->input('valor');

    $retorno = Production::create(
      [
        'intermediation_id' => $id,
        'created_at' => Carbon::parse($date),
        'valor' => $value,
      ]
    );

    return $retorno;
  }

  public function delete($id){
    $retorno = Production::destroy($id);
    return $retorno;
  }


}
