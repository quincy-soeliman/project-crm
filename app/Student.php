<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

  protected $table = 'students';

  protected $fillable = [
    'ov_number',
    'first_name',
    'last_name'
  ];
  
  public function user() {
    return $this->belongsTo('App\User');
  }

  public function college() {
    return $this->belongsTo('App\College');
  }

  public function reviewers() {
    return $this->belongsToMany('App\Reviewer')->withTimestamps();
  }

  public function analyses() {
    return $this->belongsToMany('App\Analysis')->withTimestamps();
  }

  public function workprocesses() {
    return $this->belongsToMany('App\Workprocess')->withPivot('done')->withTimestamps();
  }

}
