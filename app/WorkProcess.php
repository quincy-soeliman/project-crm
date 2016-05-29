<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workprocess extends Model {

  protected $fillable = [
    'title',
    'description'
  ];

  public function coretask() {
    return $this->belongsTo('App\Coretask');
  }

  public function analyses() {
    return $this->belongsToMany('App\Analysis');
  }

}
