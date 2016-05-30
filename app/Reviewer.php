<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model {

  protected $table = 'reviewers';

  protected $fillable = [
    'first_name',
    'last_name',
    'telephone_number',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function company() {
    return $this->belongsTo('App\Company');
  }

  public function students() {
    return $this->belongsToMany('App\Student')->withTimestamps();
  }

}
