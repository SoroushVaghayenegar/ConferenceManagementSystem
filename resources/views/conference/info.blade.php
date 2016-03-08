@extends('layouts.app')

@section('title', $conference->name )

@section('content')

<div class="container">
    <h1 class="text-capitalize">{{$conference->name}} Conference</h1> </br>
    <p class="text-left"><strong>Description:</strong> {{$conference->description}}</p>
    <p class="text-left"><strong>Capacity:</strong>    {{$conference->capacity}}</p> 
    <p class="text-left"><strong>Start Time:</strong>  {{ date('F d, Y', strtotime($conference->start)) }}</p>  
    <p class="text-left"><strong>End Time:</strong>    {{ date('F d, Y', strtotime($conference->end)) }}</p>    
</div>
@endsection