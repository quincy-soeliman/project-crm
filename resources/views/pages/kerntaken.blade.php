@extends('layouts.app')

@section('content')

    @include('layouts.navigation')

    <div class="profile container">
        <div class="row">
            @if( session('status') )
                <div class="message">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            <div class="head col-xs-12 col-md-12">
                <div class="no-padding col-xs-12 col-md-12">
                    <h1 class="title">Kerntaak toevoegen</h1>
                </div>
            </div>
            <div class="kerntaak-form col-xs-12 col-md-12">
                <form action="{{ url('/kerntaak') }}" method="POST">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    
                    <div class="form-group col-xs-12 col-md-12">
                        <label for="first_name">Kerntaak titel:</label>
                        <input type="text" class="form-control" autocomplete="off" name="first_name" placeholder="Kerntaak titel">
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Aanmaken</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection