<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="GestStock | La première plateforme de gestion de stock en milieu
						universitaire.">
    <meta name="author" content="GestStock | La première plateforme de gestion de stock en milieu
						universitaire.">
    <meta name="keywords" content="gestion stock universitaire GestStock" />
    <title>GestStock | Dashboard</title>

    <link type="text/css" href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <script src="/jquery.min.js"></script>
    <script src="/js/app.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>

    <style>
        .card{
            margin: 20px;
        }
        .content, .content-wrapper{
            background: #fcfcfc;
            height: 100%;
        }
    </style>
    
</head>

<body class="hold-transition skin-blue sidebar-mini ">
    <!-- Site wrapper -->
    <div class="wrapper">

        @include('layouts.partials.header')

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        @include('layouts.partials.side-bar')

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if(session('flash_message'))
                <div class="row" style="width: 100%; background: #fcfcfc; margin-left: 15px; ">
                    <div class="alert alert-success" style="margin: 15px; width: 100%;">
                        {{  session('flash_message')}}
                    </div>
                </div>
            @endif
            @if(session('error_message'))
                <div class="row" style="width: 100%; background: #fcfcfc; margin-left: 15px; ">
                    <div class="alert alert-danger" style="margin: 15px; width: 100%;">
                        {{  session('error_message')}}
                    </div>
                </div>
            @endif
            
            @yield('content')

        </div>
        <!-- /.content-wrapper -->
        

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>2020 &copy; GestStock. Tous droits réservés | Développé par <a
                    href="https://iitech-benin.net" target="_blank">iitech-bénin</a></strong>
        </footer>


        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    
    
    <script>
    $('input').each(function(){
        console.log($(this).attr('type'))
        if( $(this).attr('type')=='number' ) $(this).attr('required',true)
        else if ( $(this).attr('name')=="email" ){
            $(this).attr('required',true)
            $(this).attr('type', "email")
        } 
    })

    $('input').bind('input', function(){
        if( $(this).attr('name')=='search' ){
            $('tr').css('display','none')
            var input_value = $(this).val().toLowerCase()
            if( input_value=="" ) $('tr').removeAttr('style') 
            else{
                    $('tr').each(function(){
                        var content =  $(this).text().replace(/\n/gi, "").toLowerCase()
                        if( content.includes(input_value) ){
                            $(this).css('display','block')
                        } 
                    })
            }
        }
    })

    $('form button').attr('onclick','').click(function(e) {
        e.preventDefault()
        const wrapper = document.createElement('div');
        var action = $(this).parent().attr('action')
        wrapper.innerHTML = '<form method="POST" action="'+action+'" accept-charset="UTF-8" style="display:inline">'+
                            `<input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="7RKP2BgnKDPLhiShWSNeq5L87uqFyrl7H49gVGFf">
                            <button type="submit" class="btn btn-warning" style="color: white"  title="Supprimer AjoutStock" > Continuer </button>
                                        
                        </form>`;
        swal({
            title: "Attention, voulez vous vraiment continuer la suppression ?",
            content: wrapper, 
            icon: "warning",
            buttons: false,
        });
    })
    $('form').submit(function(e){
        if( $(this).attr('role')=="search" ){
            e.preventDefault()
        }
    })
    </script>
</body>

</html>
