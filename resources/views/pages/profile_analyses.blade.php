@if( $role === 'student' )
    <div class="analyses col-xs-12 col-md-12">
        <div class="col-xs-12 col-md-12">
            <h3 class="headline-title">
                Analyses van {{ $profile->first_name }} {{ $profile->last_name }}:
            </h3>
        </div>

        <div class="analyses-container col-xs-12 col-md-12">
            @foreach ($analyses as $analysis)

                <div class="analyse-box col-xs-12 col-md-12">
                    <h1 class="trigger-dropdown" toslidedown=".coretask-box">{{ $analysis->title }} <i class="fa fa-caret-down" aria-hidden="true"></i></h1>

                    @foreach ($analysis->coretasks()->get() as $coretask)
                        @if (count($coretask->workprocesses()->get()) > 0)
                            <div class="coretask-box col-xs-12 col-md-12">
                                <h1 class="trigger-dropdown" toslidedown=".workprocess-box">{{ $coretask->title }} <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                                @foreach ($analysis->workprocesses()->get() as $workprocess)
                                    @if ($workprocess->coretask_id == $coretask->id)
                                        <div class="workprocess-box col-xs-12 col-md-12">
                                            <h1>{{ $workprocess->title }}</h1>
                                            <?php $w = $workprocess->students()->where('student_id', $data[0]->id)->first(); ?>
                                            {{ $w->pivot->done }}
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