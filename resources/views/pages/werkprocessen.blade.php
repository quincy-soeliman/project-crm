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
                    <h1 class="title">Werkprocessen toevoegen</h1>
                </div>
            </div>
            <div class="add-form col-xs-12 col-md-12">
                @foreach( $coretasks as $coretask )
                    <div class="whole-container col-xs-12 col-md-12">
                        <h1 class="trigger-dropdown" toslidedown=".add-workprocess-form">{{ $coretask->title }}</h1>
                        <div class="add-workprocess-form col-xs-12 col-md-12">
                            {{--<div class="col-md-12 col-xs-12">
                                <h3 class="headline-title">
                                    Werkprocessen van {{ $coretask->title }}:
                                </h3>
                            </div>--}}
                            <div class="existing-workprocesses-container col-xs-12 col-md-12">
                                @foreach( $workprocesses as $workprocess )
                                    @if( $workprocess->coretask_id === $coretask->id )
                                        <h2>{{ $workprocess->title }}</h2>
                                        <p>{{ $workprocess->description }}</p>
                                    @endif
                                @endforeach
                            </div>
                            {{--<div class="col-md-12 col-xs-12">
                                <h3 class="headline-title">
                                    Voeg één werkprocess toe:
                                </h3>
                            </div>--}}
                            <form action="{{ url('/werkproces') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group col-xs-12 col-md-12">
                                    <input type="hidden" class="form-control" autocomplete="off" name="coretask_id" value="{{ $coretask->id }}">
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="title">Werkprocess titel:</label>
                                    <input type="text" class="form-control" autocomplete="off" name="title" placeholder="Werkprocess titel">
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="description">Werkprocess beschrijving:</label>
                                    <textarea type="text" class="form-control" autocomplete="off" name="description" placeholder="Werkprocess beschrijving"></textarea>
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection