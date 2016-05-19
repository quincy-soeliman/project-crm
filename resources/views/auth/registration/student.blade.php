@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ url('registreer/student') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="ov_number">OV Nummer:</label>
                    <input type="text" class="form-control" name="ov_number">
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label for="first_name">Naam:</label>
                    <input type="text" class="form-control" name="first_name">
                </div>

                <div class="form-group">
                    <label for="last_name">Achternaam:</label>
                    <input type="text" class="form-control" name="last_name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>
            </form>
        </div>
    </div>
@endsection