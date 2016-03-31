@extends('layouts.app')

@section('title', 'Events')

@section('content')


 <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-globe"></i> Events</h3>
      </div>
    </div>


  @if(Auth::user()->is_admin)
        <button  class="btn btn-warning"><a href="{{ URL::to('conference/'.$id) }}/create_event"><i class="fa fa-plus"></i>  Create a new event</a></button>
      @endif
        <button  class="btn btn-default">  <a href="{{ URL::to('directory') }}">Return to conferences</a></button>
        </br>
        </br>

<div class="container">


  @if (session('event_registered'))
  <div class="alert alert-success" id="success-alert">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        You are registered in the event!
      </h4>

  </div>
  @endif
  <div class="panel panel-default" >

    <ul class="nav nav-tabs nav-justified">
      <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Events</strong></a></li>
    </ul>
    <div class="tab-content">
      <div id="currentConferences" class="tab-pane fade in active">
        @if (count($events) > 0)
          <div class="panel-body" >
            <table width="100%" class="table">
              <thead>
                <th>Name</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location</th>
                <th></th>
                <th></th>
              </thead>
              <tbody style="position: relative; center: 40%; ">
                @foreach ($events as $event)
                  <tr>
                    <td class="table-text">{{ $event->name }}</td>
                    <td class="table-text">{{ $event->topic }}</td>
                    <td class="table-text">{{ $event->capacity }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($event->start)) }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($event->end)) }}</td>
                    <td class="table-text">{{ $event->location }}</td>
                    <td>
                       <a href="{{ URL::to('conference/'.$event->id) }}/edit_event" class="btn btn-default">Edit event</a>
                    </td>
                    <td>
                        <a href="{{ URL::to('conference/'.$event->id) }}/join_event" class="btn btn-register">Register</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        @else
          <h2 align="center" style="color:#ff4d4d">No Current Events!</h2>
        @endif
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-conferences').attr('class','active');
})
</script>


@endsection
