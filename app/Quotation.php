<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Quotation extends Model implements HasMedia{
  use HasMediaTrait;

  protected $fillable = ['date_solicitation', 'proponent', 'cpf', 'industry', 'description', 'value', 'id_insurer', 'id_brokerage', 'id_user', 'id_business', 'status'];


  public function brokerage(){
    return $this->belongsTo(Broker::class, 'id_broker');
  }

  public function user(){
    return $this->belongsTo(User::class, 'id_user');
  }

  public function business(){
    return $this->belongsTo(Business::class, 'id_business');
  }


}
