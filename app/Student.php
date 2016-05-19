<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

  protected $table = 'students';

  protected $fillable = [
    'ov_number',
    'first_name',
    'last_name'
  ];
  
  public function user() {
    return $this->belongsTo('App\User');
  }

}
