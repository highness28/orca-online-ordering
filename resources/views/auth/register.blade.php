<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Orite Copier and Supplies</title>
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
            <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
            <link rel="stylesheet" href="{{ url('dist/css/style.css') }}">
            <link rel="stylesheet" href="{{ url('plugins/iCheck/square/blue.css') }}">
            <link rel="icon" href="{{ url('dist/img/logo.jpg') }}">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Google Font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        </head>
        <body class="hold-transition login-page">
            <div class="login-box">
            <div class="login-logo">
                <a href="/"><b>Orite Copier and Supplies </b>Dashboard</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign up to start your session</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Administrator</option>
                                <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Sales</option>
                                <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Inventory</option>
                            </select>
                        </div>
                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('brand') }}</i></div>
                    </div>

                    <div class="form-group has-feedback">
                        <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="password_confirmation" type="password" placeholder="Password confirm" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="first_name" type="text" placeholder="First Name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" name="first_name" required>
                        <span class="form-control-feedback"></span>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="middle_name" type="text" placeholder="Middle Name" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" value="{{ old('middle_name') }}" name="middle_name">
                        <span class="form-control-feedback"></span>
                        @if ($errors->has('middle_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('middle_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="last_name" type="text" placeholder="Last Name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" name="last_name">
                        <span class="form-control-feedback"></span>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input id="mobile_number" type="number" placeholder="Mobile Number" class="form-control{{ $errors->has('mobile_number') ? ' is-invalid' : '' }}" value="{{ old('mobile_number') }}" name="mobile_number">
                        <span class="form-control-feedback"></span>
                        @if ($errors->has('mobile_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile_number') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

            <!-- jQuery 3 -->
            <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
            <!-- iCheck -->
            <script src="{{ url('plugins/iCheck/icheck.min.js') }}"></script>
    </body>
</html>