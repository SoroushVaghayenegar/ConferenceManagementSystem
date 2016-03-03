@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-globe"></i> Current Conferences</h3>
        </div>
</div>
<!-- SHOW IF ONLY USER IS ADMIN -->
@if(Auth::user()->is_admin)
  <a href="{{ URL::to('create_conference') }}" class="btn btn-danger"><i class="icon_plus_alt"></i>  Create a new conference</a>
  </br>
  </br>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style='opacity: 0.8; position: relative;'>
                <div class="panel-heading">
                    <h1 style="text-align: center;"><strong>Conferences</strong></h1>
                </div>
				<div class="panel-body">
					<table width="100%" class="table table-striped conference-table">
                    	<thead>
                        	<th>Name</th>
                          <th>Capacity</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th></th>
                      </thead>
                      <tbody style="position: relative; center: 40%;">
                        @foreach ($conferences as $conference)
                        	<tr>
                            <td class="table-text">{{ $conference->name }}</td>
                            <td class="table-text">{{ $conference->capacity }}</td>
                            <td class="table-text">{{ $conference->start }}</td>
                            <td class="table-text">{{ $conference->end }}</td>
                            <td>
                              <a href="{{ URL::to('conference/'.$conference->id) }}" class="btn btn-info">Details</a> 
                            </td>
                            <td> 
                              <button type="submit" class="btn btn-info"><i class=""></i>Register</button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
