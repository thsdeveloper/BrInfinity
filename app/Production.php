<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
  public function intermediation(){
    return $this->belongsTo(Intermediation::class);
  }

}
