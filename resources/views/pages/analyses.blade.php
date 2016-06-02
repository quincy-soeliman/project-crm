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
                    @foreach ($analyses as $analysis)
                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="analyse-box col-xs-12 col-md-12">
                            <h1 class="trigger-dropdown" toslidedown=".coretask-box">{{ $analysis->title }} <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                            <a href="{{ url('/analyses/' . $analysis->id . '/beoordelaars') }}" class="add-reviewer btn btn-default">Beoorderlaar toevoegen</a>

                            @foreach ($analysis->coretasks()->get() as $coretask)
                                @if (count($coretask->workprocesses()->get()) > 0)
                                    <div class="coretask-box col-xs-12 col-md-12">
                                        <h1 class="trigger-dropdown" toslidedown=".workprocess-box">{{ $coretask->title }} <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                                        @foreach ($analysis->workprocesses()->get() as $workprocess)
                                            @if ($workprocess->coretask_id == $coretask->id)
                                                <div class="workprocess-box col-xs-12 col-md-12">
                                                    <h1>{{ $workprocess->title }}</h1>
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
        </div>
    </div>
@endsection