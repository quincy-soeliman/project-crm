<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable {

  protected $fillable = [
    'email',
    'password',
    'role',
    'active',
  ];

  protected $hidden = [
    'password',
    'remember_token',
    'active',
  ];

  public function student() {
    return $this->hasOne('App\Student');
  }

  public function teacher() {
    return $this->hasOne('App\Teacher');
  }

  public function college() {
    return $this->hasOne('App\College');
  }

  public function reviewer() {
    return $this->hasOne('App\Reviewer');
  }

  public function company() {
    return $this->hasOne('App\Company');
  }

  public function administrator() {
    return $this->hasOne('App\Administrator');
  }

}
