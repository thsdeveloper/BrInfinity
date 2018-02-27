<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurerProduction extends Model
{

  public function productions(){
    return $this->belongsTo(Production::class);
  }

  public function insurers(){
    return $this->belongsTo(Insurer::class);
  }
}
