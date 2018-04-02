<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Cotacoe;
use App\Corretora;
use App\Seguradora;
use App\User;


class QuotationController extends Controller{

  public function index(){
    $cotacoes = Cotacoe::with('corretora', 'user', 'seguradora')->get();
    $corretoras = Corretora::get();
    $seguradoras = Seguradora::get();
    $user = Auth::user();

    //dd($user);
    return view('quotation/home', compact('cotacoes', 'corretoras', 'seguradoras', 'user'));
  }

  public function insert(Request $request){
    $data_solicitacao = $request->input('data_solicitacao');
    $proponent = $request->input('proponent');
    $cpf = $request->input('cpf');
    $ramo = $request->input('ramo');
    $descricao = $request->input('descricao');
    $negocio = $request->input('negocio');
    $valor = $request->input('valor');
    $seguradora_id = $request->input('seguradora_id');
    $corretora_id = $request->input('corretora_id');

    $retorno = Cotacoe::create(
      [
        'data_solicitacao' => $data_solicitacao,
        'proponent' => $proponent,
        'cpf' => $cpf,
        'ramo' => $ramo,
        'descricao' => $descricao,
        'negocio' => $negocio,
        'valor' => $valor,
        'status' => 0,
        'seguradora_id' => $seguradora_id,
        'corretora_id' => $corretora_id,
        'user_id' => Auth::user()->id,
      ]
    );

    // $retorno->addMediaFromBase64($arquivo)->toMediaLibrary('cotacao');

    return $retorno;
  }

  public function delete($id){
    $retorno = Cotacoe::destroy($id);
    return $retorno;
  }

  public function updateStatus(Request $request){
    $id = $request->input('id');
    $text_status = $request->input('text_status');
    $status = $request->input('status');

    $quotation = Cotacoe::find($id);
    $quotation->text_status = $text_status;
    $quotation->status = $status;

    if($quotation->save()){
      return 'Sucesso';
    }else{
      return 'Deu erro';
    }
  }

  public function update(Request $request){
    $idQ = $request->input('idQ');

    $data_solicitacao = $request->input('data_solicitacao');
    $proponent = $request->input('proponent');
    $cpf = $request->input('cpf');
    $ramo = $request->input('ramo');
    $descricao = $request->input('descricao');
    $negocio = $request->input('negocio');
    $valor = $request->input('valor');
    $seguradora_id = $request->input('seguradora_id');
    $corretora_id = $request->input('corretora_id');

    //Update
    $data_validade = $request->input('data_validade');
    $congenere = $request->input('congenere');
    $last_valor = $request->input('last_valor');
    $comissao = $request->input('comissao');
    $arquivo = $request->input('arquivo');

    $quotation = Cotacoe::find($idQ);
    $quotation->data_solicitacao = $data_solicitacao;
    $quotation->proponent = $proponent;
    $quotation->cpf = $cpf;
    $quotation->ramo = $ramo;
    $quotation->descricao = $descricao;
    $quotation->negocio = $negocio;
    $quotation->valor = $valor;
    $quotation->seguradora_id = $seguradora_id;
    $quotation->corretora_id = $corretora_id;
    //Update
    $quotation->data_validade = $data_validade;
    $quotation->congenere = $congenere;
    $quotation->last_valor = $last_valor;
    $quotation->comissao = $comissao;
    $quotation->arquivo = $arquivo;

    if($quotation->save()){
      return 'Sucesso';
    }else{
      return 'Deu erro';
    }

  }


  public function downloadCotacao($type){
    //$data = User::get()->toArray();

    $data = Cotacoe::get()->toArray();
    //$insurer = Insurer::get()->toArray();


    return Excel::create('relatorio', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data){
        $sheet->fromArray($data);
      });
    })->download($type);
  }
}
