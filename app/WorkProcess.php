<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkProcess extends Model {
  protected $table = 'work_processes';

  protected $fillable = [
    'title', 'description'
  ];

  public function coreTask() {
    return $this->belongsTo('App\CoreTask');
  }
}
