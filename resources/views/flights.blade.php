@extends('layouts.app')

@section('title', 'Flights')

@section('content')

<div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-plane"></i>Flights</h3>
        </div>
</div>
<div class="container">
  <div class="panel panel-dark" style='opacity:0.9'>
        
        <h1 align="center" style="color:white">Flights</h1>

        <div class="panel-body">

          
                  
        </div>    
  </div>  
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.sidebar-menu > li').attr('class','');
    $('#sidebar-flights').attr('class','active');
  })
</script>  

@endsection
