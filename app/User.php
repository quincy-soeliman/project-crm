<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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

  public function reviewer() {
    return $this->hasOne('App\Reviewer');
  }

}
