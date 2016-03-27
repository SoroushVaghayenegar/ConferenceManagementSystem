@extends('layouts.app')

@section('title', 'Conferences')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-globe"></i> Conferences</h3>
        </div>
</div>
<!-- SHOW IF ONLY USER IS ADMIN -->
@if(Auth::user())
@if(Auth::user()->is_admin)
  <a href="{{ URL::to('create_conference') }}" class="btn btn-primary"><i class="fa fa-plus"></i>  Create a new conference</a>
  </br>
  </br>
@endif
@endif
<div class="container">
  <div class="panel panel-default" style='opacity:0.9'>
    
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
                                <th>Capacity</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody style="position: relative; center: 40%;">
                              @foreach ($current_conferences as $current_conference)
                                <tr>
                                  <td class="table-text">{{ $current_conference->name }}</td>
                                  <td class="table-text">{{ $current_conference->capacity }}</td>
                                  <td class="table-text">{{ date('F d, Y', strtotime($current_conference->start)) }}</td>
                                  <td class="table-text">{{ date('F d, Y', strtotime($current_conference->end)) }}</td>
                                  <td class="table-text">{{ $current_conference->location }}</td>
                                  <td>
                                    <a href="{{ URL::to('conference/'.$current_conference->id) }}" class="btn btn-info">Details</a> 
                                  </td>
                                  <td> 
                                    <a href="/conference/{{$current_conference->id}}/join" class="btn btn-danger">Register</a> 
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
                            <tbody style="position: relative; center: 40%;">
                              @foreach ($past_conferences as $past_conference)
                                <tr>
                                  <td class="table-text">{{ $past_conference->name }}</td>
                                  <td class="table-text">{{ $past_conference->capacity }}</td>
                                  <td class="table-text">{{ date('F d, Y', strtotime($past_conference->start)) }}</td>
                                  <td class="table-text">{{ date('F d, Y', strtotime($past_conference->end)) }}</td>
                                  <td class="table-text">{{ $past_conference->location }}</td>
                                  <td>
                                    <a href="{{ URL::to('conference/'.$past_conference->id) }}" class="btn btn-info">Details</a> 
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
              <h2 align="center" style="color:#ff4d4d">No Past Conferences!</h2>
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
