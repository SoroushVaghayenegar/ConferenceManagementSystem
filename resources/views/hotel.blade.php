@extends('layouts.app')

@section('title', 'Hotel')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-bed"></i>Hotel</h3>
        </div>
</div>
<div class="container">
  <div class="panel panel-dark" >
        
        <h1 align="center" style="color:white"><strong>Hotel Rooms</strong></h1>

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
                                  <td>ROOM NUMBER</td>
                                  <td>
                                    <address>
                                      <strong>{{$hotel->name}}</strong><br>
                                      {{$hotel->address}}
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
