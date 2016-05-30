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
                        <h1 class="title">{{ $profile->first_name }} {{ $profile->last_name }} {{ $profile->name }}</h1>
                        @if( $profile->ov_number != '' )
                            <h2 class="sub-title">OV nummer: {{ $profile->ov_number }}</h2>
                        @endif
                    </div>
                    <div class="edit-link no-padding col-xs-2 col-md-2">
                        @if( Auth::id() == $profile->user_id )
                            <a href="{{ url( 'profiel/' . $profile->user_id . '/bewerk' ) }}">Profiel bewerken</a>
                        @endif
                    </div>
                </div>
                <div class="info col-xs-12 col-md-12">
                    {{-- @if( $profile->reviewer_id != '' ) --}}
                        <div class="reviewers col-xs-12 col-md-12">
                            <h3 class="headline-title">
                                Beoorderlaar:
                            </h3>
                            <ul class="reviewers-list">
                                <li>
                                    <a href="{{ url('profile/reviewer_id') }}">- Quincy Soeliman</a>
                                </li>
                            </ul>
                        </div>
                    {{-- @endif --}}
                    <div class="additional-info col-xs-12 col-md-12">
                        <h3 class="headline-title">
                            Over {{ $role }}:
                        </h3>
                        <div class="no-padding col-xs-12 col-md-6">
                            
                            @if( $profile->college != '' )
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">School:</p>
                                    <p class="info-text col-xs-12 col-md-8"><a href="{{ '/profile/' . $profile->college_id }}">{{ $profile->college }}</a></p>
                                </div>
                            @endif
                            
                            {{--@if( $profile->company_id != '' )--}}
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">Bedrijf:</p>
                                    <p class="info-text col-xs-12 col-md-8">E.V.I.L Corporation inc.</p>
                                </div>
                            {{--@endif--}}
                            
                            @if( $email != '' )
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">E-mail:</p>
                                    <p class="info-text col-xs-12 col-md-8"><a href="{{ $email }}">{{ $email }}</a></p>
                                </div>
                            @endif
                            
                            {{--if( $profile->telephone_number != '' ) --}}
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">Telefoon:</p>
                                    <p class="info-text col-xs-12 col-md-8">+31 229 56 78 90</p>
                                </div>
                            {{-- @endif --}}
                            
                            {{--if( $profile->mobile_number != '' ) --}}
                                <div class="profile-info-box col-xs-12 col-md-12">
                                    <p class="info-label col-xs-12 col-md-4">Mobiel:</p>
                                    <p class="info-text col-xs-12 col-md-8">06589745631</p>
                                </div>
                            {{-- @endif --}}

                        </div>
                    </div>
                </div>
                @include('pages.profile_analyses')
            @endforeach
        </div>
    </div>
@endsection