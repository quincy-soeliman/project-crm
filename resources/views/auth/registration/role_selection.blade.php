@extends('layouts.app')

@section('content')
    <div class="background">
        <div class="color-overlay"></div>
        <div class="background-image"></div>
    </div>
    <nav class="register-role-select-nav col-xs-12 col-md-12">
        <a href="{{ url('login') }}">Login</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="role-selection-container">
                <div class="role-selection col-xs-12 col-md-6 col-xs-push-0 col-md-push-3">
                    <h1 class="title">
                        Registreer als
                    </h1>
                    <div class="add-spacing col-xs-12 col-md-10 col-xs-push-0 col-md-push-1">

                        <a href="{{ url('registreer/student') }}">
                            <div class="role col-xs-6 col-md-3">
                                <div class="role-click-container col-xs-12 col-md-12">
                                    <i class="fa fa-graduation-cap"></i>
                                    <p>Student</p>
                                </div>
                            </div>                            
                        </a>

                        <a href="{{ url('registreer/docent') }}">
                            <div class="role col-xs-6 col-md-3">
                                <div class="role-click-container col-xs-12 col-md-12">
                                    <i class="fa fa-user"></i>
                                    <p>Docent</p>
                                </div>
                            </div>                            
                        </a>

                        <a href="{{ url('registreer/beoorderlaar') }}">
                            <div class="role col-xs-6 col-md-3">
                                <div class="role-click-container col-xs-12 col-md-12">
                                    <i class="fa fa-user"></i>
                                    <p>Beoorderlaar</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ url('registreer/bedrijf') }}">
                            <div class="role col-xs-6 col-md-3">
                                <div class="role-click-container col-xs-12 col-md-12">
                                    <i class="fa fa-building"></i>
                                    <p>Bedrijf</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection