@if( $role === 'student' )
  @if (empty($not_done_wps))
    <div class="analyses-status col-xs-12 col-md-12">
      <div class="col-xs-12 col-md-12">
        <h2>Student is gedekt.</h2>
      </div>
    </div>
  @else
    <div class="analyses-status col-xs-12 col-md-12">
      <div class="col-xs-12 col-md-12">
        <h2>Student is niet gedekt.</h2>

        <ul>
          @foreach ($not_done_wps as $wp)
            <li>- {{ $wp }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <div class="analyses col-xs-12 col-md-12">
    <div class="col-xs-12 col-md-12">
      <h3 class="headline-title">
        Analyses van {{ $profile->first_name }} {{ $profile->last_name }}:
      </h3>
    </div>

    <div class="analyses-container col-xs-12 col-md-12">
      @foreach ($analyses as $analysis)

        <div class="analyse-box col-xs-12 col-md-12">
          <h1 class="trigger-dropdown" toslidedown=".coretask-box">{{ $analysis->title }} <i class="fa fa-caret-down"
                                                                                             aria-hidden="true"></i>
          </h1>

          @foreach ($analysis->coretasks()->get() as $coretask)
            @if (count($coretask->workprocesses()->get()) > 0)
              <div class="coretask-box col-xs-12 col-md-12">
                <h1 class="trigger-dropdown" toslidedown=".workprocess-box">{{ $coretask->title }} <i
                    class="fa fa-caret-down" aria-hidden="true"></i></h1>
                @foreach ($analysis->workprocesses()->get() as $workprocess)
                  @if ($workprocess->coretask_id == $coretask->id)
                    <div class="workprocess-box col-xs-12 col-md-12">
                      <h1>{{ $workprocess->title }}</h1>
                      <?php
                      $w = $workprocess->students()->where('student_id', $data[0]->id)->first();
                      $current_user = App\User::find(Auth::id());
                      $reviewer = App\Reviewer::where('user_id', '=', $current_user->id)->first();
                      ?>

                      @if ($current_user->role == 'reviewer')
                        @foreach ($reviewer->workprocesses as $reviewer_workprocess)
                          @if ($reviewer_workprocess->id == $workprocess->id)
                            @if (!$w->pivot->done)
                              <a href="{{ url('profiel/' . $profile->id . '/werkproces/' . $workprocess->id) }}"><i
                                  class="fa fa-check"></i></a>
                            @else
                              <a href="{{ url('profiel/' . $profile->id . '/werkproces/' . $workprocess->id . '/onvoltooid') }}"><i
                                  class="fa fa-times"></i></a>
                            @endif
                          @endif
                        @endforeach
                      @endif

                      @if ($current_user->role == 'student')
                        @if ($w->pivot->done)
                          <p>Done</p>
                        @endif
                      @endif
                    </div>
                  @endif
                @endforeach
              </div>
            @endif
          @endforeach
        </div>
      @endforeach
    </div>

  </div>
@endif