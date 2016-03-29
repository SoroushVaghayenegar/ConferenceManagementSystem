@extends('layouts.app')

@section('title', 'Manage Participants')

@section('content')
<!--overview start-->
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> Manage Participants</h3>
  </div>
</div>

<div class="container">

  @if (session('approved') || session('unapproved'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        @if (session('approved'))
        The participant is approved.
        @elseif (session('unapproved'))
        The participant is unapproved.
        @endif
      </h4>
    </div>
  </div>
  @endif
  <div class="panel panel-default">
    <header class="panel-heading">Participants</header>
    <div class="panel-body">
      <div class="row">
        <span class="h4 col-md-2">
          <strong>Select a conference</strong>
        </span>


        <div class="col-md-6">
          <select id="current_conferences" class="form-control">
            <option value="#">Select a conference</option>
            @if (count($conferences) > 0)
            @foreach ($conferences as $conference)
            @if ($conference->id == $current)
            <option value="/conference/{{$conference->id}}/participants" selected>{{$conference->name}}</option>
            @else
            <option value="/conference/{{$conference->id}}/participants">{{$conference->name}}</option>
            @endif
            @endforeach
            @else
            <option>No conferences available!</option>
            @endif
          </select>
        </div>
      </div>
      <h3 style="color:white; text-align: center"><strong>Participants</strong></h3>
      <table id="participants_table_current" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Phone No</th>
            <th>Flight No</th>
            <th>Arrival date</th>
            <th>Arrival time</th>
            <th>Hotel needed</th>
            <th>Taxi needed</th>
            <th>Approved</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @if (isset($attendees))
          @foreach ($attendees as $attendee)
          <tr>
            <td>{{$attendee->name}}</td>
            <td>{{$attendee->age}}</td>
            <td>{{$attendee->phone}}</td>
            <td>{{$attendee->flight ? $attendee->flight : "N/A"}}</td>
            <td>{{$attendee->arrival_date ? $attendee->arrival_date : "N/A"}}</td>
            <td>{{$attendee->arrival_time ? $attendee->arrival_time : "N/A"}}</td>
            <td>{{$attendee->hotel_requested ? "Yes": "No"}}</td>
            <td>{{$attendee->taxi_requested ? "Yes": "No"}}</td>
            <td>{{$attendee->approved? "Yes": "No"}}</td>
            @if (isset($attendee->approved) && $attendee->approved)
            <td><button class="btn btn-sm btn-danger" onclick="unapprove({{$attendee->id}})">Unapprove</button></td>
            @else
            <td><button class="btn btn-sm btn-default" onclick="approve({{$attendee->id}})">Approve</button></td>
            @endif
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
//  Script for running DataTable -->
$(function(){
  $("#participants_table_current").dataTable();
})
$(function(){
  $("#participants_table_past").dataTable();
})

// Make the sidebar active
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-manageParticipants').attr('class','active');
})

var onChangeHandler = function () {
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
    window.location = url; // redirect
  }
  return false;
}
$('#past_conferences').on('change', onChangeHandler);
$('#current_conferences').on('change', onChangeHandler);

$('#option_current').click(function(){

});

$('#option_past').click(function(){

});

var approve = function (id) {
  @if (!isset($current))
  return;
  @else
  window.location = "/approve/conference/" + {{$current}} + "/participant/" + id;
  @endif
}

var unapprove = function (id) {
  @if (!isset($current))
  return;
  @else
  window.location = "/unapprove/conference/" + {{$current}} + "/participant/" + id;
  @endif
}

</script>
@endsection
