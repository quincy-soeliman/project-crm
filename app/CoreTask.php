<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coretask extends Model {

  protected $fillable = [
    'title'
  ];

  public function workprocesses() {
    return $this->hasMany('App\Workprocess');
  }

  public function analyses() {
    return $this->belongsToMany('App\Analysis')->withTimestamps();
  }

}
