@extends('layouts.app')

@section('title', 'Create Inventory')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-archive"></i>Inventory</h3>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-offset-2 col-lg-8">
      <div class="panel panel-default">
        <header class="panel-heading">
          Create inventory
        </header>
        <div class="panel-body">

  				@include('common.errors')

  				<form action='{{ url("hotel/$hotel->id/create_inventory") }}' method="POST" class="form-horizontal">
  					{{ csrf_field() }}

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Name</label>

  						<div class="col-md-6">
  							<input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Water, Towel.."></input>
  						</div>
  					</div>

            <div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Type</label>

  						<div class="col-md-6">
  							<input type="text" name="type" class="form-control" value="{{old('type')}}"></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Quantity</label>

  						<div class="col-md-6">
  							<input name="quantity" class="form-control" value="{{old('quantity')}}"></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<div class="col-sm-offset-3 col-sm-6">
  							<a href='{{ URL::to("hotel/$hotel->id/inventory") }}' class="btn btn-default">Back</a>
  							<button type="submit" class="btn btn-info">
  								Submit
  							</button>
  						</div>
  					</div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
