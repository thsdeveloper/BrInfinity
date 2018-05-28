<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{

  protected $fillable = [
    'id',
    'intermediation_id',
    'valor',
  ];

  public function intermediation(){
    return $this->belongsTo(Intermediation::class);
  }

}
