@foreach ($analyses as $analysis)
    {{ $analysis->title }}

    <?php $workprocesses = $analysis->workprocesses()->get(); ?>

    @foreach ($workprocesses as $workprocess)
        {{ $workprocess->title }}
        <?php $coretask = App\Coretask::find($workprocess->coretask_id) ?>
        {{ $coretask->title }}
    @endforeach
@endforeach

@extends('layouts.app')

@section('content')

    @include('layouts.navigation')

    <div class="welcome-banner col-xs-12 col-md-12">
        <div class="image col-xs-12 col-md-12"></div>
        <div class="color col-xs-12 col-md-12"></div>
        <div class="title col-xs-12 col-md-12">
            <h1>{{ $role }}</h1>
        </div>
    </div>

    <div class="profile container">
        <div class="row">
            @if( session('status') )
                <div class="message">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            <div class="head col-xs-12 col-md-12">
                <div class="no-padding col-xs-10 col-md-10">
                    <h1 class="title">Analyse overzicht</h1>
                </div>
            </div>
            <div class="analyses col-xs-12 col-md-12" style="padding-top: 2em;">
                <div class="analyses-container col-xs-12 col-md-12">
                    <!-- Analyse box -->
                    <div class="analyse-box col-xs-12 col-md-12">
                        <h1 class="trigger-dropdown">Analyse title 1 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <!-- Coretask box -->
                        <div class="coretask-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown">Coretask title 1 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 1</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                        </div>
                        <!-- Coretask box -->
                        <div class="coretask-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown">Coretask title 2 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 1</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                        </div>

                    </div>
                    <!-- Analyse box -->
                    <div class="analyse-box col-xs-12 col-md-12">
                        <h1 class="trigger-dropdown">Analyse title 2 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <!-- Coretask box -->
                        <div class="coretask-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown">Coretask title 1 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 1</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                        </div>
                        <!-- Coretask box -->
                        <div class="coretask-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown">Coretask title 2 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 1</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                        </div>
                        <!-- Coretask box -->
                        <div class="coretask-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown">Coretask title 3 <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 1</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                            <!-- Workprocess box -->
                            <div class="workprocess-box col-xs-12 col-md-12">
                                <h1>Workprocess title 2</h1>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection