@extends('layouts.app')

@section('title', 'Create hotel rooms')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-bed"></i>Hotel</h3>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-offset-2 col-lg-8">
      <div class="panel panel-default">
        <header class="panel-heading">
          Create hotel rooms
        </header>
        <div class="panel-body">

  				@include('common.errors')
          
  				<form action='{{ url("conference/$conference->id/create_hotel") }}' method="POST" class="form-horizontal">
  					{{ csrf_field() }}

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Conference</label>

  						<div class="col-md-6">
  							<input type="text" name="conference" class="form-control" value="{{$conference->name}}" disabled></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Hotel name</label>

  						<div class="col-md-6">
  							<input type="text" name="name" class="form-control"></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Address</label>

  						<div class="col-md-6">
  							<textarea name="address" class="form-control"></textarea>
  						</div>
  					</div>

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Room Type</label>

  						<div class="col-md-6">
  							<input type="text" name="type" class="form-control"></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<label class="col-md-4 control-label" class="control-label"> Room Capacity</label>

  						<div class="col-md-6">
  							<input type="text" name="capacity" class="form-control"></input>
  						</div>
  					</div>

  					<div class="form-group">
  						<div class="col-sm-offset-3 col-sm-6">
  							<a href='{{ URL::to("conference/$conference->id/hotels") }}' class="btn btn-default">Back</a>
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
