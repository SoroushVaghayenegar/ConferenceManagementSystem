@extends('layouts.app')

@section('title', 'Conferences')

  @section('content')

    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-globe"></i> Conferences</h3>
      </div>
    </div>
    

<div class="container">
  <div class="panel panel-default" >

    <ul class="nav nav-tabs nav-justified">
      <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Current Conferences</strong></a></li>
      <li><a data-toggle="tab" href="#pastConferences"><strong>Past Conferences</strong></a></li>
    </ul>
    <div class="tab-content">
      <div id="currentConferences" class="tab-pane fade in active">
        @if (count($current_conferences) > 0)
          <div class="panel-body" >
            <table width="100%" class="table">
              <thead>
                <th>Name</th>
                <th>Total Capacity</th>
                <th>Remaining Capacity</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location</th>
                <th></th>
                <th></th>
              </thead>
              <tbody style="position: relative; center: 40%; ">
                @foreach ($current_conferences as $current_conference)
                  <tr>
                    <td class="table-text">{{ $current_conference->name }}</td>
                    <td class="table-text">{{ $current_conference->capacity }}</td>
                    @if(($current_conference->approved/$current_conference->capacity) < 0.2)
                      <td class="table-text" style="color:#00e600">{{ $current_conference->capacity - $current_conference->approved }}</td>
                    @elseif(($current_conference->availableCapacity/$current_conference->capacity) < 0.5)
                      <td class="table-text" style="color:#ff751a">{{ $current_conference->capacity - $current_conference->approved }}</td>
                    @else
                      <td class="table-text" style="color:red">{{ $current_conference->capacity - $current_conference->approved }}</td>
                    @endif
                    <td class="table-text">{{ date('F d, Y', strtotime($current_conference->start)) }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($current_conference->end)) }}</td>
                    <td class="table-text">{{ $current_conference->location }}</td>
                    <td>
                      <a href="{{ URL::to('conference/'.$current_conference->id) }}" class="btn btn-details">Details</a>
                    </td>
                    <td>
                      @if(Auth::user())
                        @if($current_conference->isRegistered)
                        <a href="/conference/{{$current_conference->id}}/join" class="btn btn-success" disabled>
                          <i class="fa fa-check"></i>
                          Registered
                        </a>
                        @else
                        <a href="/conference/{{$current_conference->id}}/join" class="btn btn-register">Register</a>
                        @endif
                      @else
                        <a href="/login" class="btn btn-register">Register</a>
                      @endif

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        @else
          <h2 align="center" style="color:#ff4d4d">No Current Conferences!</h2>
        @endif
      </div>
      <div id="pastConferences" class="tab-pane fade">
        @if (count($past_conferences) > 0)
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
                @foreach ($past_conferences as $past_conference)
                  <tr>
                    <td class="table-text">{{ $past_conference->name }}</td>
                    <td class="table-text">{{ $past_conference->capacity }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($past_conference->start)) }}</td>
                    <td class="table-text">{{ date('F d, Y', strtotime($past_conference->end)) }}</td>
                    <td class="table-text">{{ $past_conference->location }}</td>
                    <td>
                      <a href="{{ URL::to('conference/'.$past_conference->id) }}" class="btn btn-details">Details</a>
                    </td>
                    <td>
                      <a href="/conference/{{$past_conference->id}}/join" class="btn btn-default" disabled>Register</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <br/>
          <h2 align="center" style="color:#ff4d4d">No Past Conferences!</h2>
          <br/>
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
