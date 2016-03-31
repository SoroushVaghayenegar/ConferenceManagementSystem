@extends('layouts.app')

@section('title', 'Edit event')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Join Event</div>

        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')

          <h1 class="text-capitalize">{{$specific_event->name}} Event</h1> </br>
          <p class="text-left"><strong>Description:</strong>  {{$specific_event->topic}} <strong>Capacity:</strong>  {{$specific_event->capacity}}</p>
          <p class="text-left"><strong>Start:</strong>   {{date('F d, Y', strtotime($specific_event->start))}} <strong>End:</strong>    {{date('F d, Y', strtotime($specific_event->end))}}</p>

          <form action="/event/{{$specific_event->id}}/join_event" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <p class="text-center">
              <strong>Register</strong>
            </p>

            <p class="text-left"><strong>Please check who in your group is registering:</strong></p>


            <p class="text-left">
              <label>
                @foreach ($participants as $participant)
                <input type="checkbox" name="participants[]" value="{{$participant->id}}" style="margin-right: 5px">{{$participant->name}}</input>
                @endforeach
              </label>
            </p>
              <button type="submit" class="btn btn-default pull-right">Submit</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>






@endsection
