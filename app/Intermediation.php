<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intermediation extends Model
{
  public function user(){
    return $this->belongsTo(User::class);
  }
  //
  public function productions(){
    return $this->hasMany(Production::class);
  }

  public function corretora(){
    return $this->belongsTo(Corretora::class);
  }

  public function seguradora(){
    return $this->belongsTo(Seguradora::class);
  }

}
