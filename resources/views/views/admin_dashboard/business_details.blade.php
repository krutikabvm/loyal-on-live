@extends('admin_dashboard.master_layout')

@section('title', 'Businesses Details')

@section('content')
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
    <style>
        .business-search{display: block;}
        .customer-search{display: none;}
        #reviews{ display: none; }
        .other{
            width: 82%;
            padding: 5px;
            margin-top: 8px;
            float: right;display: none;
        }
        .stamp-dropright select{float: right;}
        .pac-container {
            z-index: 10000 !important;
        }
    </style>
    <div class="busines1-main">

        <div class="switch-field">

            <a href="{{route('admin.business')}}" class="back-btn"> <img src="{{asset('admin_dashboard/assets/images/back.png')}}" alt="img"> Back</a>
            @if(empty($business_details->activation_code))
                <a href="{{route('admin.active_account',encrypt($business_details->user_id) )}}" class="cancel-btn">Activate Account</a>
            @elseif(!empty($business_details->activation_code) && $business_details->account_status == "pending" )
                 <a href="#" class="cancel-btn" id="pending">Pending</a>
            @else
                @if($business_details->delete == 0)
    	            <a href="{{route('admin.cancel_account',encrypt($business_details->user_id) )}}" class="cancel-btn">Cancel Account</a>
    	        @else
    	            <a href="{{route('admin.reactivate_account',encrypt($business_details->user_id) )}}" class="cancel-btn">ReActivate Account</a>
    	        @endif
            @endif
            <input type="radio" id="radio-one" name="switch-one" value="yes" checked/>

            <label for="radio-one">Profiles</label>

            <input type="radio" id="radio-two" name="switch-one" value="no" />

            <label for="radio-two">Review <sub> {{ count($business_reviews) }} </sub></label>

        </div>

        <div class="business-step1" id="profiles">

            <div class="row">

                <div class="col-md-7">

                    <div class="profile-pic">

                        <div class="cover-photo">
                            <form class="images-form" action="{{ route('upload-image') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="business_id" value="{{ $business_details->id }}">
                                <input accept="image/*" type='file' id="coverInput" name="coverInput" @if($business_details) @if($business_details->cover_img)
                                src="{{env('APP_URL').$business_details->cover_img}}"
                                @else
                                src="{{asset('admin_dashboard')}}/assets/images/cover.svg"
                                @endif

                                @else

                                src="{{asset('admin_dashboard')}}/assets/images/cover.svg"

                                @endif

                                alt="cover-img" style="    opacity: 0; padding: 1px; font-size: 2.6rem; width: 52px; height: 40px; position: absolute; top: 104px; right: 0px; cursor: pointer; display: block; border-radius: 13px 0px 0px; z-index: 1;">
                                <img id="coverImagePreview" @if($business_details) @if($business_details->cover_img)
                                src="{{url($business_details->cover_img)}}"
                                @else
                                src="{{asset('admin_dashboard')}}/assets/images/cover.svg"
                                @endif

                                @else

                                src="{{asset('admin_dashboard')}}/assets/images/cover.svg"

                                @endif

                                alt="cover-img" />
                                <input type="file" id="my_file" style="display: none;">
                                <span class="edit-profile"><img src="{{asset('business_dashboard')}}/assets/images/cover-edit.svg" alt="icon"></span>
                                <button type="submit" class="btn btn-success cover-update" style="
                                                padding: 1px; font-size: 2.6rem; width: 51px; height: 40px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;
                                                border-radius: 0px;border-top-left-radius: 13px;">
                                    ✔
                                </button>
                            </form>

                        </div>

                        <div class="profile-pic2">
                            <form class="images-form" action="{{ route('upload-image') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="business_id" value="{{ $business_details->id }}">
                                <input accept="image/*" type='file' id="profilePicInput" name="profilePicInput"   @if(!empty($business_details->image) )
                                    src="{{env('APP_URL').$business_details->image}}"
                                @else
                                    src="{{asset('admin_dashboard/assets/images/cafe.png')}}"

                                @endif
                                alt="cover-img" style="opacity: 0; padding: 4px !important; position: absolute; right: 0; bottom: 0; padding: 0px; font-size: 15px; width: 29px; height: 28px; cursor: pointer; z-index: 1; float: right; border-radius: 0;">
                                <img id="profileImagePreview"  @if($business_details) @if($business_details->image)
                                src="{{url($business_details->image)}}"
                                @else
                                src="{{asset('admin_dashboard')}}/assets/images/profile-pic.svg"
                                @endif

                                @else

                                src="{{asset('admin_dashboard')}}/assets/images/profile-pic.svg"

                                @endif

                                alt="profile-img" />
                                <input type="file" id="my_file2" style="display: none;">
                                <button type="submit" class="btn btn-success profile-pic-update" style="
                                                  position: absolute; right: 0; bottom: 0; padding: 0px; font-size: 15px; width: 29px; height: 28px; cursor: pointer; display: none; float: right;" id="location_update">
                                    ✔
                                </button>
                                <span class="edit-profile2"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="icon"></span>
                            </form>

                        </div>
                        <div class="business-details">
                            <span class="edit-profile3" style="bottom: auto;right: 20px" data-toggle="modal" data-target="#myModal"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="icon"></span>
                            <span class="bio-text">Name: <strong>{{@$business_details->business_name}}</strong></span>

                            <span class="bio-text">Email: <strong>{{@$business_details->business_email}}</strong></span>

                            <span class="bio-text">Phone: <strong>{{@$business_details->business_number}}</strong></span>

                            <span class="bio-text">Registered Business Address: <strong>{{@$business_details->business_address}}</strong></span>

                            <h3 class="bio-head">Bio:</h3>

                            <p class="bio-details">
                                {{@$business_details->description}}
                            </p>
                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="account-type-main">

                        <span class="account-type">Account Type: <strong class="premium">@if($business_details->plan == 1 ) Free @else Premium @endif</strong></span>

                        <span class="account-type">Loyalty Cards: <strong>{{count(@$loyality_cards)}}</strong></span>

                        @if($business_details->account_status == "active" && $business_details->delete == 0 )
                            <span class="p-info">Status: <strong class="active">Active</strong></span>
                        @elseif ($business_details->delete == 1)
                            <span class="p-info">Status: <strong class="text text-danger">Deactivated</strong></span>
                        @endif



                        <div class="free-period" style="border-top: unset">

                            {{-- <p class="per-text">Free period:  2 days left</p>

                            <span><img src="{{asset('admin_dashboard/assets/images/round-e.png')}}" alt="icon"></span> --}}

                        </div>

                        <ul class="customer-ul">

                            <li style="padding-top: 15px;padding-bottom: 15px">

                                <span>Customers: <strong>{{@$customers}}</strong></span>

                            </li>

                           <!--  <li>

                                <span>Platform: </span>

                                <img src="{{asset('admin_dashboard/assets/images/android.png')}}" alt="no img">

                                <img src="{{asset('admin_dashboard/assets/images/apple.png')}}" alt="no img">

                            </li> -->

                        </ul>



                        <a href="{{route('business-billing')}}" class="billing-btn">Billing</a>



                    </div>

                    <ul class="social-main">

                        <li>
                            <span> <img src="{{asset('admin_dashboard/assets/images/fb.png')}}" alt="img"> </span>

                            <input id="fb_te" type="text" readonly placeholder="{{@$business_details->facebook_link}}">
                            <form id="fb_form" class="general_form">
                                <div id="fb_form_container" style="display:none;">
                                    <input type="hidden" name="id" value="{{$business_details->id}}">
                                    <input type="hidden" name="field" value="facebook_link">
                                    <input type="hidden" name="table" value="business">
                                    <input type="text" required placeholder="Facebook Link" value="{{@$business_details->facebook_link}}" name="facebook_link" class="custom-input" style="float: left;">
                                    <button type="submit" class="btn btn-success fb_submit" style="
                                              padding: 0px; font-size: 15px; width: 25px; height: 25px; cursor: pointer; display:none;float:right" id="location_update">
                                        ✔
                                    </button>
                                </div>

                            </form>

                            <span class="edit-field edit-input fb_e true"> <img src="{{asset('admin_dashboard/assets/images/round-e.png')}}" alt="no img"> </span>

                        </li>

                        <li>

                            <span> <img src="{{asset('admin_dashboard/assets/images/insta.png')}}" alt="img"> </span>

                            <span class="edit-field insta_e true "> <img src="{{asset('admin_dashboard/assets/images/round-e.png')}}" alt="no img"> </span>
                            <form id="insta_form" class="general_form">
                                <div id="insta_form_container" style="display:none;">

                                    <input type="hidden" name="id" value="{{$business_details->id}}">
                                    <input type="hidden" name="field" value="instagram_link">
                                    <input type="hidden" name="table" value="business">
                                    <input type="text" required placeholder="Instagram Link" value="{{$business_details->instagram_link}}" name="instagram_link" class="custom-input" style="float: left;">

                                    <button type="submit" class="btn btn-success insta_submit" style="
                                              padding: 0px; font-size: 15px; width: 25px; height: 25px; cursor: pointer; display:none;float:right" id="location_update">
                                        ✔
                                    </button>
                                </div>

                            </form>
                            <input id="insta_te" type="text" readonly placeholder="{{@$business_details->instagram_link}}">
                        </li>

                    </ul>

                </div>

            </div>



            <div class="row">

                <div class="col-md-6">

                    <div class="card-main">

                        <h2 class="card-pre-text">Loyalty Card Preview</h2>

                        @foreach($loyality_cards as $key => $card)
                            @php
                                //dd($card);
                            @endphp
                            <div class="stamp-main">
                                <div class="stamp-collect-text-main">
                                    <span class="stamp-tex">Set Stamp Collection Limit:</span>
                                    <div class="stamp-dropright" style="display: flex;">
                                        <select name="stamps_per_day" data-id="{{@$card['id']}}" class="stamps_per_day" id="stamps_per_day{{$key}}" data-stamp-id="{{$key}}">
                                            @for($i=1;$i<11;$i++) <option @if(@$card['stamps_per_day']==$i) selected @endif value="{{$i}}">{{$i}} Stamp per day</option>
                                                @endfor
                                            <option value="5000" @if(@$card['stamps_per_day']==5000) selected @endif >Unlimited</option>
                                        </select>
                                        <span class="questions" style="margin-left: 10px;"><img src="{{asset('business_dashboard')}}/assets/images/questions.svg" alt="img" onclick="alert('Set how many stamps can be collected for a card in a 24 hour period')"></span>
                                    </div>
                                </div>

                                <div class="stamp-collect-text-main" id="stamp-collect-text-main{{$key}}" style="display: none;" >
                                    <span class="stamp-tex">How many stamp does a customer need to collect to earn a reward? (a complete loyality card)</span>
                                    <div class="stamp-dropright">
                                        <select name="number_stamps" class="stamps_per_day" data-key = "{{$key}}" data-id="{{$card->id}}" id="number_of_stamps">
                                            @for($i=1;$i<11;$i++) <option value="{{$i}}" @if($card->number_stamps == $i) selected @endif >{{$i}} </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="logo-text-main">

                                    <img width="50px" id="m3" src="{{env('APP_URL').$business_details->image}}" alt="logo">

                                    <span> <p id="s_days">Collect {{@$card->number_stamps}}</p> <p id="s_reward">stamps to Earn:
                                        @if($card->description == 'other')
                                            {{$card->other_description}}
                                        @else
                                            {{$card->description}}
                                        @endif
                                    </p></span>

                                    <span class="edit-field2" data-toggle="modal" data-target="#exampleModalCenter{{$key}}"> <img src="{{asset('admin_dashboard/assets/images/round-e.png')}}" alt="no img"> </span>



                                </div>



                                <div class="upi-main" id="s_bk" style="@if(empty($card->img ) ) display: none; @endif background-image:url('@if(!empty($card->img) ) {{ url(@$card->img) }}  @endif') ">



                                    <ul class="nft-logo" id="days_logo{{$key}}">

                                        @for($stamps = 0; $stamps< @$card->number_stamps ; $stamps++ )
                                            @if($stamps + 1 == $card->number_stamps)
                                                <li class="active"><img src="{{ asset('business/assets/images/gift.svg') }}"></li>
                                            @else
                                                <li class="active"><img src="{{ asset('business/assets/images/all.svg') }}"></li>
                                            @endif
                                        @endfor

                                    </ul>

                                </div>

                            </div>

                        @endforeach

                        <a href="{{route('admin.loyality_card_insights',encrypt($business_details->id) )}}" class="insight-btn">Loyalty Card Insights</a>



                    </div>

                </div>
                <div class="col-md-6">
                    @foreach(@$locations as $key => $location)

                        <div class="open-table-main">
                            <div class="open-table-inner">

                                <span class="edit-img table_time1" id="table_time1{{$key}}" data-id="{{$key}}"><img src="{{asset('admin_dashboard/assets/images/round-e.png')}}" alt="no img"></span>

                                <h2 class="opening-text"> <img src="{{asset('admin_dashboard/assets/images/Vector.png')}}" alt="no img"> Location {{$key+1}} ({{@$location->address}})</h2>
                                @php $time=@$times[$key]; @endphp

                                <div class="open-table-main pl-0 pr-0">
    						          <form class="time_table1" id="time_table_{{$key}}"  data-form-id="{{$key}}">
                                        <input type="text" id="locup" name="locup" onkeypress="insert_location_option(this)" value="{{@$location->address}}" class="form-control" style="display: none">
    						          	<button type="submit" class="btn btn-success time_submit1Btn" style="padding: 2px;
    font-size: 16px;
    width: 28px;
    height: 28px;
    cursor: pointer;
    display: block;
    float: right;
    margin-bottom: 15px;display:none;" 	hidden disabled id="time_submit{{$key}}">
    						              ✔
    						    		</button>
    						            <div class="opening-table1">
    						              <!-- <form id="time_table1"> -->
    						              <table class="table t1 table-striped table_disable" id="t1{{$key}}">
    						                <thead style="background: #F7FAFF;">
    						                  <tr class="disabled_table" id="auto{{$key}}">

    						                    <th scope="col">

    						                      Autofill

    						                    </th>

    						                    <th scope="col">

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input class="open_close" name="open_close" type="radio" value="open" data-id="{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input class="open_close" type="radio" name="open_close" value="close" data-id="{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </th>

    						                    <th scope="col">
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="basicExampleho{{$key}}" data-id="{{$key}}" value="9:00am" class="auto_time ui-timepicker-input from basicExampleho">
    						                      </span>

    						                    </th>

    						                    <th scope="col">

    						                      To

    						                    </th>

    						                    <th scope="col">

    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="basicExamplehc{{$key}}" data-id="{{$key}}" value="5:00pm" class="auto_time ui-timepicker-input basicExamplehc">
    						                      </span>

    						                    </th>

    						                  </tr>
    						                </thead>
    						                <tbody id="tbody{{$key}}">

    						                  <tr class="disabled_table" id="monday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[0]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" name="monday_open_close1" @if($time[0]['status']=="open" ) checked @endif value="open" class="OpenClose" data-id="monday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" name="monday_open_close1" @if($time[0]['status']=="close" ) checked @endif value="close" class="OpenClose" data-id="monday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tmo" name="monday_open_time1" @if($time[0]['status']=="close" ) disabled @endif @if($time[0]['status']=="open" ) value="{{$time[0]['open_time']}}" @else value="9:00am" @endif required class="to">
    						                      </span>
    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tmc" name="monday_close_time1" @if($time[0]['status']=="close" ) disabled @endif @if($time[0]['status']=="open" ) value="{{$time[0]['close_time']}}" @else value="5:00pm" @endif required class="tc">

    						                      </span>
    						                    </td>

    						                  </tr>

    						                  <tr class="disabled_table" id="tuesday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[1]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if($time[1]['status']=="open" ) checked @endif name="tuesday_open_close1" value="open" class="OpenClose" data-id="tuesday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if($time[1]['status']=="close" ) checked @endif name="tuesday_open_close1" value="close" class="OpenClose" data-id="tuesday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tto" name="tuesday_open_time1" @if($time[1]['status']=="close" ) disabled @endif @if($time[1]['status']=="open" ) value="{{$time[1]['open_time']}}" @else value="9:00am" @endif required class="to">
    						                      </span>
    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="ttc" name="tuesday_close_time1" @if($time[1]['status']=="close" ) disabled @endif @if($time[1]['status']=="open" ) value="{{$time[1]['close_time']}}" @else value="5:00pm" @endif required class="tc">
    						                      </span>

    						                    </td>

    						                  </tr>

    						                  <tr class="disabled_table" id="wednesday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[2]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if($time[2]['status']=="open" ) checked @endif name="wednesday_open_close1" value="open" class="OpenClose" data-id="wednesday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if($time[2]['status']=="close" ) checked @endif value="close" name="wednesday_open_close1" class="OpenClose" data-id="wednesday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="two" name="wednesday_open_time1" @if($time[2]['status']=="close" ) disabled @endif @if($time[2]['status']=="open" ) value="{{$time[2]['open_time']}}" @else value="9:00am" @endif required class="to">
    						                      </span>
    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="twc" name="wednesday_close_time1" @if($time[2]['status']=="close" ) disabled @endif @if($time[2]['status']=="open" ) value="{{$time[2]['close_time']}}" @else value="5:00pm" @endif required class="tc">

    						                      </span>
    						                    </td>

    						                  </tr>





    						                  <tr class="disabled_table" id="thursday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[3]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if($time[3]['status']=="open" ) checked @endif name="thursday_open_close1" value="open" class="OpenClose" data-id="thursday{{$key}}" ><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if($time[3]['status']=="close" ) checked @endif name="thursday_open_close1" value="close" class="OpenClose" data-id="thursday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>

    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="ttho" name="thrusday_open_time1" @if($time[3]['status']=="close" ) disabled @endif @if($time[3]['status']=="open" ) value="{{$time[3]['open_time']}}" @else value="9:00am" @endif required class="to">

    						                      </span>



    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>

    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tthc" name="thrusday_close_time1" @if($time[3]['status']=="close" ) disabled @endif @if($time[3]['status']=="open" ) value="{{$time[3]['close_time']}}" @else value="5:00pm" @endif required class="tc">

    						                      </span>

    						                    </td>

    						                  </tr>





    						                  <tr class="disabled_table" id="friday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[4]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if($time[4]['status']=="open" ) checked @endif name="friday_open_close1" value="open" class="OpenClose" data-id="friday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if($time[4]['status']=="close" ) checked @endif name="friday_open_close1" value="close" class="OpenClose" data-id="friday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>

    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tfo" name="friday_open_time1" @if($time[4]['status']=="close" ) disabled @endif @if($time[4]['status']=="open" ) value="{{$time[4]['open_time']}}" @else value="9:00am" @endif required class="to">

    						                      </span>


    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tfc" name="friday_close_time1" @if($time[4]['status']=="close" ) disabled @endif @if($time[4]['status']=="open" ) value="{{$time[4]['close_time']}}" @else value="5:00pm" @endif required class="tc">

    						                      </span>



    						                    </td>

    						                  </tr>



    						                  <tr class="disabled_table" id="saturday{{$key}}">

    						                    <th scope="row">

    						                      {{$time[5]['day']}}

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if($time[5]['status']=="open" ) checked @endif name="saturday_open_close1" value="open" class="OpenClose" data-id="saturday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if($time[5]['status']=="close" ) checked @endif name="saturday_open_close1" value="close" class="OpenClose" data-id="saturday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tsso" name="saturday_open_time1" @if($time[5]['status']=="close" ) disabled @endif @if($time[5]['status']=="open" ) value="{{$time[5]['open_time']}}" @else value="9:00am" @endif required class="to">

    						                      </span>


    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tssc" @if($time[5]['status']=="close" ) disabled @endif @if($time[5]['status']=="open" ) value="{{$time[5]['close_time']}}" @else value="5:00pm" @endif name="saturday_close_time1" required class="tc">

    						                      </span>

    						                    </td>

    						                  </tr>

    						                  <tr class="disabled_table" id="sunday{{$key}}">

    						                    <th scope="row">

    						                      Sunday

    						                    </th>

    						                    <td>

    						                      <div class="custom-radio open">

    						                        <label>

    						                          <input type="radio" @if(@$time[6]['status']=="open" ) checked @endif name="sunday_open_close1" value="open" class="OpenClose" data-id="sunday{{$key}}"><span>Open</span>

    						                        </label>

    						                      </div>



    						                      <div class="custom-radio closed">

    						                        <label>

    						                          <input type="radio" @if(@$time[6]['status']=="close" ) checked @endif value="close" name="sunday_open_close1" class="OpenClose" data-id="sunday{{$key}}"><span>Closed</span>

    						                        </label>

    						                      </div>

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tso" @if(@$time[6]['status']=="close" ) disabled @endif @if(@$time[6]['status']=="open" ) value="{{@$time[6]['open_time']}}" @else value="9:00am" @endif name="sunday_open_time1" required class="to">

    						                      </span>

    						                    </td>

    						                    <td>

    						                      To

    						                    </td>

    						                    <td>
    						                      <span class="time-picker">
    						                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
    						                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
    						                        </svg>
    						                        <input id="tsc" @if(@$time[6]['status']=="close" ) disabled @endif @if(@$time[6]['status']=="open" ) value="{{$time[6]['close_time']}}" @else value="5:00pm" @endif name="sunday_close_time1" required class="tc">
    						                      </span>


    						                    </td>

    						                  </tr>


    						                </tbody>
    						              </table>
    						              <input name="id" name="id" value="{{@$locations[$key]->id}}" type="hidden">
    						              <input type="hidden" name="field" value="time_table">
    						              <input type="hidden" name="table" value="business_details">
    						              <!-- <button type="submit" style="display:none"class="btn btn-primary" hidden disabled id="time_submit1">Update</button> -->
    						              <!-- </form> -->
    						            </div>
    						          </form>
    						    </div>
                            </div>

                        </div>

                    @endforeach
                </div>

            </div>
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
                                     @if($b->account_status == "active" )
                                        <span class="p-info">Status: <strong class="active">Active</strong></span>
                                    @else
                                        <span class="p-info">Status: <strong class="text text-danger">Pending</strong></span>
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
                @else
                    <h3>No record found</h3>
                @endif
            </ul>
            <div class="custom-pagination">
                <?php echo $business_reviews->render(); ?>
            </div>
        </div>
    </div>
    @foreach($loyality_cards as $key => $card)
        @if(!empty($card))
            <div class="modal fade remove-pad" id="exampleModalCenter{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$key}}" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered custom-style" role="document">

                    <div class="modal-content">



                        <div class="modal-body">

                            <div class="loyality-main">
                                <span class="loyality-text">Your Loyalty Cards</span>
                                <span class="popup-close" id="dismiss" data-dismiss="modal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                      </svg>

                                </span>
                                <div class="stamp-collect">
                                   <form action="{{ route('admin.UpdateScheme') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" name="loyal_id" value="{{@$card->id}}">
                                        <input type="hidden" name="business_id" value="{{@$business_details->id}}">
                                        <div class="stamp-collect-text-main">
                                            <span class="stamp-tex">How many stamp does a customer need to collect to earn a reward? (a complete loyality card)</span>
                                            <div class="stamp-dropright">
                                                <select name="number_stamps" class="stamps_per_day" id="stamps_per_day_new" data-key="{{$key}}">
                                                    @for($i=1;$i<11;$i++) <option value="{{$i}}" @if($i == @$card->number_stamps) selected @endif >{{$i}} </option>
                                                    @endfor
                                                </select>

                                            </div>
                                        </div>
                                        <div class="stamp-collect-text-main">
                                            <span class="stamp-tex">What reward does a customer earn when they complete the card </span>
                                            <div class="stamp-dropright">
                                                <select name="description" required  id="stamp_description_add_new" data-key="{{$key}}" class="stamp_description_add_new">

                                                    <option value="1 Free Coffee"  @if(@$card->description == '1 Free Coffee' ) selected @endif >1 Free Coffee</option>

                                                     <option value="1 Free Hot Drink" @if(@$card->description == '1 Free Hot Drink' ) selected @endif >1 Free Hot Drink </option>

                                                     <option value="1 Free Sandwich" @if(@$card->description == '1 Free Sandwich' ) selected @endif  >1 Free Sandwich </option>

                                                     <option value="1 Free Coffee and Snack" @if(@$card->description == '1 Free Coffee and Snack' ) selected @endif >1 Free Coffee and Snack</option>

                                                     <option value="1 Free Meal" @if(@$card->description == '1 Free Meal' ) selected @endif >1 Free Meal</option>

                                                     <option value="1 Free Side with Meal" @if(@$card->description == '1 Free Side with Meal' ) selected @endif >1 Free Side with Meal </option>

                                                     <option value="1 Free Lunch" @if(@$card->description == '1 Free Lunch' ) selected @endif  >1 Free Lunch </option>

                                                     <option value="1 Free Smoothie" @if(@$card->description == '1 Free Smoothie' ) selected @endif>1 Free Smoothie</option>

                                                     <option value="1 Free Ice cream" @if(@$card->description == '1 Free Ice cream' ) selected @endif >1 Free Ice cream </option>

                                                     <option value="1 Free Haircut" @if(@$card->description == '1 Free Haircut' ) selected @endif >1 Free Haircut</option>

                                                     <option value="1 Free Drink" @if(@$card->description == '1 Free Drink' ) selected @endif >1 Free Drink </option>
                                                     <option value="other"  @if(@$card->description == 'other' ) selected @endif >Other</option>

                                                </select>
                                                <!-- <span class="questions"><img src="{{asset('business_dashboard')}}/assets/images/questions.svg" alt="img"></span> -->
                                                <input type="text" id="other{{$key}}" data-key={{$key}} class="other" autofill="off" name="other_description" value="{{@$card->other_description}}" placeholder="Enter other reward" @if(@$card->description == 'other' ) style="display:block" @endif >
                                            </div>
                                        </div>

                                        <div class="stamp-select-img-main">
                                            <div class="stamp-pad">
                                                <div class="logo-text-main">
                                                    <img id="newSchemebussiness_logo" src="{{url(@$business_details->image)}}" alt="logo">
                                                    <span>Collect  &nbsp;</span><span id="stamp-collection">{{@$card->number_stamps}}&nbsp;</span> <span>stamp to Earn: </span><span id="stamp-description{{$key}}">

                                                        @if(@$card->description == 'other')
                                                            {{@$card->other_description}}
                                                        @else
                                                            {{@$card->description}}
                                                        @endif

                                                    </span>

                                                    <div id="edit-icon-new" class="edit-icon3">
                                                        <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="noimg" style="position: absolute;right: 0;top: 60px;z-index: 9;cursor: pointer;">
                                                    </div>
                                                    <input accept="image/*" type='file' id="newSchemeImg{{$key}}" data-id="{{$key}}" name="newSchemeImg" class="newSchemeImg" style="opacity: 0; padding: 1px; font-size: 2.6rem; width: 31px; height: 29px; position: absolute; top: 60px; right: 0px; cursor: pointer; display: block; border-radius: 13px 0px 0px; z-index: 9999;">
                                                </div>
                                                <div class="upi-main2" id="newSchemeImgPreview{{$key}}"  style="@if(empty(@$card->img ) ) display: none; @endif background-image:url('@if(!empty(@$card->img) ) {{ url(@$card->img) }}  @endif') ">

                                                    <ul class="nft-logo" id="days_logo2_new{{$key}}">
                                                         @for($stamps = 0; $stamps< @$card->number_stamps ; $stamps++ )
                                                            @if($stamps + 1 == @$card->number_stamps)
                                                                <li class="active"><img src="{{ asset('business/assets/images/gift.svg') }}"></li>
                                                            @else
                                                                <li class="active"><img src="{{ asset('business/assets/images/all.svg') }}"></li>
                                                            @endif
                                                        @endfor
                                                    </ul>


                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="remove-scheme" id="remove-scheme-img-new" style="display:none;"> Remove Image</button>
                                        <div class="modal-footer popup-footer">
                                            <button type="submit" class="btn btn-success btn-primary">Update Loyalty Card</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        @endif
    @endforeach

    <div class="modal fade remove-pad" id="pendingCode" tabindex="-1" role="dialog" aria-labelledby="pendingCodeTitle" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered custom-style" role="document">

                <div class="modal-content">



                    <div class="modal-body">

                        <div class="active-body">

                        <h1 class="activ-head">ACTIVATE CODE</h1>

                            <div class="active-key-main">

                                <h1 class="text-center" style="font-weight: 600;font-size: 50px;">{{$business_details->activation_code}}</h1>




                            </div>

                            <button type="submit" class="acti-close-btn" data-dismiss="modal" style="background: #747784;" >Close</button>

                    </div>

                    </div>



                </div>

            </div>

    </div>
     <div class="modal fade remove-pad" id="pendingCode" tabindex="-1" role="dialog" aria-labelledby="pendingCodeTitle" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered custom-style" role="document">

                <div class="modal-content">



                    <div class="modal-body">

                        <div class="active-body">

                        <h1 class="activ-head">ACTIVATE CODE</h1>

                            <div class="active-key-main">

                                <h1 class="text-center" style="font-weight: 600;font-size: 50px;">{{ Session::get('code') }}</h1>




                            </div>

                            <button type="submit" class="acti-close-btn" data-dismiss="modal" style="background: #747784;" >Close</button>

                    </div>

                    </div>



                </div>

            </div>

    </div>
    <style>
        .form-group{margin-left:15px;margin-right: 15px}
    </style>
    <div class="modal fade remove-pad" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered custom-style" role="document">

                <div class="modal-content">



                    <div class="modal-body">

                        <div class="active-body">

                            <h1 class="activ-head">Edit Business Details</h1>

                               <form id="insert_location" action="{{route('admin.update_business_data')}}" method="post">
                                 @csrf
                                    <input type="hidden" value="{{$business_details->id}}" name="id">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="b_name" value="{{$business_details->business_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address:</label>
                                        <input type="email" class="form-control" id="email"  value="{{$business_details->business_email}}" readonly="readonly">
                                      </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$business_details->business_number}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address:</label>

                                        <input type="text" name="address" onkeypress="insert_location(this)" id="insert_address" autocomplete="off" class="form-control" value="{{$business_details->business_address}}" placeholder="Enter Address" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Bio:</label>
                                        <textarea name="bio" class="form-control" id="" cols="30" rows="10">{{$business_details->description}}</textarea>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" class="btn btn-info">Save</button>
                                    </div>
                                </form>

                        </div>

                    </div>

                    </div>



                </div>

            </div>

    </div>
     @if(\Session::has('code'))
        <script>
            $("#pendingCode").modal("show");
        </script>
    @endif
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=nl&output=json&key={{env('GOOGLE_MAP_KEY')}}" async defer></script>
<script>

    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
  $.ajaxSetup({

    headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

  });

  //   timepicker
  $(function() {
    $('.t1 #basicExampleho').timepicker({
      'showDuration': true
    });
    $('.t1 .auto_time').timepicker({
      'showDuration': true
    });
    $('.t1 #basicExamplehc').timepicker({
      'showDuration': true
    });
    $('.t1 #tso').timepicker({
      'showDuration': true
    });
    $('.t1 #tsc').timepicker({
      'showDuration': true
    });
    $('.t1 #tmo').timepicker({
      'showDuration': true
    });
    $('.t1 #tmc').timepicker({
      'showDuration': true
    });
    $('.t1 #tto').timepicker({
      'showDuration': true
    });
    $('.t1 #ttc').timepicker({
      'showDuration': true
    });
    $('.t1 #two').timepicker({
      'showDuration': true
    });
    $('.t1 #twc').timepicker({
      'showDuration': true
    });
    $('.t1 #ttho').timepicker({
      'showDuration': true
    });
    $('.t1 #tthc').timepicker({
      'showDuration': true
    });
    $('.t1 #tfo').timepicker({
      'showDuration': true
    });
    $('.t1 #tfc').timepicker({
      'showDuration': true
    });
    $('.t1 #tsso').timepicker({
      'showDuration': true
    });
    $('.t1 #tssc').timepicker({
      'showDuration': true
    });
    //2
    $('.t2 #basicExampleho').timepicker({
      'showDuration': true
    });
    $('.t2 #basicExamplehc').timepicker({
      'showDuration': true
    });
    $('.t2 #tso').timepicker({
      'showDuration': true
    });
    $('.t2 #tsc').timepicker({
      'showDuration': true
    });
    $('.t2 #tmo').timepicker({
      'showDuration': true
    });
    $('.t2 #tmc').timepicker({
      'showDuration': true
    });
    $('.t2 #tto').timepicker({
      'showDuration': true
    });
    $('.t2 #ttc').timepicker({
      'showDuration': true
    });
    $('.t2 #two').timepicker({
      'showDuration': true
    });
    $('.t2 #twc').timepicker({
      'showDuration': true
    });
    $('.t2 #ttho').timepicker({
      'showDuration': true
    });
    $('.t2 #tthc').timepicker({
      'showDuration': true
    });
    $('.t2 #tfo').timepicker({
      'showDuration': true
    });
    $('.t2 #tfc').timepicker({
      'showDuration': true
    });
    $('.t2 #tsso').timepicker({
      'showDuration': true
    });
    $('.t2 #tssc').timepicker({
      'showDuration': true
    });

    // 3
    $('.t3 #basicExampleho').timepicker({
      'showDuration': true
    });
    $('.t3 #basicExamplehc').timepicker({
      'showDuration': true
    });
    $('.t3 #tso').timepicker({
      'showDuration': true
    });
    $('.t3 #tsc').timepicker({
      'showDuration': true
    });
    $('.t3 #tmo').timepicker({
      'showDuration': true
    });
    $('.t3 #tmc').timepicker({
      'showDuration': true
    });
    $('.t3 #tto').timepicker({
      'showDuration': true
    });
    $('.t3 #ttc').timepicker({
      'showDuration': true
    });
    $('.t3 #two').timepicker({
      'showDuration': true
    });
    $('.t3 #twc').timepicker({
      'showDuration': true
    });
    $('.t3 #ttho').timepicker({
      'showDuration': true
    });
    $('.t3 #tthc').timepicker({
      'showDuration': true
    });
    $('.t3 #tfo').timepicker({
      'showDuration': true
    });
    $('.t3 #tfc').timepicker({
      'showDuration': true
    });
    $('.t3 #tsso').timepicker({
      'showDuration': true
    });
    $('.t3 #tssc').timepicker({
      'showDuration': true
    });
    $(".table_disable :input").prop("disabled", true);
  });
    $(".newSchemeImg").on("change",function(){
        previewImage($(this).data('id'));
    });

    $("#pending").on('click',function(){
        $("#pendingCode").modal("show");
    });


    function previewImage(id){
        var file = $("#newSchemeImg"+id).get(0).files[0];
        if (file) {

            var reader = new FileReader();
            reader.onload = function (e) {
                $('#newSchemeImgPreview'+id).css('background', 'url('+e.target.result +')');
                $('#newSchemeImgPreview'+id).css('background-position', 'center center');

            }
            reader.readAsDataURL(file);
        }
    }
    coverInput.onchange = evt => {
        const [file] = coverInput.files
        if (file) {
            $('.edit-profile').hide();
            $('#coverInput').hide();
            $('.cover-update').css('display', 'block');

            coverImagePreview.src = URL.createObjectURL(file)
        }
    }
    profilePicInput.onchange = evt => {
        const [file] = profilePicInput.files
        if (file) {
            $('.edit-profile2').hide();
            $('#profilePicInput').hide();
            $('.profile-pic-update').css('display', 'block');

            profileImagePreview.src = URL.createObjectURL(file)
        }
    }

  $(".location_update").on("click", function() {
    let key = $(this).data("key");
    edit = $(this).hasClass("add");
    if (edit) {
      $(this).removeClass("add");
      $("#address-box-"+key).css("display", "none");
      $("#location-form-container-"+key).css("display", "block");
      //   $("#input_address").attr("disabled",false);
      //   $("#loc_field").attr("disabled",false);

    } else {

      $(this).addClass("add");
      $("#address-box-"+key).css("display", "block");
      $("#location-form-container-"+key).css("display", "none");
      //   $("#input_address").attr("disabled",true);
      //   $("#loc_field").attr("disabled",true);
    }
    $(this).hide();
    $('#location_update_'+key).css('display', 'block');


  });
  $(".location-form").on("submit", function() {
    event.preventDefault();
    let form_key = $(this).data("form-key");
    url = "{{route('update_data')}}";
    id = "location-form-"+form_key;
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#address-box-"+form_key).html("<p>" + $("#input_address_"+form_key).val() + "</p>");
        $("#address-box-"+form_key).css("display", "block");
        $("#location-form-container-"+form_key).css("display", "none");
        //   $("#input_address").attr("disabled",true);
        //   $("#loc_field").attr("disabled",true);
        $('#location_update'+form_key).css('display', 'block');
        $('#location_update_'+form_key).css('display', 'none');
      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }
    })

  });

    function initAutocomplete() {
    initAutocomplete1();
    insert_location();
  }

  function initAutocomplete1(input) {

    // const input = document.getElementsByClassName("input_address");

      // Specify just the place data fields that you need.
      let form_id = input.getAttribute("data-form-id");
      const autocomplete = new google.maps.places.Autocomplete(input, {
        fields: ["place_id", "geometry", "name", "formatted_address"],
      });
      const geocoder = new google.maps.Geocoder();

      autocomplete.addListener("place_changed", () => {


        const place = autocomplete.getPlace();

        if (!place.place_id) {
          return;
        }

        geocoder
          .geocode({
            placeId: place.place_id
          })
          .then(({
            results
          }) => {

            var input = document.createElement("input");
            input.setAttribute('type', 'hidden');
            input.setAttribute("name", "lat");
            input.setAttribute("value", results[0].geometry.location.lat());

            var input2 = document.createElement("input");
            input2.setAttribute('type', 'hidden');
            input2.setAttribute("name", "lon");
            input2.setAttribute("value", results[0].geometry.location.lat());

            var parent = document.getElementById("location-form-"+form_id);
            parent.appendChild(input);
            parent.appendChild(input2);

            //   console.log(results[0].geometry.location.lat());
            //   console.log(results[0].geometry.location.lng());

          })
          .catch((e) => window.alert("Geocoder failed due to: " + e));
      });

  }

  function insert_location(input = null) {

    // const input = document.getElementById("insert_address");
    // Specify just the place data fields that you need.
    const autocomplete = new google.maps.places.Autocomplete(input, {
      fields: ["place_id", "geometry", "name", "formatted_address"],
    });
    const geocoder = new google.maps.Geocoder();

    autocomplete.addListener("place_changed", () => {


      const place = autocomplete.getPlace();

      if (!place.place_id) {
        return;
      }

      geocoder
        .geocode({
          placeId: place.place_id
        })
        .then(({
          results
        }) => {

          var input = document.createElement("input");
          input.setAttribute('type', 'hidden');
          input.setAttribute("name", "lat");
          input.setAttribute("value", results[0].geometry.location.lat());

          var input2 = document.createElement("input");
          input2.setAttribute('type', 'hidden');
          input2.setAttribute("name", "lon");
          input2.setAttribute("value", results[0].geometry.location.lat());

          var parent = document.getElementById("insert_location");
          parent.appendChild(input);
          parent.appendChild(input2);

          //   console.log(results[0].geometry.location.lat());
          //   console.log(results[0].geometry.location.lng());

        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));
    });
  }
  // table 1 functions

   function insert_location_option(input = null) {

// const input = document.getElementById("insert_address");
// Specify just the place data fields that you need.
const autocomplete = new google.maps.places.Autocomplete(input, {
  fields: ["place_id", "geometry", "name", "formatted_address"],
});
const geocoder = new google.maps.Geocoder();

autocomplete.addListener("place_changed", () => {


  const place = autocomplete.getPlace();

  if (!place.place_id) {
    return;
  }

  geocoder
    .geocode({
      placeId: place.place_id
    })
    .then(({
      results
    }) => {

      var input = document.createElement("input");
      var country = "";
      var city = "";
      input.setAttribute('type', 'hidden');
      input.setAttribute("name", "lat");
      input.setAttribute("value", results[0].geometry.location.lat());

      var input2 = document.createElement("input");
      input2.setAttribute('type', 'hidden');
      input2.setAttribute("name", "lon");
      input2.setAttribute("value", results[0].geometry.location.lng());

      for (var i = 0; i < results[0].address_components.length; i++) {

      for (var b = 0; b < results[0].address_components[i].types.length; b++) {


          if (results[0].address_components[i].types[b] == "country") {

              //this is the object you are looking for

              country = results[0].address_components[i].long_name;

             

          }

          if (results[0].address_components[i].types[b] == "locality") {

            //this is the object you are looking for

            city = results[0].address_components[i].long_name;

           

            }

      }

      }

     console.log(country);

     var input3 = document.createElement("input");
      input3.setAttribute('type', 'hidden');
      input3.setAttribute("name", "country");
      input3.setAttribute("value", country);

      var input4 = document.createElement("input");
      input4.setAttribute('type', 'hidden');
      input4.setAttribute("name", "city");
      input4.setAttribute("value", city);

    

      var parent = document.getElementById("time_table_0");
      parent.appendChild(input);
      parent.appendChild(input2);
      parent.appendChild(input3);
      parent.appendChild(input4);

         console.log(results);
      //   console.log(results[0].geometry.location.lng());

    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
});
}
  $(".time_table1").on("submit", function() {
    event.preventDefault();
    var form_id = $(this).data('form-id');
    url = "{{route('admin.update_data')}}";
    id = "time_table_"+form_id;
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#t1"+form_id+" tr").addClass("disabled_table");
        $("#time_submit"+form_id).attr("disabled", true);
        $("#time_submit"+form_id).css("display", "none");

      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }
    })
    $("#time_submit"+form_id).css('display', 'none');
    $("#table_time1"+form_id).show();
    $("#t1"+form_id+" :input").prop("disabled", true);


  });
  $(".table_time1").click(function() {
    var id = $(this).data('id');
    edit = $("#t1"+id+" tr").hasClass("disabled_table");

    if (edit) {
        $('#locup').show();
      $("#t1"+id+" :input").prop("disabled", false);
      $("#t1"+id+" tr").removeClass("disabled_table");
      $("#time_submit"+id).attr("disabled", false);
      $("#time_submit"+id).css("display", "block");
    } else {

      console.log("no");
      $("#t1"+id+" tr").addClass("disabled_table");
      $("#time_submit"+id).attr("disabled", true);
      $("#time_submit"+id).css("display", "none");
    }
    $(this).hide();
  });

  $("#time_table2").on("submit", function() {

    event.preventDefault();
    url = "{{route('update_data')}}";
    id = "time_table2";
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#time_table2 tr").addClass("disabled_table");
        $("#time_submit2").attr("disabled", true);
        $("#time_submit2").css("display", "none");
        $('#locup').hide();
      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }
    })



  });
  $(".table_time2").click(function() {
    edit = $(".t2 tr").hasClass("disabled_table");

    if (edit) {

      $(".t2 tr").removeClass("disabled_table");
      $("#time_submit2").attr("disabled", false);
      $("#time_submit2").css("display", "block");
    } else {
      console.log("no");
      $(".t2 tr").addClass("disabled_table");
      $("#time_submit2").attr("disabled", true);
      $("#time_submit2").css("display", "none");
    }




  });
  $("#time_table3").on("submit", function() {
    event.preventDefault();
    url = "{{route('update_data')}}";
    id = "time_table3";
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#time_table3 tr").addClass("disabled_table");
        $("#time_submit3").attr("disabled", true);
        $("#time_submit3").css("display", "none");

      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }
    })



  });
  $(".table_time3").click(function() {
    edit = $(".t3 tr").hasClass("disabled_table");

    if (edit) {

      $(".t3 tr").removeClass("disabled_table");
      $("#time_submit3").attr("disabled", false);
      $("#time_submit3").css("display", "block");
    } else {
      console.log("no");
      $(".t3 tr").addClass("disabled_table");
      $("#time_submit3").attr("disabled", true);
      $("#time_submit3").css("display", "none");
    }




  });


  // start table 1 functions
  $('.t1 [name=sunday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='sunday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t1 #sunday #tso").attr("disabled", true);
      $(".t1 #sunday #tsc").attr("disabled", true);

      $(".t1 #sunday .open span").css("color", "#707070");
      $(".t1 #sunday .close span").css("color", "#ffffff");


      $(".t1 #sunday .open span").css("background-color", "#ffffff");

      $(".t1 #sunday .close span").css("background-color", "#FF3D5A");


    } else {

      $(".t1 #sunday #tso").attr("disabled", false);
      $(".t1 #sunday #tsc").attr("disabled", false);

      $(".t1 #sunday .open span").css("color", "#ffffff");
      $(".t1 #sunday .close span").css("color", "#707070");


      $(".t1 #sunday .open span").css("background-color", "#4EADEA");

      $(".t1 #sunday .close span").css("background-color", "#ffffff");
    }


  });
  $('.t1 [name=monday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='monday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t1 #monday #tmo").attr("disabled", true);
      $(".t1 #monday #tmc").attr("disabled", true);

      $(".t1 #monday .open span").css("color", "#707070");
      $(".t1 #monday .close span").css("color", "#ffffff");


      $(".t1 #monday .open span").css("background-color", "#ffffff");

      $(".t1 #monday .close span").css("background-color", "#FF3D5A");



    } else {


      $(".t1 #monday .open span").css("color", "#ffffff");
      $(".t1 #monday .close span").css("color", "#707070");


      $(".t1 #monday .open span").css("background-color", "#4EADEA");

      $(".t1 #monday .close span").css("background-color", "#ffffff");

      $(".t1 #monday #tmo").attr("disabled", false);
      $(".t1 #monday #tmc").attr("disabled", false);
    }


  });
  $('.t1 [name=tuesday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='tuesday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t1 #tuesday #tto").attr("disabled", true);
      $(".t1 #tuesday #ttc").attr("disabled", true);

      $(".t1 #tuesday .open span").css("color", "#707070");
      $(".t1 #tuesday .close span").css("color", "#ffffff");


      $(".t1 #tuesday .open span").css("background-color", "#ffffff");

      $(".t1 #tuesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t1 #tuesday #tto").attr("disabled", false);
      $(".t1 #tuesday #ttc").attr("disabled", false);

      $(".t1 #tuesday .open span").css("color", "#ffffff");
      $(".t1 #tuesday .close span").css("color", "#707070");


      $(".t1 #tuesday .open span").css("background-color", "#4EADEA");

      $(".t1 #tuesday .close span").css("background-color", "#ffffff");


    }


  });
  $('.t1 [name=wednesday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='wednesday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t1 #wednesday #two").attr("disabled", true);
      $(".t1 #wednesday #twc").attr("disabled", true);
      $(".t1 #wednesday .open span").css("color", "#707070");
      $(".t1 #wednesday .close span").css("color", "#ffffff");


      $(".t1 #wednesday .open span").css("background-color", "#ffffff");

      $(".t1 #wednesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t1 #wednesday #two").attr("disabled", false);
      $(".t1 #wednesday #twc").attr("disabled", false);

      $(".t1 #wednesday .open span").css("color", "#ffffff");
      $(".t1 #wednesday .close span").css("color", "#707070");


      $(".t1 #wednesday .open span").css("background-color", "#4EADEA");

      $(".t1 #wednesday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t1 [name=thursday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='thursday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t1 #thursday #ttho").attr("disabled", true);
      $(".t1 #thursday #tthc").attr("disabled", true);

      $(".t1 #thursday .open span").css("color", "#707070");
      $(".t1 #thursday .close span").css("color", "#ffffff");


      $(".t1 #thursday .open span").css("background-color", "#ffffff");

      $(".t1 #thursday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t1 #thursday #ttho").attr("disabled", false);
      $(".t1 #thursday #tthc").attr("disabled", false);

      $(".t1 #thursday .open span").css("color", "#ffffff");
      $(".t1 #thursday .close span").css("color", "#707070");


      $(".t1 #thursday .open span").css("background-color", "#4EADEA");

      $(".t1 #thursday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t1 [name=friday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='friday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t1 #friday input[type=time]").attr("disabled", true);

      $(".t1 #friday #tfo").attr("disabled", true);
      $(".t1 #friday #tfc").attr("disabled", true);

      $(".t1 #friday .open span").css("color", "#707070");
      $(".t1 #friday .close span").css("color", "#ffffff");


      $(".t1 #friday .open span").css("background-color", "#ffffff");

      $(".t1 #friday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t1 #friday #tfo").attr("disabled", false);
      $(".t1 #friday #tfc").attr("disabled", false);

      $(".t1 #friday .open span").css("color", "#ffffff");
      $(".t1 #friday .close span").css("color", "#707070");


      $(".t1 #friday .open span").css("background-color", "#4EADEA");

      $(".t1 #friday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t1 [name=saturday_open_close1]').change(function() {
    selected_value = $(".t1 input[name='saturday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t1 #saturday #tsso").attr("disabled", true);
      $(".t1 #saturday #tssc").attr("disabled", true);

      $(".t1 #saturday .open span").css("color", "#707070");
      $(".t1 #saturday .close span").css("color", "#ffffff");


      $(".t1 #saturday .open span").css("background-color", "#ffffff");

      $(".t1 #saturday .close span").css("background-color", "#FF3D5A");



    } else {
      $(".t1 #saturday #tsso").attr("disabled", false);
      $(".t1 #saturday #tssc").attr("disabled", false);

      $(".t1 #saturday .open span").css("color", "#ffffff");
      $(".t1 #saturday .close span").css("color", "#707070");


      $(".t1 #saturday .open span").css("background-color", "#4EADEA");

      $(".t1 #saturday .close span").css("background-color", "#ffffff");
    }


  });

  $('.t1 [name=open_close]').unbind().change(function() {
    selected_value = $(".t1 input[name='open_close']:checked").val();
    console.log(selected_value);
    if (selected_value == "close") {
      $(".t1 #auto input[type=time]").attr("disabled", true);
      $(".t1 tbody input[value=close]").prop("checked", true).change();
      // $("tbody input[value=open]").removeAttr("checked").change();
      $(".t1 tbody input[value=open]").prop("checked", false).change();
      $(".t1 tbody .open span").css("background-color", "#ffffff");
      $(".t1 tbody .open span").css("color", "#707070");

      $(".t1 tbody .close span").css("background-color", "#FF3D5A");
      $(".t1 tbody .close span").css("color", "#ffffff");




      $(".t1 tbody .ui-timepicker-input").attr("disabled", "true");
    } else {
      $(".t1 #auto input[type=time]").attr("disabled", false);

      //   $("tbody input[value=close]").removeAttr("checked");
      $(".t1 tbody input[value=close]").prop("checked", false).change();
      $(".t1 tbody input[value=open]").prop("checked", true).change();
      $(".t1 tbody .open span").css("background-color", "#4EADEA");

      $(".t1 tbody .open span").css("color", "#ffffff");


      $(".t1 tbody .close span").css("background-color", "#ffffff");

      $(".t1 tbody .close span").css("color", "#707070");


      $(".t1 tbody .ui-timepicker-input").removeAttr("disabled")
    }


  });
  $(".t1 .basicExampleho").change(function(event) {
    val = $(this).data("id");
    open_time = $(this).val();

    $(".t1 #sunday"+val+" #tso").val(open_time);
    $(".t1 #monday"+val+" #tmo").val(open_time);
    $(".t1 #tuesday"+val+" #tto").val(open_time);
    $(".t1 #wednesday"+val+" #two").val(open_time);
    $(".t1 #thursday"+val+" #ttho").val(open_time);
    $(".t1 #friday"+val+" #tfo").val(open_time);
    $(".t1 #saturday"+val+" #tsso").val(open_time);

  });
  $(".t1 #basicExampleho").change(function(event) {

    open_time = $(".t1 #basicExampleho").val();

    $(".t1 #sunday #tso").val(open_time);
    $(".t1 #monday #tmo").val(open_time);
    $(".t1 #tuesday #tto").val(open_time);
    $(".t1 #wednesday #two").val(open_time);
    $(".t1 #thursday #ttho").val(open_time);
    $(".t1 #friday #tfo").val(open_time);
    $(".t1 #saturday #tsso").val(open_time);

  });

    $(".t1 .basicExamplehc").change(function(event) {
    val = $(this).data("id");
    close_time = $(this).val();

    $(".t1 #sunday"+val+" #tsc").val(close_time);
    $(".t1 #monday"+val+" #tmc").val(close_time);
    $(".t1 #tuesday"+val+" #ttc").val(close_time);
    $(".t1 #wednesday"+val+" #twc").val(close_time);
    $(".t1 #thursday"+val+" #tthc").val(close_time);
    $(".t1 #friday"+val+" #tfc").val(close_time);
    $(".t1 #saturday"+val+" #tssc").val(close_time);

  });
  $(".t1 #basicExamplehc").change(function(event) {

    close_time = $(".t1 #basicExamplehc").val();

    $(".t1 #sunday #tsc").val(close_time);
    $(".t1 #monday #tmc").val(close_time);
    $(".t1 #tuesday #ttc").val(close_time);
    $(".t1 #wednesday #twc").val(close_time);
    $(".t1 #thursday #tthc").val(close_time);
    $(".t1 #friday #tfc").val(close_time);
    $(".t1 #saturday #tssc").val(close_time);

  });

  // end table 1 functions


  // start table 2 functions
  $('.t2 [name=sunday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='sunday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t2 #sunday #tso").attr("disabled", true);
      $(".t2 #sunday #tsc").attr("disabled", true);

      $(".t2 #sunday .open span").css("color", "#707070");
      $(".t2 #sunday .close span").css("color", "#ffffff");


      $(".t2 #sunday .open span").css("background-color", "#ffffff");

      $(".t2 #sunday .close span").css("background-color", "#FF3D5A");


    } else {

      $(".t2 #sunday #tso").attr("disabled", false);
      $(".t2 #sunday #tsc").attr("disabled", false);

      $(".t2 #sunday .open span").css("color", "#ffffff");
      $(".t2 #sunday .close span").css("color", "#707070");


      $(".t2 #sunday .open span").css("background-color", "#4EADEA");

      $(".t2 #sunday .close span").css("background-color", "#ffffff");
    }


  });
  $('.t2 [name=monday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='monday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t2 #monday #tmo").attr("disabled", true);
      $(".t2 #monday #tmc").attr("disabled", true);

      $(".t2 #monday .open span").css("color", "#707070");
      $(".t2 #monday .close span").css("color", "#ffffff");


      $(".t2 #monday .open span").css("background-color", "#ffffff");

      $(".t2 #monday .close span").css("background-color", "#FF3D5A");



    } else {


      $(".t2 #monday .open span").css("color", "#ffffff");
      $(".t2 #monday .close span").css("color", "#707070");


      $(".t2 #monday .open span").css("background-color", "#4EADEA");

      $(".t2 #monday .close span").css("background-color", "#ffffff");

      $(".t2 #monday #tmo").attr("disabled", false);
      $(".t2 #monday #tmc").attr("disabled", false);
    }


  });
  $('.t2 [name=tuesday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='tuesday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t2 #tuesday #tto").attr("disabled", true);
      $(".t2 #tuesday #ttc").attr("disabled", true);

      $(".t2 #tuesday .open span").css("color", "#707070");
      $(".t2 #tuesday .close span").css("color", "#ffffff");


      $(".t2 #tuesday .open span").css("background-color", "#ffffff");

      $(".t2 #tuesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t2 #tuesday #tto").attr("disabled", false);
      $(".t2 #tuesday #ttc").attr("disabled", false);

      $(".t2 #tuesday .open span").css("color", "#ffffff");
      $(".t2 #tuesday .close span").css("color", "#707070");


      $(".t2 #tuesday .open span").css("background-color", "#4EADEA");

      $(".t2 #tuesday .close span").css("background-color", "#ffffff");


    }


  });
  $('.t2 [name=wednesday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='wednesday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t2 #wednesday #two").attr("disabled", true);
      $(".t2 #wednesday #twc").attr("disabled", true);
      $(".t2 #wednesday .open span").css("color", "#707070");
      $(".t2 #wednesday .close span").css("color", "#ffffff");


      $(".t2 #wednesday .open span").css("background-color", "#ffffff");

      $(".t2 #wednesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t2 #wednesday #two").attr("disabled", false);
      $(".t2 #wednesday #twc").attr("disabled", false);

      $(".t2 #wednesday .open span").css("color", "#ffffff");
      $(".t2 #wednesday .close span").css("color", "#707070");


      $(".t2 #wednesday .open span").css("background-color", "#4EADEA");

      $(".t2 #wednesday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t2 [name=thursday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='thursday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t2 #thursday #ttho").attr("disabled", true);
      $(".t2 #thursday #tthc").attr("disabled", true);

      $(".t2 #thursday .open span").css("color", "#707070");
      $(".t2 #thursday .close span").css("color", "#ffffff");


      $(".t2 #thursday .open span").css("background-color", "#ffffff");

      $(".t2 #thursday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t2 #thursday #ttho").attr("disabled", false);
      $(".t2 #thursday #tthc").attr("disabled", false);

      $(".t2 #thursday .open span").css("color", "#ffffff");
      $(".t2 #thursday .close span").css("color", "#707070");


      $(".t2 #thursday .open span").css("background-color", "#4EADEA");

      $(".t2 #thursday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t2 [name=friday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='friday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t2 #friday input[type=time]").attr("disabled", true);

      $(".t2 #friday #tfo").attr("disabled", true);
      $(".t2 #friday #tfc").attr("disabled", true);

      $(".t2 #friday .open span").css("color", "#707070");
      $(".t2 #friday .close span").css("color", "#ffffff");


      $(".t2 #friday .open span").css("background-color", "#ffffff");

      $(".t2 #friday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t2 #friday #tfo").attr("disabled", false);
      $(".t2 #friday #tfc").attr("disabled", false);

      $(".t2 #friday .open span").css("color", "#ffffff");
      $(".t2 #friday .close span").css("color", "#707070");


      $(".t2 #friday .open span").css("background-color", "#4EADEA");

      $(".t2 #friday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t2 [name=saturday_open_close1]').change(function() {
    selected_value = $(".t2 input[name='saturday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t2 #saturday #tsso").attr("disabled", true);
      $(".t2 #saturday #tssc").attr("disabled", true);

      $(".t2 #saturday .open span").css("color", "#707070");
      $(".t2 #saturday .close span").css("color", "#ffffff");


      $(".t2 #saturday .open span").css("background-color", "#ffffff");

      $(".t2 #saturday .close span").css("background-color", "#FF3D5A");



    } else {
      $(".t2 #saturday #tsso").attr("disabled", false);
      $(".t2 #saturday #tssc").attr("disabled", false);

      $(".t2 #saturday .open span").css("color", "#ffffff");
      $(".t2 #saturday .close span").css("color", "#707070");


      $(".t2 #saturday .open span").css("background-color", "#4EADEA");

      $(".t2 #saturday .close span").css("background-color", "#ffffff");
    }


  });

  $('.t2 [name=open_close]').unbind().change(function() {
    selected_value = $(".t2 input[name='open_close']:checked").val();
    console.log(selected_value);
    if (selected_value == "close") {
      $(".t2 #auto input[type=time]").attr("disabled", true);
      $(".t2 tbody input[value=close]").prop("checked", true).change();
      // $("tbody input[value=open]").removeAttr("checked").change();
      $(".t2 tbody input[value=open]").prop("checked", false).change();
      $(".t2 tbody .open span").css("background-color", "#ffffff");
      $(".t2 tbody .open span").css("color", "#707070");

      $(".t2 tbody .close span").css("background-color", "#FF3D5A");
      $(".t2 tbody .close span").css("color", "#ffffff");




      $(".t2 tbody .ui-timepicker-input").attr("disabled", "true");
    } else {
      $(".t2 #auto input[type=time]").attr("disabled", false);

      //   $("tbody input[value=close]").removeAttr("checked");
      $(".t2 tbody input[value=close]").prop("checked", false).change();
      $(".t2 tbody input[value=open]").prop("checked", true).change();
      $(".t2 tbody .open span").css("background-color", "#4EADEA");

      $(".t2 tbody .open span").css("color", "#ffffff");


      $(".t2 tbody .close span").css("background-color", "#ffffff");

      $(".t2 tbody .close span").css("color", "#707070");


      $(".t2 tbody .ui-timepicker-input").removeAttr("disabled")
    }


  });

  $(".t2 #basicExampleho").change(function(event) {

    open_time = $(".t2 #basicExampleho").val();

    $(".t2 #sunday #tso").val(open_time);
    $(".t2 #monday #tmo").val(open_time);
    $(".t2 #tuesday #tto").val(open_time);
    $(".t2 #wednesday #two").val(open_time);
    $(".t2 #thursday #ttho").val(open_time);
    $(".t2 #friday #tfo").val(open_time);
    $(".t2 #saturday #tsso").val(open_time);

  });


  $(".t2 #basicExamplehc").change(function(event) {

    close_time = $(".t2 #basicExamplehc").val();

    $(".t2 #sunday #tsc").val(close_time);
    $(".t2 #monday #tmc").val(close_time);
    $(".t2 #tuesday #ttc").val(close_time);
    $(".t2 #wednesday #twc").val(close_time);
    $(".t2 #thursday #tthc").val(close_time);
    $(".t2 #friday #tfc").val(close_time);
    $(".t2 #saturday #tssc").val(close_time);

  });

  // end table 2 functions

  // start table 2 functions
  $('.t3 [name=sunday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='sunday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t3 #sunday #tso").attr("disabled", true);
      $(".t3 #sunday #tsc").attr("disabled", true);

      $(".t3 #sunday .open span").css("color", "#707070");
      $(".t3 #sunday .close span").css("color", "#ffffff");


      $(".t3 #sunday .open span").css("background-color", "#ffffff");

      $(".t3 #sunday .close span").css("background-color", "#FF3D5A");


    } else {

      $(".t3 #sunday #tso").attr("disabled", false);
      $(".t3 #sunday #tsc").attr("disabled", false);

      $(".t3 #sunday .open span").css("color", "#ffffff");
      $(".t3 #sunday .close span").css("color", "#707070");


      $(".t3 #sunday .open span").css("background-color", "#4EADEA");

      $(".t3 #sunday .close span").css("background-color", "#ffffff");
    }


  });
  $('.t3 [name=monday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='monday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t3 #monday #tmo").attr("disabled", true);
      $(".t3 #monday #tmc").attr("disabled", true);

      $(".t3 #monday .open span").css("color", "#707070");
      $(".t3 #monday .close span").css("color", "#ffffff");


      $(".t3 #monday .open span").css("background-color", "#ffffff");

      $(".t3 #monday .close span").css("background-color", "#FF3D5A");



    } else {


      $(".t3 #monday .open span").css("color", "#ffffff");
      $(".t3 #monday .close span").css("color", "#707070");


      $(".t3 #monday .open span").css("background-color", "#4EADEA");

      $(".t3 #monday .close span").css("background-color", "#ffffff");

      $(".t3 #monday #tmo").attr("disabled", false);
      $(".t3 #monday #tmc").attr("disabled", false);
    }


  });
  $('.t3 [name=tuesday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='tuesday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t3 #tuesday #tto").attr("disabled", true);
      $(".t3 #tuesday #ttc").attr("disabled", true);

      $(".t3 #tuesday .open span").css("color", "#707070");
      $(".t3 #tuesday .close span").css("color", "#ffffff");


      $(".t3 #tuesday .open span").css("background-color", "#ffffff");

      $(".t3 #tuesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t3 #tuesday #tto").attr("disabled", false);
      $(".t3 #tuesday #ttc").attr("disabled", false);

      $(".t3 #tuesday .open span").css("color", "#ffffff");
      $(".t3 #tuesday .close span").css("color", "#707070");


      $(".t3 #tuesday .open span").css("background-color", "#4EADEA");

      $(".t3 #tuesday .close span").css("background-color", "#ffffff");


    }


  });
  $('.t3 [name=wednesday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='wednesday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t3 #wednesday #two").attr("disabled", true);
      $(".t3 #wednesday #twc").attr("disabled", true);
      $(".t3 #wednesday .open span").css("color", "#707070");
      $(".t3 #wednesday .close span").css("color", "#ffffff");


      $(".t3 #wednesday .open span").css("background-color", "#ffffff");

      $(".t3 #wednesday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t3 #wednesday #two").attr("disabled", false);
      $(".t3 #wednesday #twc").attr("disabled", false);

      $(".t3 #wednesday .open span").css("color", "#ffffff");
      $(".t3 #wednesday .close span").css("color", "#707070");


      $(".t3 #wednesday .open span").css("background-color", "#4EADEA");

      $(".t3 #wednesday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t3 [name=thursday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='thursday_open_close1']:checked").val();

    if (selected_value == "close") {

      $(".t3 #thursday #ttho").attr("disabled", true);
      $(".t3 #thursday #tthc").attr("disabled", true);

      $(".t3 #thursday .open span").css("color", "#707070");
      $(".t3 #thursday .close span").css("color", "#ffffff");


      $(".t3 #thursday .open span").css("background-color", "#ffffff");

      $(".t3 #thursday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t3 #thursday #ttho").attr("disabled", false);
      $(".t3 #thursday #tthc").attr("disabled", false);

      $(".t3 #thursday .open span").css("color", "#ffffff");
      $(".t3 #thursday .close span").css("color", "#707070");


      $(".t3 #thursday .open span").css("background-color", "#4EADEA");

      $(".t3 #thursday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t3 [name=friday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='friday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t3 #friday input[type=time]").attr("disabled", true);

      $(".t3 #friday #tfo").attr("disabled", true);
      $(".t3 #friday #tfc").attr("disabled", true);

      $(".t3 #friday .open span").css("color", "#707070");
      $(".t3 #friday .close span").css("color", "#ffffff");


      $(".t3 #friday .open span").css("background-color", "#ffffff");

      $(".t3 #friday .close span").css("background-color", "#FF3D5A");

    } else {
      $(".t3 #friday #tfo").attr("disabled", false);
      $(".t3 #friday #tfc").attr("disabled", false);

      $(".t3 #friday .open span").css("color", "#ffffff");
      $(".t3 #friday .close span").css("color", "#707070");


      $(".t3 #friday .open span").css("background-color", "#4EADEA");

      $(".t3 #friday .close span").css("background-color", "#ffffff");

    }


  });
  $('.t3 [name=saturday_open_close1]').change(function() {
    selected_value = $(".t3 input[name='saturday_open_close1']:checked").val();

    if (selected_value == "close") {
      $(".t3 #saturday #tsso").attr("disabled", true);
      $(".t3 #saturday #tssc").attr("disabled", true);

      $(".t3 #saturday .open span").css("color", "#707070");
      $(".t3 #saturday .close span").css("color", "#ffffff");


      $(".t3 #saturday .open span").css("background-color", "#ffffff");

      $(".t3 #saturday .close span").css("background-color", "#FF3D5A");



    } else {
      $(".t3 #saturday #tsso").attr("disabled", false);
      $(".t3 #saturday #tssc").attr("disabled", false);

      $(".t3 #saturday .open span").css("color", "#ffffff");
      $(".t3 #saturday .close span").css("color", "#707070");


      $(".t3 #saturday .open span").css("background-color", "#4EADEA");

      $(".t3 #saturday .close span").css("background-color", "#ffffff");
    }


  });

  $('.t3 [name=open_close]').unbind().change(function() {
    selected_value = $(".t3 input[name='open_close']:checked").val();
    console.log(selected_value);
    if (selected_value == "close") {
      $(".t3 #auto input[type=time]").attr("disabled", true);
      $(".t3 tbody input[value=close]").prop("checked", true).change();
      // $("tbody input[value=open]").removeAttr("checked").change();
      $(".t3 tbody input[value=open]").prop("checked", false).change();
      $(".t3 tbody .open span").css("background-color", "#ffffff");
      $(".t3 tbody .open span").css("color", "#707070");

      $(".t3 tbody .close span").css("background-color", "#FF3D5A");
      $(".t3 tbody .close span").css("color", "#ffffff");




      $(".t3 tbody .ui-timepicker-input").attr("disabled", "true");
    } else {
      $(".t3 #auto input[type=time]").attr("disabled", false);

      //   $("tbody input[value=close]").removeAttr("checked");
      $(".t3 tbody input[value=close]").prop("checked", false).change();
      $(".t3 tbody input[value=open]").prop("checked", true).change();
      $(".t3 tbody .open span").css("background-color", "#4EADEA");

      $(".t3 tbody .open span").css("color", "#ffffff");


      $(".t3 tbody .close span").css("background-color", "#ffffff");

      $(".t3 tbody .close span").css("color", "#707070");


      $(".t3 tbody .ui-timepicker-input").removeAttr("disabled")
    }


  });

  $(".t3 #basicExampleho").change(function(event) {

    open_time = $(".t3 #basicExampleho").val();

    $(".t3 #sunday #tso").val(open_time);
    $(".t3 #monday #tmo").val(open_time);
    $(".t3 #tuesday #tto").val(open_time);
    $(".t3 #wednesday #two").val(open_time);
    $(".t3 #thursday #ttho").val(open_time);
    $(".t3 #friday #tfo").val(open_time);
    $(".t3 #saturday #tsso").val(open_time);

  });


  $(".t3 #basicExamplehc").change(function(event) {

    close_time = $(".t3 #basicExamplehc").val();

    $(".t3 #sunday #tsc").val(close_time);
    $(".t3 #monday #tmc").val(close_time);
    $(".t3 #tuesday #ttc").val(close_time);
    $(".t3 #wednesday #twc").val(close_time);
    $(".t3 #thursday #tthc").val(close_time);
    $(".t3 #friday #tfc").val(close_time);
    $(".t3 #saturday #tssc").val(close_time);

  });

  // end table 3 functions

  $("#add_location").on("click", function() {
    count = $(this).attr("data-location-count");
    count = parseInt(count);
    if (count == 3) {
      $("#add_location").css("display", "none");
    }
    // count=count+1;

    if (count < 4) {
      $(this).attr("data-location-count", count);
      $("#insert_modal_location").modal("show");
      // $(".location_"+count.toString()).css("display","block");
      console.log(count);
    }




  });

  // table insert functions

  $('#insert_location [name=sunday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='sunday_open_close1']:checked").val();

    if (selected_value == "close") {
      $("#insert_location  #sunday #tso").attr("disabled", true);
      $("#insert_location  #sunday #tsc").attr("disabled", true);

      $("#insert_location  #sunday .open span").css("color", "#707070");
      $("#insert_location #sunday .close span").css("color", "#ffffff");


      $("#insert_location #sunday .open span").css("background-color", "#ffffff");

      $("#insert_location #sunday .close span").css("background-color", "#FF3D5A");


    } else {

      $("#insert_location #sunday #tso").attr("disabled", false);
      $("#insert_location #sunday #tsc").attr("disabled", false);

      $("#insert_location #sunday .open span").css("color", "#ffffff");
      $("#insert_location #sunday .close span").css("color", "#707070");


      $("#insert_location #sunday .open span").css("background-color", "#4EADEA");

      $("#insert_location #sunday .close span").css("background-color", "#ffffff");
    }


  });
  $('#insert_location [name=monday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='monday_open_close1']:checked").val();

    if (selected_value == "close") {

      $("#insert_location #monday #tmo").attr("disabled", true);
      $("#insert_location #monday #tmc").attr("disabled", true);

      $("#insert_location #monday .open span").css("color", "#707070");
      $("#insert_location #monday .close span").css("color", "#ffffff");


      $("#insert_location #monday .open span").css("background-color", "#ffffff");

      $("#insert_location #monday .close span").css("background-color", "#FF3D5A");



    } else {


      $("#insert_location #monday .open span").css("color", "#ffffff");
      $("#insert_location #monday .close span").css("color", "#707070");


      $("#insert_location #monday .open span").css("background-color", "#4EADEA");

      $("#insert_location #monday .close span").css("background-color", "#ffffff");

      $("#insert_location #monday #tmo").attr("disabled", false);
      $("#insert_location #monday #tmc").attr("disabled", false);
    }


  });
  $('#insert_location [name=tuesday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='tuesday_open_close1']:checked").val();

    if (selected_value == "close") {

      $("#insert_location #tuesday #tto").attr("disabled", true);
      $("#insert_location #tuesday #ttc").attr("disabled", true);

      $("#insert_location #tuesday .open span").css("color", "#707070");
      $("#insert_location #tuesday .close span").css("color", "#ffffff");


      $("#insert_location #tuesday .open span").css("background-color", "#ffffff");

      $("#insert_location #tuesday .close span").css("background-color", "#FF3D5A");

    } else {
      $("#insert_location #tuesday #tto").attr("disabled", false);
      $("#insert_location #tuesday #ttc").attr("disabled", false);

      $("#insert_location #tuesday .open span").css("color", "#ffffff");
      $("#insert_location #tuesday .close span").css("color", "#707070");


      $("#insert_location #tuesday .open span").css("background-color", "#4EADEA");

      $("#insert_location #tuesday .close span").css("background-color", "#ffffff");


    }


  });
  $('#insert_location [name=wednesday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='wednesday_open_close1']:checked").val();

    if (selected_value == "close") {
      $("#insert_location #wednesday #two").attr("disabled", true);
      $("#insert_location #wednesday #twc").attr("disabled", true);
      $("#insert_location #wednesday .open span").css("color", "#707070");
      $("#insert_location #wednesday .close span").css("color", "#ffffff");


      $("#insert_location #wednesday .open span").css("background-color", "#ffffff");

      $("#insert_location #wednesday .close span").css("background-color", "#FF3D5A");

    } else {
      $("#insert_location #wednesday #two").attr("disabled", false);
      $("#insert_location #wednesday #twc").attr("disabled", false);

      $("#insert_location #wednesday .open span").css("color", "#ffffff");
      $("#insert_location #wednesday .close span").css("color", "#707070");


      $("#insert_location #wednesday .open span").css("background-color", "#4EADEA");

      $("#insert_location #wednesday .close span").css("background-color", "#ffffff");

    }


  });
  $('#insert_location [name=thursday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='thursday_open_close1']:checked").val();

    if (selected_value == "close") {

      $("#insert_location #thursday #ttho").attr("disabled", true);
      $("#insert_location #thursday #tthc").attr("disabled", true);

      $("#insert_location #thursday .open span").css("color", "#707070");
      $("#insert_location #thursday .close span").css("color", "#ffffff");


      $("#insert_location #thursday .open span").css("background-color", "#ffffff");

      $("#insert_location #thursday .close span").css("background-color", "#FF3D5A");

    } else {
      $("#insert_location #thursday #ttho").attr("disabled", false);
      $("#insert_location #thursday #tthc").attr("disabled", false);

      $("#insert_location #thursday .open span").css("color", "#ffffff");
      $("#insert_location #thursday .close span").css("color", "#707070");


      $("#insert_location #thursday .open span").css("background-color", "#4EADEA");

      $("#insert_location #thursday .close span").css("background-color", "#ffffff");

    }


  });
  $('#insert_location [name=friday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='friday_open_close1']:checked").val();

    if (selected_value == "close") {
      $("#insert_location #friday input[type=time]").attr("disabled", true);

      $("#insert_location #friday #tfo").attr("disabled", true);
      $("#insert_location #friday #tfc").attr("disabled", true);

      $("#insert_location #friday .open span").css("color", "#707070");
      $("#insert_location #friday .close span").css("color", "#ffffff");


      $("#insert_location #friday .open span").css("background-color", "#ffffff");

      $("#insert_location #friday .close span").css("background-color", "#FF3D5A");

    } else {
      $("#insert_location #friday #tfo").attr("disabled", false);
      $("#insert_location #friday #tfc").attr("disabled", false);

      $("#insert_location #friday .open span").css("color", "#ffffff");
      $("#insert_location #friday .close span").css("color", "#707070");


      $("#insert_location #friday .open span").css("background-color", "#4EADEA");

      $("#insert_location #friday .close span").css("background-color", "#ffffff");

    }


  });
  $('#insert_location [name=saturday_open_close1]').change(function() {
    selected_value = $("#insert_location input[name='saturday_open_close1']:checked").val();

    if (selected_value == "close") {
      $("#insert_location #saturday #tsso").attr("disabled", true);
      $("#insert_location #saturday #tssc").attr("disabled", true);

      $("#insert_location #saturday .open span").css("color", "#707070");
      $("#insert_location #saturday .close span").css("color", "#ffffff");


      $("#insert_location #saturday .open span").css("background-color", "#ffffff");

      $("#insert_location #saturday .close span").css("background-color", "#FF3D5A");



    } else {
      $("#insert_location #saturday #tsso").attr("disabled", false);
      $("#insert_location #saturday #tssc").attr("disabled", false);

      $("#insert_location #saturday .open span").css("color", "#ffffff");
      $("#insert_location #saturday .close span").css("color", "#707070");


      $("#insert_location #saturday .open span").css("background-color", "#4EADEA");

      $("#insert_location #saturday .close span").css("background-color", "#ffffff");
    }


  });

  $('#insert_location [name=open_close]').unbind().change(function() {
    selected_value = $("#insert_location input[name='open_close']:checked").val();
    console.log(selected_value);
    if (selected_value == "close") {
      $("#insert_location #auto input[type=time]").attr("disabled", true);
      $("#insert_location tbody input[value=close]").prop("checked", true).change();
      // $("tbody input[value=open]").removeAttr("checked").change();
      $("#insert_location tbody input[value=open]").prop("checked", false).change();
      $("#insert_location tbody .open span").css("background-color", "#ffffff");
      $("#insert_location tbody .open span").css("color", "#707070");

      $("#insert_location tbody .close span").css("background-color", "#FF3D5A");
      $("#insert_location tbody .close span").css("color", "#ffffff");




      $("#insert_location tbody .ui-timepicker-input").attr("disabled", "true");
    } else {
      $("#insert_location #auto input[type=time]").attr("disabled", false);

      //   $("tbody input[value=close]").removeAttr("checked");
      $("#insert_location tbody input[value=close]").prop("checked", false).change();
      $("#insert_location tbody input[value=open]").prop("checked", true).change();
      $("#insert_location tbody .open span").css("background-color", "#4EADEA");

      $("#insert_location tbody .open span").css("color", "#ffffff");


      $("#insert_location tbody .close span").css("background-color", "#ffffff");

      $("#insert_location tbody .close span").css("color", "#707070");


      $("#insert_location tbody .ui-timepicker-input").removeAttr("disabled")
    }


  });

  $("#insert_location #basicExampleho").change(function(event) {

    open_time = $("#insert_location #basicExampleho").val();

    $("#insert_location #sunday #tso").val(open_time);
    $("#insert_location #monday #tmo").val(open_time);
    $("#insert_location #tuesday #tto").val(open_time);
    $("#insert_location #wednesday #two").val(open_time);
    $("#insert_location #thursday #ttho").val(open_time);
    $("#insert_location #friday #tfo").val(open_time);
    $("#insert_location #saturday #tsso").val(open_time);

  });


  $("#insert_location #basicExamplehc").change(function(event) {

    close_time = $("#insert_location #basicExamplehc").val();

    $("#insert_location #sunday #tsc").val(close_time);
    $("#insert_location #monday #tmc").val(close_time);
    $("#insert_location #tuesday #ttc").val(close_time);
    $("#insert_location #wednesday #twc").val(close_time);
    $("#insert_location #thursday #tthc").val(close_time);
    $("#insert_location #friday #tfc").val(close_time);
    $("#insert_location #saturday #tssc").val(close_time);

  });
  // Noor Work
  $('.OpenClose').on('change',function(){

      selected_value = $(this).val();
      id = "#"+$(this).data("id");

      if (selected_value == "close") {
        $(".t1 "+id+" .to").attr("disabled", true);
        $(".t1 "+id+" .tc").attr("disabled", true);

        $(".t1 "+id+" .open span").css("color", "#707070");
        $(".t1 "+id+" .close span").css("color", "#ffffff");


        $(".t1 "+id+" .open span").css("background-color", "#ffffff");

        $(".t1 "+id+" .close span").css("background-color", "#FF3D5A");

      } else {

        $(".t1 "+id+" .to").attr("disabled", false);
        $(".t1 "+id+" .tc").attr("disabled", false);

        $(".t1 "+id+" .open span").css("color", "#ffffff");
        $(".t1 "+id+" .close span").css("color", "#707070");


        $(".t1 "+id+" .open span").css("background-color", "#4EADEA");

        $(".t1 "+id+" .close span").css("background-color", "#ffffff");
      }
  });
  $('.open_close').unbind().change(function() {
    selected_value = $(this).val();
    id = $(this).data('id');

    if (selected_value == "close") {
      $("#basicExampleho"+id).attr("disabled", "true");
      $("#basicExamplehc"+id).attr("disabled", "true");
      $(".t1 #auto"+id+" input[type=time]").attr("disabled", true);
      $(".t1 #tbody"+id+" input[value=close]").prop("checked", true).change();

      $(".t1 #tbody"+id+" input[value=open]").prop("checked", false).change();
      $(".t1 #tbody"+id+" .open span").css("background-color", "#ffffff");
      $(".t1 #tbody"+id+" .open span").css("color", "#707070");

      $(".t1 #tbody"+id+" .close span").css("background-color", "#FF3D5A");
      $(".t1 #tbody"+id+" .close span").css("color", "#ffffff");

      $(".t1 #tbody"+id+" .ui-timepicker-input").attr("disabled", "true");
    } else {
      $("#basicExampleho"+id).removeAttr("disabled");
      $("#basicExamplehc"+id).removeAttr("disabled");
      // $("#auto"+id+" input[type=time]").removeAttr("disabled");

      $("#tbody"+id+" input[value=close]").removeAttr('checked');
      $("#tbody"+id+" input[value=open]").prop("checked", true).change();
      $("#tbody"+id+" .open span").css("background-color", "#4EADEA");

      $("#tbody"+id+" .open span").css("color", "#ffffff");


      $("#tbody"+id+" .close span").css("background-color", "#ffffff");

      $("#tbody"+id+" .close span").css("color", "#707070");

      $("#tbody"+id+" .ui-timepicker-input").removeAttr("disabled");

    }

    $('.from.ui-timepicker-input').datepicker().on('change', function (ev) {
       var firstDate = $(this).val();
       alert(firstDate);
    });
  });
  $("#remove_location").on('click',function(){
    deleLocation($(this).data('id'));
  });

  function deleLocation(LocationID){
        let text = "Are you sure to delete this location";
        if (confirm(text) == true) {
           url = "{{route('delete_location')}}";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: {id:LocationID}, // post data || get data
            success: function(result) {
                //   console.log(result);
                if(result.msg == "deleted"){
                    alert("Location is deleted successfully");
                }
                window.location.href = "{!! url('') !!}/business/location";
            },
            error: function(xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })
        }
    }
    // facebook field related work
    $(".fb_e").on("click", function() {
        edit = $(".fb_e").hasClass("true");

        // if (edit) {
        $(".fb_e").removeClass("true");
        $("#fb_te").css("display", "none");
        $("#fb_form_container").css("display", "block");
        $("#fb_form_container button").css("display", "block");
        $("#fb_form_container button").attr("disabled", false);
        // }
        //  else {
        //     $(".fb_e").addClass("true");
        //     $("#fb_te").css("display", "block");
        //     $("#fb_form_container").css("display", "none");
        //     $("#fb_form_container button").css("display", "none");
        //     $("#fb_form_container button").attr("disabled", true);
        // }

        $(this).hide();
        $('#fb_form').css('width', '90%');
        $('.fb_submit').css('display', 'block');



    });
    $(".insta_e").on("click", function() {
            edit = $(".insta_e").hasClass("true");

            $(".insta_e").removeClass("true");
            $("#insta_te").css("display", "none");
            $("#insta_form_container").css("display", "block");
            $("#insta_form_container button").css("display", "block");
            $("#insta_form_container button").attr("disabled", false);

            $(this).hide();
            $('#insta_form').css('width', '90%');
            $('.insta_submit').css('display', 'block');

        });
     $(".general_form").submit(function(event) {
        event.preventDefault();
        id = $(this).attr("id");


        url = "{{route('update_data')}}";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: $("#" + id).serialize(), // post data || get data
            success: function(result) {
                //   console.log(result);
                if (id == "bio_form") {
                    $('#bio_form_container').css('display', 'none');
                    // $("#bio_form").css('width',0);
                    $(".bio_te").html($("[name=description]").val());
                    $(".bio_te").css("display", "block");
                    $(".bio_u").css("display", "none");
                    $(".bio_e").addClass('true');
                    $(".bio_e").show();

                }
                if (id == "fb_form") {
                    $('#fb_form_container').css('display', 'none');
                    $('.fb_submit').css('display', 'none');
                    $(".fb_e").show();
                    $(".fb_e").addClass('true');
                    $("#fb_form").css('width',0);
                    $("#fb_te").val($("[name=facebook_link]").val());
                    $("#fb_te").show();


                }
                if (id == "insta_form") {
                    $('#insta_form_container').css('display', 'none');
                    $('.insta_submit').css('display', 'none');
                    $(".insta_e").show();
                    $(".insta_e").addClass('true');
                    $("#insta_form").css('width',0);
                    $("#insta_te").val($("[name=instagram_link]").val());
                    $("#insta_te").show();



                }


            },
            error: function(xhr, resp, text) {

                console.log(xhr.responseText);
            }
        });



    });

    $('.images-form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            type:'POST',
            url: "{{route('upload-image')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                data = JSON.parse(data);
                if(data.msg == "updated"){
                    alert('Image updated successfully');
                }
                $('.edit-profile2').show();
                $('#profilePicInput').show();
                $('.profile-pic-update').css('display', 'none');

                $('.edit-profile').show();
                $('#coverInput').show();
                $('.cover-update').css('display', 'none');

                $('.edit-icon3').show();
                $('#cardInput').show();
                $('.loyalty-card-image-update').css('display', 'none');
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });

    }));

    $(".edit-field2").on('click',function(){
        // let id = $(this).data("id");
        // $("#stamp-collect-text-main"+id).css("display","flex");
        // $(this).css("display","none");

    });
    //Number of stamps per day
    $('.stamps_per_day').on('change', function() {
        let number_stamps = $(this).val();
    	let key = $(this).data("key");
        var output = '';
        for (var i = 0; i < number_stamps; i++) {
            if(i + 1 == number_stamps){
                output += '<li class="active"><img src="{!! asset('business/assets/images/gift.svg') !!}"></li>';
            }else{
                output += '<li class="active"><img src="{{ asset('business/assets/images/all.svg') }}"></li>';
            }
       	}
	       $("#days_logo2_new"+key).html(output);
    });

    $('.stamp_description_add_new').on('change', function() {
       let stamp_description = $(this).val();
       let key = $(this).data('key');
       if(stamp_description == "other"){
         $("#other"+key).css("display","block");
       }else{
         $("#other"+key).css("display","none");
        $("#stamp-description"+key).html(stamp_description);
       }

    });

    $('.other').on('keyup', function() {
       let other_description = $(this).val();
       let key = $(this).data('key');

        $("#stamp-description"+key).html(other_description);

    });

    $("#radio-two").click(function(){
        $("#profiles").css("display","none");
        $("#reviews").css("display","block");
        $(".cancel-btn").css("display","none");
    });
    $("#radio-one").click(function(){
        $("#profiles").css("display","block");
        $("#reviews").css("display","none");
        $(".cancel-btn").css("display","block");
    });
  // end table functions

  $('.stamps_per_day').on('change', function() {
        stamp_id = $(this).data("stamp-id");
        str = "stamps_per_day=" + this.value + "&table=loyalty_scheme&field=stamps_per_day&id=" + $(this).attr("data-id");
        url = "{{route('update_data')}}";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: str, // post data || get data
            success: function(result) {
                // console.log(result.stamps_per_day);
                if(result.stamps_per_day == 5000){
                    $("#stamps_text"+stamp_id).html('Unlimited');
                }else{
                    $("#stamps_text"+stamp_id).html(result.stamps_per_day);
                }
               //  var output = "";
               // for (var i = 0; i < result.stamps_per_day; i++) {
               //      if(i + 1 == result.stamps_per_day){
               //          output += '<li class="active"><img src="{!! asset('business/assets/images/gift.svg') !!}"></li>';
               //      }else{
               //          output += '<li class="active"><img src="{!! asset('business/assets/images/all.svg') !!}"></li>';
               //      }
               // }
               // $("#days_logo2"+stamp_id).html(output);
            },
            error: function(xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })
    });
</script>

@endsection
