@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference Management System')



@if(Auth::check())
    @section('content')           
            <!-- USER IS LOGGED IN-->
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
                                <th>Conference Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Companions</th>
                                <th>Flight Number</th>
                                <th>Hotel Room Address & Phone Number</th>
                            </thead>
                            <tbody style='color:#ffa366'>
                                <tr>
                                    <td>Brain Health Conference</td>
                                    <td>March 23, 2016</td>
                                    <td>March 27, 2016</td>
                                    <td>
                                        Graham </br>
                                        Sherry </br>
                                        Jon    </br>
                                        Yuwei
                                    </td>
                                    <td style='color:#00bfff'> AT0421</td>
                                    <td>
                                        <address>
                                          <strong>Holiday Inn</strong><br>
                                          1355 Market Street, Suite 900<br>
                                          San Francisco, CA 94103<br>
                                          <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>
                                  </td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>
                </div>
            </div>

    @endsection
@else
    @section('content')
    <!-- MAIN PAGE  -  USER HAS NOT LOGGED IN YET -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style='opacity:0.9'>
                    <div class="panel-heading">
                        <h1 style="text-align: center;">Welcome to Gobind Sarvar Conferences!</h1>
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
