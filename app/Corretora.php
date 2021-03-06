<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model{

  public function seguradoras(){
    return $this->BelongsToMany(Seguradora::class, 'intermediations');
  }

  public function seguradora(){
    return $this->belongsTo(Seguradora::class);
  }

  public function producoes(){
    return $this->hasMany(Intermediation::class);
  }

  public function getTotalValor($idCorretora, $idSeguradora){
    return $this->producoes->where('corretora_id', $idCorretora)->sum('valor');
  }


}
