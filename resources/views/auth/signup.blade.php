<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('default/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('default/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('default/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('default/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('default/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" href="{{ asset('default/dist/css/spx.css')}}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!--[if IE]>
    <style>
        .login-box-body{
            border: 1px solid #ddd;
        }
    </style>
    <![endif]-->
    <style>
        .login-page{
            background: #fff;
        }
        .logo-login{
            text-align: center;
        }
        .login-box-msg{
            text-align: center;
            margin-top:10px;
            font-weight: bold;
        }
        .login-box-body{
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
        }
        .login-logo{
            /*margin-top: 50px;*/
            background: #f9b638;
            margin-bottom: 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
        }
        .login-box{
            padding-top:50px;
        }
        .btn-login{
            background: #f9b638;
            color: #fff;
        }
        .btn-login:hover{
            background: #f1ba54;
            color:#fff;
        }
    </style>
</head>
<body class="hold-transition login-page">
@if(Auth::user())
    <script>window.location.href='/';</script>
@endif
<div class="login-box">
    <div class="login-logo">
        <a href="/" style="text-transform: uppercase;font-size: 30px;color:#fff;"><b>????ng nh???p</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">T??n</label>
                <input class="form-control form-control-lg" type="text" value="{{old('name')}}" name="name" placeholder="Nh???p v??o t??n c???a b???n" />
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control form-control-lg" type="email" value="{{old('email')}}" name="email" placeholder="Nh???p v??o email" />
            </div>
            <div class="mb-3">
                <label class="form-label">M???t kh???u</label>
                <input class="form-control form-control-lg" type="password" value="{{old('password')}}" name="password" placeholder="Nh???p m???t kh???u" />
            </div>

            <div class="mb-3">
                <label class="form-label">Nh???p l???i m???t kh???u</label>
                <input class="form-control form-control-lg" type="password" value="{{old('repassword')}}" name="repassword" placeholder="Nh???p l???i m???t kh???u" />
            </div>
            <a href="{{ route('login') }}">B???n ???? c?? t??i kho???n ? ????ng nh???p ngay</a>

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-lg btn-primary">Sign up</button>
            </div>
        </form>
        <p class="text-danger login-box-msg">Vui l??ng k?? ????? ti???p t???c!
        <?php //Hi???n th??? th??ng b??o th??nh c??ng?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <?php //Hi???n th??? th??ng b??o l???i?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('default/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('default/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('default/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{ asset('default/dist/js/spx.js')}}?v=1"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
