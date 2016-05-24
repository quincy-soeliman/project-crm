@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="message">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <div class="message">
        <p>{{ session('status') }}</p>
    </div>

    @foreach ($data as $profile)
        <p>{{ $profile }}</p>
    @endforeach
@endsection