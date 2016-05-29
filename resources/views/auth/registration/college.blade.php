@extends('layouts.app')

@section('content')
    <div class="background">
        <div class="color-overlay"></div>
        <div class="background-image"></div>
    </div>
    <nav class="register-role-select-nav col-xs-12 col-md-12">
        <a href="{{ url('login') }}">Login</a>
    </nav>
    <div class="register-container container">
        <div class="row">
            <div class="form-container">
                @if (session('status'))
                    <div class="message">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
                <form action="{{ url('registreer/school') }}" method="post"
                      class="col-md-4 col-md-offset-4 col-xs-12 col-xs-push-0">
                    {!! csrf_field() !!}
                    <h1 class="title">Registreer als: School</h1>

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="name">School naam<span class="red">*</span>:</label>
                        <input type="text" class="form-control" autocomplete="off" name="name" placeholder="School naam"
                               required>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="email">Email<span class="red">*</span>:</label>
                        <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email"
                               required>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="password">Wachtwoord<span class="red">*</span>:</label>
                        <input type="password" class="form-control" autocomplete="off" name="password"
                               placeholder="Wachtwoord" required>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Registreer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection