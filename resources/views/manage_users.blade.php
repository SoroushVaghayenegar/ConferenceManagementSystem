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
    <div class="panel panel-dark" >

        <h1 align='center' style="color:white"><strong>Users</strong></h1>

        <div class="panel-body">
            <table id="users_table" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Admin</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->id}}</td>
                            <td>@if($user->is_admin) 
                                    True
                                @else
                                    False
                                @endif</td>
                            <td><a href="" class="btn btn-danger">Remove</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
        
<!-- Script for running DataTable -->
        <script>
          $(function(){
            $("#users_table").dataTable();
          })
          $(document).ready(function(){
            $('.sidebar-menu > li').attr('class','');
            $('#sidebar-manageUsers').attr('class','active');
          })
        </script>
@endsection
