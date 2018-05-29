<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{

  protected $fillable = [
    'id',
    'intermediation_id',
    'valor',
    'created_at',
    'updated_at'
  ];

  public function intermediation(){
    return $this->belongsTo(Intermediation::class);
  }

}
