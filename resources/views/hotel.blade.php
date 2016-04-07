@extends('layouts.app')

@section('title', 'Hotel')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-bed"></i>Hotel</h3>
        </div>
</div>
<div class="container">
  @if (session('hotel_added') || session('hotel_removed'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        @if (session("hotel_added"))
        Hotel added
        @elseif (session('hotel_removed'))
        Hotel removed
        @endif
      </h4>
    </div>
  </div>
  @endif

  <a href="{{ URL::to('manage_conferences') }}" id="back" class="btn btn-backToC"><i class="fa fa-arrow-left"></i>  Go back to Conferences</a>
  
  <div class="panel panel-default" >
    <header class="panel-heading">
      Hotel rooms
    </header>

    <div class="panel-body">
      @if(Auth::user()->is_admin)
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
      @else
        @if (isset($current))
        
            <h1 align='center'> <strong>{{$conferenceName}}</strong></h1>

            <button class="btn btn-primary" onclick="window.location.href = '/conference/{{$current}}/create_hotel'">Create hotel</button>
        @endif   
      @endif

      <table id="hotel_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name/Address</th>
                <th>Room number</th>
                <th>Room type</th>
                <th>Occupancy</th>
                <th>Inventory</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          @if(isset($hotels))
          @foreach ($hotels as $hotel)
          <tr>
              <td>
                <address>
                  <strong>{{$hotel->name}}</strong><br>
                  {{$hotel->address}}
                </address>
              </td>
              <td>{{$hotel->room}}</td>
              <td>{{$hotel->type}}</td>
              <td>{{$hotel->remaining}} / {{$hotel->capacity}}</td>
              <td>
                <a href='{{ url('/hotel/'.$hotel->id.'/inventory') }}' class="btn btn-default btn-sm">
                  Inventory
                </a>
              </td>
              <td>
                <a href="{{ URL::to('hotel/'.$hotel->id) }}" class="btn btn-danger btn-sm">
                  Remove
                </a>
              </td>
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
$(document).ready(function(){
  var oldURL = document.referrer.split("/").pop();
  if(oldURL == "manage_conferences")
    document.getElementById("back").style.visibility = "visible" ;

  @if(!Auth::user()->is_admin)
    document.getElementById("back").style.visibility = "visible" ;
  @endif
  
});

var onChangeHandler = function () {
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
    window.location = url; // redirect
  }
  return false;
}

$('#conference_selector').on('change', onChangeHandler);


$(document).ready(function(){
  $("#hotel_table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-hotel').attr('class','active');
})

</script>
@endsection
