@extends('layouts.app')

@section('content')

<!-- Bootstrap Datepicker plugin-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap Typeahead plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.0/bootstrap3-typeahead.js"></script>

<!-- Bootstrap Tags input plugin-->
<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<script src="/js/bootstrap-tagsinput.js"></script>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-plus"></i> Manage Conferences</h3>
	</div>
</div>

@if(Session::has('flash_message'))
<div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
@endif

<div class="container">
	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{$conference->name}}
			</div>

			<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.errors')

				<!-- New Conference Form -->
				<form action="{{ url('conference/'.$conference->id) }}/edit" method="POST" class="form-horizontal">
					{{ csrf_field() }}

					<!-- Name -->
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Title</label>

						<div class="col-md-6">
							<input type="text" name="name" id="conference-name" class="form-control" value="{{$conference->name}}">
						</div>
					</div>

					<!-- Description -->
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Description</label>

						<div class="col-md-6">
							<textarea rows="4" name="description" id="conference-description" class="form-control">{{$conference->description}}</textarea>
						</div>
					</div>

					<!-- Capacity -->
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Capacity</label>

						<div class="col-md-6">
							<input type="text" name="capacity" id="conference-capacity" class="form-control" value="{{$conference->capacity}}" placeholder="optional - must be at least 1">
						</div>
					</div>

					<!-- Start Date -->
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Start Date</label>

						<div class="col-md-6" id="start-datepicker">
							<input type="text" name="start" id="conference-start" class="form-control" value="{{$conference->start}}">
						</div>
					</div>

					<!-- End Date -->
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> End Date</label>

						<div class="col-md-6" id="end-datepicker">
							<input type="text" name="end" id="conference-end" class="form-control" value="{{$conference->end}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Location</label>

						<div class="col-md-6">
							<input type="text" name="location" id="conference-location" class="form-control" value="{{$conference->location}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Address</label>

						<div class="col-md-6">
							<input type="text" name="address" id="conference-address" class="form-control" value="{{ $conference->address}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" class="control-label"> Managers</label>
						<div class="col-md-6">
							<select multiple id="managers" name="managers[]" data-role="tagsinput">
							</select>
						</div>

					</div>

					<!-- Add Conference Button -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<a href="{{ URL::to('manage_conferences') }}" class="btn btn-default">Back</a>
							<button type="submit" class="btn btn-info">
								Save Changes
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>



		<!-- Current Conferences -->

	</div>
</div>





<script>
$('#start-datepicker input').datetimepicker({
  format: 'YYYY/MM/D HH:mm:ss'
});
$('#end-datepicker input').datetimepicker({
   format: 'YYYY/MM/D HH:mm:ss'
});

$('#managers').tagsinput({
	itemValue: 'id',
	itemText: 'name',
	typeahead: {
		displayKey: 'name',
		afterSelect: function(val) { this.$element.val(""); },
		source: function (query) { return $.get('/user/autocomplete') }
	}
});

$(document).ready(function(){
	$('.sidebar-menu > li').attr('class','');
	$('#sidebar-manageConferences').attr('class','active');

	prefillManagers();
})

function prefillManagers() {
	@if (isset($conference->managers))
	@foreach ($conference->managers as $manager)
	$('#managers').tagsinput('add', {'id': {{$manager->id}}, 'name': '{{$manager->name}}' });
	@endforeach
	@endif
}

</script>
@endsection
