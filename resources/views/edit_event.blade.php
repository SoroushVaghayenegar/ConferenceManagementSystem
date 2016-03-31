@extends('layouts.app')

@section('title', 'Edit event')

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
    <h3 class="page-header"><i class="fa fa-plus"></i> Edit event</h3>
  </div>
</div>

@if(Session::has('flash_message'))
<div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
@endif

<div class="container">
  <div class="col-sm-offset-2 col-sm-8">
    
    <!-- SHOW IF ONLY USER IS ADMIN -->
   
      @if(Auth::user()->is_admin)
        <a href="{{ URL::previous() }}" class= "btn btn-primary">Back</a>
        <br>
        <br>
      @endif




      <div class="panel panel-default">
        <div class="panel-heading">
          New Event
          <button type="button" id="close_panel" class="close" data-dismiss="">x</button>
        </div>
 
        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')

          <!-- New Conference Form -->
          <form action="/conference/{{$id}}/edit_event" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Name -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Title</label>

              <div class="col-md-6">
                <input type="text" name="name" id="event-name" class="form-control" value="{{ $specific_event->name }}">
              </div>
            </div>

            <!-- Description -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Description</label>

              <div class="col-md-6">
                <textarea rows="4" name="description" id="event-description" class="form-control" >{{ $specific_event->topic }}</textarea>
              </div>
            </div>

            <!-- Capacity -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Capacity</label>

              <div class="col-md-6">
                <input type="text" name="capacity" id="event-capacity" class="form-control" value="{{ $specific_event->capacity }}" placeholder="optional">
              </div>
            </div>

            <!-- Start Date -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Start Date</label>

              <div class="col-md-6" id="start-datepicker">
                <input type="text" name="start" id="event-start" class="form-control" value="{{ $specific_event->start }}">
              </div>
            </div>

            <!-- End Date -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> End Date</label>

              <div class="col-md-6" id="end-datepicker">
                <input type="text" name="end" id="event-end" class="form-control" value="{{ $specific_event->end }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Location</label>

              <div class="col-md-6">
                <input type="text" name="location" id="event-location" class="form-control" value="{{$specific_event->location }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Event Facilitators</label>
              <div class="col-md-6">
                <select multiple id="facilitators" name="facilitators[]" data-role="tagsinput"></select>
              </div>
            </div>

            <!-- Add Conference Button -->
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                   Save Changes
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<script>
$('#start-datepicker input').datepicker({ format: "yyyy/mm/dd" });
$('#end-datepicker input').datepicker({ format: "yyyy/mm/dd" });

$("#create_new_button").click(function(){
  $("#create_panel").stop(true).fadeIn({
        duration: 2000,
        queue: false
    }).css('display', 'none').slideDown(2000);
});

$("#close_panel").click(function(){
  $("#create_panel").fadeTo(500, 500).slideUp(500, function(){});
});


$('#facilitators').tagsinput({
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

  prefillFacilitators();
})


function prefillFacilitators() {
  @if (isset($specific_event->facilitators))
  @foreach ($specific_event->facilitators as $facilitator)
  $('#facilitators').tagsinput('add', {'id': {{$facilitator->id}}, 'name': '{{$facilitator->name}}' });
  @endforeach
  @endif
}

</script>





@endsection