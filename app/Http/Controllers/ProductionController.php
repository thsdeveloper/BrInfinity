<?php

namespace App\Http\Controllers;

use App\User;
use App\Production;
use App\Insurer;
use App\InsurerProduction;
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

    $productions = Production::with('broker', 'insurers')->get();
    // $insurersProduction = InsurerProduction::with('insurers')->get();
    // $insurers = Insurer::getAll();

    dd($productions);

    return view('producao', compact('productions'));

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
