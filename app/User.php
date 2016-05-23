<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable {

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'email',
    'password',
    'role',
    'active',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
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

  public function administrators() {
    return $this->hasOne('App\Administrator');
  }

}
