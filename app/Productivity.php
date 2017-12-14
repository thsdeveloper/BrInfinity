<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Productivity extends Model{

  protected $fillable = ['id_intermediation', 'value', 'date'];

    public function intermidations(){
      return $this->belongsTo(Intermediation::class, 'id_intermediation');
    }

}
