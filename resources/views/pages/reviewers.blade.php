@extends('layouts.app')

@section('content')

  @include('layouts.navigation')

  <div class="row">
    <div class="welcome-banner col-xs-12 col-md-12">
      <div class="image col-xs-12 col-md-12"></div>
      <div class="color col-xs-12 col-md-12"></div>
      <div class="title col-xs-12 col-md-12">
        <h1>Reviewers</h1>
      </div>
    </div>
  </div>

  <div class="container">
    @if (count($reviewers) > 0)
      <div class="row">
        <div class="header">
          <div class="col-md-4">
            <p>Beoordelaar:</p>
          </div>

          <div class="col-md-4">
            <p>Bedrijf:</p>
          </div>

          @if ($current_user->role = 'college')
            <div class="col-md-4">
              <p>Acties:</p>
            </div>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="reviewers">
          @foreach ($reviewers as $reviewer)

            <div class="col-md-4">
              <p>{{ $reviewer->first_name }} {{ $reviewer->last_name }}</p>
            </div>

            <div class="col-md-4">
              <p>{{ $reviewer->company }}</p>
            </div>

            @if ($current_user->role = 'college')
              <div class="col-md-4">
                <a href="{{ url('beoordelaars/koppeling/' . $reviewer->user_id) }}">
                  <button class="btn btn-primary">Voeg KT/WP toe</button>
                </a>
              </div>
            @endif

          @endforeach
        </div>
      </div>
    @endif
  </div>

@endsection