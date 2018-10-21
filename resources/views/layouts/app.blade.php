<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Orite Coper and Supplies</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/morris.js/morris.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link red="icon" href="{{ url('dist/img/logo.jpg') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  @yield('css')

  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b>rite</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Orite</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> &nbsp;
              <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ Auth::user()->avatar ? 'data:image/png;base64,'.base64_encode(Auth::user()->avatar) : url('img/users/default.png') }}" class="img-circle">
                <p>
                  {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                  <small>Joined {{ Auth::user()->created_at->diffForHumans() }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('/user') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" class="btn btn-default btn-flat" value="Sign out">
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::user()->avatar)
            <img src="data:image/png;base64,{{ base64_encode(Auth::user()->avatar) }}" class="img-circle" alt="User Image" style="height: 100%">
          @else
              <img src="{{ url('/img/users/default.png') }}" class="img-circle" alt="Product" style="width: 100%">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>
            @if(Auth::user()->role == 1)
              Administrator
            @elseif(Auth::user()->role == 2)
              Sales Personnel
            @else
              Stock Custodian
            @endif
          </a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>


        
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li><a href="{{ url('/orders') }}"><i class="fa fa-book"></i> <span>Orders</span></a></li>
        
        @if(in_array(Auth::user()->role, [1]))
          <li><a href="{{ url('/product') }}"><i class="fa fa-product-hunt"></i> <span>Products</span></a></li>
          <li><a href="{{ url('/brand') }}"><i class="fa fa-tag"></i> <span>Brands</span></a></li>
          <li><a href="{{ url('/category') }}"><i class="fa fa-list-alt"></i> <span>Category</span></a></li>
        @endif
        
        @if(in_array(Auth::user()->role, [1,2]))
          <li><a href="{{ url('/sales') }}"><i class="fa fa-dollar"></i> <span>Sales</span></a></li>
        @endif
        
        @if(in_array(Auth::user()->role, [1,3]))
          <li><a href="{{ url('/inventory') }}"><i class="fa fa-dropbox"></i> <span>Inventory</span></a></li>
        @endif
        
        <li class="header">LABELS</li>
        
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield("breadCrumbTitle")
        <small>@yield("breadCrumbSubTitle")</small>
      </h1>
      <ol class="breadcrumb">
        @yield("breadCrumbList")
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This site is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by John David O. Ladrillo and Jhona A. Isidoro</strong>
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ url('bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ url('bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{ url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ url('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<script src="{{ url('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ url('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
@yield("js")
</body>
</html>
