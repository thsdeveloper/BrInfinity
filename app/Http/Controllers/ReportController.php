<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productivity;
use App\Intermediation;
use App\Insurer;

class ReportController extends Controller{

  //Relatorio do sistema
  public function index(){

    $productivity = Productivity::with('intermidations')->whereYear('date', '=', date('Y'))->orderBy('date')->get();
    $intermediation = Intermediation::with('user', 'insurer')->get(['id', 'id_insurer']);

    $retorno = json_encode(ReportController::getReportYear($productivity, $intermediation));
    $table = json_encode(ReportController::getReportTable($productivity, $intermediation));

    //dd($retorno);

    return view('report.index', ['retorno' => $retorno, 'table' => $table]);
  }


  public function mensal(){

    $productivity = Productivity::with('intermidations.insurer')->orderBy('date')->get();
    $insurer = Insurer::get();


    //var_dump($productivity);
    return view('report.mensal', ['retorno' => $productivity, 'seguradoras' => $insurer]);
  }

  static function getReportYear($productivity, $intermediation){
    $array = array();
    $meses = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $total = 0;
    $retorno = array();
    $retornoArray = array();
    $RecebeValor = array();

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

            foreach ($meses as $key => $m) {
              $array[$inter->insurer->name][$m] = 0;
            }

          }

          //$total = $total + $valor;
          $array[$inter->insurer->name][$dataMes] = $array[$inter->insurer->name][$dataMes] + $value->value;
        }
      }
      //  array_push($array, array($total, $inter->insurer->name));
      //  $total = 0;
    }



    foreach ($array as $key => $insurer) {
      $totalGeral  = 0;

      $insurerValores = array();

      foreach ($insurer as $k => $v) {
        $totalGeral = $totalGeral+$v;
        array_push($insurerValores, $v);
      }

      $RecebeValor['total'] = $totalGeral;
      $RecebeValor['seguradora'] = $key;
      $RecebeValor['valores'] = $insurerValores;

      //$retorno = array($insurer, $key);

      array_push($retornoArray, $RecebeValor);
    }

    return $retornoArray;

  }

  static function getReportTable($productivity, $intermediation){
    $array = array();
    $meses = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $total = 0;
    $retorno = array();
    $retornoArray = array();

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

            foreach ($meses as $key => $m) {
              $array[$inter->insurer->name][$m] = 0;
            }

          }

          //$total = $total + $valor;
          $array[$inter->insurer->name][$dataMes] = $array[$inter->insurer->name][$dataMes] + $value->value;
        }
      }
      //  array_push($array, array($total, $inter->insurer->name));
      //  $total = 0;
    }


    foreach ($array as $key => $insurer) {
      $totalGeral  = 0;

      foreach ($insurer as $k => $v) {
        $totalGeral = $totalGeral+$v;
      }

      $insurer['total'] = $totalGeral;
      $insurer['seguradora'] = $key;
      $insurer['valores'] = array();
      //$retorno = array($insurer, $key);

      array_push($retornoArray, $insurer);
    }

    return $retornoArray;

  }

  public function showData($id, $ano){

    $productivity = Productivity::with('intermidations')->whereYear('date', '=', $ano)->orderBy('date')->get();

    return $productivity;
  }
}
