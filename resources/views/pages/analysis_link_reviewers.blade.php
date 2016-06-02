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
                    <h1 class="title">Koppelen van analyses</h1>
                </div>
            </div>
            <div class="update col-xs-12 col-md-12">
                <form action="{{ url('/analyses/' . $id . '/beoordelaars') }}" method="POST">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    
                    <div class="form-group col-xs-12 col-md-12">
                        <label for="reviewers">Beoordelaars:</label>
                        <select autocomplete="off" name="reviewers[]" id="reviewer" placeholder="School"
                                class="form-control" multiple="multiple" value="">
                            @foreach ($reviewers as $reviewer)
                                <option value="{{ $reviewer->id }}">{{ $reviewer->first_name }} {{ $reviewer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Bijwerken</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection