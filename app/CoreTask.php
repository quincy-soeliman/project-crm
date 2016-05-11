<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreTask extends Model {
  protected $table = 'core_tasks';

  protected $fillable = [
    'title'
  ];

  public function workProcesses() {
    return $this->hasMany('App\WorkProcess');
  }
}
