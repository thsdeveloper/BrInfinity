<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Production;
use App\Intermediation;
use App\Insurer;
use App\User;
use App\Seguradora;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller{

  //Relatorio do sistema
  public function index(){

    $seguradoras = Seguradora::get();

    $productivity = Production::with('intermediation')->whereMonth('created_at', '=', date('m'))->orderBy('created_at')->get();



    $retornoArray = array();
    foreach ($seguradoras as $key => $seg) {


      $dados = array(
        'seguradora'=> $seg->name,
        'janeiro' => "R$ 10",
        'fevereiro' => 'R$ 10',
        'marco' => "R$ 10",
        'abril' => 'R$ 10',
        'maio' => "R$ 10",
        'junho' => 'R$ 10',
        'julho' => "R$ 10",
        'agosto' => 'R$ 10',
        'setembro' => "R$ 10",
        'outubro' => 'R$ 10',
        'novembro' => "R$ 10",
        'dezembro' => 'R$ 10',
        'total' => '900'
      );

      array_push($retornoArray, $dados);
      $intermediations = Intermediation::where('seguradora_id', $seg->id)->get();

    }

    dd($intermediations);



    // $intermediation = Intermediation::with('user', 'seguradora')->get(['id', 'seguradora_id']);
    // compact('dados')
    return view('report.index');
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
