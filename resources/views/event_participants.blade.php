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
    <header class="panel-heading">Participants</header>
    <div class="panel-body">
      <div class="row">
        <span class="h4 col-md-2">
          <strong>Select a conference</strong>
        </span>
		<button type="button" class="btn btn-default" id="print">Print Participants List</button>


        <div class="col-md-6">


        </div>
      </div>

      @if (isset($availableCapacity))
      <div class="row">
        <span class="h5 col-md-3">
          <strong>Available seats (Unapproved):</strong>
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
            <th>Flight No</th>
            <th>Arrival time</th>
            <th>Hotel needed</th>
            <th>Taxi needed</th>
            <th>Approved</th>
            <th>Hotel room</th>
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
            <td>{{$attendee->arrival_date ? date('F d, Y', strtotime($attendee->arrival_date)) : "N/A"}}<br>
            {{$attendee->arrival_time ? date('h:i A', strtotime($attendee->arrival_time)) : "N/A"}}</td>
            <td>{{$attendee->hotel_requested ? "Yes": "No"}}</td>
            <td>{{$attendee->taxi_requested ? "Yes": "No"}}</td>
            <td>{{$attendee->approved? "Yes": "No"}}
              @if (isset($attendee->approved) && $attendee->approved)
              <button class="btn btn-sm btn-danger" onclick="unapprove({{$attendee->id}})">Unapprove</button>
              @else
              <button class="btn btn-sm btn-default" onclick="approve({{$attendee->id}})">Approve</button>
              @endif
            </td>
            <td>
              @if (isset($attendee->hotel))
              <strong>{{$attendee->hotel->name}}</strong>
              <br>
              Room {{$attendee->hotel->room}}
              @else
              <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal" data-participant="{{$attendee->id}}">Assign</a>
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









@endsection