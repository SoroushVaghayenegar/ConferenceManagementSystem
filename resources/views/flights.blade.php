@extends('layouts.app')

@section('title', 'Flights')

@section('content')

<script src="/js/highcharts.js"></script>
<script src="/js/highcharts-3d.js"></script>
<script src="/js/exporting.js"></script>

<!--overview start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-plane"></i>Flights</h3>
    </div>
</div>

<div class="container">

  <div class="panel panel-default">
	<header class="panel-heading">Flights</header>
	<div class="panel-body">
	  <div class="row">
			<span class="h4 col-md-2">
			  <strong>Select a conference</strong>
			</span>
			<button type="button" class="btn btn-default" id="print">Print Report</button>
			<div class="col-md-6">
			  <select id="current_conferences" class="form-control">
				<option value="#">Select a conference</option>
				@if (count($conferences) > 0)
				@foreach ($conferences as $conference)
				@if ($conference->id == $current)
				<option value="/conference/{{$conference->id}}/flights" selected>{{$conference->name}}</option>
				@else
				<option value="/conference/{{$conference->id}}/flights">{{$conference->name}}</option>
				@endif
				@endforeach
				@else
				<option>No conferences available!</option>
				@endif
			  </select>
			</div>
		</div>
		<h3 style="color:white; text-align: center"><strong>Participants</strong></h3>
		<table id="participants_table_current" class="table table-display nowrap table-bordered" border="1" data-toggle="tab" href="#table" cellspacing="0" width="100%">
			<thead>
			  <tr>
				<th>Name</th>
				<th>Flight No</th>
				<th>Arrival date</th>
				<th>Arrival time</th>
				<th>Taxi needed</th>
				<th>Approved</th>
			  </tr>
			</thead>
			<tbody>
			  @if (isset($attendees))
			  @foreach ($attendees as $attendee)
			  <tr>
				<td>{{$attendee->name}}</td>
				<td>{{$attendee->flight ? $attendee->flight : "N/A"}}</td>
				<td>{{$attendee->arrival_date ? date('F d, Y', strtotime($attendee->arrival_date)) : "N/A"}}</td>
            	<td>{{$attendee->arrival_time ? date('h:i A', strtotime($attendee->arrival_time)) : "N/A"}}</td>
				<td>{{$attendee->taxi_requested ? "Yes": "No"}}</td>
				<td>{{$attendee->approved? "Yes": "No"}}</td>
			  </tr>
			  @endforeach
			  @endif
			</tbody>
		</table>
    </div>
  </div>
</div>



<script type="text/javascript">
//  Script for running DataTable -->
$(function(){
  $("#participants_table_current").DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
})


// Make the sidebar active
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-flights').attr('class','active');
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
