@extends('layouts.app');

@section('content')

    <div class="container">
        <div class="row">
            <form action="{{ url('registreer/school') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">School naam:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="text" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>
                
            </form>
        </div>
    </div>

@endsection