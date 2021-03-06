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
                    <h1 class="title">Analyse toevoegen</h1>
                </div>
            </div>
            <div class="col-xs-12 col-md-12">
                <p>Klik op één van de kerntaken om de werkprocessen te selecteren. Vervolgens kan je onder het veld op werkprocessen klikken om één werkproces te selecteren. Het is mogelijk om dan nog een keer op het veld te klikken om meerdere werkprocessen toe te voegen.</p>
            </div>
            <div class="add-form col-xs-12 col-md-12">
                <form action="{{ url('analyses/aanmaken') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group col-xs-12 col-md-12">
                        <label for="title">Analyse titel:</label>
                        <input type="text" class="form-control" autocomplete="off" name="title"
                               placeholder="Analyse titel">
                    </div>

                    @foreach( $coretasks as $coretask )
                        <input type="hidden" name="coretasks[]" value="{{ $coretask->id }}">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group analyse-coretask-select col-xs-12 col-md-12">
                                <h1 class="trigger-dropdown" toslidedown=".analyse-workprocess-select">{{ $coretask->title }}</h1>
                                <div class="form-group analyse-workprocess-select col-xs-12 col-md-12">
                                    <label for="workprocesses">Werkprocessen:</label>
                                    <select autocomplete="off" name="workprocesses[]"
                                            class="analyse-workprocess-select-field" placeholder="Werkprocessen"
                                            class="form-control" multiple="multiple" style="width: 100%;">
                                        @foreach ($coretask->workprocesses()->get() as $workproces)
                                            <option value="{{ $workproces->id }}">{{ $workproces->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Aanmaken</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection