@extends('layouts.app')

@section('title', $conference->name )

@section('content')

<div class="container">
  @if (session('joined'))
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Registered!</div>
        <div class="panel-body">
          <h3 class="text-center">
            <strong><i class="fa fa-check"></i></strong>
            Congratulations! You're registered to <strong>{{$conference->name}}</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Conference details</div>

        <div class="panel-body">
          <h1 class="text-capitalize">{{$conference->name}} Conference</h1> </br>
          <p class="text-left"><strong>Description:</strong> {{$conference->description}}</p>
          <p class="text-left"><strong>Capacity:</strong>    {{$conference->capacity}}</p>
          <p class="text-left"><strong>Start Time:</strong>  {{$conference->start}}</p>
          <p class="text-left"><strong>End Time:</strong>    {{$conference->end}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
