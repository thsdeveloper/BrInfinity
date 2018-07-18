<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Production;
use App\Intermediation;
use App\Seguradora;
use DB;

class ReportController extends Controller{

  //Relatorio do sistema
  public function index(){
    $productions = Production::with('intermediation')->whereYear('created_at', '=', date('Y'))->orderBy('created_at')->get();
    $intermediations = Intermediation::with('user', 'seguradora')->get(['id', 'seguradora_id']);
    $table = json_encode(ReportController::getReportTable($productions, $intermediations));

    return view('report.index', ['table' => $table]);
  }


  public function mensal(){

    $seguradoras = Seguradora::get();
    $intermediations = Intermediation::get();
    $productions = Production::get();

    return view('report.mensal', ['table' => $seguradoras]);
  }


  static function getReportTable($productions, $intermediations){
    $array = array();
    $meses = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $total = 0;
    $retorno = array();
    $retornoArray = array();

    //Percorrendo
    foreach ($intermediations as $keyInter => $inter) {
      foreach ($productions as $key => $value) {
        if($value->intermediation_id === $inter->id){
          $data = $value->created_at;
          $valor = $value->valor;
          $dataMes = date("F", strtotime($data));
          if(!array_key_exists($inter->seguradora->name, $array)){
            $array[$inter->seguradora->name] = array();
          }
          if(!array_key_exists($dataMes, $array[$inter->seguradora->name])){
            foreach ($meses as $key => $m) {
              $array[$inter->seguradora->name][$m] = 0;
            }
          }
          $total = $total + $valor;
          $array[$inter->seguradora->name][$dataMes] = $array[$inter->seguradora->name][$dataMes] + $value->valor;
        }
      }
    }

    foreach ($array as $key => $seguradora) {
      $totalGeral  = 0;
      foreach ($seguradora as $k => $v) {
        if(is_numeric($totalGeral) && is_numeric($v)){
          $totalGeral = $totalGeral + $v;
        }
      }
      $seguradora['total'] = $totalGeral;
      $seguradora['seguradora'] = $key;
      $seguradora['tableMensal'] = array();

      $retorno = array($seguradora, $key);
      array_push($retornoArray, $seguradora);
    }

    return $retornoArray;
  }

  public function showData($id, $ano){
    $productions = Production::with('intermediation')->whereYear('date', '=', $ano)->orderBy('date')->get();
    return $productions;
  }

  public function downloadExcel($type){
    $data = Production::get()->toArray();
    return Excel::create('relatorio', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data){
        $sheet->fromArray($data);
      });
    })->download($type);
  }

  public function downloadAnual($type){
    //$data = User::get()->toArray();
    $data = Production::get()->toArray();
    //$insurer = Insurer::get()->toArray();
    return Excel::create('relatorio', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data){
        $sheet->fromArray($data);
      });
    })->download($type);
  }

}
