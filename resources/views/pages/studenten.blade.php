@extends('layouts.app')

@section('content')

    @include('layouts.navigation')

    <div class="profile container">
        <div class="row">
            @if( session('status') )
                <div class="message">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            <div class="head col-xs-12 col-md-12">
                <div class="no-padding col-xs-10 col-md-10">
                    <h1 class="title">Studenten</h1>
                </div>
            </div>
            <div class="users col-xs-12 col-md-12">

                <div class="col-xs-12 col-md-12">
                    
                    <div class="acordeon-layout fix-padding col-xs-12 col-md-12">
                        @foreach ($students as $student)
                            <p>{{ $student->first_name }} {{ $student->last_name }}</p>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection