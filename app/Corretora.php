<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model{

  public function seguradoras(){
    return $this->belongsToMany(Seguradora::class);
  }

  public function seguradora(){
    return $this->belongsTo(Seguradora::class);
  }

  public function producoes(){
    return $this->hasMany(Production::class);
  }

  public function getTotalValor($idCorretora, $idSeguradora){
    return $this->producoes->where('corretora_id', $idCorretora)->sum('valor');
  }


}
