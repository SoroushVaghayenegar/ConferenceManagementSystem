@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> Manage Event Participants</h3>
  </div>
</div>


  <div class="container">

@if(!Auth::user()->is_admin)
  <a href="javascript: history.go(-1)" id="back" class="btn btn-backToC"><i class="fa fa-arrow-left"></i>  Go back to Conferences</a>
@endif


  @if (session('approved') || session('unapproved') || session("hotel_assigned"))
  <div class="alert alert-success" id="success-alert">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        @if (session('approved'))
        The participant is <strong>approved</strong>.
        @elseif (session('unapproved'))
        The participant is <strong style="color:red">unapproved</strong>.
        @elseif (session('hotel_assigned'))
        The participant has been assigned with a hotel room.
        @endif
      </h4>

  </div>
  @endif
  <div class="panel panel-default">
    <header class="panel-heading">Event Participants</header>
    <div class="panel-body">
      <div class="row">
        <span class="h4 col-md-4">
          <h2><strong>{{$event->name}}</strong></h2>
        </span>
		<button type="button" class="btn btn-default" id="print">Print Participants List</button>


        <div class="col-md-6">


        </div>
      </div>

      @if (isset($availableCapacity))
      <div class="row">
        <span class="h5 col-md-3">
          <strong>Available seats:</strong>
        </span>
          <div class="h4 col-md-1">
              @if($availableCapacity > 10)
                <strong class="table-text" style="color:#00e600">{{ $availableCapacity }}</strong>
              @else
                <strong class="table-text" style="color:red">{{ $availableCapacity }}</strong>
              @endif
          </div>
      </div>
      @endif
      <h3 style="color:white; text-align: center"><strong>Participants</strong></h3>
      <table id="participants_table_current" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Phone No</th>
            <th>Approved</th>
            <th>Hotel room</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($attendees))
          @foreach ($attendees as $attendee)
          <?php
 
          $participant = $conference_attendees->where('id',$attendee->participant_id)->first();
      
          ?>
          <tr>
            <td>{{$participant->name}}</td>
            <td>{{$participant->age}}</td>
            <td>{{$participant->phone}}</td>
            <td>{{$participant->approved? "Yes": "No"}}
              @if (isset($participant->approved) && $participant->approved)
              <button class="btn btn-sm btn-danger" onclick="unapprove({{$participant->id}})">Unapprove</button>
              @else
              <button class="btn btn-sm btn-default" onclick="approve({{$participant->id}})">Approve</button>
              @endif
            </td>
            <td>
              @if (isset($participant->hotel))
              <strong>{{$participant->hotel->name}}</strong>
              <br>
              Room {{$participant->hotel->room}}
              @else
              <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal" data-participant="{{$participant->id}}">Assign</a>
              @endif
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" style="left: auto !important;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">
                <i class="fa fa-bed"></i>
                Assign Hotel
              </h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Hotel name</th>
                    <th>Room number</th>
                    <th>Room type</th>
                    <th>Capacity</th>
                    <th>Remaining</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="hotel-list">
                    <!-- to be populated by AJAX -->
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div>
  </div>
</div>


<script>

@if(!Auth::user()->is_admin)
  $(document).ready(function(){
    var oldURL = document.referrer.split("/").pop();
    if(oldURL == "manage_conferences")
      document.getElementById("back").style.visibility = "visible" ;
    
  });
@endif
//  Script for running DataTable -->
$(function(){
  $("#participants_table_current").DataTable();
})

$('#modal').on('show.bs.modal', function (e) {
  @if (!isset($current))
  return;
  @else
  var url = "/conference/" + {{$current}} + "/hotels-json"
  @endif

  var participantId = $(e.relatedTarget).data('participant');

  $.getJSON(url, function (data, status, xhr) {
    populateHotels(data, participantId);
  });
})

function populateHotels(data, id) {
  // First empty the table
  $("#hotel-list").empty();

  for (var i = 0; i < data.length; i++) {
    var hotel = data[i];
    if (hotel.remaining < 1)
      continue;
    var template = "<tr><td>"+hotel.name+"</td><td>"+hotel.room+
    "</td><td>"+hotel.type+"</td>" + "<td>"+hotel.capacity+"</td><td>"+
    hotel.remaining+"</td><td>"+
    "<button class='btn btn-default btn-sm' onclick='selectHotel("+hotel.id+","+id+")'>Select</button></td></tr>";

    $("#hotel-list").prepend(template);
  }
}

function selectHotel(id, participant) {
  @if (!isset($current))
  return;
  @else
  window.location = "/conference/" + {{$current}} + "/participant/" + participant + "/assign-hotel/" + id;
  @endif
}

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


$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
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

function printData()
{
   var table=document.getElementById("participants_table_current");
   newWin= window.open("");
   newWin.document.write(table.outerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})
</script>







@endsection