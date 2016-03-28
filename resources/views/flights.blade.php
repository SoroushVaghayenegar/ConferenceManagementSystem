@extends('layouts.app')

@section('title', 'Flights')

@section('content')
<!--overview start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-plane"></i>Flights</h3>
    </div>
</div>

<div class="container">

  <div class="panel panel-dark" >
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Current Conferences</strong></a></li>
            <li><a data-toggle="tab" href="#pastConferences"><strong>Past Conferences</strong></a></li>
        </ul>
		
		<div class="tab-content">
            <div id="currentConferences" class="tab-pane fade in active">
                <div class="panel-body">
                    <h3 style="color:#ff4d4d">Choose conference:</h3>
                    
					<strong>
                        <select class="form-control" style="background-color: #006bb3; color:#d9d9d9">
                            @if (count($current_conferences) > 0)
                                @foreach ($current_conferences as $current_conference)
                                    <option value="{{$current_conference->id}}">{{$current_conference->name}}</option>
                                @endforeach
                            @else
                                <option>No conferences available!</option>
                            @endif
                        </select>
                    </strong>
                    <h3 align="center" style="color:white"><strong>Participants flight details</strong></h3>
                    <table id="participants_table_current" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Flight No</th>
								<th>Arrival date</th>
								<th>Arrival time</th>
								<th>Taxi requested</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (isset($attendees))
                        @foreach ($attendees as $attendee)
                            <tr>
                                <td>{{$attendee->name}}</td>
                                <td>{{$attendee->flight ? $attendee->flight : "N/A"}}</td>
								<td>{{$attendee->arrival_date ? $attendee->arrival_date : "N/A"}}</td>
								<td>{{$attendee->arrival_time ? $attendee->arrival_time : "N/A"}}</td>
                                <td>{{$attendee->taxi_requested ? "Yes": "No"}}</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="pastConferences" class="tab-pane fade">
                <div class="panel-body">
                    <h3 style="color:#ff4d4d">Choose conference:</h3>
                    <strong>
                        <select class="form-control" style="background-color: #006bb3; color:#d9d9d9">
                            @if (count($past_conferences) > 0)
                                @foreach ($past_conferences as $past_conference)
                                    <option>{{$past_conference->name}}</option>
                                @endforeach
                            @else
                                <option>No conferences available!</option>
                            @endif
                        </select>
                    </strong>
                    <h3 align="center" style="color:white"><strong>Participants flight details</strong></h3>
                    <table id="participants_table_past" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Flight No</th>
								<th>Arrival date</th>
								<th>Arrival time</th>
								<th>Taxi requested</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (isset($attendees))
                        @foreach ($attendees as $attendee)
                            <tr>
                                <td>{{$attendee->name}}</td>
                                <td>{{$attendee->flight ? $attendee->flight : "N/A"}}</td>
								<td>{{$attendee->arrival_date ? $attendee->arrival_date : "N/A"}}</td>
								<td>{{$attendee->arrival_time ? $attendee->arrival_time : "N/A"}}</td>
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


<script type="text/javascript">
  
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
	$('#sidebar-flights').attr('class','active');
  })

  $('#option_current').click(function(){

  });

  $('#option_past').click(function(){

  });
</script>  

@endsection
