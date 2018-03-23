<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
  public function corretora(){
      return $this->belongsTo(Corretora::class);
  }

  public function seguradora(){
      return $this->belongsTo(Seguradora::class);
  }
}
