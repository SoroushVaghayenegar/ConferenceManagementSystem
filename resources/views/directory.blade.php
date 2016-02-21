@extends('layouts.app')

@section('title', 'Gobind Sarvar Conference')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style='opacity: 0.8; position: relative;'>
                <div class="panel-heading">
                    <h1 style="text-align: left;">Current Conferences</h1>
                </div>
				<div class="panel-body">
					<table width="100%" class="table table-striped conference-table">
                    	<thead>
                        	<th>Name</th>
                            <th>Description</th>
                      </thead>
                      <tbody style="position: relative; center: 40%;">
                      	<tr>
                          <td class="table-text">&nbsp;Name</td>
                          <td> 
                          	<button type="submit" class="btn btn-info"><i class=""></i>Detail</button>
                        </td>
                        </tr>
                      </tbody>
                    </table>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
