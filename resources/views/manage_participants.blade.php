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
  <div class="panel panel-dark" >
    <div class="tab-content">
      <div id="currentConferences" class="tab-pane fade in active">
        <div class="panel-body">
          <select id="current_conferences" class="form-control" style="background-color: #006bb3; color:#d9d9d9">
            <option value="#">Select a conference</option>
            @if (count($conferences) > 0)
            @foreach ($conferences as $conference)
            <option value="/conference/{{$conference->id}}/participants">{{$conference->name}}</option>
            @endforeach
            @else
            <option>No conferences available!</option>
            @endif
          </select>
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
                <th>Hotel requested</th>
                <th>Taxi requested</th>
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
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
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

</script>
@endsection
