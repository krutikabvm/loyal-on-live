<!DOCTYPE html>

<html lang="en">

<head>

<title>{{env('APP_NAME')}} - @yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/x-icon" href="./assets/images/favicon.png">





<link rel="stylesheet" href="{{asset('admin_dashboard/assets/css/bootstrap-min.css')}}">

<link rel="stylesheet" href="{{asset('admin_dashboard/assets/css/style.css')}}">

<link rel="stylesheet" href="{{asset('admin_dashboard/assets/css/jquery.timepicker.min.css')}}" type="text/css">



<script src="{{asset('admin_dashboard/assets/js/jQuery-v3.6.0.js')}}" type="text/javascript"></script>

<script src="{{asset('admin_dashboard/assets/js/bootstrap.js')}}" type="text/javascript"></script>



<script src="{{asset('admin_dashboard/assets/js/jquery.timepicker.js')}}" type="text/javascript"></script>



<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<meta name="csrf-token" content="{{ Session::token() }}"> 

</head>

<body>

    

    

     <div class="busines-admin">

        <div class="container-fluid">

            <div class="admin-panel-main">

                @include("admin_dashboard.sidebar")

                <!-- right side -->

                <div class="admin-right" id="main">

                    <!-- Top sidebar -->

                    @include("admin_dashboard.topbar")

                    <!-- Top sidebar End -->

                     @yield('content')





                </div>

            </div>

        </div>

    </div>

    

    

    @yield('script')



    <script>
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
      
     $(document).ready(function() {
        if ($(window).width() < 991) {
            $(".admin-right").addClass("full-width-side");
            $("#mySidenav").hide(0);
        }
        $("#show-menu").click(function() {
            $("#mySidenav").slideToggle(0);
            if ($(".admin-right").hasClass("full-width-side")) {
                $(".admin-right").removeClass("full-width-side");
            } else {
                $(".admin-right").addClass("full-width-side");
            }
        });


    });
    $(document).ready(function(){

        // if ($(window).width() < 991){

        //     $(".admin-right").addClass("full-width-side");

        //     $("#mySidenav").hide(0);

        // } 

        // $("#show-menu").click(function(){
            
        //     $("#mySidenav").slideToggle(0);
        //     console.log("as");
        //     if($(".admin-right").hasClass("full-width-side"))
        //     {
        //         $(".admin-right").removeClass("full-width-side"); 
        //     }else{
        //         $(".admin-right").addClass("full-width-side");
        //     }

        // });



    });
</script>

</body>

</html>