<?php

namespace App;

use App\CoreTask;
use App\WorkProcess;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model {
  protected $table = 'analyses';

  protected $fillable = [
    'title'
  ];

  public function getCoreTasks() {
    return CoreTask::all();
  }

  public function getWorkProcesses() {
    return WorkProcess::all();
  }
}
