<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model {

  protected $table = 'administrators';

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'telephone_number',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }

}
