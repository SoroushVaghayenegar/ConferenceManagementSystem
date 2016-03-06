@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-globe"></i> Conferences</h3>
        </div>
</div>
<!-- SHOW IF ONLY USER IS ADMIN -->
@if(Auth::user()->is_admin)
  <a href="{{ URL::to('create_conference') }}" class="btn btn-danger"><i class="icon_plus_alt"></i>  Create a new conference</a>
  </br>
  </br>
@endif
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#currentConferences"><strong>Current Conferences</strong></a></li>
    <li><a data-toggle="tab" href="#pastConferences"><strong>Past Conferences</strong></a></li>
  </ul>
  <div class="tab-content">
    <div id="currentConferences" class="tab-pane fade in active">
      <div class="panel-body" >
          <table width="100%" class="table table-striped">
                      <thead>
                          <th>Name</th>
                          <th>Capacity</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th></th>
                      </thead>
                      <tbody style="position: relative; center: 40%;">
                        @foreach ($current_conferences as $current_conference)
                          <tr>
                            <td class="table-text">{{ $current_conference->name }}</td>
                            <td class="table-text">{{ $current_conference->capacity }}</td>
                            <td class="table-text">{{ $current_conference->start }}</td>
                            <td class="table-text">{{ $current_conference->end }}</td>
                            <td>
                              <a href="{{ URL::to('conference/'.$current_conference->id) }}" class="btn btn-info">Details</a> 
                            </td>
                            <td> 
                              <button type="submit" class="btn btn-info"><i class=""></i>Register</button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  
        </div>
    </div>
    <div id="pastConferences" class="tab-pane fade">
        @if (count($past_conferences) > 0)
          <div class="panel-body" >
            <table width="100%" class="table table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                        </thead>
                        <tbody style="position: relative; center: 40%;">
                          @foreach ($past_conferences as $past_conference)
                            <tr>
                              <td class="table-text">{{ $past_conference->name }}</td>
                              <td class="table-text">{{ $past_conference->capacity }}</td>
                              <td class="table-text">{{ $past_conference->start }}</td>
                              <td class="table-text">{{ $past_conference->end }}</td>
                              <td>
                                <a href="{{ URL::to('conference/'.$past_conference->id) }}" class="btn btn-info">Details</a> 
                              </td>
                              <td> 
                                <button type="submit" class="btn btn-info"><i class=""></i>Register</button>
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
@endsection
