<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Cotacoe extends Model implements HasMedia{

  use HasMediaTrait;

  protected $fillable = [
    'data_solicitacao',
    'proponent',
    'cpf',
    'ramo',
    'descricao',
    'negocio',
    'valor',
    'seguradora_id',
    'corretora_id',
    'user_id',
    'status',
    'text_status',
    'data_validade',
    'congenere',
    'last_valor',
    'comissao',
    'arquivo'
  ];


  public function corretora(){
    return $this->belongsTo(Corretora::class);
  }

  public function seguradora(){
    return $this->belongsTo(Seguradora::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }


}
