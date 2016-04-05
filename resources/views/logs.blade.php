@extends('layouts.app')

@section('title', 'Logs')

@section('content')
<!--overview start-->
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-file-text"></i> Logs</h3>
  </div>
</div>

<div class="container">

  
  
  <div class="panel panel-default">
    <header class="panel-heading">
      <h1 align="center">All Logs</h1>  
    </header>
    <div class="panel-body">
      <div class="row">
        <span class="h3 col-md-2">
          <strong>Select type</strong>
        </span>


        <div class="h3 col-md-3">


          <select id="logs_select" class="form-control">

            <option value="#">Select a type</option>
            @if (count($types) > 0)
              <option value="/logs" selected>--ALL TYPES--</option>
              @foreach($types as $type)
                @if ($type->type == $current)
                  <option value="/logs/{{$type->type}}" selected>{{$type->type}}</option>
                @else
                  <option value="/logs/{{$type->type}}">{{$type->type}}</option>
                @endif
              @endforeach
            @else
              <option>No Log types available!</option>
            @endif
          </select>
          

        </div>
      </div>

      
      <h3 style="color:white; text-align: center"><strong>Logs</strong></h3>
      <table id="logs_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Type</th>
            <th>Activity</th>
            <th>Date & Time</th>
          </tr>
        </thead>
        <tbody>
          @foreach($logs as $log)
            <tr>
              <td>{{$log->type}}</td>
              <td style="text-align: left;"><strong>{{$log->username}}</strong> 
                  (<u>{{$log->useremail}}</u>)
                  {{$log->activity}}</td>
              <td>{{date('F d, Y - h:i A', strtotime($log->created_at))}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      

    </div>
  </div>
</div>


<script>
//  Script for running DataTable -->
$(function(){
  $("#logs_table").DataTable({
        "order": [[ 2, "desc" ]]
    } );
})



// Make the sidebar active
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-logs').attr('class','active');

})

$('#logs_select').on('change', function(){
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
    window.location = url; // redirect
  }
  return false;
});


</script>
@endsection
