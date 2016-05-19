@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <form action="{{ url('registreer/administrator') }}">
                {{!! csrf_fields() !!}}

                <div class="form-group">
                    <label for="first_name">Voornaam:</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Achternaam:</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="telephone_number">Telefoonnummer:</label>
                </div>

            </form>
        </div>
    </div>

@endsection