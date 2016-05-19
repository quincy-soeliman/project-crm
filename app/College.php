<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model {

  protected $table = 'colleges';

  protected $fillable = [
    'name',
  ];
  
  public function user() {
    return $this->belongsTo('App\User');
  }

  public function students() {
    return $this->hasMany('App\Student');
  }

  public function teachers() {
    return $this->hasMany('App\Teacher');
  }

}
