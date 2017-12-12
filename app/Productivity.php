<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Productivity extends Model{

  protected $fillable = [
        'id_intermediation', 'value', 'date'
    ];


}
