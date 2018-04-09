<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguradora extends Model
{

  public function producoes(){
    return $this->belongsToMany(Production::class);
  }



}
