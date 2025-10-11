@extends('business_dashboard.master_layout')

@section('title', 'business Plans')

@section('content')



<div class="your-plan-main">

    @php



$o=DB::table("business")

->where("user_id",auth()->user()->id)->first();



@endphp



<style>

    

    .current{

        border: 4px solid #4EADEA;

    box-sizing: border-box;

    box-shadow: 0px 2px 12px rgb(0 0 0 / 27%);



    }
    #premium_plan{
        display: none;
    }
</style>



                        <h2 class="plan-head">Your Current Plan : <span id="c_plan">@if($o->plan==1) Basic Plan @ELSE Premium Plan @endif</span></h2>

                        <div class="plan-outer">

                            <div class="pkg-outer">

                                 @foreach($plans as $plan)
                                    @php 
                                        $features = unserialize($plan->plan_features);
                                        $upcoming = unserialize($plan->upcoming_features);
                                    @endphp    

                                    <div id="@if($plan->id == 1) basic_plan @else premium_plan @endif" class="@if($o->plan==$plan->id) current @endif pkg-main pkgactive" style="@if($plan->id == 2) display: none; @endif"  >
                                        <span class="yplan" id="basic_plan_text" style="@if($o->plan==$plan->id) display: block; @else display: none; @endif" >Your Plan</span>
                                        <h3 class="pkg-title">({{$plan->plan_name}})</h3>

                                        <span class="pkg-sub-title">({{$features[0]}})</span>

                                        <ul class="pkg-ul">

                                           @for($i = 1; $i <= sizeof($features)-1; $i++ )
                                                <li>
                                                    <span>{{$features[$i]}}</span>
                                                </li>
                                            @endfor

                                            @if(!empty($upcoming))
                                                 <li>
                                                    <span>*Coming Soon*</span>
                                                     @for($i = 0; $i < sizeof($upcoming); $i++ )
                                                        <p> {{ $upcoming[$i] }}</p>
                                                    @endfor
                                                </li>
                                            @endif

                                        </ul>

                                        <span id="fr" class="pkg-btn pkg-price">{{$plan->plan_price}}</span>

                                    </div>

                                @endforeach

                                    

                                <!-- <div id="premium_plan" class="@if($o->plan==2) current @endif pkg-main">
                                    <span class="yplan" id="premium_plan_text" style="@if($o->plan==2) display: block; @else display: none; @endif" >Your Plan</span>
                                    <h3 class="pkg-title">Premium</h3>

                                    <span class="pkg-sub-title">(Up to 3 Locations)</span>

                                    <ul class="pkg-ul">

                                        <li>

                                            <span>Everything in Basic +</span>

                                        </li>

                                        <li>

                                            <span>1 extra digital loyalty card</span>

                                        </li>

                                        <li>

                                            <span>Advanced Analytcics</span>

                                        </li>

                                        <li>

                                            <span>Custom branded promotional  pack</span>

                                        </li>

                                        <li>

                                            <span>Send push notfications to your customers</span>

                                        </li>

                                    </ul>

                                    <span id="pr" class="pkg-price-basic pkg-price">

                                        £19.99

                                        </span>

                                </div> -->
                            

                            </div>

                        </div>

                    </div>

                    







<script>

$.ajaxSetup({



headers: {



'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



}



});



$("#basic_plan").on("click",function(){

   

 check=$("#basic_plan").hasClass("current");



 if(!check){

   $(this).addClass("current");

   $("#premium_plan").removeClass("current");

   update_plan(1);

 }

});



$("#premium_plan").on("click",function(){

   check=$("#premium_plan").hasClass("current");

   if(!check){

   $(this).addClass("current");

   $("#basic_plan").removeClass("current");

   update_plan(2);

   }

});





function update_plan(plan){

    str="plan="+plan;

    url="{{route('update_plan')}}";

     $.ajax({

                url: url, // url where to submit the request

                type : "POST", // type of action POST || GET

                dataType : 'json', // data type

                data : str, // post data || get data

                success : function(result) {

                  console.log(result);

                if(plan==1){

                    $("#c_plan").text("Basic Plan");
                    $("#basic_plan_text").css("display","block");
                    $("#premium_plan_text").css("display","none");
                    $(".upgrade-btn").css("display","block");
                }

                 if(plan==2){

                    $("#c_plan").text("Premium Plan");
                    $("#basic_plan_text").css("display","none");
                    $("#premium_plan_text").css("display","block");
                    $(".upgrade-btn").css("display","none");
                }



                

               

                  

                },

                error: function(xhr, resp, text) {

                  

                    console.log(xhr.responseText);

                }

            })

}





</script>





@endsection



