@extends('layouts.app')

@section('title', $conference->name )

@section('content')

<div class="container">
  @if(Auth::user())
  @if (session('joined'))
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Registered!</div>
        <div class="panel-body">
          <h3 class="text-center">
            <strong><i class="fa fa-check"></i></strong>
            Thank you! You're registered to <strong>{{$conference->name}}</strong>
          </h3>
          <p class="text-center">
            Your request is pending approval from an administrator. You will be notified via email.
          </p>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endif
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Conference details</div>

        <div class="panel-body">
            <h1 class="text-capitalize">{{$conference->name}} Conference</h1> </br>
            <p class="text-left"><strong>Description:</strong> {{$conference->description}}</p>
            <p class="text-left"><strong>Capacity:</strong>    {{$conference->capacity}}</p>
            <p class="text-left"><strong>Start Time:</strong>  {{ date('F d, Y', strtotime($conference->start)) }}</p>
            <p class="text-left"><strong>End Time:</strong>    {{ date('F d, Y', strtotime($conference->end)) }}</p>
            @if(Auth::user())
              <a class="btn btn-default" href="/directory">Back</a>
            @else
              <a class="btn btn-default" href="/home">Back</a>
            @endif
            @if(Auth::user())
            @if(!isset($registration))
              @if(isset($is_past))
                <a class="btn btn-default pull-right" href="/conference/{{$conference->id}}/join" disabled>Register</a>
              @else
                <a class="btn btn-danger pull-right" href="/conference/{{$conference->id}}/join">Register</a>
              @endif
            @endif
            @endif
        </div>
      </div>
    </div>
  </div>
  @if(Auth::user())
  @if(isset($registration))
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Your registration</div>

        <div class="panel-body">
          @foreach ($registration as $index => $participant)
          <p><strong>Participant {{$index+1}}</strong></p>
          <?php 
          $user = $conference->attendees()->where('participant_id', $participant->id)->first()->pivot;
          ?>
            @if($participant['primary_user'])
            <p>Name: {{Auth::user()->name}}</p>
            @else
            <p>Name: {{$participant['name']}}</p>
            @endif
            <p>Flight: {{$user['flight']}}</p>
			<p>Arrival date: {{$user['arrival_date']}}</p>
			<p>Arrival time: {{$user['arrival_time']}}</p>
            <p>Hotel requested: {{$participant['hotel']?'Yes':'No'}}</p>
            <p>Taxi requested: {{$participant['taxi']?'Yes':'No'}}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif
  @endif
</div>
@endsection
