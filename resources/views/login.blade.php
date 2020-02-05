<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">
  <title>Geststock | Connexion</title>
  <!-- Bootstrap Core CSS -->
  <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{asset('css/animate.css')}}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <!-- color CSS -->
  <link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body style="background: #1e3953;  ">
  <div class="row">
    <div class="col-md-4">
    </div>

    <div class="col-md-4">
      <div class="white-box" style="margin-top: 20%; margin-bottom: 40%; border-radius: 5px">
       
         <br><br><br><br><br>
            <form class="form-horizontal new-lg-form" action="{!! route('user/login') !!}" method="post">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <!--a href="#" class="text-center db"><img style="height: 60px;"
                  src="{{asset('plugins/images/admin-logo-dark.jpg')}}" alt="Home" /><br /> </a-->
              <a href="#" class="text-center db" style="color: #5673fd; font-size: 2em; font-weight: bold">GestStock<br/> </a>
              <h4 class="text-center" style="color: #1e3953; font-weight: bold"> Connexion </h4>
              <div class="form-group m-t-40">
                <div class="col-xs-12">
                  <input class="form-control" type="text" name="id" required="" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <input class="form-control" type="password" name="password" required="" placeholder="Password">
                </div>
              </div>
              @if(session('error'))
              <div class="alert alert-danger" style="border-radius: 5px">
                {{  session('error') }}
              </div>
              @endif
              <div class="form-group">
                <div class="col-md-12">
                  <div class="checkbox checkbox-primary pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup"> Se souvenir </label>
                  </div>
                  <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i>
                    Mot de passe oublié ?</a>
                </div>
              </div>
              <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                  <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Se
                    connecter</button>
                </div>
              </div>
              <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                  <br>
                  <!--p>Votre compte n'est pas encore activé ? <a href="{{URL::to('/')}}/user/activate"
                      class=" m-l-5"><b>Activez le</b></a></p-->
                </div>
              </div>
            </form>
      </div>
    </div>

  </div>

  <!-- jQuery -->
  <script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- Menu Plugin JavaScript -->
  <script src="{{asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>

  <!--slimscroll JavaScript -->
  <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
  <!--Wave Effects -->
  <script src="{{asset('js/waves.js')}}"></script>
  <!-- Custom Theme JavaScript -->
  <script src="{{asset('js/custom.min.js')}}"></script>
  <!--Style Switcher -->
  <script src="{{asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>



</body>

</html>
