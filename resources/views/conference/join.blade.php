@extends('layouts.app')

@section('title', $conference->name )

@section('content')

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
                  <th>Phone number</th>
                  <th>Flight number</th>
                  <th>Hotel needed</th>
                  <th>Taxi needed</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" value="{{Auth::user()->name}}" disabled="true"></input>
                  </td>
                  <th>
                    <input type="text" name="primary[phone]"></input>
                  </td>
                  <td>
                    <input type="text" name="primary[flight]"></input>
                  </td>
                  <th>
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
              Leave <strong>Flight number</strong> blank if it is unknown
            </p>
            <p class="text-left">
              <label>
                <input type="checkbox" name="same_flight" style="margin-right: 5px"></input>
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
                    <th>Phone number</th>
                    <th>Flight number</th>
                    <th>Hotel needed</th>
                    <th>Taxi needed</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody id="participants">
                  <tr id="participants_row0">
                    <td>
                      <input type="text" name="participant[0][name]"></input>
                    </td>
                    <th>
                      <input type="text" name="participant[0][phone]"></input>
                    </td>
                    <td>
                      <input type="text" name="participant[0][flight]"></input>
                    </td>
                    <th>
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
var count = 1;
function participantTemplate(i) {
  return "<tr id='participants_row"+i+"'><td><input type='text' name='participant["+i+"][name]'></input></td><th><input type='text' name='participant["+i+"][phone]'></input></td><td><input type='text' name='participant["+i+"][flight]'></input></td><th><input type='checkbox' name='participant["+i+"][hotel]'></input></td><td><input type='checkbox' name='participant["+i+"][taxi]'></input></td><td><a onclick='removeParticipant("+i+")'><i class='fa fa-times'></i></a></td></tr>";
}

function addParticipant() {
  $('#participants').append(participantTemplate(count));
  count++;
}

function removeParticipant(index) {
  $('#participants_row'+index).remove();
}

</script>
@endsection
