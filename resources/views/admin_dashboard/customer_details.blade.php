@extends('admin_dashboard.master_layout')

@section('title', 'Customer Details')

@section('content')
    <style>
        .business-search{display: none;}
        .customer-search{display: block;}
    </style>
    @if (\Session::has('success'))
        <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success">
                  <ul>
                      <li>{!! \Session::get('success') !!}</li>
                  </ul>
              </div>
            </div>
        </div>
    @endif
    <!-- Top sidebar End -->
   <div class="customer2-main">

        <div class="switch-field">
            <a href="{{route('admin.customers')}}" class="back-btn"> <img src="{{ asset('admin_dashboard/assets/images/back.png') }}" alt="img"> Back</a>
             @if($customer->delete == 0)
                <a href="{{route('admin.cancel_customer_account',encrypt($customer->id) )}}" class="cancel-btn">Cancel Account</a>
            @else    
                <a href="{{route('admin.reactivate_customer_account',encrypt($customer->id) )}}" class="cancel-btn">ReActivate Account</a>
            @endif   

        </div>

        <div class="customer2-maininfo">
            <div class="custom-profile-left">
                <div class="pro-info-main">
                    <div class="profile-pic3">
                    	@if(!empty($customer->img) )
                        	<img src="{{url($customer->img)}} " id="previewImg" alt="cover-img">
                        @else
                        	<img src="{{ asset('admin_dashboard/assets/images/girl.png') }} " id="previewImg" alt="cover-img">

                        @endif
                        <form class="images-form"  method="post" enctype="multipart/form-data">
                       		<input type="hidden" name="customer_id" value="{{ $customer->id }}">

                        	<input type="file" id="profileImg" name="profileImg" accept="image/*" style="display: none;">
                        	<button type="submit" class="btn btn-success cover-update" style="
                                        padding: 1px; font-size: 2.6rem; width: 51px; height: 40px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;
                                        border-radius: 0px;border-top-left-radius: 13px;">
                            ✔
                        </button>
                        </form>
                        <span class="edit-profile3" id="edit-profile" style="cursor: pointer;"><img src="{{ asset('admin_dashboard/assets/images/edit-r.png' )}}" alt="icon"></span>
                    </div>
                    <span class="pro-data">Name: <strong>{{@$customer->name}}</strong></span>
                    <span class="pro-data">Email: <strong>{{@$customer->email}}</strong></span>
                    <span class="pro-data">Phone: <strong>{{@$customer->phone_number}}</strong></span>
                    <span class="pro-data">Account Creation: 
                    <strong>
                        @if(!empty($customer->provider) )   
                            {{ucwords($customer->provider)}}
                        @else
                            E-Mail
                        @endif
                    </strong></span>
                    <span class="pro-data">DOB: <strong>{{@$customer->dob}}</strong></span>
                    <span class="pro-data">Gender: <strong>{{ucwords(@$customer->gender)}}</strong></span>
                </div>
                <ul class="customer-ul2">
                    <li>
                    <span class="p-info">Platform: 
                        @if($customer->device_type == "android")    
                            <img src="{{asset('admin_dashboard/assets/images/android-icon.png') }}" alt="no img">
                        @elseif($customer->device_type == "ios")
                            <img src="{{asset('admin_dashboard/assets/images/apple-icon.png') }}" alt="no img">
                        @endif  
                    </span>
                    </li>
                    <li>
                        <span>Loyalty Cards: <strong>{{@$customer->cards_count}}</strong></span>
                    </li>
                </ul>
            </div>
            <div class="custom-profile-right">
                <h2 class="card-pre-text">Cards Collected ({{@$customer->cards_count}})</h2>
                @foreach($loyality_cards as $card)
                <span class="pro-data"><strong>{{$card->business_name}} | </strong><strong>Completed:{{@$card->claim}} </strong></span>
	                <div class="stamp-main3">

	                    <div class="logo-text-main3">

	                        <img width="50px" id="m3" src="{{env('APP_URL').$card->image}}" alt="logo">
	                        <span> <p id="s_days3" style="margin-right:3px;">Collect {{@$card->number_stamps}} </p> <p id="s_reward3"> stamps to Earn: {{@$card->description}}</p></span>

	                    </div>

	                    <div class="upi-main3" id="s_bk3" style="background-image:url('@if(!empty($card->img) ) {{ url(@$card->img) }}  @endif') ">
	                    
	                        <ul class="nft-logo" id="days_logo5">
	                       
								@for($stamps = 0; $stamps< @$card->number_stamps ; $stamps++ )
	                                @if($stamps + 1 == $card->number_stamps)
                                        @if($stamps < $card->collected_stamps)
	                                       <li class="active"><img src="{{ asset('business/assets/images/gift.svg') }}"></li>
                                        @else  
                                            <li class="active"><img src="{{ asset('admin_dashboard/assets/images/gift1.svg') }}"></li>
                                        @endif  
	                                @else
                                        @if($stamps < $card->collected_stamps)
	                                      <li class="active"><img src="{{ asset('business/assets/images/all.svg') }}"></li>
                                        @else
                                            <li class="active"><img src="{{ asset('admin_dashboard/assets/images/fan.svg') }}"></li>
                                        @endif                                        
	                                @endif
	                            @endfor

	                        </ul>
	                
	                
	                    </div>
	                </div>
                @endforeach

            </div>
        </div>

    </div>
    <script>
    	$("#edit-profile").on('click',function(){
    		$("#profileImg").trigger('click');
    	});

    	profileImg.onchange = evt => {
	        const [file] = profileImg.files
	        if (file) {
	            $('#edit-profile').hide();
	            $('#profileImg').hide();
	            $('.cover-update').css('display', 'block');
	            console.log(file);
	            previewImg.src = URL.createObjectURL(file)
	        }
	    }
	    $.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });
	    $('.images-form').on('submit',(function(e) {
	        e.preventDefault();
	        var formData = new FormData(this);
	        console.log(formData);
	        $.ajax({
	            type:'POST',
	            url: "{{route('admin.uploadCusImg')}}",
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	                data1 = JSON.parse(data);
	                alert(data1.msg);
	                $('#edit-profile').show();
			        $('.cover-update').css('display', 'none');
	            },
	            error: function(data){
	                console.log("error");
	                console.log(data);
	            }
	        });
	        
    	}));

    </script>
@endsection