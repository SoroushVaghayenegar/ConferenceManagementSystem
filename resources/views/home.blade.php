@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference Management System')



@if(Auth::check())
    @section('content')  
 <!-- USER IS LOGGED IN-->

    @if (count($conferences) > 0)         
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-home"></i> Home</h3>
            </div>
        </div>    

        <div class="container">
            <div class="panel panel-dark" style='opacity:0.9'>
                <div class="panel-heading">
                    <h1 align='center' style='color:black'><strong>Currently registered conferences</strong></h1>
                </div>

                <div class="panel-body">
                    <table width="100%" class="table" >
                        <thead>
                            <th>Conference Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Companions</th>
                            <th>Flight No</th>
                            <th>Arrival date</th>
                            <th>Arrival time</th>
                            <th>Hotel Room Address & Phone Number</th>
                        </thead>
                        @foreach ($conferences as $conference)
                        <tbody style=''>
                            <tr>
                                <td>{{ $conference->name }}</td>
                                <td>{{ date('F d, Y', strtotime($conference->start)) }}</td>
                                <td>{{ date('F d, Y', strtotime($conference->end)) }}</td>
                                <td>
                                    @foreach($participants as $participant)
                                        @if($conference->attendees()->find($participant->id))
                                            @if($participant->primary_user)
                                                <?php 
                                                $primaryUser = $conference->attendees()->where('participant_id', $participant->id)->first()->pivot;
                                                ?>
                                            @else
                                                {{$participant->name}}</br>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td style='color:#00bfff'> {{$primaryUser["flight"]}}</td>
                                <td>{{$primaryUser->arrival_date}}</td>
                                <td>{{$primaryUser->arrival_time}}</td>
                                <td>
                                    <address>
                                      <strong>Hotel Name not implemented</strong><br>
                                      {{ $conference->address }}<br>
                                      {{ $conference->location }}<br>
                                      <abbr title="Phone">P:</abbr> 123 456 789
                                  </address>
                              </td>
                          </tr>
                      </tbody>
                      @endforeach
                  </table>



              </div>
          </div>
      </div>
    @else
        <h2 align="center" style="color:#ff4d4d">No Current Conferences!</h2>
    @endif
    @endsection
@else
    @section('content')
    <!-- MAIN PAGE  -  USER HAS NOT LOGGED IN YET -->
    <div id="lss">
        
        <br/>
        <h1 style="text-align: center; color:white"><strong>Welcome to Gobind Sarvar Conference Management System!</strong></h1>
        
        <img src="/img/gs.png" alt="Gobind Sarvar Logo" style="position:relative;width:30%;left:35%;" align="center">

        <h3 style="text-align: center;">Don't have an account?</h3>
        <div class="col-md-6 col-md-offset-5">
            <a href="{{ URL::to('register') }}" class="btn btn-success" ><h4>Create a new account!</h4></a>
        </div>
        <br/>
          <br/>
          <br/>        
          <br/>
          <br/><br/>
    </div>
            
        
    
        <div class="row">
            <div class="col-md-10 col-md-offset-1">    
                <h2 style="color: black;"><strong>Check our upcoming events!</strong></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="sticky">
                    @foreach($current_conferences as $conference)
                        <li class="notes">
                            
                                <div class="navbar-header">
                                    <strong>{{ date('F d, Y', strtotime($conference->start)) }}</strong> 
                                    to
                                    <strong>{{ date('F d, Y', strtotime($conference->end)) }}</strong>
                                </div><br/>
                                <h2>{{$conference->name}}</h2>
                                <p>{{$conference->description}}</p>

                                <p> Available Seats
                                    @if(($conference->availableCapacity/$conference->capacity) < 0.2)
                                      <strong style="color:#00e600">{{ $conference->capacity - $conference->availableCapacity }}</strong>
                                    @elseif(($conference->availableCapacity/$conference->capacity) < 0.5)
                                      <strong style="color:#ff751a">{{ $conference->capacity - $conference->availableCapacity }}</strong>
                                    @else
                                      <strong style="color:red">{{ $conference->capacity - $conference->availableCapacity }}</strong>
                                    @endif
                                </p>

                            <a href="{{ URL::to('conference/'.$conference->id) }}" class="btn btn-info">Get More Info</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endsection
@endif 
