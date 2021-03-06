@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference')

@section('loginButton')
<li><a href="{{ URL::to('login') }}" class="btn btn-primary" style="color:white;">Login!</a></li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style='opacity:0.9'>
                <div class="panel-heading">
                    <h1 style="text-align: center;">Welcome to Gobind Sarvar Conferences!</h1>
                </div>

                <div class="panel-body">
                    <img src="GobindSarvar.jpg" alt="Gobind Sarvar Logo" style="position:relative;width:30%;left:35%;" align="center">
                    <h2 style="text-align: center;">Don't have an account?</h2>
                    <a href="{{ URL::to('register') }}" class="btn btn-success" style="position:relative;left: 40%;font-size: 200%;">Sign Up Here!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
