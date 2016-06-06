@extends('layouts.app')

@section('content')
<div class="background">
    <div class="color-overlay"></div>
    <div class="background-image"></div>
</div>
<div class="container success-register-container">
    <div class="row">
        <div class="success-register col-md-4 col-md-offset-4 col-xs-12 col-xs-push-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-xs-12 col-md-12">
                        <h1>Uw account is geregistreerd!</h1>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <p>Uw account moet nog geactiveerd worden door het administrator voordat deze gebruikt kan worden.</p>
                        <p>Over 3 seconden wordt u doorgestuurd naar het login pagina.</p>
                    </div>
                    <?php header( "refresh:3;url=/login" ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
