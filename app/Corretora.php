<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model{

  public function seguradoras(){
    return $this->hasMany(Seguradora::class);
  }

  public function producoes(){
    return $this->hasMany(Production::class);
  }



}
