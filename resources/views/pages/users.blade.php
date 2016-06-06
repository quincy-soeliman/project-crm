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
                    <h1 class="title">Geregistreerde gebruikers</h1>
                </div>
            </div>
            <div class="users col-xs-12 col-md-12">
                <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Studenten</h3>
                    <!-- Search for students -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'student')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Docenten</h3>
                    <!-- Search for teacher -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'teacher')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Beoordelaars</h3>
                    <!-- Search for reviewer -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'reviewer')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Scholen</h3>
                    <!-- Search for college -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'college')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Bedrijven</h3>
                    <!-- Search for company -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'company')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
              <div class="user-container col-xs-12 col-md-12">
                    <h3 class="heading-title">Administrators</h3>
                    <!-- Search for administrator -->
                    @foreach ($users as $user)
                        @if ($user->active == 0 && $user->role == 'administrator')
                            <div class="user col-xs-12 col-md-12">
                                <p>{{ $user->email }}</p>
                                <a class="user-option deny" href="{{ url('/gebruikers/' . $user->id . '/verwijder') }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a class="user-option accept" href="{{ url('/gebruikers/' . $user->id) }}"><i class="fa fa-check" aria-hidden="true"></i></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection