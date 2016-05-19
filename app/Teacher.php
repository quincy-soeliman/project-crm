<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

  protected $table = 'teachers';

  protected $fillable = [
    'first_name',
    'last_name',
    'telephone_number',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function college() {
    return $this->belongsTo('App\Colleg');
  }

}
