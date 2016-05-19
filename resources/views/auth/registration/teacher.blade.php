@extends('layouts.app');

@section('content');

<div class="container">
  <div class="row">
    <form action="{{ url('register/student') }}" method="post">
      {!! csrf_field() !!}

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
      </div>

      <div class="form-group">
        <label for="first_name">First name:</label>
        <input type="text" class="form-control" name="first_name" required>
      </div>

      <div class="form-group">
        <label for="last_name">Last name:</label>
        <input type="text" class="form-control" name="last_name" required>
      </div>

      <div class="form-group">
        <label for="telephone_number">Telephone number:</label>
        <input type="number" class="form-control" name="telephone_number">
      </div>

    </form>
  </div>
</div>

@endsection