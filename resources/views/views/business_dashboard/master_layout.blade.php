<!DOCTYPE html>

<html lang="en">

<head>

<title>{{env('APP_NAME')}} - @yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/x-icon" href="./assets/images/favicon.png">





<link rel="stylesheet" href="{{asset('business_dashboard/assets/css/bootstrap-min.css')}}">

<link rel="stylesheet" href="{{asset('business_dashboard/assets/css/style.css')}}">

<link rel="stylesheet" href="{{asset('business/assets/css/jquery.timepicker.min.css')}}" type="text/css">



<script src="{{asset('business_dashboard/assets/js/jQuery-v3.6.0.js')}}" type="text/javascript"></script>

<script src="{{asset('business_dashboard/assets/js/bootstrap.js')}}" type="text/javascript"></script>



<script src="{{asset('business/assets/js/jquery.timepicker.js')}}" type="text/javascript"></script>



<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<meta name="csrf-token" content="{{ Session::token() }}">

</head>

<body>





     <div class="busines-admin">

        <div class="container-fluid">

            <div class="admin-panel-main">

                @include("business_dashboard.sidebar")

                <!-- right side -->

                <div class="admin-right" id="main">

                    <!-- Top sidebar -->

                    @include("business_dashboard.topbar")

                    <!-- Top sidebar End -->

                @yield('content')





                </div>

            </div>

        </div>

    </div>


<style>

    .infoim {
        background: url("{{asset('business_dashboard')}}/assets/images/infoicon.png");
	width: 22px;
	height: 19px;
	float: right;
	background-repeat: no-repeat;
	background-position: center;
	/* border: 2px solid; */
	/* border-radius: 50%; */
	/* padding: 12px; */
	/* background-size: 6px; */
    cursor: pointer;
}
.nft-logo3 img {
	-webkit-filter: grayscale(100%);
	filter: grayscale(100%);
}
.nft-logo3 .active img {
	-webkit-filter: grayscale(0%);
	filter: grayscale(0%);
}
.nft-logo3 li.active {

	background: #fff !important;
}
.nft-logo3 li {

background: unset !important;
}
</style>


    @yield('script')



    <script>

    // $(document).ready(function(){

    //     $("#show-menu").click(function(){

    //         $("#mySidenav").slideToggle(100);

    //     });

    //     $("#show-menu").click(function(){

    //         $(".admin-right").addClass("full-width-side");

    //     });

    // });







    $(document).ready(function(){

        if ($(window).width() < 991)

    {

        $(".admin-right").addClass("full-width-side");

        $("#mySidenav").hide(0);

    }

        $("#show-menu").click(function(){

            $("#mySidenav").slideToggle(0);

            if($(".admin-right").hasClass("full-width-side"))

            {$(".admin-right").removeClass("full-width-side");}

            else{$(".admin-right").addClass("full-width-side");}

        });





    });

$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});





</script>

</body>

</html>
