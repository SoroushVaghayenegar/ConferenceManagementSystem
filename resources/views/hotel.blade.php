@extends('layouts.app')

@section('title', 'Hotel')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-bed"></i>Hotel</h3>
        </div>
</div>
<div class="container">
  <div class="panel panel-default" >
    <header class="panel-heading">
      Hotel rooms
    </header>

    <div class="panel-body">
      <div class="row">
        <span class="h4 col-md-2">
          <strong>Select a conference</strong>
        </span>

        <div class="col-md-6">
          <select id="conference_selector" class="form-control">
            <option value="#">Select a conference</option>
            @if (count($conferences) > 0)
            @foreach ($conferences as $conference)
            @if (isset($current) && $conference->id == $current)
            <option value="/conference/{{$conference->id}}/hotels" selected>{{$conference->name}}</option>
            @else
            <option value="/conference/{{$conference->id}}/hotels">{{$conference->name}}</option>
            @endif
            @endforeach
            @else
            <option>No conferences available!</option>
            @endif
          </select>
        </div>

        <div class="col-md-2">
          @if (isset($current))
          <button class="btn btn-primary" onclick="window.location.href = '/conference/{{$current}}/create_hotel'">Create hotel</button>
          @else
          <button class="btn btn-primary" disabled>Select a conference</button>
          @endif
        </div>
      </div>


      <table id="hotel_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
          @if(isset($hotels))
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
              <td><a href="{{ URL::to('hotel/'.$hotel->id) }}" class="btn btn-danger" style="width:100%">Remove</a></td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Script for running DataTable -->
<script>
var onChangeHandler = function () {
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
    window.location = url; // redirect
  }
  return false;
}

$('#conference_selector').on('change', onChangeHandler);


$(document).ready(function(){
  $("#hotel_table").DataTable();
});
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-hotel').attr('class','active');
})

</script>
@endsection
