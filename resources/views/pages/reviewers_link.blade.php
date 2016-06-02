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
          <h1 class="title">Koppel KT/WP</h1>
        </div>
      </div>
      <div class="add-form col-xs-12 col-md-12">
        <form action="{{ url('beoordelaars/koppeling/' . $id) }}" method="POST">
          {{ csrf_field() }}

          @foreach( $coretasks as $coretask )
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
            <button type="submit" class="btn btn-primary">Koppel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection