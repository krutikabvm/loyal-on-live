@php



$o=DB::table("business")

->where("user_id",auth()->user()->id)->first();



@endphp

<div class="top-sidebar-main">
    <div class="sidebar-left-main">
        <span class="menu" id="show-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
              </svg>
        </span>
        <div class="search-top business-search">
            <form action="{{route('admin.business_search')}}" method="GET">
        	@csrf
                <input type="search" placeholder="Search..." name="search">
            </form>
        </div>
        <div class="search-top customer-search">

            <form action="{{route('admin.customer_search')}}" method="POST">
            	@csrf
                <input type="search" placeholder="Search..." name="search">
            </form>
        </div>
    </div>
    <div class="sidebar-right-main">
        <a href="{{route('admin.logout')}}" class="logout-btn"> <img src="{{asset('admin_dashboard/assets/images/log-out1.svg')}}" alt="icon"> Logout</a>
    </div>
</div>

<script>
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
</script>