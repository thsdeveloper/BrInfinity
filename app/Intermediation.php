<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Intermediation extends Model{

  protected $fillable = ['id_intermediation', 'value', 'date'];

  protected $hidden = [
      'password', 'remember_token',
  ];


  public function user(){
    return $this->belongsTo(User::class, 'id_user');
  }

  public function insurer(){
    return $this->belongsTo(Insurer::class, 'id_insurer');
  }

  public function brokerage(){
    return $this->belongsTo(Brokerage::class, 'id_brokerage');
  }


}
