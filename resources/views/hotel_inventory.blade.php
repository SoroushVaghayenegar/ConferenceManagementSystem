@extends('layouts.app')

@section('title', 'Inventory')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-archive"></i>Inventory</h3>
        </div>
</div>
<div class="container">
  @if (session('inventory_added') || session('inventory_deleted'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        <i class="fa fa-check"></i>
        @if (session('inventory_added'))
        Inventory added
        @elseif (session('inventory_deleted'))
        Inventory deleted
        @endif
      </h4>
    </div>
  </div>
  @endif
  <div class="panel panel-default" >
    <header class="panel-heading">
      Inventory
    </header>

    <div class="panel-body">

      <table id="inventories_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          @if(isset($inventories))
          @foreach ($inventories as $inventory)
          <tr>
              <td>{{$inventory->name}}</td>
              <td>{{$inventory->type}}</td>
              <td>{{$inventory->quantity}}</td>
              <td>
                <a href="{{url('inventory/'.$inventory->id.'/delete')}}" class="btn btn-danger btn-sm">Remove</a>
              </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>

      <a class="btn btn-default" href="{{url('conference/'.$hotel->conference->id.'/hotels')}}">View Hotel</a>
      <a class="btn btn-primary pull-right" href="{{url('hotel/'.$hotel->id.'/create_inventory')}}">Add Inventory to Hotel</a>
    </div>
  </div>
</div>

<script>


$(document).ready(function(){
  $("#inventories_table").DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});
$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-inventories').attr('class','active');
})

</script>

@endsection
