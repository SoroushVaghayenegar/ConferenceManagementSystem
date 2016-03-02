@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference')

<!--@section('loginButton')
<li><a href="{{ URL::to('login') }}" class="btn btn-primary" style="color:white;">Login!</a></li>
@endsection -->

@if(Auth::check())
@section('content')           
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-home"></i> Home</h3>
            </div>
        </div>
              
        <h1 align='center'>NEWS HERE</h1>    

@endsection
@else
@section('content')
<!-- <div class="container"> -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style='opacity:0.9'>
                <div class="panel-heading">
                    <h1 style="text-align: center;">Welcome to Gobind Sarvar Conferences!</h1>
                </div>

                <div class="panel-body">
                    <img src="GobindSarvar.jpg" alt="Gobind Sarvar Logo" style="position:relative;width:30%;left:35%;" align="center">
                    <h3 style="text-align: center;">Don't have an account?</h3>
                    <a href="{{ URL::to('register') }}" class="btn btn-success" style="position:relative;left: 38%;">Create a new account</a>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection
@endif 