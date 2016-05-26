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
                <form action="{{ url('registreer/bedrijf') }}" method="post" class="col-md-4 col-md-offset-4 col-xs-12 col-xs-push-0">
                    {!! csrf_field() !!}
                    <h1 class="title">Registreer als: Bedrijf</h1>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="name">Naam<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Naam" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="email">Email<span class="red">*</span>:</label>
                    <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="password">Wachtwoord<span class="red">*</span>:</label>
                    <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Wachtwoord" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="address">Adres<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="address" placeholder="Adres" required>
                </div>

                <div class="form-group col-xs-6 col-md-6">
                    <label for="zip_code">Postcode<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="zip_code" placeholder="Postcode" required>
                </div>

                <div class="form-group col-xs-6 col-md-6">
                    <label for="iso_number">ISO nummer<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="iso_number" placeholder="ISO nummer" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="telephone_number">Telefoonnummer:</label>
                    <input type="number" class="form-control" autocomplete="off" name="telephone_number" placeholder="Telefoonnummer">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>

            </form>
        </div>
    </div>

@endsection