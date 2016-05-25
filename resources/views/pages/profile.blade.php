@extends('layouts.app')

@section('content')
    <div class="message">
        <p>{{ session('status') }}</p>
    </div>

    @foreach ($data as $profile)
        <p>{{ $profile }}</p>
    @endforeach
@endsection