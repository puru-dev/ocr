<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ocr Test') }}</title>
    
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ "Ocr Test" }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('nav')
        </main>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
<script>
    $(document).ready(function(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } 
    });
    function showPosition(position) {
      $("#latitude").val(position.coords.latitude);
      $("#longitude").val(position.coords.longitude); 
    }
</script>
<script>
$(document).ready(function(){
$(document).on("click", "#update_data", function() { 
   var url = "{{@$employee->id?URL('employee/update/'.@$employee->id):URL('employee/store')}}";
   var type = "{{@$employee->id?'PATCH':'POST'}}";
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
    $.ajax({
        url: url,
        type: type,
        cache: false,
        data:{
            name: $('#name').val(),
            email: $('#email').val(),
            contact_number: $('#contact_number').val(),
            office_location: $('#office_location').val(),
            salary: $('#salary').val(),
            password: $('#password').val(),
            latitude: $('#latitude').val(),
            longitude: $('#longitude').val()
        },
        success: function(data){
            if (data.errors) {
            jQuery('.alert-danger').empty();
           jQuery.each(data.errors, function(key, value){
                jQuery('.alert-success').hide();
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+value+'</p>');
            });
       }else{
            jQuery('.alert-danger').hide();
            jQuery('.alert-success').show();
            jQuery('.alert-success').append('<p>'+data.success+'</p>');
       }
    }
        });

    }); 

});

</script> 
<script type="text/javascript">
    $('#sel2').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-counties')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#sel1").empty();
                $.each(res,function(key,value){
                    $("#sel1").append('<option value="'+value+'">'+value+'</option>');
                });
                $("#sel1").selectpicker('refresh');
           
            }else{
               $("#sel1").empty();
               $("#sel1").selectpicker('refresh');
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>    
</body>
</html>
