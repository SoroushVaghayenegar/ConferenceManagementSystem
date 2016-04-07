@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<!-- Bootstrap Datepicker plugin-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-user"></i> Profile</h3>
                    <!-- <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="icon_documents_alt"></i>Pages</li>
                        <li><i class="fa fa-user-md"></i>Profile</li>
                      </ol> -->
                    </div>
                  </div>
                  <div class="row">
                    <!-- profile-widget -->
                    <div class="col-lg-12">
                      <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                          <div class="col-lg-2 col-sm-2">
                            <strong><span class="username">{{Auth::user()->name}}</span></strong>
                            <input id="profile-image-upload" class="hidden" type="file">               
                            <div  class="follow-ava" >
                              <img  id="profile_picture" alt="Change Image" src="img/1.jpg" class="img-circle">
                            </div>
                            <!-- <h6>Administrator</h6>  -->                             
                          </div>
                          <div class="col-lg-4 col-sm-4 follow-info">
                            <!-- Can edit information here later-->
                            <p></p>
                            <p></p>
                            <!-- <p><i class="fa fa-twitter"></i></p> -->
                            <h6>
                              <span><i class="icon_calendar"></i><strong>Joined:</strong></span>
                              {{ date('F d, Y', strtotime(Auth::user()->created_at)) }}
                            </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- page start-->
                  <div class="row">
                   <div class="col-lg-12">
                    <section class="panel">
                      <header class="panel-heading tab-bg-info">
                        <ul class="nav nav-tabs">
                                  <!-- <li class="active">
                                      <a data-toggle="tab" href="#recent-activity">
                                          <i class="icon-home"></i>
                                          Daily Activity
                                      </a>
                                    </li> -->
                                    <li class="active">
                                      <a data-toggle="tab" href="#profile">
                                        <i class="icon-user"></i>
                                        <strong>Profile</strong>
                                      </a>
                                    </li>
                                    <li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                        <i class="icon-envelope"></i>
                                        <strong>Edit Profile</strong>
                                      </a>
                                    </li>
                                    
                                  </ul>
                                </header>
                                <div class="panel-body">
                                  <div class="tab-content">
                                    <!-- profile -->
                                    <div id="profile" class="tab-pane active">
                                      <section class="panel">
                                        
                                       <div class="panel-body bio-graph-info">
                                        <h1><strong>Biography</strong></h1>
                                        <div class="row">
                                          <div class="bio-row">
                                            <p><span><strong>Name </span>:</strong>&nbsp; {{Auth::user()->name}}</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span><strong>Gender </span>:</strong>&nbsp; {{Auth::user()->gender}}</p>
                                          </div>                                           
                                          <div class="bio-row">
                                            <p><span><strong>Date of Birth </span>:</strong>&nbsp; {{Auth::user()->date_of_birth}}</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span><strong>City </span>:</strong>&nbsp; {{Auth::user()->city}}</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span><strong>Country </span>:</strong>&nbsp; {{Auth::user()->country}}</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span><strong>Email </span>:</strong>&nbsp; {{Auth::user()->email}}</p>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </section>
                                    <section>
                                      <div class="row">                                              
                                      </div>
                                    </section>
                                  </div>
                                  <!-- edit-profile -->
                                  <div id="edit-profile" class="tab-pane">
                                    <section class="panel">                                          
                                      <div class="panel-body bio-graph-info">
                                        <h1> <strong>Profile Info</strong></h1>
                                        <form class="form-horizontal" action="{{ url('/profile') }}" method="post" role="form">
                                          <!-- added for csrf -->
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}" />                                                 
                                          <div class="form-group">
                                            <label for="name" class="col-lg-2 control-label"><strong>Name</strong></label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="name" name="name" placeholder=" " value="{{Auth::user()->name}}">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-lg-2 control-label"><strong>Gender</strong></label>
                                            <div class="col-lg-6" id="gender">
                                                <input type="text" class="form-control" name="gender" value="{{Auth::user()->gender}}" disabled>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-lg-2 control-label"><strong>Date of Birth</strong></label>
                                            <div class="col-lg-6" id="date_of_birth-datepicker">
                                                <input type="text" class="form-control" name="date_of_birth" value="{{Auth::user()->date_of_birth}}">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-lg-2 control-label"><strong>City</strong></label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control"  name="city" placeholder="" value="{{Auth::user()->city}}">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label"><strong>Country</strong></label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="c-name" name="country" placeholder="" value="{{Auth::user()->country}}">
                                            </div>
                                          </div>
										  
                                          
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label" for="email"><strong>Email</strong></label>
                                            <div class="col-lg-6">
                                              <input type="email" class="form-control" id="email" name="email" placeholder=" "  value="{{Auth::user()->email}}" disabled>
                                              
                                            </div>
                                          </div>
                                    
              

                                          <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" name="submit" type="submit" class="btn btn-primary">Save</button>
                                              <button type="button" class="btn btn-danger">Cancel</button>
											  
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                    </section>
                                  </div>
                                  
                                </div>
                              </div>
                            </section>
                          </div>
                        </div>

<script>
$('#date_of_birth-datepicker input').datepicker({ startView: 2});


</script>
<!--

-->

<!-- page end-->
@endsection
