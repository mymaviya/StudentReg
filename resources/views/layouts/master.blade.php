
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Top CBSE School in Gorakhpur | Best Public CBSE Affiliated Schools, Gorakhpur</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (Auth::check()) <meta name="user-id" content="{{ Auth::user()->id }}" /> @else <meta name="user-id" content="0" /> @endif
  <link rel="stylesheet" href="/css/app.css">
  <link rel="apple-touch-icon" sizes="180x180" href="./img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon/favicon-16x16.png">
  <link rel="icon" sizes="16x16" href="./img/favicon/favicon.icon">
  {{-- <link rel="manifest" href="./img/favicon/site.webmanifest"> --}}
  <link rel="mask-icon" href="./img/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
<style>
.link, .link:hover, .link:focus {
      text-decoration: none;
      color: inherit;
 }
    .ert{
    background-color:#bcd631;
    border-radius: unset;
    font-size: 20px !important;
    font-weight: 600;
        color: #17345b;
}
.collection_para{
    text-align: right;
    border-right: 3px solid #BCD631;
    height: 50em;
    padding-top: 100px;

}
 .collection_para ul li{
    line-height: 43px;
    list-style-type: none;
    color: #fff !important;
    padding-right: 20px;
    padding-top: 10px;
}
 .collection_para ul li:hover{
    border-bottom:1px solid #BCD631;
    color: #BCD631;

}

</style>

</head>
<body style="background: #17345b;"  class="hold-transition sidebar-mini">
<div id="app" class="wrapper">

<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Update</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <b-avatar variant="info" class="user-image img-circle elevation-2" src="/images/avatar.png"></b-avatar>
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="/images/avatar.png" class="img-circle elevation-2" alt="User Image">

            <p>{{ Auth::user()->name }} </p>
          </li>
          <!-- Menu Body -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off red"></i> {{ __('Logout') }}
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <div class="container-fluid">
    <div class="row content mt-5">

        <nav class="col-md-3 sidenav collection_para">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                    <router-link class="link" to="/NewRegistration"><li>New Student's Registration</li></router-link>

                    <router-link class="link" to="/update_register"><li>Update Student's Registration</li></router-link>

                    <router-link class="link" to="/register"><li>Pay Registration Fee</li></router-link>

                    <router-link class="link" to="/register"><li>Downloads</li></router-link>

                    <router-link class="link" to="/register"><li>Profile</li></router-link>

            </ul>
        </nav>

      <div class="col-md-9 text-left">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div>

    </div>
  </div>



</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/js/app.js"></script>

</body>
</html>
