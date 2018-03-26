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
  /**
  * Show the profile for the given user.
  *
  * @param  int  $id
  * @return Response
  */

  public function showGeral(){
    // $producoes = Production::with('intermediation.corretora', 'intermediation.seguradora')->get(['valor', 'intermediation_id']);
    // $corretoras = Corretora::get();
    // $seguradoras = Seguradora::get(['id']);
    // $insurersProduction = InsurerProduction::with('insurers')->get();
    // $insurers = Insurer::getAll();
    // dd($producoes);

    $data = Corretora::with('seguradoras')->get();

    $intermedations = DB::table('intermediations')
    ->join('productions', 'intermediations.id', '=', 'productions.intermediation_id')
    ->join('seguradoras', 'intermediations.seguradora_id', '=', 'seguradoras.id')
    ->select(array(DB::raw('sum(productions.valor) AS total')))
    ->get();

    //->sum('productions.valor');

    // $seguradoras



    return view('producao', compact('corretoras', 'seguradoras', 'data'));

  }

  public function insert(Request $request){

    $id = $request->input('id');
    $date = $request->input('data');
    $value = $request->input('valor');

    $retorno = Productivity::create(
      [
        'id_intermediation' => $id,
        'date' => Carbon::parse($date),
        'value' => $value,
      ]
    );

    return $retorno;
  }

  public function delete($id){
    $retorno = Productivity::destroy($id);
    return $retorno;
  }


}
