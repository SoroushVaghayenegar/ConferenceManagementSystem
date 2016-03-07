@extends('layouts.app')

@section('title', $conference->name )

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Join Conference</div>

        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')

          <h1 class="text-capitalize">{{$conference->name}} Conference</h1> </br>
          <p class="text-left"><strong>Description:</strong>  {{$conference->description}} <strong>Capacity:</strong>  {{$conference->capacity}}</p>
          <p class="text-left"><strong>Start:</strong>   {{$conference->start}} <strong>End:</strong>    {{$conference->end}}</p>

          <form action="/conference/{{$conference->id}}/join" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <p class="text-center">
              <strong>Register</strong>
            </p>
            <p class="text-left">
              <input type="checkbox" name="same_flight"></input>
              All participants are travelling on the same flight
            </p>

            <p class="text-left">
              <input type="checkbox" name="same_hotel"></input>
              All participants are staying in the same hotel room
            </p>

            <p class="text-left"><strong>For each participant joining in your group, enter their information:</strong></p>

            <div class="form-group" style="margin: 0">
              <table class="join-table table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Phone number</th>
                    <th>Flight number</th>
                    <th>Hotel needed</th>
                    <th>Taxi needed</th>
                  </tr>
                </thead>
                <tbody id="participants">
                  <tr>
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
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
          <button class="btn btn-default" onclick="addParticipant()">Add 1 participant</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
var count = 1;
function participantTemplate(i) {
  return "<tr><td><input type='text' name='participant["+1+"][name]'></input></td><th><input type='text' name='participant["+1+"][phone]'></input></td><td><input type='text' name='participant["+1+"][flight]'></input></td><th><input type='checkbox' name='participant["+1+"][hotel]'></input></td><td><input type='checkbox' name='participant["+1+"][taxi]'></input></td></tr>";
}

function addParticipant() {
  $('#participants').append(participantTemplate(count));
  count++;
}

</script>
@endsection
