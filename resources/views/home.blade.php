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
                    <table width="100%" class="table">
                        <thead>
                            <th>{{count($participants)}}</th> 
                            <!--<th>Conference Name</th>-->
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Companions</th>
                            <th>Flight No</th>
                            <th>Arrival date</th>
                            <th>Arrival time</th>
                            <th>Hotel Room Address & Phone Number</th>
                        </thead>
                        @foreach ($conferences as $conference)
                        <tbody style='color:#ffa366'>
                            <tr>
                                <td>{{ $conference->name }}</td>
                                <td>{{ $conference->start }}</td>
                                <td>{{ $conference->end }}</td>
                                <td>
                                    @foreach($participants as $participant)
                                        @if($conference->attendees()->find($participant->id) && !$participant->primary_user)
                                            {{$participant->name}}</br>
                                        @endif
                                    @endforeach
                                </td>
                                <td style='color:#00bfff'> AT0421</td>
                                <td>March 22, 2016</td>
                                <td>12:00::00</td>
                                <td>
                                    <address>
                                      <strong>Hotel Name not implemented</strong><br>
                                      {{ $conference->address }}<br>
                                      {{ $conference->location }}<br>
                                      <abbr title="Phone">P:</abbr> (123) 456-7890
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
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style='opacity:0.9'>
                    <div class="panel-heading">
                        <h1 style="text-align: center;"><strong>Welcome to Gobind Sarvar Conference Management System!</strong></h1>
                    </div>

                    <div class="panel-body" >
                        <img src="GobindSarvar.jpg" alt="Gobind Sarvar Logo" style="position:relative;width:30%;left:35%;" align="center">
                        <h3 style="text-align: center;">Don't have an account?</h3>
                        <a href="{{ URL::to('register') }}" class="btn btn-success" style="position:relative;left: 40%;"><h4>Create a new account!</h4></a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif 
