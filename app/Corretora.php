<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model{

  public function seguradoras(){
    return $this->belongsToMany(Seguradora::class);
  }

  public function producoes(){
    return $this->hasMany(Production::class);
  }

  public function getTotalValor(){
    return $this->producoes->sum('valor');
  }


}
