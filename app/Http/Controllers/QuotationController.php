<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Quotation;
use App\Brokerage;
use App\Business;
use App\Insurer;
use App\User;


class QuotationController extends Controller{

  public function index(){
    $quotations = Quotation::with('brokerage', 'user', 'business')->get();
    $brokerage = Brokerage::get();
    $business = Business::get();
    $insurer = Insurer::get();
    $user = Auth::user();

    //dd($user);
    return view('quotation.index', compact('quotations', 'brokerage', 'business', 'insurer', 'user'));
  }

  public function insert(Request $request){

    $date_solicitation = $request->input('date_solicitation');
    $proponent = $request->input('proponent');
    $cpf = $request->input('cpf');
    $industry = $request->input('industry');
    $description = $request->input('description');
    $value = $request->input('value');
    $id_insurer = $request->input('id_insurer');
    $id_brokerage = $request->input('id_brokerage');
    $id_user = $request->input('id_user');
    $id_business = $request->input('id_business');

    $UrlArquivo = $request->input('arquivo');

    $retorno = Quotation::create(
      [
        'date_solicitation' => Carbon::parse($date_solicitation),
        'proponent' => $proponent,
        'cpf' => $cpf,
        'industry' => $industry,
        'description' => $description,
        'value' => $value,
        'id_insurer' => $id_insurer,
        'id_brokerage' => $id_brokerage,
        'id_user' => $id_user,
        'id_business' => $id_business,
      ]
    );

     $retorno->addMediaFromBase64($UrlArquivo)->toMediaLibrary('cotacao');


    return $retorno;
  }

  public function delete($id){
    $retorno = Quotation::destroy($id);
    return $retorno;
  }

  public function updateStatus(Request $request){
    $id = $request->input('id');
    $text_status = $request->input('text_status');
    $status = $request->input('status');

    $quotation = Quotation::find($id);
    $quotation->text_status = $text_status;
    $quotation->status = $status;

    if($quotation->save()){
      return 'Sucesso';
    }else{
      return 'Deu erro';
    }
  }

  public function update(Request $request){
    $id = $request->input('id');
    $text_status = $request->input('text_status');
    $status = $request->input('status');


    $date_solicitation = $request->input('date_solicitation');
    $proponent = $request->input('proponent');
    $cpf = $request->input('cpf');
    $industry = $request->input('industry');
    $description = $request->input('description');
    $value = $request->input('value');
    $id_insurer = $request->input('id_insurer');
    $id_brokerage = $request->input('id_brokerage');
    $id_user = $request->input('id_user');
    $id_business = $request->input('id_business');
    $validity = $request->input('validity');
    $congenere = $request->input('congenere');
    $last_value = $request->input('last_value');
    $comission = $request->input('comission');
    $idStatus = $request->input('idStatus');



    $quotation = Quotation::find($id);
    $quotation->text_status = $text_status;
    $quotation->status = $status;

    $quotation->date_solicitation = Carbon::parse($date_solicitation);
    $quotation->proponent = $proponent;
    $quotation->cpf = $cpf;
    $quotation->industry = $industry;
    $quotation->description = $description;
    $quotation->value = $value;
    $quotation->id_insurer = $id_insurer;
    $quotation->id_brokerage = $id_brokerage;
    $quotation->id_user = $id_user;
    $quotation->id_business = $id_business;
    $quotation->validity = $validity;
    $quotation->congenere = $congenere;
    $quotation->last_value = $last_value;
    $quotation->comission = $comission;

    $quotation->status = $idStatus;

    if($quotation->save()){
      return 'Sucesso';
    }else{
      return 'Deu erro';
    }

  }


  public function downloadCotacao($type){
    //$data = User::get()->toArray();

    $data = Quotation::get()->toArray();
    //$insurer = Insurer::get()->toArray();


    return Excel::create('relatorio', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data){
        $sheet->fromArray($data);
      });
    })->download($type);
  }
}
