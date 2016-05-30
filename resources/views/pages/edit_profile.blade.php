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
            @foreach ($data as $profile)
                <div class="head col-xs-12 col-md-12">
                    <div class="no-padding col-xs-12 col-md-12">
                        <h1 class="title">Profiel van {{ $profile->first_name }} {{ $profile->last_name }} {{ $profile->name }} bewerken</h1>
                    </div>
                </div>
                <div class="update col-xs-12 col-md-12">
                    <form action="{{ url('profiel/' . $profile->user_id . '/update') }}" method="POST">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        
                        @if ($role === 'student')
                            @include('edit.student')
                        @elseif ($role === 'teacher')
                            @include('edit.teacher')
                        @elseif ($role === 'reviewer')
                            @include('edit.reviewer')
                        @elseif ($role === 'college')
                            @include('edit.college')
                        @elseif ($role === 'company')
                            @include('edit.company')
                        @endif

                        <div class="form-group col-xs-12 col-md-12">
                            <button type="submit" class="btn btn-primary">Bijwerken</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection