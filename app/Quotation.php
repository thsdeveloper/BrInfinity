<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quotation extends Model{

  protected $fillable = ['date_solicitation', 'proponent', 'cpf', 'industry', 'description', 'value', 'id_insurer', 'id_brokerage', 'id_user', 'id_business', 'status'];


  public function brokerage(){
    return $this->belongsTo(Brokerage::class, 'id_brokerage');
  }

  public function user(){
    return $this->belongsTo(User::class, 'id_user');
  }

  public function business(){
    return $this->belongsTo(Business::class, 'id_business');
  }


}
