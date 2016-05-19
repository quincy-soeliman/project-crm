@extends('layouts.app');

@section('content');

<div class="container">
  <div class="row">
    <form action="{{ url('register/teacher') }}" method="post">
      {!! csrf_field() !!}

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Wachtwoord:</label>
        <input type="password" class="form-control" name="password" required>
      </div>

      <div class="form-group">
        <label for="first_name">Voornaam:</label>
        <input type="text" class="form-control" name="first_name" required>
      </div>

      <div class="form-group">
        <label for="last_name">Achternaam:</label>
        <input type="text" class="form-control" name="last_name" required>
      </div>

      <div class="form-group">
        <label for="telephone_number">Telefoonnummer:</label>
        <input type="number" class="form-control" name="telephone_number">
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-primary">Registreer</button>
      </div>

    </form>
  </div>
</div>

@endsection