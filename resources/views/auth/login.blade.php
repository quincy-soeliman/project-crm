@extends('layouts.app')

@section('content')
<div class="background">
    <div class="color-overlay"></div>
    <div class="background-image"></div>
</div>
<div class="container login-container">
    <div class="row">
        <div class="login-screen col-md-4 col-md-offset-4 col-xs-12 col-xs-push-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="message">
                            <p>{{ session('status') }}</p>
                        </div> 
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="role-select col-md-12 col-xs-12">
                                <label for="role">Login als:</label>
                                <select name="role" id="role">
                                    <option value="student">Student</option>
                                    <option value="teacher">Docent</option>
                                    <option value="reviewer">Beoordelaar</option>
                                    <option value="school">School</option>
                                    <option value="company">Bedrijf</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="login-link password-reset col-md-6 col-xs-6">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                            <div class="login-link register col-md-6 col-xs-6">
                                <a class="btn btn-link" href="{{ url('/registreer') }}">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
