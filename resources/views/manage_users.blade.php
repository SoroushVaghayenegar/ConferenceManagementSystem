@extends('layouts.app')

@section('title', 'Manage Users')



@section('content')
<!--overview start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-user"></i> Manage Users</h3>
    </div>
</div>


<div class="container">
  @if (session('cannot_set_self') || session('set_user') || session('set_admin'))
  <div class="panel panel-default">
    <header class="panel-heading">Status</header>
    <div class="panel-body">
      <h4 class="text-center">
        @if (session("cannot_set_self"))
        <i class="fa fa-exclamation"></i>
        You cannot set your own admin privileges.
        @elseif (session('set_user'))
        <i class="fa fa-check"></i>
        User set as Normal User.
        @elseif (session('set_admin'))
        <i class="fa fa-check"></i>
        User set as Admin User.
        @endif
      </h4>
    </div>
  </div>
  @endif
    <div class="panel panel-default" >

        <h1 align='center' ><strong>Users</strong></h1>

        <div class="panel-body">
            <table id="users_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>User Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->date_of_birth}}</td>
                            <td>{{$user->city}}</td>
                            <td>{{$user->country}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->id}}</td>
                            <td>
                              {{$user->is_admin ? "Admin": "Normal User"}}<br>
                              @if (!$user->is_admin)
                              <a class="btn btn-sm btn-link" href='{{url("user/$user->id/set_admin")}}'>Set as admin</a>
                              @else
                              <a class="btn btn-sm btn-link" href='{{url("user/$user->id/set_user")}}'>Set as user</a>
                              @endif
                            </td>
                            <td><a href="{{ URL::to('manage_users/'.$user->id) }}" class="btn btn-danger" style="width:100%">Remove</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script for running DataTable -->
        <script>

        $(document).ready(function() {
            $("#users_table").DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );
        } );

          $(document).ready(function(){
            $('.sidebar-menu > li').attr('class','');
            $('#sidebar-manageUsers').attr('class','active');
          })
        </script>
@endsection
