<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model{

  //Retorna a corretora daquela producao
  public function broker(){
    return $this->belongsTo(Broker::class);
  }

  //Retorna todas as seguradora daquela producao
  public function insurers(){
    return $this->belongsToMany(Insurer::class, 'insurer_productions', 'production_id', 'insurer_id');
  }


}
