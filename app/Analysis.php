<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model {

  protected $fillable = [
    'title'
  ];

  public function students() {
    return $this->belongsToMany('App\Student')->withTimestamps();
  }

  public function coretasks() {
    return $this->belongsToMany('App\Coretask')->withTimestamps();
  }

  public function workprocesses() {
    return $this->belongsToMany('App\Workprocess')->withTimestamps();
  }

}
