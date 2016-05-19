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

}
