@extends('layouts.app')

@section('title', 'Inventory')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-archive"></i>Inventory</h3>
        </div>
</div>
<div class="container">
  @if (session('inventory_added'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        Inventory added
      </h4>
    </div>
  </div>
  @endif
  <div class="panel panel-default" >
    <header class="panel-heading">
      Inventory
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
            <option value="/conference/{{$conference->id}}/inventory" selected>{{$conference->name}}</option>
            @else
            <option value="/conference/{{$conference->id}}/inventory">{{$conference->name}}</option>
            @endif
            @endforeach
            @else
            <option>No conferences available!</option>
            @endif
          </select>
        </div>

        {{-- <div class="col-md-2">
          @if (isset($current))
          <button class="btn btn-primary" onclick="window.location.href = '/conference/{{$current}}/create_hotel'">Create hotel</button>
          @else
          <button class="btn btn-primary" disabled>Select a conference</button>
          @endif
        </div> --}}
      </div>

      <table id="hotel_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
          @if(isset($inventories))
          @foreach ($inventories as $inventory)
          <tr>
              <td>{{$inventory->name}}</td>
              <td>{{$inventory->type}}</td>
              <td>{{$inventory->quantity}}</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

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
