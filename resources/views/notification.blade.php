@extends('layouts.app')

@section('title', 'Notification')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-archive"></i>Notification</h3>
        </div>
</div>
<div class="container">
  @if (session('notification_sent'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        Notification Sent
      </h4>
    </div>
  </div>
  @endif

  <a href="{{ URL::to('manage_conferences') }}" id="back" class="btn btn-backToC"><i class="fa fa-arrow-left"></i>  Go back to Conferences</a>
  @if(Auth::user()->is_admin)
    <div class="panel panel-default" >
      <header class="panel-heading">
        Notification
      </header>

      <div class="panel-body">
        <div class="row">
          <span class="h4 col-md-2">
            <strong>Select a conference</strong>
          </span>

          <div class="col-md-6">
            <select id="conference_selector" class="form-control">
              <option value="#">Select a conference</option>
              @if (count($conferences) > 0)
              @foreach ($conferences as $conference)
              @if (isset($current) && $conference->id == $current)
              <option value="/notification/conference/{{$conference->id}}" selected>{{$conference->name}}</option>
              @else
              <option value="/notification/conference/{{$conference->id}}">{{$conference->name}}</option>
              @endif
              @endforeach
              @else
              <option>No conferences available!</option>
              @endif
            </select>
          </div>

          {{-- <div class="col-md-2">
            @if (isset($current))
            <button class="btn btn-primary" onclick="window.location.href = '/conference/{{$current}}/create_hotel'">Create hotel</button>
            @else
            <button class="btn btn-primary" disabled>Select a conference</button>
            @endif
          </div> --}}
        </div>
      </div>
    </div>
  @endif
  
  @if(!Auth::user()->is_admin)
    <h1 align='center'> <strong>{{$conferenceName}}</strong></h1>
  @endif
  
  @if (isset($current))
  <div class="panel panel-default" >
    <header class="panel-heading">
      Message
    </header>

    <div class="panel-body">
      <div class="row">

        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Conference Form -->
        <form action="{{ url('/notification/conference/'.$current) }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}

          <!-- Title -->
          <div class="form-group">
            <label class="col-md-4 control-label" class="control-label"> Title</label>

            <div class="col-md-6">
              <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
          </div>

          <!-- Message -->
          <div class="form-group">
            <label class="col-md-4 control-label" class="control-label"> Message</label>

            <div class="col-md-6">
              <textarea rows="8" name="notification" id="conference-description" class="form-control" value="{{ old('message') }}"></textarea>
            </div>
          </div>

          <!-- Add Conference Button -->
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-default">
                <i class="fa fa-envelope"></i>Send Message
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
</div>

<script>
var onChangeHandler = function () {
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
    window.location = url; // redirect
  }
  return false;
}

$('#conference_selector').on('change', onChangeHandler);

$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-notification').attr('class','active');

  
  var oldURL = document.referrer.split("/").pop();
  if(oldURL == "manage_conferences")
    document.getElementById("back").style.visibility = "visible" ;
  
  @if(!Auth::user()->is_admin)
    document.getElementById("back").style.visibility = "visible" ;
  @endif

})

</script>

@endsection
