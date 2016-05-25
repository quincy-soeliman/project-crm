@extends('layouts.app')

@section('content')
    @if ($request->cookie('status'))
        {{ $request->cookie('status') }}
    @endif
@endsection