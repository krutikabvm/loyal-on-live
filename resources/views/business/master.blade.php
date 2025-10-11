<!DOCTYPE html>
<html lang="en">
<head>
    
<title>{{env('APP_NAME')}} - @yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="{{asset('business/assets/images/favicon.png')}}">
<link rel="stylesheet" href="{{asset('business/assets/css/style.css')}}" type="text/css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{asset('business/assets/css/bootstrap-min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('business/assets/css/jquery.timepicker.min.css')}}" type="text/css">
<script src="{{asset('business/assets/js/jQuery-v3.6.0.js')}}" type="text/javascript"></script>
<script src="{{asset('business/assets/js/bootstrap.js')}}" type="text/javascript"></script>

<link rel="stylesheet" href="{{asset('business/assets/css/jquery-ui.css')}}">
<script src="{{asset('business/assets/js/jQuery-ui.js')}}"></script>
<meta name="csrf-token" content="{{ Session::token() }}"> 

<script src="{{asset('business/assets/js/jquery.timepicker.js')}}" type="text/javascript"></script>

<style>
    
    .pricing{
        border:1px solid #FF3D5A;
    }
</style>
</head>

<body>
      @yield('content')
    
    
        @yield('script')
        <script src="{{asset('business/assets/js/custom.js')}}" type="text/javascript"></script>

</body>

</html>



