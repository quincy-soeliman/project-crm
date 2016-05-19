<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

  protected $table = 'companies';

  protected $fillable = [
    'name',
    'address',
    'zip_code',
    'telephone_number',
    'iso_number',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function reviewers() {
    return $this->hasMany('App\Reviewer');
  }

}
