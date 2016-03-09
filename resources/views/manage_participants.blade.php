@extends('layouts.app')

@section('title', 'Manage Participants')



@section('content')           
<!--overview start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Manage Participants</h3>
    </div>
</div>


<div class="container">
    <div>
        <i class="fa fa-info" style="color:red"></i> <strong style="color:#0088cc"> Pick a conference first !</strong>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="option_current" value="current" checked>
                Current Conference
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="option_past" value="past">
                Past Conference
          </label>
        </div>


    </div>
    <select class="form-control" style="background-color: #808080; color:white">
        @if (count($current_conferences) > 0)
            @foreach ($current_conferences as $current_conference)
                <option>{{$current_conference->name}}</option>
            @endforeach
        @else
            <option>No conferences available!</option>
        @endif

    </select>
    <div class="panel panel-dark" style='opacity:0.9'>

        <h1 align='center' style="color:white">Participants</h1>

        <div class="panel-body">
            <table id="participants_table" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Admin</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    -->
                </tbody>
            </table>
        </div>
    </div>
</div>
        
<!-- Script for running DataTable -->
        <script>
          $(function(){
            $("#participants_table").dataTable();
          })
          $(document).ready(function(){
            $('.sidebar-menu > li').attr('class','');
            $('#sidebar-manageParticipants').attr('class','active');
          })

          $('#option_current').click(function() {
               
            });
        </script>
@endsection
