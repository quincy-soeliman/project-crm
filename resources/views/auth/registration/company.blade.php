@extends('layouts.app')

@section('content')
    <div class="background">
        <div class="color-overlay"></div>
        <div class="background-image"></div>
    </div>
    <div class="register-container container">
        <div class="row">
            <form action="{{ url('registreer/bedrijf') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="address">Adress:</label>
                    <input type="text" class="form-control" name="address" required>
                </div>

                <div class="form-group">
                    <label for="zip_code">Postcode:</label>
                    <input type="text" class="form-control" name="zip_code" required>
                </div>

                <div class="form-group">
                    <label for="telephone_number">Telefoonnummer:</label>
                    <input type="number" class="form-control" name="telephone_number">
                </div>

                <div class="form-group">
                    <label for="iso_number">ISO nummer:</label>
                    <input type="text" class="form-control" name="iso_number" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>

            </form>
        </div>
    </div>

@endsection