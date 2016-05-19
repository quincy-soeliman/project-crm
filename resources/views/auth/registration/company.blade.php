@extends('layouts.app');

@section('content')

    <div class="container">
        <div class="row">
            <form action="{{ url('registreer/bedrijf') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" class="form-control" name="field" required>
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