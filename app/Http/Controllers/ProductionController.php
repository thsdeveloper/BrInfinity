<?php

namespace App\Http\Controllers;

use App\User;
use App\Corretora;
use App\Seguradora;
use App\Production;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    $corretoras = Corretora::get();
    $seguradoras = Seguradora::get();


    $producoes = Production::with('corretora', 'seguradora')->get();
    //dd($producoes);


    // $insurersProduction = InsurerProduction::with('insurers')->get();
    // $insurers = Insurer::getAll();
    // dd($producoes);

    return view('producao', compact('corretoras', 'seguradoras', 'producoes'));

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
