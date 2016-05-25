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
                <form action="{{ url('registreer/administrator') }}" method="post" class="col-md-4 col-md-offset-4 col-xs-12 col-xs-push-0">
                    {!! csrf_field() !!}
                    <h1 class="title">Registreer als: Student</h1>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="ov_number">OV Nummer:</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="OV Nummer" name="ov_number">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" class="form-control" autocomplete="off" placeholder="Wachtwoord" name="password">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="college_id">School:</label>
                    <select autocomplete="off" name="college_id" id="college" placeholder="School" class="form-control">
                        @foreach ($colleges as $college)
                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" autocomplet="off" placeholder="Email" name="email">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="first_name">Naam:</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="Naam" name="first_name">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="last_name">Achternaam:</label>
                    <input type="text" class="form-control" autocomplete="off" placeholder="Achternaam" name="last_name">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>
            </form>
        </div>
    </div>
@endsection