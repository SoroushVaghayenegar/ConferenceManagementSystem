@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<div class="container">
  <div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        New Conference
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

          <!-- Start Date -->
          <div class="form-group">
            <label class="col-md-4 control-label" class="control-label"> End Date</label>

            <div class="col-md-6" id="end-datepicker">
              <input type="text" name="end" id="conference-end" class="form-control" value="{{ old('end') }}">
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

    <!-- Current Conferences -->
    @if (count($conferences) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Current Conferences
      </div>

      <div class="panel-body">
        <table class="table table-striped conference-table">
          <thead>
            <th>Conference</th>
            <th>&nbsp;</th>
          </thead>
          <tbody>
            @foreach ($conferences as $conference)
            <tr>
              <!-- Name -->
              <td class="table-text">
                <div>{{ $conference->name }}</div>
              </td>

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
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>
</div>
<script>
$('#start-datepicker input').datepicker({ format: "yyyy/mm/dd" });
$('#end-datepicker input').datepicker({ format: "yyyy/mm/dd" });
</script>
@endsection
