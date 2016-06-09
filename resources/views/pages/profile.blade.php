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
                    <div class="no-padding col-xs-10 col-md-10">
                      @if (!$profile->name)
                        <h1 class="title">{{ $profile->first_name }} {{ $profile->last_name }}</h1>
                      @else
                        <h1 class="title"> {{ $profile->name }}</h1>
                      @endif
                        @if( $profile->ov_number != '' )
                            <h2 class="sub-title">OV nummer: {{ $profile->ov_number }}</h2>
                        @endif
                    </div>

                    @if( Auth::id() == $profile->user_id )
                        <div class="edit-link no-padding col-xs-2 col-md-2">
                            <a href="{{ url( 'profiel/' . $profile->user_id . '/bewerk' ) }}">Profiel bewerken</a>
                        </div>
                    @endif
                </div>

                <div class="info col-xs-12 col-md-12">

                    @if (!empty($reviewers))
                        <div class="reviewers col-xs-12 col-md-12">
                            <h3 class="headline-title">
                                {{ count($reviewers) > 1 ? 'Beoordelaars' : 'Beoordelaar' }}
                            </h3>

                            <ul class="reviewers-list">
                                @foreach ($reviewers as $reviewer)
                                    <li>
                                        <a href="{{ url('profiel/' . $reviewer->id) }}">- {{ $reviewer->first_name }} {{ $reviewer->last_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="additional-info col-xs-12 col-md-12">
                        <div class="no-padding col-xs-12 col-md-6">

                            @if( $profile->college != '' )
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">School:</p>
                                @if( $role === 'teacher' )
                                    <p class="info-text col-xs-12 col-md-8"><a
                                                href="{{ '/profile/' . $profile->college->id }}">{{ $profile->college->name }}</a>
                                    </p>
                                @else
                                    <p class="info-text col-xs-12 col-md-8"><a
                                                href="{{ '/profile/' . $profile->college_id }}">{{ $profile->college }}</a>
                                    </p>
                                @endif
                                </div>
                            @endif

                            @if( $profile->company != '' )
                            <div class="profile-info-box col-xs-12 col-md-12">
                                <p class="info-label col-xs-12 col-md-4">Bedrijf:</p>
                                <p class="info-text col-xs-12 col-md-8">{{ $profile->company }}.</p>
                            </div>
                            @endif

                            @if( $email != '' )
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">E-mail:</p>
                                    <p class="info-text col-xs-12 col-md-8"><a href="{{ $email }}">{{ $email }}</a></p>
                                </div>
                            @endif

                              @if ($role == 'college')
                                <div class="profile-info-box col-xs-12 col-md-12">
                                  <h2 class="info-label col-md-12">Contactpersoon:</h2>
                                </div>

                                <div class="profile-info-box col-xs-12 col-md-12">
                                  <p class="info-label col-xs-12 col-md-4">Voornaam:</p>
                                  <p class="info-text col-xs-12 col-md-8">{{ $profile->first_name }}</p>
                                </div>

                                <div class="profile-info-box col-xs-12 col-md-12">
                                  <p class="info-label col-xs-12 col-md-4">Achternaam:</p>
                                  <p class="info-text col-xs-12 col-md-8">{{ $profile->last_name }}</p>
                                </div>
                              @endif

                            @if( $profile->telephone_number != '' )
                            <div class="profile-info-box col-xs-12 col-md-12">
                                <p class="info-label col-xs-12 col-md-4">Telefoon:</p>
                                <p class="info-text col-xs-12 col-md-8">0{{ $profile->telephone_number  }}</p>
                            </div>
                           @endif

                            @if( $profile->mobile_number != '' )
                            <div class="profile-info-box col-xs-12 col-md-12">
                                <p class="info-label col-xs-12 col-md-4">Mobiel:</p>
                                <p class="info-text col-xs-12 col-md-8">0{{ $profile->mobile_number }}</p>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

                @include('pages.profile_analyses')
            @endforeach
        </div>
    </div>
@endsection