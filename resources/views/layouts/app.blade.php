<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>





    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <link href="/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="/css/widgets.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet" />
    <link href="/css/xcharts.min.css" rel=" stylesheet">
    <link href="/css/jquery-ui-1.10.4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    <!-- javascripts -->
    <!-- bootstrap -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="/js/scripts.js"></script>

    <link href="/css/style.css" rel="stylesheet">
    <?php

    $i = rand(1, 28);
    ?>

    <!-- for background use numbers 1-28 for different patters -->
    <style>
        body {
            font-family: 'Raleway';
            margin-top: 25px;
            background-image: url('/background_patterns/23.png');
        }

        button .fa {
            margin-right: 6px;
        }

        .table-text div {
            padding-top: 6px;
        }
    </style>

    <script>
        $(function () {
            $('#conference-name').focus();
        });
    </script>
</head>

<body>
<section id="container" class="">
    <header class="header dark-bg">
        @if(Auth::check())
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>
        @endif
        <!--logo start-->
        <a href="{{ URL::to('') }}" class="logo">Gobind <span class="lite">Sarvar</span></a>
        <!--logo end-->
        <div class="top-nav notification-row">
            <ul class="nav pull-right top-menu">
                @if(Auth::check())
                    <!-- user  dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="/img/avatar.png">
                            </span>
                            <span class="username">{{{Auth::user()->name}}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="{{ URL::to('/profile') }}"><i class="icon_profile"></i> My Profile</a>
                            </li>

                            <li>
                                <a href="{{ URL::to('logout') }}"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user dropdown end -->
                @else
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="{{ URL::to('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                @endif
            </ul>
        </div>
    </header>

    @if(Auth::check())
    <!--sidebar start-->
          <aside>
              <div id="sidebar"  class="nav-collapse collapse">
                  <!-- sidebar menu start-->
                  <ul class="sidebar-menu">
                      <li class="active">
                          <a class="" href="{{ URL::to('') }}">
                              <i class="icon_house_alt"></i>
                              <span>Home</span>
                          </a>
                      </li>
                      <li class="">
                          <a class="" href="{{ URL::to('/directory') }}">
                              <i class="fa fa-globe"></i>
                              <span>Conferences</span>
                          </a>
                      </li>
                      @if(Auth::user()->is_admin)
                          <li class="">
                              <a class="" href="{{ URL::to('/create_conference') }}">
                                  <span>Manage conferences</span>
                              </a>
                          </li>
                          <li class="">
                              <a class="" href="{{ URL::to('/manage_users') }}">
                                    <i class="fa fa-plus"></i>
                                  <span>Manage Users</span>
                              </a>
                          </li>
                          <li>
                              <a class="" href="">
                                  <i class="icon_piechart"></i>
                                  <span>Reports</span>

                              </a>

                          </li>

                          <li class="">
                              <a class="" href="{{ URL::to('/flights')}}">
                                  <i class="fa fa-plane"></i>
                                  <span>flights</span>
                              </a>
                          </li>
                          <li class="">
                              <a class="" href="{{ URL::to('/hotel') }}">
                                  <i class="fa fa-bed"></i>
                                  <span>Hotel</span>
                              </a>
                          </li>
                      @endif
                  </ul>
                  <!-- sidebar menu end-->
              </div>
          </aside>
          <!--sidebar end-->

        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        <section>
    @else
        <section class="wrapper">
            @yield('content')
        </section>

    @endif
</section>




</body>
</html>
