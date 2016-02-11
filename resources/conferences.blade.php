@extends('layouts.app')

@section('content')
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
                    <form action="conference" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Conference Name -->
                        <div class="form-group">
                            <label for="conference-name" class="col-sm-3 control-label" Conference</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="conference-name" class="form-control" value="{{ old('conference') }}">
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
                                <th Conference</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($conferences as $conference)
                                    <tr>
                                        <td class="table-text"><div>{{ $conference->name }}</div></td>

                                        <!-- Conference Delete Button -->
                                        <td>
                                            <form action="conference/{{ $conference->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>Delete
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
@endsection
