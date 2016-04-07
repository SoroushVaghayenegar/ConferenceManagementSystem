@extends('layouts.app')

@section('title', $conference->name )

@section('content')
  <!-- Bootstrap Datepicker plugin-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Join Conference</div>

          <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <h1 class="text-capitalize">{{$conference->name}} Conference</h1> </br>
            <p class="text-left"><strong>Description:</strong>  {{$conference->description}} <strong>Capacity:</strong>  {{$conference->capacity}}</p>
            <p class="text-left"><strong>Start:</strong>   {{date('F d, Y', strtotime($conference->start))}} <strong>End:</strong>    {{date('F d, Y', strtotime($conference->end))}}</p>

            <form action="/conference/{{$conference->id}}/join" method="POST" class="form-horizontal">
              {{ csrf_field() }}
              <p class="text-center">
                <strong>Register</strong>
              </p>

              <p class="text-left"><strong>Enter your information:</strong></p>

              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone number</th>
                    <th>Flight number</th>
                    <th>Arrival date</th>
                    <th>Arrival time</th>
                    <th>Hotel needed</th>
                    <th>Taxi needed</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled="true"></input>
                    </td>
                    <td>
                      <input type="text" class="form-control" value="{{Auth::user()->gender}}" disabled="true"></input>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="primary[phone]"></input>
                    </td>
                    <td>
                      <input type="text" id="primary_flight" class="form-control" name="primary[flight]"></input>
                    </td>
                    <td>
                      <div id="arrival_date-datepicker">
                        <input type="text" class="form-control" name="primary[arrival_date]"></input>
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="primary[arrival_time]"></input>
                    </td>
                    <td>
                      <input type="checkbox" name="primary[hotel]"></input>
                    </td>
                    <td>
                      <input type="checkbox" name="primary[taxi]"></input>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p class="text-left">
                <i class="fa fa-info-circle" style="margin-right: 5px"></i>
                Leave <strong>Flight number</strong> and <strong>arrival info</strong> blank if it is unknown
              </p>

              <p class="text-left">
                <label>
                  <input type="checkbox" id="same_flight" name="same_flight" style="margin-right: 5px"></input>
                  All participants are travelling on the same flight with me
                </label>
              </p>

              <p class="text-left">
                <label>
                  <input type="checkbox" name="same_hotel" style="margin-right: 5px"></input>
                  All participants are staying in the same hotel room with me
                </label>
              </p>

              <p class="text-left"><strong>For each additional participant in your group, enter their information:</strong></p>

              <div class="form-group" style="margin: 0">
                <table class="join-table table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone number</th>
                      <th>Flight number</th>
                      <th>Arrival date</th>
                      <th>Arrival time</th>
                      <th>Hotel needed</th>
                      <th>Taxi needed</th>
                      <th>Remove</th>
                    </tr>
                  </thead>
                  <tbody id="participants">
                    <tr id="participants_row0">
                      <td>
                        <input type="text" class="form-control" name="participant[0][name]"></input>
                      </td>
                      <td>
                        <div class="input-group date">
                          <select class="form-control" name="participant[0][gender]">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="participant[0][phone]"></input>
                      </td>
                      <td>
                        <input type="text" class="form-control participant_flight" name="participant[0][flight]"></input>
                      </td>
                      <td>
                        <div id="arrival_date-datepicker">
                          <input type="text" class="form-control" name="participant[0][arrival_date]"></input>
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="participant[0][arrival_time]"></input>
                      </td>
                      <td>
                        <input type="checkbox" name="participant[0][hotel]"></input>
                      </td>
                      <td>
                        <input type="checkbox" name="participant[0][taxi]"></input>
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <button type="button" class="btn btn-default" onclick="addParticipant()">Add more participant</button>
                <button type="submit" class="btn btn-default pull-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  $('#arrival_date-datepicker input').datepicker({ startView: 2 });

  var same_flight = false;

  var count = 1;
  function participantTemplate(i) {
    return "<tr id='participants_row"+i+"'>\
    <td><input type='text' class='form-control' name='participant["+i+"][name]'></input></td>\
    <div class='input-group date'><td><select class='form-control' name='participant["+i+"][gender]'>\
    <option value='Male'>Male</option><option value='Female'>Female</option></select></div></td>\
    <td><input type='text' class='form-control' name='participant["+i+"][phone]'></input></td> \
    <td><input type='text' class='form-control participant_flight' name='participant["+i+"][flight]'></input></td> \
    <td><div id='arrival_date-datepicker'><input type='text' class='form-control' name='participant["+i+"][arrival_date]'></input></div></td> \
    <td><input type='text' class='form-control' name='participant["+i+"][arrival_time]'></input></td> \
    <td><input type='checkbox' name='participant["+i+"][hotel]'></input></td> \
    <td><input type='checkbox' name='participant["+i+"][taxi]'></input></td> \
    <td><a onclick='removeParticipant("+i+")'><i class='fa fa-times'></i></a></td></tr>";
  }

  function addParticipant() {
    $('#participants').append(participantTemplate(count));

    if (same_flight) {
      $(".participant_flight").val($("#primary_flight").val());
      $(".participant_flight").prop("disabled", true);
    }

    count++;
  }

  function removeParticipant(index) {
    $('#participants_row'+index).remove();
  }

  $("#same_flight").click(function () {
    if ($(this).is(':checked')) {
      same_flight = true;
      $(".participant_flight").prop("disabled", true);
      $(".participant_flight").val($("#primary_flight").val());

      $("#primary_flight").keyup(function(){
         $(".participant_flight").val($("#primary_flight").val());
      });
    } else {
      same_flight = false;
      $(".participant_flight").prop("disabled", false);
      $("#primary_flight").off("keyup");
    }
  });

  </script>
@endsection
