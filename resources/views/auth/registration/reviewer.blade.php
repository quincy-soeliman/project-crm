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
                    <h1 class="title">Registreer als: Beoordelaar</h1>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="email">Email<span class="red">*</span>:</label>
                    <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="password">Wachtwoord<span class="red">*</span>:</label>
                    <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Wachtwoord" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="first_name">Voornaam<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="first_name" placeholder="Voornaam" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="last_name">Achternaam<span class="red">*</span>:</label>
                    <input type="text" class="form-control" autocomplete="off" name="last_name" placeholder="Achternaam" required>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="company_id">Bedrijf<span class="red">*</span>:</label>
                    <select autocomplete="off" name="company_id" id="company" class="form-control" placeholder="Bedrijf" required>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label for="telephone_number">Telefoonnummer:</label>
                    <input type="text" class="form-control" autocomplete="off" name="telephone_number" placeholder="Telefoonnummer">
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Registreer</button>
                </div>
                
            </form>
        </div>
    </div>

@endsection