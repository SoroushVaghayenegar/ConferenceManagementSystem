@extends('layouts.app')

@section('title', 'Hotel')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-bed"></i>Hotel</h3>
        </div>
</div>
<div class="container">
  <div class="panel panel-dark" style='opacity:0.9'>
        
        <h1 align="center" style="color:white">Hotel Rooms</h1>

        <div class="panel-body">

          
                  <table id="hotel_table" class="display" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Room</th>
                              <th>Address</th>
                              <th>type</th>
                              <th>capacity</th>
                              <th>conference</th>
                              <th>Full?</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($hotels as $hotel)
                              <tr>
                                  <td>{{$hotel->name}}</td>
                                  <td>
                                    <address>
                                      <strong>Hotel's name</strong><br>
                                      1355 Market Street, Suite 900<br>
                                      San Francisco, CA 94103<br>
                                      <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                  </td>
                                  <td>{{$hotel->type}}</td>
                                  <td>{{$hotel->capacity}}</td>
                                  <td>{{$hotel->conference_id}}</td>
                                  <td>Full</td>
                                  <td><a href="" class="btn btn-danger">Remove</a></td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
        </div>    
  </div>  
</div>
         
<!-- Script for running DataTable -->
        <script>
          $(document).ready(function(){
            $("#hotel_table").dataTable();
          });
          $(document).ready(function(){
            $('.sidebar-menu > li').attr('class','');
            $('#sidebar-hotel').attr('class','active');
          })
          
        </script>
@endsection
