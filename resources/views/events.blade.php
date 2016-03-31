@extends('layouts.app')

@section('title', 'Events')

@section('content')


 <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-globe"></i> Conferences</h3>
      </div>
    </div>
    

  @if(Auth::user()->is_admin)
        <button  class="btn btn-warning"><a href="{{ URL::to('conference/'.$id) }}/create_event"><i class="fa fa-plus"></i>  Create a new event</a></button>
        <button  class="btn btn-default">  <a href="{{ URL::to('manage_conferences') }}">return to conferences</a></button>
        </br>
        </br>
      @endif

<div class="container">
  <div class="panel panel-default" >

    <ul class="nav nav-tabs nav-justified">
      <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Events</strong></a></li>
    </ul>
    <div class="tab-content">
      <div id="currentConferences" class="tab-pane fade in active">
        @if (count($events) > 1)
          <div class="panel-body" >
            <table width="100%" class="table">
              <thead>
                <th>Name</th>
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
                    <td class="table-text">{{ $event->capacity }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($event->start)) }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($event->end)) }}</td>
                    <td class="table-text">{{ $event->location }}</td>
                    <td>
                      <a href="#" class="btn btn-details">Details</a>
                    </td>
                    <td>
                        <a href="/login" class="btn btn-register">Register</a>
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
