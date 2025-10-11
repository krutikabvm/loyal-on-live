@extends('admin_dashboard.master_layout')
@section('title', 'Billing')
@section('content')
<style>
    .business-search{display: block;}
    .customer-search{display: none;}
    #reviews{ display: none; }
</style>
<div class="busines3-main">

	<div class="switch-field">
	    <a href="{{route('admin.business')}}" class="back-btn"> <img src="{{asset('admin_dashboard/assets/images/back.png') }}" alt="img"> Back</a>
<!-- 	    <a href="#" class="cancel-btn">Cancel Account</a> -->
	    <input type="radio" id="radio-one" name="switch-one" value="yes" checked="">
	    <label for="radio-one">Profiles</label>
	    <input type="radio" id="radio-two" name="switch-one" value="no">
	    <label for="radio-two">Review <sub> {{ count($business_reviews) }} </sub> </label>
	</div>

	<div class="invoice-main" id="profiles">
	    <h2>Invoices</h2>
	    <ul class="invoice-ul">
	        <li>
	            <span class="active">
	                <img src="{{asset('admin_dashboard/assets/images/active2.svg') }} " alt="icon">
	                PAID
	            </span>
	            <span>August 1, 2021</span>
	            <span>$14:95</span>
	        </li>
	        <li>
	         <span class="active">
	             <img src="{{asset('admin_dashboard/assets/images/active2.svg') }}" alt="icon">
	             PAID
	         </span>
	         <span>August 1, 2021</span>
	         <span>$14:95</span>
	     </li>
	     <li>
	         <span class="active">
	             <img src="{{asset('admin_dashboard/assets/images/active2.svg') }}" alt="icon">
	             PAID
	         </span>
	         <span>August 1, 2021</span>
	         <span>$14:95</span>
	     </li>
	    </ul>
	</div>
	<div id="reviews"> 
        <ul class="business1-ul" >
            @if(!empty($business_reviews))
                @foreach($business_reviews as $key => $b)
                    <li>
                        <div class="busi-left">
                            <span class="p-img">
                                @if(!empty($b->image) )
                                    <img src="{{env('APP_URL').$b->image}}" alt="no img">
                                    
                                @else
                                    <img src="{{asset('admin_dashboard/assets/images/cafe.png') }}" alt="no img">

                                @endif
                            </span>
                            <div class="about-person">
                                <span class="p-info">Name: <strong>{{ @$b->business_name }}</strong></span>
                                <span class="p-info">Account Type: <strong class="premium">@if($b->plan == 1 ) Free @else Premium @endif</strong> </span>
                                <span class="p-info">Loyalty Cards: <strong>{{ @$b->loyality_cards }}</strong></span>
                                @if($b->delete == 0 )
                                    <span class="p-info">Status: <strong class="active">Active</strong></span>
                                @else
                                    <span class="p-info">Status: <strong class="text text-danger">De Active</strong></span>
                                @endif
                                @if(!empty($b->created_at) )
                                    <span class="p-info">Account Created: <strong>{{ date('d-m-Y',strtotime(@$b->created_at)) }}</strong></span>
                                @else
                                    <span class="p-info">Account Created: <strong>NULL</strong></span>
                                @endif
                                <span  class="p-info">Customers: <strong>{{ @$b->customers }}</strong></span>
                            </div>
                        </div>
                        <div class="busi-right">
                            <a href="{{route('admin.business_details',encrypt(@$b->id))}}" class="view-pro">View Profile</a>
                        </div>
                    </li>
                @endforeach
            @endif
            <h3>No record found</h3>
        </ul>
        <div class="custom-pagination">
            <?php echo $business_reviews->render(); ?>
        </div>
    </div>
</div>
<script>
    $("#radio-two").click(function(){
        $("#profiles").css("display","none");
        $("#reviews").css("display","block");
    });
    $("#radio-one").click(function(){
        $("#profiles").css("display","block");
        $("#reviews").css("display","none");
    });
</script>
@endsection