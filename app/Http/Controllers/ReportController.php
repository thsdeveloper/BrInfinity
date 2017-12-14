<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productivity;
use App\Intermediation;

class ReportController extends Controller{

  //Relatorio do sistema
  public function index(){

    $productivity = Productivity::with('intermidations')->whereYear('date', '=', date('Y'))->orderBy('date')->get();
    $intermediation = Intermediation::with('user', 'insurer')->get(['id', 'id_insurer']);

    $retorno = json_encode(ReportController::getReportYear($productivity, $intermediation));

    return view('report.index', ['retorno' => $retorno]);
  }

  static function getReportYear($productivity, $intermediation){
    $array = array();
    $total = 0;

    foreach ($intermediation as $keyInter => $inter) {


      foreach ($productivity as $key => $value) {
        if($value->id_intermediation === $inter->id){
          $data = $value->date;
          $valor = $value->value;

          $dataMes = date("F", strtotime($data));

          if(!array_key_exists($inter->insurer->name, $array)){
            $array[$inter->insurer->name] = array();

          }

          if(!array_key_exists($dataMes, $array[$inter->insurer->name])){
            $array[$inter->insurer->name][$dataMes] = 0;
          }

          //$total = $total + $valor;
          $array[$inter->insurer->name][$dataMes] = $array[$inter->insurer->name][$dataMes]  + $value->value;
        }
      }

      //  array_push($array, array($total, $inter->insurer->name));
      //  $total = 0;

    }

    return $array;

  }

  public function showData($id, $ano){

    $productivity = Productivity::with('intermidations')->whereYear('date', '=', $ano)->orderBy('date')->get();

    return $productivity;
  }
}
