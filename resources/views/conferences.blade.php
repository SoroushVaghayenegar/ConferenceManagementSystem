@extends('layouts.app')

@section('title', 'Manage Conferences')

@section('content')
<!-- Bootstrap Datepicker plugin-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap Typeahead plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.0/bootstrap3-typeahead.js"></script>

<!-- Bootstrap Tags input plugin-->
<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap-tagsinput.js"></script>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-plus"></i> Manage Conferences</h3>
  </div>
</div>

<div class="container">
 

    <!-- SHOW IF ONLY USER IS ADMIN -->

      @if(Auth::user()->is_admin)
        <button id="create_new_button" class="btn btn-primary"><i class="fa fa-plus"></i>  Create a new conference</button>
        </br>
        </br>
      @endif


    <!-- Current Conferences -->
    @if (count($conferences) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Conferences
      </div>

      <div class="panel-body">
        <table class="table table-striped conference-table">
          <thead>
            <th>Conference</th>
            <th>Date</th>
            <th colspan="8"></th>
          </thead>
          <tbody>
            @foreach ($conferences as $conference)
            <tr>
              <!-- Name -->
              <td>
                <div>{{ $conference->name }}</div>
              </td>
              <td >
                {{ date('F d, Y', strtotime($conference->start)) }}
              </td>
              @if($event_facilitator == null || Auth::user()->is_admin)
              <!-- Edit button -->
              <td>
                 <a href="{{ URL::to('conference/'.$conference->id) }}/edit" class="btn btn-info">Edit</a>
              </td>
              @endif
              <td>
                 <a href="{{ URL::to('conference/'.$conference->id) }}/eventlist" class="btn btn-success">Event List</a>
              </td>
              @if(isset($conference_manager) || Auth::user()->is_admin)
                <td>
                  <a href='{{ url("conference/$conference->id/participants") }}' class="btn btn-default" style="background-color:#9966ff">
                    <i class="fa fa-user"></i>
                    Participants
                  </a>
                </td>
                <td>
                  <a href='{{ url("conference/$conference->id/flights") }}' class="btn btn-default" style="background-color:#9966ff">
                    <i class="fa fa-plane"></i>
                    Flights
                  </a>
                </td>
                <td>
                  <a href='{{ url("conference/$conference->id/hotels") }}' class="btn btn-default" style="background-color:#9966ff">
                    <i class="fa fa-bed"></i>
                    Hotels
                  </a>
                </td>
                <td>
                  <a href='{{ url("notification/conference/$conference->id") }}' class="btn btn-default" style="background-color:#e6ac00">
                    <i class="fa fa-envelope"></i>
                    Send Notification
                  </a>
                </td>
              @endif
              <td>
                  <a href='{{ url("reports/$conference->id") }}' class="btn btn-default" style="background-color:#a6a6a6">
                    <i class="icon_piechart"></i>
                    Report
                  </a>
                </td>
              @if(Auth::user()->is_admin)
              <!-- Delete Button -->
              <td>
                <form action="{{ url('conference/'.$conference->id) }}" method="POST">
                  {!! csrf_field() !!}
                  {!! method_field('DELETE') !!}

                  <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </form>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

    @if ($errors->isEmpty())
      <div id="create_panel" style="display:none">
    @else
      <div id="create_panel">
    @endif
      <div class="panel panel-default">
        <div class="panel-heading">
          New Conference
          <button type="button" id="close_panel" class="close" data-dismiss="">x</button>
        </div>

        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')

          <!-- New Conference Form -->
          <form action="/conference" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Name -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Title</label>

              <div class="col-md-6">
                <input type="text" name="name" id="conference-name" class="form-control" value="{{ old('name') }}">
              </div>
            </div>

            <!-- Description -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Description</label>

              <div class="col-md-6">
                <textarea rows="4" name="description" id="conference-description" class="form-control" value="{{ old('description') }}"></textarea>
              </div>
            </div>

            <!-- Capacity -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Capacity</label>

              <div class="col-md-6">
                <input type="text" name="capacity" id="conference-capacity" class="form-control" value="{{ old('capacity') }}" placeholder="optional">
              </div>
            </div>

            <!-- Start Date -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Start Date</label>

              <div class="col-md-6" id="start-datepicker">
                <input type="text" name="start" id="conference-start" class="form-control" value="{{ old('start') }}">
              </div>
            </div>

            <!-- End Date -->
            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> End Date</label>

              <div class="col-md-6" id="end-datepicker">
                <input type="text" name="end" id="conference-end" class="form-control" value="{{ old('end') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Location</label>

              <div class="col-md-6">
                <input type="text" name="location" id="conference-location" class="form-control" value="{{ old('location') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Address</label>

              <div class="col-md-6">
                <input type="text" name="address" id="conference-address" class="form-control" value="{{ old('address') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" class="control-label"> Managers</label>
              <div class="col-md-6">
                <select multiple id="managers" name="managers[]" data-role="tagsinput"></select>
              </div>
            </div>

            <!-- Add Conference Button -->
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-plus"></i>Add Conference
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
$('#start-datepicker input').datetimepicker({
  format: 'YYYY/MM/D HH:mm:ss'
});
$('#end-datepicker input').datetimepicker({
   format: 'YYYY/MM/D HH:mm:ss'
});

$("#create_new_button").click(function(){
  $("#create_panel").stop(true).fadeIn({
        duration: 1000,
        queue: false
    }).css('display', 'none').slideDown(1000);
});

$("#close_panel").click(function(){
  $("#create_panel").fadeTo(100, 500).slideUp(500, function(){});
});


$('#managers').tagsinput({
  itemValue: 'id',
  itemText: 'name',
  typeahead: {
    displayKey: 'name',
    afterSelect: function(val) { this.$element.val(""); },
    source: function (query) { return $.get('user/autocomplete') }
  }
});

$(document).ready(function(){
  $('.sidebar-menu > li').attr('class','');
  $('#sidebar-manageConferences').attr('class','active');
})

</script>
@endsection
