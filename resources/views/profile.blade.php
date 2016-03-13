@extends('layouts.app')

<?php 

$currentName = Auth::user()->name;
$currentEmail = Auth::user()->email;
$emailError="";



?>

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
                            <span class="username">{{{ $currentName }}}</span>               
                            <div class="follow-ava">
                              <img alt="" src="img/avatar.png">
                            </div>
                            <!-- <h6>Administrator</h6>  -->                             
                          </div>
                          <div class="col-lg-4 col-sm-4 follow-info">
                            <!-- Can edit information here later-->
                            <p></p>
                            <p></p>
                            <!-- <p><i class="fa fa-twitter"></i></p> -->
                            <h6>
                              <span><i class="icon_calendar"></i>Joined:</span>
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
                                        Profile
                                      </a>
                                    </li>
                                    <li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                        <i class="icon-envelope"></i>
                                        Edit Profile
                                      </a>
                                    </li>
                                    <li class="">
                                      <a data-toggle="tab" href="#edit-group">
                                        <i class="icon-envelope"></i>
                                        Group
                                      </a>
                                    </li>
                                  </ul>
                                </header>
                                <div class="panel-body">
                                  <div class="tab-content">
                                    <!-- profile -->
                                    <div id="profile" class="tab-pane active">
                                      <section class="panel">
                                        <div class="bio-graph-heading">
                                         <!--  Hello I’m Jenifer Smith, a leading expert in interactive and creative design specializing in the mobile medium. My graduation from Massey University with a Bachelor of Design majoring in visual communication. -->
                                       </div>
                                       <div class="panel-body bio-graph-info">
                                        <h1>Biography</h1>
                                        <div class="row">
                                          <div class="bio-row">
                                            <p><span>Name </span>:&nbsp; {{{$currentName}}}</p>
                                          </div>                                           
                                          <div class="bio-row">
                                            <p><span>Birthday </span>:</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span>Country </span>:</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span>Occupation </span>:</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span>Email </span>:&nbsp; {{{$currentEmail}}}</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span>Mobile </span>:</p>
                                          </div>
                                          <div class="bio-row">
                                            <p><span>Phone </span>: </p>
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
                                        <h1> Profile Info</h1>
                                        <form class="form-horizontal" action="{{ url('/profile') }}" method="post" role="form">
                                          <!-- added for csrf -->
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}" />                                                 
                                          <div class="form-group">
                                            <label for="name" class="col-lg-2 control-label">Name</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="name" name="name" placeholder=" " value={{{$currentName}}}>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">About Me</label>
                                            <div class="col-lg-10">
                                              <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="c-name" placeholder=" ">
                                            </div>
                                          </div>
										  
										<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
											<label class="col-lg-2 control-label">Date of Birth</label>
											<div class="col-lg-6" id="date_of_birth-datepicker">
												  <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
													@if ($errors->has('date_of_birth'))
													<span class="help-block">
														<strong>{{ $errors->first('date_of_birth') }}</strong>
													</span>
													@endif
											</div>
										</div>
										
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Occupation</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="occupation" placeholder=" ">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label" for="email">Email</label>
                                            <div class="col-lg-6">
                                              <input type="email" class="form-control" id="email" name="email" placeholder=" " value={{{$currentEmail}}}>
                                              <?php echo "<p class='text-danger'>$emailError</p>";?>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Mobile</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="mobile" placeholder=" ">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Website URL</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="url" placeholder="http://www.demowebsite.com ">
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
                                  <div id="edit-group" class="tab-pane">
                                    <section class="panel">                                          
                                      <div class="panel-body bio-graph-info">
                                        <h1> Group Info</h1>
                                        <form class="form-horizontal" action="{{ url('/profile') }}" method="post" role="form">
                                          <!-- added for csrf -->
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}" />                                                 
                                          <div class="form-group">
                                            <label for="member-name" class="col-lg-2 control-label">Name</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="member-name" name="member-name" placeholder=" " >
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-lg-2 control-label" for="member-email">Email</label>
                                            <div class="col-lg-6">
                                              <input type="email" class="form-control" id="member-email" name="member-email" placeholder=" " >
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" name="submit" type="submit" class="btn btn-primary">Add member</button>
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
$('#date_of_birth-datepicker input').datepicker({ startView: 2, format: "yyyy/mm/dd"});
</script>
<!--

-->

<!-- page end-->
@endsection
