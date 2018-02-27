<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Insurer extends Model
{
  //Retorna todas as seguradoras
  public static function getAll(){
    return static::orderBy('name')->get();
  }
}
