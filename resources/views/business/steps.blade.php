@extends('business.master')


@section('title', 'Steps')



@section('content')



    <style id="ui">.upi-main:after{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            content: "";
            display: block;
            border-radius: 0px 0px 10px 10px;
            background: rgba(0,0,0,.3);
            height: 100%;

        }</style>





    <div class="steps-main">

        <div class="step-container">

            <a href="{{route('end')}}" class="logout-btn"> <img src="{{asset('business/assets/images/log-out1.svg')}}"
                                                                alt="icon"> Logout</a>

            <div class="flex-main">

                <div class="sidebar-main">

                    <ul class="nav nav-tabs">


                        <li id="step1_li"

                            @if($step_number==0) class="active" @endif


                        ><a @if($step_number > 0) data-toggle="tab" @endif href="#step1"


                            @if($step_number > 0) class="done" @endif

                            >

                                <span class="step-num">1</span>

                                <div class="number-right">

                                    <span>Step One</span>

                                    <h4>Contact Info</h4>

                                </div>

                            </a></li>

                        <li id="step2_li"

                            @if($step_number==1) class="active" @endif


                        ><a @if($step_number > 1) data-toggle="tab" @endif href="#step2"


                            @if($step_number>1) class="done" @endif

                            >

                                <span class="step-num">2</span>

                                <div class="number-right">

                                    <span>Step Two</span>

                                    <h4>Choose Plan</h4>

                                </div>

                            </a></li>

                        <li id="step3_li"

                            @if($step_number==2) class="active" @endif

                        ><a @if($step_number > 2) data-toggle="tab" @endif href="#step3"

                            @if($step_number>2) class="done" @endif

                            >

                                <span class="step-num">3</span>

                                <div class="number-right">

                                    <span>Step Three</span>

                                    <h4>Your Business</h4>

                                </div>

                            </a></li>

                        <li id="step4_li"

                            @if($step_number==3) class="active" @endif

                        ><a @if($step_number > 3) data-toggle="tab" @endif href="#step4"

                            @if($step_number>3) class="done" @endif

                            >

                                <span class="step-num">4</span>

                                <div class="number-right">

                                    <span>Step Four</span>

                                    <h4>Loyalty Scheme</h4>

                                </div>

                            </a></li>

                        <li id="step5_li"

                            @if($step_number==4) class="active" @endif

                        ><a @if($step_number > 4) data-toggle="tab" @endif href="#step5">

                                <span class="step-num">5</span>

                                <div class="number-right">

                                    <span>Step Five</span>

                                    <h4>Complete Set Up</h4>

                                </div>

                            </a></li>

                    </ul>

                </div>

                <div class="tab-right-main">

                    <div class="tab-content">

                        <div id="step1" class="tab-pane fade

                @if($step_number==0) in active @endif">

                            <div class="contact-info">

                                <h1 class="contact-heading">Contact Info</h1>

                                <form id="step1_form" method="POST" action="{{route('business.contactinfo')}}">

                                    @csrf

                                    <input type="hidden" name="lat" id="lat" value="" required>
                                    <input type="hidden" name="lon" id="lon" value="" required>
                                    <div class="row">

                                        <div class="col-md-6">

                                            <label class="contact-label">Business Name</label>

                                            <input class="contact-field" autocomplete="chrome-off" autofill="off"
                                            value="{{isset($data->business_name) ? $data->business_name:''}}"
                                                   name="business_name" required type="text" placeholder="Enter here">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="contact-label">Your Name</label>

                                            <input class="contact-field" autocomplete="chrome-off" autofill="off"
                                                   name="name" type="text" required
                                                   value="{{isset(Auth::user()->name) ? Auth::user()->name:''}}"
                                                   onkeypress="return isCharacterKey(event)"
                                                   placeholder="Enter here">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="contact-label">Business Email Address</label>

                                            <input class="contact-field" autocomplete="chrome-off" autofill="off"
                                                   name="business_email" required type="email" value="{{$email}}"
                                                   value="{{isset($data->email) ? $data->email:''}}"
                                                   placeholder="Enter here">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="contact-label">Contact Number</label>

                                            <input class="contact-field" autocomplete="chrome-off" autofill="off"
                                                   name="business_number" placeholder=""
                                                   v="[+][0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                                   onkeypress="return isNumberKey(event)"
                                                   value="{{isset($data->business_number) ? $data->business_number:''}}"
                                                   required type="tel">

                                        </div>

                                        <div class="col-12" style="margin: 0px 15px;">

                                            <label class="contact-label">Business Address</label>

                                            <input id="business_address" required name="business_address" autofill="off"
                                                   class="contact-field" type="text" autocomplete="bilal"
                                                   value="{{isset($data->business_address) ? $data->business_address:''}}"
                                                   placeholder="Search Here">


                                        </div>

                                        <div class="col-12" style="margin: 0px 15px;">


                                            <button href="#" id="step1_submit"

                                                    type="submit"

                                                    class="continue-btn">Save and Continue

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">

                                                    <path fill-rule="evenodd"
                                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>

                                                </svg>

                                            </button>


                                        </div>

                                    </div>


                                </form>

                            </div>

                        </div>


                        <div id="step2" class="tab-pane fade   @if($step_number==1) in active @endif">


                            <!--freee plan-->
                            <div class="choose-plan">

                                <h1 class="contact-heading">Choose Plan </h1>

                                <!--<div class="billing-main">-->

                                <!--    <span class="m-billing">Monthly Billing</span>-->

                                <!--    <div class="switch-main">-->

                                <!--        <label class="switch">-->

                                <!--            <input id="checkbox" type="checkbox" >-->

                                <!--            <span class="slider round"></span>-->

                                <!--        </label>-->

                                <!--    </div>-->

                                <!--    <div class="annual-text">-->

                                <!--        <span>Annual Billing</span>-->

                                <!--        <p>Get 2 months free!</p>-->

                                <!--    </div>-->

                                <!--</div>-->

                                <div class="pkg-outer">

                                   @foreach($plans as $plan)
                                        <div id="{{$plan->id}}"
                                             class="pkg-main fre-pkg  @if(isset($data->plan)) @if( $data->plan == 1 && $plan->id == 1) active-pkg @elseif($data->plan == 2  && $plan->id == 2) active-pkg @endif @elseif($plan->id == 1)  active-pkg  @endif">

                                        <h3 class="pkg-title">{{$plan->plan_name}}</h3>

{{--                                        <span class="pkg-sub-title">(1 Location)</span>--}}

                                        <ul class="pkg-ul">

                                            @foreach(unserialize($plan->plan_features) as $planFeature)
                                                <li>

                                                    <span>{{$planFeature}}</span>

                                                </li>
                                            @endforeach

                                            @if($plan->upcoming_features)
                                                @foreach(unserialize($plan->upcoming_features) as $upcomingFeature)
                                                        <li>

                                                            <span>{{$upcomingFeature}}</span>

                                                        </li>
                                                @endforeach
                                            @endif


                                        </ul>

                                        <span id="fr" class="pkg-price-basic @if($plan->plan_price == 'Free') active @endif">{{$plan->plan_price}}</span>


                                    </div>
                                    @endforeach

                                    <form method='POST' id="pkg_form" action="{{route('business.plans')}}">

                                        @csrf`


                                        <input type="hidden" id="pkg_id" name="plan" value="1" required>

                                    </form>

                                </div>

                                <a href="javascript:void(0)" class="continue-btn step2_button">Save and Continue

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-arrow-right" viewBox="0 0 16 16">

                                        <path fill-rule="evenodd"
                                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                    </svg>

                                </a>


                            </div>

                        </div>


                        <div id="step3" class="tab-pane fade @if($step_number==2) in active @endif">

                            @php

                                if(!$data){
                              $data = new stdClass();
                            $data->description = null;
                            $data->plan = null;

                                }
                                if($data->description==" "){
                                $data->description=null;
                                }

                            @endphp


                            <form id="log_link" method="POST" action="{{route('business.detail')}}">

                                @csrf

                                <div class="ur-busines-main" id="busines1">

                                    <h1 class="contact-heading">Your Business</h1>

                                    <div class="upload-img-main">

                                        <div class="logo-left">

                                            <span>Your Logo</span>

                                            <label for="my_file1">

                                                <img

                                                    @if($logo)src="{{asset($logo)}}"

                                                    @else

                                                    src="{{asset('business/assets/images/up-img.svg')}}"

                                                    @endif

                                                    id="m1"/>

                                            </label>


                                            <input type="file" name="img" value="{{isset($logo) ? asset($logo):''}}"
                                                   id="my_file1" style="display: none;">


                                        </div>

                                        <div class="cover-right">

                                            <span>Your Cover Photo</span>

                                            <label for="my_file2">


                                                <img

                                                    @if($cover)src="{{asset($cover)}}"

                                                    @else

                                                    src="{{asset('business/assets/images/cover.svg')}}"

                                                    @endif


                                                    id="m2"/>

                                            </label>


                                            <input type="file" id="my_file2"
                                                   value="{{isset($cover) ? asset($cover):''}}" name="cover_img"
                                                   style="display: none;"/>

                                        </div>

                                    </div>

                                    <label class="customer-text"><strong>Bio</strong> (Visible to your
                                        customers)</label>

                                    <textarea autofill="off" class="customer-rev" name="desc" required
                                              placeholder="Enter business description...">{{$data->description ?? ''}}</textarea>

                                    <label class="customer-text"><strong>Social Links</strong> (Please add at least one)</label>

                                    <ul class="busines-ul">

                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                            </svg>
                                            <input autofill="off" type="text" autocomplete="chrome-off" required
                                                   class="form-control" name="facebook_link"
                                                   value="{{$data->facebook_link ?? ''}}" placeholder="Facebook">

                                        </li>

                                        <li>
                                            <img src="{{asset('business/assets/images/insta-n.png')}}" alt="pre-cion">
                                            <input autofill="off" autocomplete="chrome-off" required
                                                   class="form-control" value="{{$data->instagram_link ?? ''}}"
                                                   type="text" name="instagram_link" placeholder="Instagram">

                                        </li>

                                    </ul>


                                    <div class="next-icon-main">
                                    <!--<span class="pre" id="back-step2"><img src="{{asset('business/assets/images/pre.svg')}}" alt="pre-cion"></span>-->
                                    <!--<span class="next" id="step2-next-icon"><img src="{{asset('business/assets/images/next.svg')}}" alt="next-icon"></span>-->
                                        <ul class="bullets-ul">

                                            <li class="active"></li>

                                            <li id="show-step2"></li>

                                        </ul>
                                    </div>


                                    <button type="submit" class="continue-btn" id="log_form">Next

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">

                                            <path fill-rule="evenodd"
                                                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                        </svg>

                                    </button>

                                </div>


                            </form>


                            <form id="locations" method="POST" action="{{route('business.detail2')}}">

                            @csrf

                            <!-- business step 2 -->

                                <div class="business-step2" id="business2">

                                    <h1 class="contact-heading">Your Business</h1>

                                    <span class="loc-sub-heading">Location  (where will stamps be collected by customers?):</span>

                                    <span class="busines-check">

                            <input type="checkbox" id="same_address" name="same_address" value="same_address">

                            <label for="same_addre">Same as registered business address</label>

                        </span>

                                    <div class="search-addres-field">

                                        <span class="loc-icon"><img
                                                src="{{asset('business/assets/images/location.svg')}}"
                                                alt="location"></span>

                                        <input autofill="off" type="text" id="business_address_1" required
                                               name="address" placeholder="Search other Address"
                                               autocomplete="chrome-off">

                                        <input type="hidden" name="c1" value="1">

                                    </div>

                                    <h2 class="opening-text">Opening Hours</h2>

                                    <div class="opening-table1">


                                        <table class="table table-striped">

                                            <thead style="background: #F7FAFF;">

                                            <tr id="auto">

                                                <th scope="col">

                                                    Autofill

                                                </th>

                                                <th scope="col">

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input name="open_close" type="radio" value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="open_close" value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </th>

                                                <th scope="col">
                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="basicExampleho" value="9:00am">
                                        </span>

                                                </th>

                                                <th scope="col">

                                                    To

                                                </th>

                                                <th scope="col">

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            <input id="basicExamplehc" value="5:00pm">
                                        </span>

                                                </th>

                                            </tr>

                                            </thead>

                                            <tbody>


                                            <tr id="monday">

                                                <th scope="row">

                                                    Monday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="monday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="monday_open_close1" value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmo" value="9:00am" name="monday_open_time1" required>
                                </span>
                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmc" value="5:00pm" name="monday_close_time1" required>

  </span>
                                                </td>

                                            </tr>


                                            <tr id="tuesday">

                                                <th scope="row">

                                                    Tuesday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="tuesday_open_close1" value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="tuesday_open_close1"
                                                                   value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tto" value="9:00am" name="tuesday_open_time1" required>
                                        </span>
                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttc" value="5:00pm" name="tuesday_close_time1" required>
                                       </span>

                                                </td>

                                            </tr>


                                            <tr id="wednesday">

                                                <th scope="row">

                                                    wednesday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="wednesday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" value="close"
                                                                   name="wednesday_open_close1"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="two" value="9:00am" name="wednesday_open_time1" required>
                          </span>
                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="twc" value="5:00pm" name="wednesday_close_time1" required>

  </span>
                                                </td>

                                            </tr>


                                            <tr id="thursday">

                                                <th scope="row">

                                                    Thursday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="thursday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="thursday_open_close1"
                                                                   value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttho" value="9:00am" name="thrusday_open_time1" required>

  </span>


                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tthc" value="5:00pm" name="thrusday_close_time1" required>

  </span>

                                                </td>

                                            </tr>


                                            <tr id="friday">

                                                <th scope="row">

                                                    Friday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="friday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="friday_open_close1" value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfo" value="9:00am" name="friday_open_time1" required>

  </span>


                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
                                        <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfc" value="5:00pm" name="friday_close_time1" required>

  </span>


                                                </td>

                                            </tr>


                                            <tr id="saturday">

                                                <th scope="row">

                                                    Saturday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="saturday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" name="saturday_open_close1"
                                                                   value="close"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsso" value="9:00am" name="saturday_open_time1" required>

  </span>


                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tssc" value="5:00pm" name="saturday_close_time1" required>

  </span>

                                                </td>

                                            </tr>

                                            <tr id="sunday">

                                                <th scope="row">

                                                    Sunday

                                                </th>

                                                <td>

                                                    <div class="custom-radio open">

                                                        <label>

                                                            <input type="radio" name="sunday_open_close1"
                                                                   value="open"><span>Open</span>

                                                        </label>

                                                    </div>


                                                    <div class="custom-radio closed">

                                                        <label>

                                                            <input type="radio" value="close" name="sunday_open_close1"><span>Closed</span>

                                                        </label>

                                                    </div>

                                                </td>

                                                <td>
 <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tso" disabled value="9:00am" name="sunday_open_time1" required>

                                     </span>

                                                </td>

                                                <td>

                                                    To

                                                </td>

                                                <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsc" disabled value="5:00pm" name="sunday_close_time1" required>
                                          </span>


                                                </td>

                                            </tr>


                                            </tbody>

                                        </table>


                                    </div>


                                    <div class="next-icon-main">
                                        <span class="pre" id="back-step999"><img
                                                src="{{asset('business/assets/images/pre.svg')}}" alt="pre-cion"></span>


                                        <ul class="bullets-ul fo3">

                                            <li></li>

                                            <li class="active"></li>

                                            <!--<li id="show-step3"></li>-->

                                        </ul>
                                    </div>

                                    <button type="submit"

                                            class="continue-btn">Next

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">

                                            <path fill-rule="evenodd"
                                                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                        </svg>

                                    </button>


                            </form>

                        </div>


                        <!-- business step 3 -->


                        <div class="business-step3" id="business3">

                            <h1 class="contact-heading">Your Business</h1>

                            <div class="loc-site-box">

                                <div class="loc-site-text-drop">

                                    <span>Locations / Sites</span>

                                    <select id="new_location_count">

                                        <option value="1">1</option>

                                        <option value="2">2</option>

                                        <option value="3">3</option>
                                    </select>

                                </div>
                                <form id="other_locations" action="{{route('business.new_locations')}}">
                                    <span class="busines-check2">

                                <input type="checkbox" id="new_same_address" name="new_same_address"
                                       value="same_address">

                                <label for="new_same_address">Same as registered business address</label>

                            </span>

                                    <div class="search-addres-field2">

                                        <span class="loc-icon2"><img
                                                src="{{asset('business/assets/images/location.svg')}}"
                                                alt="location"></span>

                                        <input type="text" id="business_location_bar_2" name="new_address"
                                               placeholder="Input other Address" autocomplete="chrome-off">

                                    </div>

                            </div>


                            <div class="opening-loc-main0">

                                <h2 class="opening-text">Location 1 - Opening Hours</h2>

                                <div class="loc1-table">

                                    <table class="table table-striped">

                                        <thead style="background: #F7FAFF;">

                                        <tr id="auto2">

                                            <th scope="col">

                                                Autofill

                                            </th>

                                            <th scope="col">

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input name="new_open_close" type="radio" value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_open_close" value="close"><span>Closed</span>


                                                    </label>

                                                </div>

                                            </th>

                                            <th scope="col">
                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newBasicExampleho" value="9:00am">
                                        </span>

                                            </th>

                                            <th scope="col">

                                                To

                                            </th>

                                            <th scope="col">

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            <input id="newBasicExamplehc" value="5:00pm">
                                        </span>

                                            </th>

                                        </tr>

                                        </thead>

                                        <tbody class="newT">


                                        <tr id="newMonday">

                                            <th scope="row">

                                                Monday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_monday_open_close"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_monday_open_close"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTmo" value="9:00am" name="new_monday_open_time" required>
                                </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTmc" value="5:00pm" name="new_monday_close_time" required>

  </span>
                                            </td>

                                        </tr>


                                        <tr id="newTuesday">

                                            <th scope="row">

                                                Tuesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_tuesday_open_close"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_tuesday_open_close" value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTto" value="9:00am" name="new_tuesday_open_time" required>
                                        </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTtc" value="5:00pm" name="new_tuesday_close_time" required>
                                       </span>

                                            </td>

                                        </tr>

                                        <tr id="newWednesday">

                                            <th scope="row">

                                                wednesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_wednesday_open_close"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="new_wednesday_open_close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTwo" value="9:00am" name="new_wednesday_open_time" required>
                          </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTwc" value="5:00pm" name="new_wednesday_close_time" required>

  </span>
                                            </td>

                                        </tr>

                                        <tr id="newThursday">

                                            <th scope="row">

                                                Thursday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_thursday_open_close" value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_thursday_open_close"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTtho" value="9:00am" name="new_thrusday_open_time" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTthc" value="5:00pm" name="new_thrusday_close_time" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="newFriday">

                                            <th scope="row">

                                                Friday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_friday_open_close"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_friday_open_close"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTfo" value="9:00am" name="new_friday_open_time" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
                                        <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTfc" value="5:00pm" name="new_friday_close_time" required>

  </span>


                                            </td>

                                        </tr>

                                        <tr id="newSaturday">

                                            <th scope="row">

                                                Saturday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_saturday_open_close" value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="new_saturday_open_close"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTsso" value="9:00am" name="new_saturday_open_time" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTssc" value="5:00pm" name="new_saturday_close_time" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="newSunday">

                                            <th scope="row">

                                                Sunday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="new_sunday_open_close"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="new_sunday_open_close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
 <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTso" disabled value="9:00am" name="new_sunday_open_time" required>

                                     </span>

                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="newTsc" disabled value="5:00pm" name="new_sunday_close_time"
                                               required>
                                          </span>


                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>


                                </div>

                            </div>


                            <div style="display: none" class="opening-loc-main1">

                                <div class="location2-box">

                                    <label><strong>Location 2</strong> (Where will stamps be collected by
                                        cusotmers?):</label>

                                    <div class="search-addres-field2">

                                        <span class="loc-icon2"><img
                                                src="{{asset('business/assets/images/location.svg')}}"
                                                alt="location"></span>
                                        <input type="hidden" name="exist_2" id="exist_2" value="false">
                                        <input type="text" name="address_2" id="business_location_567"
                                               placeholder="Input other Address">

                                    </div>

                                </div>

                                <h2 class="opening-text">Location 2 - Opening Hours</h2>

                                <div class="loc1-table">

                                    <table class="table table-striped">

                                        <thead style="background: #F7FAFF;">

                                        <tr id="auto2">

                                            <th scope="col">

                                                Autofill

                                            </th>

                                            <th scope="col">

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input name="open_close2" type="radio"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="open_close2" value="close"><span>Closed</span>


                                                    </label>

                                                </div>

                                            </th>

                                            <th scope="col">
                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="basicExampleho2" value="9:00am">
                                        </span>

                                            </th>

                                            <th scope="col">

                                                To

                                            </th>

                                            <th scope="col">

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            <input id="basicExamplehc2" value="5:00pm">
                                        </span>

                                            </th>

                                        </tr>

                                        </thead>

                                        <tbody class="t2">


                                        <tr id="monday2">

                                            <th scope="row">

                                                Monday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="monday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="monday_open_close2"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmo2" value="9:00am" name="monday_open_time2" required>
                                </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmc2" value="5:00pm" name="monday_close_time2" required>

  </span>
                                            </td>

                                        </tr>


                                        <tr id="tuesday2">

                                            <th scope="row">

                                                Tuesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="tuesday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="tuesday_open_close2"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tto2" value="9:00am" name="tuesday_open_time2" required>
                                        </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttc2" value="5:00pm" name="tuesday_close_time2" required>
                                       </span>

                                            </td>

                                        </tr>

                                        <tr id="wednesday2">

                                            <th scope="row">

                                                wednesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="wednesday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="wednesday_open_close2"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="two2" value="9:00am" name="wednesday_open_time2" required>
                          </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="twc2" value="5:00pm" name="wednesday_close_time2" required>

  </span>
                                            </td>

                                        </tr>

                                        <tr id="thursday2">

                                            <th scope="row">

                                                Thursday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="thursday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="thursday_open_close2"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttho2" value="9:00am" name="thrusday_open_time2" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tthc2" value="5:00pm" name="thrusday_close_time2" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="friday2">

                                            <th scope="row">

                                                Friday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="friday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="friday_open_close2"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfo2" value="9:00am" name="friday_open_time2" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
                                        <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfc2" value="5:00pm" name="friday_close_time2" required>

  </span>


                                            </td>

                                        </tr>

                                        <tr id="saturday2">

                                            <th scope="row">

                                                Saturday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="saturday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="saturday_open_close2"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsso2" value="9:00am" name="saturday_open_time2" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tssc2" value="5:00pm" name="saturday_close_time2" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="sunday2">

                                            <th scope="row">

                                                Sunday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="sunday_open_close2"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="sunday_open_close2"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
 <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tso2" disabled value="9:00am" name="sunday_open_time2" required>

                                     </span>

                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsc2" disabled value="5:00pm" name="sunday_close_time2" required>
                                          </span>


                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>


                                </div>

                            </div>


                            <div style="display:none" class="opening-loc-main2">

                                <div class="location2-box">

                                    <label><strong>Location 3</strong> (Where will stamps be collected by
                                        cusotmers?):</label>

                                    <div class="search-addres-field2">

                                        <span class="loc-icon2"><img
                                                src="{{asset('business/assets/images/location.svg')}}"
                                                alt="location"></span>
                                        <input type="hidden" name="exist_3" id="exist_3" value="false">
                                        <input type="text" name="address_3" id="business_location_3"
                                               placeholder="Input other Address">

                                    </div>

                                </div>

                                <h2 class="opening-text">Location 3 - Opening Hours</h2>

                                <div class="loc1-table">

                                    <table class="table table-striped">

                                        <thead style="background: #F7FAFF;">

                                        <tr id="auto3">

                                            <th scope="col">

                                                Autofill

                                            </th>

                                            <th scope="col">

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input name="open_close3" type="radio"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="open_close3" value="close"><span>Closed</span>


                                                    </label>

                                                </div>

                                            </th>

                                            <th scope="col">
                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="basicExampleho3" value="9:00am">
                                        </span>

                                            </th>

                                            <th scope="col">

                                                To

                                            </th>

                                            <th scope="col">

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            <input id="basicExamplehc3" value="5:00pm">
                                        </span>

                                            </th>

                                        </tr>

                                        </thead>

                                        <tbody class="t3">


                                        <tr id="monday3">

                                            <th scope="row">

                                                Monday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="monday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="monday_open_close3"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmo3" value="9:00am" name="monday_open_time3" required>
                                </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tmc3" value="5:00pm" name="monday_close_time3" required>

  </span>
                                            </td>

                                        </tr>


                                        <tr id="tuesday3">

                                            <th scope="row">

                                                Tuesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="tuesday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="tuesday_open_close3"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tto3" value="9:00am" name="tuesday_open_time3" required>
                                        </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttc3" value="5:00pm" name="tuesday_close_time3" required>
                                       </span>

                                            </td>

                                        </tr>

                                        <tr id="wednesday3">

                                            <th scope="row">

                                                wednesday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="wednesday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="wednesday_open_close3"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="two3" value="9:00am" name="wednesday_open_time3" required>
                          </span>
                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="twc3" value="5:00pm" name="wednesday_close_time3" required>

  </span>
                                            </td>

                                        </tr>

                                        <tr id="thursday3">

                                            <th scope="row">

                                                Thursday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="thursday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="thursday_open_close3"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="ttho3" value="9:00am" name="thrusday_open_time3" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>

                                      <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tthc3" value="5:00pm" name="thrusday_close_time3" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="friday3">

                                            <th scope="row">

                                                Friday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="friday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="friday_open_close3"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>

<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfo3" value="9:00am" name="friday_open_time3" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
                                        <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tfc3" value="5:00pm" name="friday_close_time3" required>

  </span>


                                            </td>

                                        </tr>

                                        <tr id="saturday3">

                                            <th scope="row">

                                                Saturday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="saturday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" name="saturday_open_close3"
                                                               value="close"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsso3" value="9:00am" name="saturday_open_time3" required>

  </span>


                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tssc3" value="5:00pm" name="saturday_close_time3" required>

  </span>

                                            </td>

                                        </tr>

                                        <tr id="sunday3">

                                            <th scope="row">

                                                Sunday

                                            </th>

                                            <td>

                                                <div class="custom-radio open">

                                                    <label>

                                                        <input type="radio" name="sunday_open_close3"
                                                               value="open"><span>Open</span>

                                                    </label>

                                                </div>


                                                <div class="custom-radio closed">

                                                    <label>

                                                        <input type="radio" value="close"
                                                               name="sunday_open_close3"><span>Closed</span>

                                                    </label>

                                                </div>

                                            </td>

                                            <td>
 <span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tso3" disabled value="9:00am" name="sunday_open_time3" required>

                                     </span>

                                            </td>

                                            <td>

                                                To

                                            </td>

                                            <td>
<span class="time-picker">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        <input id="tsc3" disabled value="5:00pm" name="sunday_close_time3" required>
                                          </span>


                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>



                            <div class="next-icon-main">
                                <span class="pre" id="back-step9999">
                                    <img src="{{asset('business/assets/images/pre.svg')}}" alt="pre-cion">
                                </span>
                                <ul class="bullets-ul">

                                    <li></li>

                                    {{--                                <li></li>--}}

                                    <li class="active"></li>

                                </ul>
                            </div>


                            <button type="submit"

                                    class="continue-btn">Next

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-right" viewBox="0 0 16 16">

                                    <path fill-rule="evenodd"
                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                </svg>

                            </button>


</div>
                        <!--</form>-->

                        </form>

                    </div>


                    <div id="step4" class="tab-pane fade

                @if($step_number==3) in active @endif">


                        <form id="loyalty_scheme" method="POST" action="{{route('business.loyalty')}}">
                            @csrf

                            <div class="loyalty-scheme-main">

                                <h1 class="contact-heading">Loyalty Scheme</h1>


                                @if(sizeof($loyalty_scheme) > 0)
                                    @foreach($loyalty_scheme as $key =>  $loyalRecord)

                                        <input type="hidden" name="is_logo" id="is_logo" value="{{$loyalRecord->is_logo == 0 ? 0 :1}}">

                                    @if($key == 1)
                                            <input type="hidden" name="is_logo_2" id="is_logo_2" value="{{$loyalRecord->is_logo == 0 ? 0 :1}}">
                                    @endif


                                    @if(($data->plan == 1 && $key != 1) || $data->plan == 2 )
                                        <div class="main-loyalty-div">
                                        <div class="add_new_class_div {{isset($data->plan) ?  $data->plan == 2 ? 'loyalty-sec1':'' :''}}">
                                            <ul class="add_new_class {{isset($data->plan) ? $data->plan == 1 ? 'loyalty-sec1':'':'loyalty-sec1'}}">

                                                <!--<li>-->

                                                <!--    <span>-->

                                                <!--      Name-->

                                                <!--    </span>-->

                                                <input type="hidden" value="random" name="l_name" class="form-control"
                                                       autocomplete="chrome-off">

                                                @if($key == 1 )
                                                    <input type="hidden" value="random" name="l_name_2" class="form-control"
                                                           autocomplete="chrome-off">
                                                @endif


                                                <!--</li>-->

                                                <li>

                                                    <span>
                                                        How many stamp does a customer need to collect to earn a reward? (a complete loyalty card)
                                                    </span>

                                                    <select required name="{{$key == 0 ? "number_stamps":"number_stamps_2"}}">

                                                        @for($i=2;$i<=10;$i++)

                                                            <option {{$i == $loyalRecord->number_stamps ? 'selected':''}}>
                                                                {{$i}}
                                                            </option>

                                                        @endfor


                                                    </select>


                                                </li>

                                                <li>
                                                    <span>
                                                        What reward does a customer earn when they complete the card.
                                                    </span>
                                                    <div class="other-reward" id="{{$key == 0 ? "ot-reward":"ot-reward_2"}}">
                                                        <select name="{{$key == 0 ? "description":"description_2"}}" required>

                                                            <option {{$loyalRecord->description == '1 Free Coffee' ? 'selected':''}}>1 Free Coffee</option>

                                                            <option {{$loyalRecord->description == '1 Free Hot Drink' ? 'selected':''}}>1 Free Hot Drink</option>

                                                            <option {{$loyalRecord->description == '1 Free Sandwich' ? 'selected':''}}>1 Free Sandwich</option>

                                                            <option {{$loyalRecord->description == '1 Free Coffee and Snack' ? 'selected':''}}>1 Free Coffee and Snack</option>

                                                            <option {{$loyalRecord->description == '1 Free Meal' ? 'selected':''}}>1 Free Meal</option>

                                                            <option {{$loyalRecord->description == '1 Free Side with Meal' ? 'selected':''}}>1 Free Side with Meal</option>

                                                            <option {{$loyalRecord->description == '1 Free Lunch' ? 'selected':''}}>1 Free Lunch</option>

                                                            <option {{$loyalRecord->description == '1 Free Smoothie' ? 'selected':''}}>1 Free Smoothie</option>

                                                            <option {{$loyalRecord->description == '1 Free Ice cream' ? 'selected':''}}>1 Free Ice cream</option>

                                                            <option {{$loyalRecord->description == '1 Free Haircut' ? 'selected':''}}>1 Free Haircut</option>

                                                            <option {{$loyalRecord->description == '1 Free Drink' ? 'selected':''}}>1 Free Drink</option>
                                                            <option {{$loyalRecord->description == 'Other' ? 'selected':''}} id="sel_other">Other</option>

                                                        </select>



                                                        @if($loyalRecord->description == 'Other')
                                                            <input type="text" id="{{$key == 0 ? "other":"other_2"}}" autofill="off" name="other_description"
                                                                   value="{{$loyalRecord->other_description}}"
                                                                   placeholder="Enter other reward">
                                                        @else
                                                            <input type="hidden" id="{{$key == 0 ? "other":"other_2"}}" autofill="off"
                                                                   placeholder="Enter other reward" name="other_description">
                                                        @endif
                                                    </div>

                                                </li>

                                            </ul>

                                        </div>
                                        <div class="loyalty-scroll">

                                                <div class="add_new_class_in_div {{isset($data->plan) ? $data->plan == 1 ? 'loyalty-sec2':'' :'loyalty-sec2'}}">

                                                    <span class="loy-text">Loyalty Card Preview:</span>

                                                    <div class="stamp-main">

                                                        <div class="logo-text-main">


                                                            <img width="50px" id="{{$key == 0 ? "m3":"m3_2"}}"

                                                                 @if($cover)src="{{asset($logo)}}"

                                                                 @else

                                                                 src="{{asset('business/assets/images/stamp.svg')}}"

                                                                 @endif


                                                                 id="{{$key == 0 ? "img_logo":"img_logo_2" }}" alt="logo">

                                                            <span> <p id="{{$key == 0 ? "s_days":"s_days_2" }}">Collect {{$loyalRecord->number_stamps}}</p>
                                                                <p id="{{$key == 0 ? "s_reward":"s_reward_2"}}">stamps to Earn:
                                                                    @if($loyalRecord->description == 'Other')
                                                                        {{$loyalRecord->other_description}}
                                                                    @else
                                                                        {{$loyalRecord->description}}
                                                                    @endif
                                                                </p>
                                                            </span>

                                                        </div>

                                                        <div class="upi-main" id="{{$key == 0 ? "s_bk":"s_bk_2"}}" style="background-image: url({{asset($loyalRecord->img)}}); background-repeat: no-repeat; background-position: center center;">


                                                            <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                                data-gift="{{asset('business/assets/images/gift.svg')}}"
                                                                class="nft-logo" id="{{$key == 0 ? "days_logo":"days_logo_2" }}" style="{{$loyalRecord->number_stamps % 2 == 0 ? "margin-left:-20px !important":''}}">

                                                                @if($loyalRecord->number_stamps == 2)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                @elseif($loyalRecord->number_stamps == 3)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img src="{{asset('business/assets/images/gift.svg')}}"></li>
                                                                @elseif($loyalRecord->number_stamps == 4)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                @elseif($loyalRecord->number_stamps == 5)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img src="{{asset('business/assets/images/gift.svg')}}"></li>
                                                                @elseif($loyalRecord->number_stamps == 6)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img src="{{asset('business/assets/images/all.svg')}}"></li>
                                                                @elseif($loyalRecord->number_stamps == 7)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img src="{{asset('business/assets/images/gift.svg')}}"></li>
                                                                @endif
                                                            </ul>


                                                            <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                                data-gift="{{asset('business/assets/images/gift.svg')}}"
                                                                class="nft-logo nft-logo2" id="{{$key == 0 ? "days_logo2":"days_logo2_2"}}" style="{{$loyalRecord->number_stamps % 2 == 0 ? "margin-left:25px !important":''}}">
                                                                @if($loyalRecord->number_stamps == 2)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/gift.svg')}}"/></li>
                                                                @elseif($loyalRecord->number_stamps == 3)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active" style="opacity: 0"></li>
                                                                @elseif($loyalRecord->number_stamps == 4)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/gift.svg')}}"/></li>
                                                                @elseif($loyalRecord->number_stamps == 5)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active" style="opacity: 0"></li>
                                                                @elseif($loyalRecord->number_stamps == 6)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img src="{{asset('business/assets/images/gift.svg')}}"></li>
                                                                @elseif($loyalRecord->number_stamps == 7)
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active"><img  src="{{asset('business/assets/images/all.svg')}}"/></li>
                                                                    <li class="active" style="opacity: 0"></li>
                                                                @endif

                                                            </ul>

                                                            @if($key == 0)
                                                                <p hidden id='ex'>1</p>
                                                            @elseif($key == 1)
                                                                <p hidden id='ex_2'>1</p>
                                                            @endif






                                                            <div class="img-upi" id="{{$key == 0 ? "img-upi":"img-upi_2"}}" style="display: none">


                                                                <label for="my_file3">


                                                                    <img src="{{asset('business/assets/images/up-img2.svg')}}"/>

                                                                </label>


                                                                <input type="file" onclick="this.value=null;" id="{{$key == 0 ? "my_file3":"my_file3_2"}}"
                                                                       style="display: none;"/>

                                                                <input type="radio" required hidden  name="{{$key == 0 ? "scheme-logo":"scheme-logo_2"}}"
                                                                       @if($loyalRecord->is_logo == 0)
                                                                            value="{{$loyalRecord->img}}" checked
                                                                       @endif

                                                                       id="{{$key == 0 ? "scheme-logo1":"scheme-logo1_2"}}">

                                                            </div>

                                                            <span class="or-text" id="{{$key == 0 ? "or-text":"or-text_2"}}" style="display: none">or</span>


                                                            <span class="another-logo" id="{{$key == 0 ? "another-logo":"another-logo_2"}}" style="display: none">

                                                                    <input type="radio" required  name="{{$key == 0 ? "scheme-logo":"scheme-logo_2"}}"
                                                                           value="{{$logo}}"

                                                                           @if($loyalRecord->is_logo == 1)
                                                                               checked
                                                                           @endif
                                                                           id="{{$key == 0 ? "scheme-logo2":"scheme-logo2_2"}}">

                                                                    <label for="another-logo"> Use Logo Image</label>

                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>
                                                <span id="{{$key == 0 ? "rimg":"rimg_2"}}"  class="remove-img">Remove Image</span>
                                            @if($key == 1)
                                                <span class="remove-div">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                          <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"></path>
                                                          <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"></path>
                                                        </svg>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>



                                            @if($key == 1 && $data->plan == 2)

                                            @endif


                                        @endif
                                    @endforeach
                                        <img style="display: none"

                                             id="add_another_image"
                                             src="{{asset('business/assets/images/loyalty_card.jpg')}}">


                                @else
                                    <div class="main-loyalty-div">
                                        <div class="add_new_class_div {{isset($data->plan) ?  $data->plan == 2 ? 'loyalty-sec1':'' :''}}">
                                            <ul class="add_new_class {{isset($data->plan) ? $data->plan == 1 ? 'loyalty-sec1':'':'loyalty-sec1'}}">

                                                <!--<li>-->

                                                <!--    <span>-->

                                                <!--      Name-->

                                                <!--    </span>-->

                                                <input type="hidden" value="random" name="l_name" class="form-control"
                                                       autocomplete="chrome-off">


                                                <!--</li>-->

                                                <li>

                                                <span>
                                                    How many stamp does a customer need to collect to earn a reward? (a complete loyalty card)
                                                </span>

                                                    <select required name="number_stamps">

                                                        @for($i=2;$i<=10;$i++)

                                                            <option @if($i==7) selected @endif>
                                                                {{$i}}
                                                            </option>

                                                        @endfor


                                                    </select>


                                                </li>

                                                <li>
                                                <span>
                                                    What reward does a customer earn when they complete the card.
                                                </span>
                                                    <div class="other-reward" id="ot-reward">
                                                        <select name="description" required>

                                                            <option>1 Free Coffee</option>

                                                            <option>1 Free Hot Drink</option>

                                                            <option>1 Free Sandwich</option>

                                                            <option>1 Free Coffee and Snack</option>

                                                            <option>1 Free Meal</option>

                                                            <option>1 Free Side with Meal</option>

                                                            <option>1 Free Lunch</option>

                                                            <option>1 Free Smoothie</option>

                                                            <option>1 Free Ice cream</option>

                                                            <option>1 Free Haircut</option>

                                                            <option>1 Free Drink</option>
                                                            <option id="sel_other">Other</option>

                                                        </select>
                                                        <input type="hidden" id="other" autofill="off"
                                                               name="other_description"
                                                               placeholder="Enter other reward">
                                                    </div>

                                                </li>

                                            </ul>

                                        </div>
                                        <div class="loyalty-scroll">

                                            <div class="add_new_class_in_div {{isset($data->plan) ? $data->plan == 1 ? 'loyalty-sec2':'' :'loyalty-sec2'}}">

                                                <span class="loy-text">Loyalty Card Preview:</span>

                                                <div class="stamp-main">

                                                    <div class="logo-text-main">


                                                        <img width="50px" id="m3"

                                                             @if($cover)src="{{asset($logo)}}"

                                                             @else

                                                             src="{{asset('business/assets/images/stamp.svg')}}"

                                                             @endif


                                                             id="img_logo" alt="logo">

                                                        <span> <p id="s_days">Collect 7</p> <p id="s_reward">stamps to Earn: 1 Free Coffee</p></span>

                                                    </div>

                                                    <div class="upi-main" id="s_bk">


                                                        <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                            data-gift="{{asset('business/assets/images/gift.svg')}}"
                                                            class="nft-logo" id="days_logo">
                                                        <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->
                                                        <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->


                                                        </ul>

                                                        <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                            data-gift="{{asset('business/assets/images/gift.svg')}}"
                                                            class="nft-logo nft-logo2" id="days_logo2">
                                                        <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->
                                                        <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->


                                                        </ul>

                                                        <div class="img-upi" id="img-upi">


                                                            <label for="my_file3">


                                                                <img src="{{asset('business/assets/images/up-img2.svg')}}"/>

                                                            </label>


                                                            <input type="file" onclick="this.value=null;" id="my_file3"
                                                                   style="display: none;"/>

                                                            <input type="radio" hidden required name="scheme-logo"

                                                                   id="scheme-logo1">

                                                        </div>

                                                        <span class="or-text" id="or-text">or</span>


                                                        <span class="another-logo" id="another-logo">

                                                    <input type="radio" required name="scheme-logo"
                                                           value="{{$logo}}"

                                                           id="scheme-logo2">

                                                    <label for="another-logo"> Use Logo Image</label>

                                                </span>

                                                    </div>

                                                </div>

                                            </div>
                                            <span id="rimg" style="display:none" class="remove-img">Remove Image</span>
                                        </div>
                                    </div>

                                    <img style="display: none" id="add_another_image"
                                         src="{{asset('business/assets/images/loyalty_card.jpg')}}">

                                @endif

{{--                                <img style="display: none" id="add_another_image"--}}
{{--                                     src="{{asset('business/assets/images/loyalty_card.jpg')}}">--}}

                            </div>


                            <button type="submit" id="l_s_b" class="continue-btn">Save and Continue

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-right" viewBox="0 0 16 16">

                                    <path fill-rule="evenodd"
                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                </svg>

                            </button>


                        </form>

                    </div>


                    <div id="step5" class="tab-pane fade @if($step_number==4) in active @endif">

                        <div class="complete-setup-main">

                            <form id="sending_detail" method="POST" action="{{route('send.tags')}}">

                                @csrf

                                <div class="complete-setup1" id="setup1_lo">

                                    <h1 class="contact-heading">Complete Set Up</h1>

                                    <div class="loyal-tag">

                                        <span class="tag-headi">Where should we send your Loyal IOM Tag and promotion pack?</span>

                                        <ul class="input-rad-main">


                                            <li>

                                                <input type="radio" id="send_location" name="send_location"
                                                       value="{{$businessLocation}}">

                                                <label
                                                    for="{{$businessLocation}} ">{{$businessLocation}}</label>

                                            </li>


                                        @if($locations !=null)

                                                @foreach($locations as $location)

                                                    @if($location->address != $businessLocation)

                                                    <li>

                                                        <input type="radio" id="send_location" name="send_location"
                                                               value="{{$location->address}}">

                                                        <label
                                                            for="{{$location->address}} ">{{$location->address}}</label>

                                                    </li>
                                                    @endif

                                                @endforeach

                                            @endif


                                        </ul>

                                    </div>

                                    <div class="another-addres">

                                        <span class="tag-headi">Where should we send your Loyal IOM Tag and promotion pack?</span>

                                        <div class="search-addres-field3">

                                            <span class="loc-icon3"><img
                                                    src="{{asset('business/assets/images/location.svg')}}"
                                                    alt="location"></span>

                                            <input type="text" autofill="off" required name="search_location2" id="s_lo"
                                                   placeholder=" Search other Address">

                                        </div>

                                    </div>

                                    <ul class="bullets-ul">

                                        <li class="active"></li>

                                        <li id="setup2-show"></li>

                                        @if($data->plan == 2)
                                            <li id="setup2-show"></li>
                                        @endif

                                        <!--<li></li>-->

                                    </ul>

                                    <button type="submit" class="continue-btn" id="setup2-btn">Next

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">

                                            <path fill-rule="evenodd"
                                                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                        </svg>

                                    </button>

                                </div>

                            </form>

                            <div class="complete-setup2" id="setup2_lo">

                                <h1 class="contact-heading">Complete Set Up</h1>

                                <span class="contract-head">Please review the terms of our contract</span>

                                <div class="terms-div">
                                	<?php echo html_entity_decode($account_settings->terms_conditions); ?>
                                  

                                </div>

                                <div class="chec-main">

                                    <input type="checkbox" id="terms" name="fav_language" value="Foxdale">

                                    <label for="terms">I have read and agreed to the Terms and Conditions of the Loyal IOM Business Account</label>

                                </div>


                                <div class="next-icon-main">
                                    <span class="pre" id="backfinal"><img
                                            src="{{asset('business/assets/images/pre.svg')}}" alt="pre-cion"></span>


                                    <ul class="bullets-ul">

                                        <li></li>

                                        <li class="active"></li>

                                        @if(isset($data->plan) && $data->plan == 2)
                                            <li id="setup3-show"></li>
                                        @else
                                            <li style="display:none" id="setup3-show"></li>
                                        @endif

                                    </ul>

                                </div>
                                <!--id="step1-next">SUBMIT APPLICATION-->

                                <button class="continue-btn" id="step3_shift" data-id="{{$data->plan}}">
                                    @if(isset($data->plan) && $data->plan == 2)
                                        Next
                                    @else
                                        SUBMIT APPLICATION
                                    @endif


                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-arrow-right" viewBox="0 0 16 16">

                                        <path fill-rule="evenodd"
                                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                    </svg>

                                </button>

                            </div>

                            <div class="complete-setup3" id="setup3_lo">

                                <h1 class="contact-heading">Summary</h1>


                                <div class="summary-sec1">

                                    <div class="billing-1">

                                        <div class="billing-left">

                                            <h3 id="description">Premium - Monthly Billing</h3>

                                            <p>You won't be billed until 30 days after you activate your Loyal IOM
                                                account. You can cancel your plan at any time.</p>

                                        </div>

                                        <div class="billing-right">

                                            <h4>FREE for 30 Days</h4>

                                            <p><span id="price">£19.99 </span>/ month thereafter</p>

                                        </div>

                                    </div>

                                    <div class="billing2">

                                        <div class="bil2-left">

                                            <h3>Loyal IOM Tags (s)+ Loyal IOM Marketing Pack</h3>

                                            <span id="shipped">Shipped to: isle of Man</span>

                                        </div>

                                        <div class="bil2-right">

                                            <span class="pric-text">£4.99</span>

                                            <span class="fre-ship">Free Shipping</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="total-pay-main">

                                    <span>Total to pay now: </span>

                                    <span id="total">£4.99</span>

                                </div>

                                <div class="pay-card">

                                    <div class="card-outer">

                                        <input type="radio" id="card" name="fav_language" value="Card">

                                        <label for="card">Pay By Card</label>

                                    </div>

                                    <div class="card-number-main">

                                        <img src="{{asset('business/assets/images/card.png')}}" alt="icon">

                                        <div>
                                            <input type="text" autofill="off" autocomplete="chrome-off"
                                                   placeholder="Card number" id="card_number">
                                            <input onkeypress="return isNumberKey(event)" type="text" autofill="off" autocomplete="chrome-off"
                                                   placeholder="MM" id="month" maxlength="2">
                                            <input onkeypress="return isNumberKey(event)" type="text" autofill="off" autocomplete="chrome-off"
                                                   placeholder="YY" id="year" maxlength="4">
                                            <input onkeypress="return isNumberKey(event)" type="text" autofill="off" autocomplete="chrome-off"
                                                   placeholder="CVC" id="cvc" maxlength="4">
                                        </div>
                                    </div>

                                </div>


                                <div class="next-icon-main">
                                    <span class="pre" id="back-step1111"><img src="{{asset('business/assets/images/pre.svg')}}" alt="pre-cion"></span>
                                    <ul class="bullets-ul">

                                        <li></li>

                                        <li></li>

                                        <li class="active"></li>

                                    </ul>
                                </div>

                                <a href="#" class="fin continue-btn" id="step1-next" data-toggle="modal"
                                   data-url  = "{{route('payment')}}"
{{--                                   data-target="#exampleModalCenter"--}}
                                >SUBMIT APPLICATION</a>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

    </div>



    <script>

        // fileupload

        $("input[type='image']").click(function () {

            $("input[id='my_file']").click();

        });

        function isNumberKey(evt) {      //onkeypress="return isNumberKey(event)"
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                return true;
            }
        }

        function isCharacterKey(evt) {      //onkeypress="return isCharacterKey(event)"
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if ((charCode < 65 || charCode > 90) &&
                (charCode < 97 || charCode > 122) && charCode != 32) {
                return false;
            } else {
                return true;
            }
        }


        // business steps

        $(document).ready(function () {

// $("#show-step2, #step1-next").click(function(){

//     $("#busines1").hide();

//     $("#business2").show();

// });


            $("#show-step3, #step2-next").click(function () {

                $("#business2").hide();

                $("#business3").show();

            });


// complete setup steps

// $("#setup2-show, #setup2-btn").click(function(){

//     $("#setup1").hide();

//     $("#setup2").show();

// });


// $("#setup3-show, #setup3-btn").click(function(){

//     $("#setup2").hide();

//     $("#setup3").show();

// });


// card show

            $('input[type="radio"]').click(function () {

                if ($(this).attr('id') == 'card') {

                    $('.card-number-main').show();

                } else {

                    $('.card-number-main').hide();

                }

            });


        });


        $(function () {
            $('#basicExampleho').timepicker({'showDuration': true});
            $('#basicExamplehc').timepicker({'showDuration': true});
            $('#tso').timepicker({'showDuration': true});
            $('#tsc').timepicker({'showDuration': true});
            $('#tmo').timepicker({'showDuration': true});
            $('#tmc').timepicker({'showDuration': true});
            $('#tto').timepicker({'showDuration': true});
            $('#ttc').timepicker({'showDuration': true});
            $('#two').timepicker({'showDuration': true});
            $('#twc').timepicker({'showDuration': true});
            $('#ttho').timepicker({'showDuration': true});
            $('#tthc').timepicker({'showDuration': true});
            $('#tfo').timepicker({'showDuration': true});
            $('#tfc').timepicker({'showDuration': true});
            $('#tsso').timepicker({'showDuration': true});
            $('#tssc').timepicker({'showDuration': true});


            //new

            $('#newBasicExampleho').timepicker({'showDuration': true});
            $('#newBasicExamplehc').timepicker({'showDuration': true});
            $('#newTso').timepicker({'showDuration': true});
            $('#newTsc').timepicker({'showDuration': true});
            $('#newTmo').timepicker({'showDuration': true});
            $('#newTmc').timepicker({'showDuration': true});
            $('#newTto').timepicker({'showDuration': true});
            $('#newTtc').timepicker({'showDuration': true});
            $('#newTwo').timepicker({'showDuration': true});
            $('#newTwc').timepicker({'showDuration': true});
            $('#newTtho').timepicker({'showDuration': true});
            $('#newTthc').timepicker({'showDuration': true});
            $('#newTfo').timepicker({'showDuration': true});
            $('#newTfc').timepicker({'showDuration': true});
            $('#newTsso').timepicker({'showDuration': true});
            $('#newTssc').timepicker({'showDuration': true});

            //2
            $('#basicExampleho2').timepicker({'showDuration': true});
            $('#basicExamplehc2').timepicker({'showDuration': true});
            $('#tso2').timepicker({'showDuration': true});
            $('#tsc2').timepicker({'showDuration': true});
            $('#tmo2').timepicker({'showDuration': true});
            $('#tmc2').timepicker({'showDuration': true});
            $('#tto2').timepicker({'showDuration': true});
            $('#ttc2').timepicker({'showDuration': true});
            $('#two2').timepicker({'showDuration': true});
            $('#twc2').timepicker({'showDuration': true});
            $('#ttho2').timepicker({'showDuration': true});
            $('#tthc2').timepicker({'showDuration': true});
            $('#tfo2').timepicker({'showDuration': true});
            $('#tfc2').timepicker({'showDuration': true});
            $('#tsso2').timepicker({'showDuration': true});
            $('#tssc2').timepicker({'showDuration': true});

            //3
            $('#basicExampleho3').timepicker({'showDuration': true});
            $('#basicExamplehc3').timepicker({'showDuration': true});
            $('#tso3').timepicker({'showDuration': true});
            $('#tsc3').timepicker({'showDuration': true});
            $('#tmo3').timepicker({'showDuration': true});
            $('#tmc3').timepicker({'showDuration': true});
            $('#tto3').timepicker({'showDuration': true});
            $('#ttc3').timepicker({'showDuration': true});
            $('#two3').timepicker({'showDuration': true});
            $('#twc3').timepicker({'showDuration': true});
            $('#ttho3').timepicker({'showDuration': true});
            $('#tthc3').timepicker({'showDuration': true});
            $('#tfo3').timepicker({'showDuration': true});
            $('#tfc3').timepicker({'showDuration': true});
            $('#tsso3').timepicker({'showDuration': true});
            $('#tssc3').timepicker({'showDuration': true});


        });


{{--        $("#step3_shift").click(function () {--}}

{{--            $(".error-msg").remove();--}}

{{--            if ($("#terms").prop("checked") === true) {--}}

{{--                $.get("{{route('selected_plan')}}", function (data, status) {--}}

{{--                    $("#description").text(data['plan']['description']);--}}

{{--                    $("#price").text(data['plan']['price']);--}}

{{--                    $("#shipped").text("Shipped to : " + data['plan']['send_location']);--}}

{{--                    $("#total").text(data['plan']['total']);--}}

{{--                    console.log(data['plan']['id']);--}}

{{--//$("#setup2_lo").css("display","none");--}}

{{--//$("#setup3_lo").css("display","inline-block");--}}


{{--//   $("#setup2_lo").css("display","none");--}}
{{--//         $("#setup3_lo").css("display","inline-block");--}}

{{--// setTimeout(function(){--}}

{{--// window.location.href = "{{route('end')}}";--}}

{{--// }, 50000);--}}


{{--                });--}}


{{--            } else if ($(this).prop("checked") === false) {--}}

{{--                $("body").append("<span class='error-msg'>Please Accept Terms and Conditions</span>");--}}

{{--                setTimeout(--}}
{{--                    function () {--}}
{{--                        $(".error-msg").remove();--}}

{{--                    }, 4000);--}}


{{--            }--}}


{{--        });--}}


{{--        $(".fin").click(function () {--}}

{{--            $.get("{{route('payment')}}", function (data, status) {--}}


{{--// setTimeout(function(){--}}

{{--// window.location.href = "{{route('end')}}";--}}

{{--// }, 100000);--}}

{{--            });--}}


{{--        })--}}


    </script>



    <!-- Thank you popup -->

    <div class="modal fade remove-pad" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered custom-style" role="document">

            <div class="modal-content">


                <div class="modal-body">

                    <img src="{{asset('business/assets/images/check-star.svg')}}" alt="img">

                    <h1>Your application has been submitted!</h1>

                    <p class="rec-text">Once you receive you Loyal IOM tags you can return to this page to activate your
                        account!</p>


                </div>

                <div class="modal-footer popup-footer">

                    <span>If you do not recieve your tags within the next 7 business days please contact:</span>

                    <a href="#">contact@loyal-iom.com</a>

                    <button type="button" class="btn btn-secondary popup-btn" id="dismiss" data-dismiss="modal">OK
                    </button>

                    <!--<button type="button" class="btn btn-primary">Save changes</button> -->

                </div>

            </div>

        </div>

    </div>




 <script src="{{asset('business/assets/js/jquery.blockUI.js')}}"></script>


    <script src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.3.3/jquery.payment.min.js"></script>

    <script>
        $('#card_number').payment('formatCardNumber');
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=init&language=nl&output=json&key={{env('GOOGLE_MAP_KEY')}}"
        ></script>


    <script src="{{asset('business/assets/js/custom.js')}}"></script>

    <script>

        function init() {

            initAutocomplete();

            initAutocomplete1();

            initAutocomplete2();

            initAutocomplete3();
            initAutocomplete4();
            initAutocomplete567();


        }

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });


        $("#dismiss").click(function () {
            window.location.href = "{{route('end')}}";
        });

        $(document).on('click', '#scheme-logo2_2', function () {
            console.log('anc');
                        var logo = $('#my_file1').parents('div.upload-img-main').find('img').attr('src');

            if ($('#scheme-logo2_2').is(':checked')) {
                console.log('def');

                val = $("#scheme-logo2_2").attr("value");
                $("#is_logo_2").remove();
                $("#loyalty_scheme").append("<input type='hidden' name='is_logo_2' id='is_logo_2' value='1'>");
                $("#img-upi_2, #another-logo_2, #or-text_2").css("display", "none");


                img_url = '{{asset('/')}}' + val;
                document.getElementById("s_bk_2").style.backgroundImage = "url(" + logo + ")";
                document.getElementById("s_bk_2").style.backgroundRepeat = "no-repeat";
                document.getElementById("s_bk_2").style.backgroundPosition = "center";
                $('#ui_2').remove();

                style = `<style id="li_2">.upi-main:after{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    content: "";
    display: block;
    border-radius: 0px 0px 10px 10px;
    background: rgba(0,0,0,.3);
    height: 100%;
     -webkit-backdrop-filter: blur(2px);
    backdrop-filter: blur(2px);
}</style>`;

                $("body").append(style);
                $("#ex_2").remove();
                $("body").append("<p hidden id='ex_2'>1</p>");

                $("#rimg_2").css("display", "block");

                //   $("#s_bk").css("top","0");
                //   $("#s_bk").css("left","0");
                //   $("#s_bk").css("width","100%");
                //   $("#s_bk").css("content","");
                //   $("#s_bk").css("display","block");
                //     $("#s_bk").css("height","100%");

                val = $("[name=number_stamps_2]").val();

                logo = parseInt(val);
                url = $("#days_logo_2").data("url");
                gift = $("#days_logo_2").data("gift");
                var t = logo % 2;


                $("#days_logo2_2").empty();
                $("#days_logo_2").empty();
                for (let i = 0; i < logo - 1; i++) {
                    if (i % 2 == 0) {
                        $("#days_logo_2").append('<li class="active"><img   src="' + url + '"/></li>');
                    } else {
                        $("#days_logo2_2").append('<li class="active"><img   src="' + url + '"/></li>');

                    }

                }
                if (t == 1) {
                    $("#days_logo_2").append(`<li class="active"><img  src="${gift}"/></li>`);
                    $("#days_logo2_2").append(`<li class="active" style="opacity: 0"></li>`);
                    $("#days_logo_2").removeAttr("style");
                    $("#days_logo2_2").removeAttr("style");

                } else {
                    $("#days_logo_2").attr("style", "margin-left:-20px !important");
                    $("#days_logo2_2").attr("style", "margin-left:25px !important");
                    $("#days_logo2_2").append(`<li class="active"><img  src="${gift}"/></li>`);
                }


            }
        });


        $('#scheme-logo2').click(function () {
            if ($('#scheme-logo2').is(':checked')) {

                val = $("#scheme-logo2").attr("value");
                $("#is_logo").remove();
                $("#loyalty_scheme").append("<input type='hidden' name='is_logo' id='is_logo' value='1'>");
                $("#img-upi, #another-logo, #or-text").css("display", "none");


                img_url = '{{asset("/")}}' + val;
                document.getElementById("s_bk").style.backgroundImage = "url(" + img_url + ")";
                document.getElementById("s_bk").style.backgroundRepeat = "no-repeat";
                document.getElementById("s_bk").style.backgroundPosition = "center";
                $('#ui').remove();

                style = `<style id="li">.upi-main:after{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    content: "";
    display: block;
    border-radius: 0px 0px 10px 10px;
    background: rgba(0,0,0,.3);
    height: 100%;
     -webkit-backdrop-filter: blur(2px);
    backdrop-filter: blur(2px);
}</style>`;

                $("body").append(style);
                $("#ex").remove();
                $("body").append("<p hidden id='ex'>1</p>");

                $("#rimg").css("display", "block");

                //   $("#s_bk").css("top","0");
                //   $("#s_bk").css("left","0");
                //   $("#s_bk").css("width","100%");
                //   $("#s_bk").css("content","");
                //   $("#s_bk").css("display","block");
                //     $("#s_bk").css("height","100%");

                val = $("[name=number_stamps]").val();

                logo = parseInt(val);
                url = $("#days_logo").data("url");
                gift = $("#days_logo").data("gift");
                var t = logo % 2;


                $("#days_logo2").empty();
                $("#days_logo").empty();
                for (let i = 0; i < logo - 1; i++) {
                    if (i % 2 == 0) {
                        $("#days_logo").append('<li class="active"><img   src="' + url + '"/></li>');
                    } else {
                        $("#days_logo2").append('<li class="active"><img   src="' + url + '"/></li>');

                    }

                }
                if (t == 1) {
                    $("#days_logo").append(`<li class="active"><img  src="${gift}"/></li>`);
                    $("#days_logo2").append(`<li class="active" style="opacity: 0"></li>`);
                    $("#days_logo").removeAttr("style");
                    $("#days_logo2").removeAttr("style");

                } else {
                    $("#days_logo").attr("style", "margin-left:-20px !important");
                    $("#days_logo2").attr("style", "margin-left:25px !important");
                    $("#days_logo2").append(`<li class="active"><img  src="${gift}"/></li>`);
                }


            }
        });


        $(document).on('change', 'input[type="file"]', function (e) {

            // })
            // $('input[type="file"]').on("change", function (e) {

            var fileName = e.target.files[0].name;
// var filesize= Math.round(e.target.files[0].size/ 1024);

            var filesize = Math.round(e.target.files[0].size);
            var ext = fileName.split(".");
            ext = ext[ext.length - 1].toLowerCase();
            var arrayExtensions = ["jpg", "jpeg", "png", "gif"];

            if (arrayExtensions.lastIndexOf(ext) == -1) {
                $("body").append("<span class='error-msg'>Please Upload jpg,jpeg,png,gif</span>");


                return
            }


            if (filesize > 5000000) {

                $("body").append("<span class='error-msg'>Please upload imgae less than 5 MB</span>");
                return
            }


            $(".error-msg").remove();
            var id = e.target.id;
            $("body").append("<span class='success-msg'><img width='30px' src='https://raw.githubusercontent.com/Codelessly/FlutterLoadingGIFs/master/packages/cupertino_activity_indicator.gif'></span>");


            var img = e.target.files[0];

            var reader = new FileReader();

            reader.onloadend = function () {
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('type', id);
                formData.append('img',e.target.files[0]);

                $.ajax({

                    type: 'POST',

                    url: '{{route("business.scheme.imgs")}}',

                     data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,


                    success: (response) => {

                        if (response) {

                            $(".success-msg").remove();

                            if (id == "my_file1") {

                                $("#m1").attr("src", '{{asset('/')}}' + response);
                                $("#m3").attr("src", '{{asset('/')}}' + response);
                                $("#scheme-logo2").attr("value", response);
                                $("#img_logo").attr("src", '{{asset('/')}}' + response);

                            }

                            if (id == "my_file2") {

                                $("#m2").attr("src", '{{asset('/')}}' + response);

                            }


                            if (id == "my_file3") {
                                console.log("image upload");
                                //   $("#m3").attr("src",'{{asset('/')}}'+response);
                                img_url = '{{asset('/')}}' + response;
                                document.getElementById("s_bk").style.backgroundImage = "url(" + img_url + ")";
                                document.getElementById("s_bk").style.backgroundRepeat = "no-repeat";
                                document.getElementById("s_bk").style.backgroundPosition = "center";
                                $('#li').remove();
                                style = `<style id="ui">.upi-main:after{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    content: "";
    display: block;
      border-radius: 0px 0px 10px 10px;
    background: rgba(0,0,0,.3);
    height: 100%;

}</style>`;

                                $("body").append(style);
                                $("#ex").remove();
                                $("body").append("<p hidden id='ex'>1</p>");
                                //   $(".upi_main:after").css("top","0");
                                //   $(".upi_main:after").css("left","0");
                                //   $(".upi_main:after").css("width","100%");
                                //   $(".upi_main:after").css("content","");
                                //   $(".upi_main:after").css("display","block");
                                //     $(".upi_main:after").css("height","100%");


                                val = $("[name=number_stamps]").val();
                                $("#s_days").html("Collect " + val);
                                $("#rimg").css("display", "block");

                                logo = parseInt(val);
                                url = $("#days_logo").data("url");
                                gift = $("#days_logo").data("gift");
                                var t = logo % 2;
                                console.log(t, logo);

                                $("#days_logo").empty();
                                $("#days_logo2").empty();
                                for (let i = 0; i < logo - 1; i++) {
                                    if (i % 2 == 0) {


                                        $("#days_logo").append('<li class="active"><img   src="' + url + '"/></li>');
                                    } else {
                                        $("#days_logo2").append('<li class="active"><img   src="' + url + '"/></li>');

                                    }
                                }

                                if (t == 1) {
                                    $("#days_logo").append(`<li class="active"><img  src="${gift}"/></li>`);
                                    $("#days_logo2").append(`<li class="active" style="opacity: 0"></li>`);

                                    $("#days_logo").removeAttr("style");
                                    $("#days_logo2").removeAttr("style");
                                } else {
                                    $("#days_logo").attr("style", "margin-left:-20px !important");
                                    $("#days_logo2").attr("style", "margin-left:25px !important");
                                    $("#days_logo2").append(`<li class="active"><img  src="${gift}"/></li>`);
                                }


                                // $(".img-upi, .another-logo, .or-text").css("display", "none");
                                $("#img-upi, #another-logo, #or-text").css("display", "none");

                                $("#scheme-logo2").prop("checked", false);
                                $("#is_logo").remove();
                                $("#loyalty_scheme").append("<input type='hidden' name='is_logo' id='is_logo' value='0'>");

                                $("#scheme-logo1").prop("checked", true);
                                console.log("ok");
                                $("#scheme-logo1").attr("value", response);


                            }

                            if (id == "my_file3_2") {

                                //   $("#m3").attr("src",'{{asset('/')}}'+response);
                                img_url = '{{asset('/')}}' + response;
                                document.getElementById("s_bk_2").style.backgroundImage = "url(" + img_url + ")";
                                document.getElementById("s_bk_2").style.backgroundRepeat = "no-repeat";
                                document.getElementById("s_bk_2").style.backgroundPosition = "center";
                                $('#li').remove();
                                style = `<style id="ui">.upi-main:after{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    content: "";
    display: block;
      border-radius: 0px 0px 10px 10px;
    background: rgba(0,0,0,.3);
    height: 100%;

}</style>`;

                                $("body").append(style);
                                $("#ex_2").remove();
                                $("body").append("<p hidden id='ex_2'>1</p>");
                                //   $(".upi_main:after").css("top","0");
                                //   $(".upi_main:after").css("left","0");
                                //   $(".upi_main:after").css("width","100%");
                                //   $(".upi_main:after").css("content","");
                                //   $(".upi_main:after").css("display","block");
                                //     $(".upi_main:after").css("height","100%");


                                val = $("[name=number_stamps_2]").val();
                                $("#s_days_2").html("Collect " + val);
                                $("#rimg_2").css("display", "block");

                                logo = parseInt(val);
                                url = $("#days_logo_2").data("url");
                                gift = $("#days_logo_2").data("gift");
                                var t = logo % 2;
                                console.log(t, logo);

                                $("#days_logo_2").empty();
                                $("#days_logo2_2").empty();
                                for (let i = 0; i < logo - 1; i++) {
                                    if (i % 2 == 0) {


                                        $("#days_logo_2").append('<li class="active"><img   src="' + url + '"/></li>');
                                    } else {
                                        $("#days_logo2_2").append('<li class="active"><img   src="' + url + '"/></li>');

                                    }
                                }

                                if (t == 1) {
                                    $("#days_logo_2").append(`<li class="active"><img  src="${gift}"/></li>`);
                                    $("#days_logo2_2").append(`<li class="active" style="opacity: 0"></li>`);

                                    $("#days_logo_2").removeAttr("style");
                                    $("#days_logo2_2").removeAttr("style");
                                } else {
                                    $("#days_logo_2").attr("style", "margin-left:-20px !important");
                                    $("#days_logo2_2").attr("style", "margin-left:25px !important");
                                    $("#days_logo2_2").append(`<li class="active"><img  src="${gift}"/></li>`);
                                }


                                $("#img-upi_2, #another-logo_2, #or-text_2").css("display", "none");


                                $("#scheme-logo2_2").prop("checked", false);
                                $("#is_logo_2").remove();
                                $("#loyalty_scheme").append("<input type='hidden' name='is_logo' id='is_logo' value='0'>");

                                $("#scheme-logo1_2").prop("checked", true);
                                console.log("ok");
                                $("#scheme-logo1_2").attr("value", response);


                            }


                        }

                    },

                    error: function (response) {

                        console.log(response);
                        $(".success-msg").remove();


                    }

                });


            }

            reader.readAsDataURL(img);


        });


        $('#add_another_image').click(function () {

                        var logo = $('#my_file1').parents('div.upload-img-main').find('img').attr('src');


            var html = `<div class="main-loyalty-div"><div class="loyalty-sec1">
                                    <ul>

                                        <!--<li>-->

                                        <!--    <span>-->

                                        <!--      Name-->

                                        <!--    </span>-->

                                        <input type="hidden" value="random" name="l_name_2" class="form-control" autocomplete="chrome-off" >



                                        <!--</li>-->

                                        <li>

                                            <span>
                                                How many stamp does a customer need to collect to earn a reward? (a complete loyalty card)
                                            </span>

                                            <select required  name="number_stamps_2">

                                                @for($i=2;$i<=10;$i++)

            <option @if($i==7) selected @endif>{{$i}}</option>

                                                @endfor

            </select>

        </li>

    <li>
<span>
What reward does a customer earn when they complete the card.
</span>
<div class="other-reward" id="ot-reward">
<select name="description_2" required>

<option>1 Free Coffee</option>

<option>1 Free Hot Drink </option>

<option>1 Free Sandwich </option>

<option>1 Free Coffee and Snack</option>

<option>1 Free Meal</option>

<option>1 Free Side with Meal </option>

<option>1 Free Lunch </option>

<option>1 Free Smoothie</option>

<option>1 Free Ice cream </option>

<option>1 Free Haircut</option>

<option>1 Free Drink </option>
<option id="sel_other">Other</option>

</select>
<input type="hidden"   id="other_2" autofill="off" placeholder="Enter other reward">
</div>

</li>

</ul>
</div>
<div class="loyalty-scroll">

<div class="loyalty-sec2">

<span class="loy-text">2nd Loyalty Card Preview:</span>

<div class="stamp-main">

<div class="logo-text-main">



<img width="50px" id="m3_2"

@if($cover)src="{{asset($logo)}}"

                                                         @else

            src="`+logo+`"

                                                         @endif





            id="img_logo_2" alt="logo">

       <span> <p id="s_days_2">Collect 7</p> <p id="s_reward_2">stamps to Earn: 1 Free Coffee</p></span>

   </div>

   <div class="upi-main" id="s_bk_2" >



       <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                        data-gift="{{asset('business/assets/images/gift.svg')}}" class="nft-logo" id="days_logo_2">
                                                    <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->
                                                    <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->



                                                    </ul>

                                                    <ul data-url="{{asset('business/assets/images/all.svg')}}"
                                                        data-gift="{{asset('business/assets/images/gift.svg')}}" class="nft-logo nft-logo2" id="days_logo2_2">
                                                    <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->
                                                    <!--<li class="active"><img  src="{{asset('business/assets/images/point.png')}}"/></li>-->



                                                    </ul>




                                                    <div class="img-upi" id="img-upi_2">



                                                        <label for="my_file3_2">

                                                            <img  src="{{asset('business/assets/images/up-img2.svg')}}"/>

                                                        </label>



                                                        <input type="file" onclick="this.value=null;" id="my_file3_2" style="display: none;" />

                                                        <input type="radio"  hidden required name="scheme-logo_2"

                                                               id="scheme-logo1_2">

                                                    </div>

                                                    <span class="or-text" id="or-text_2">or</span>



                                                    <span class="another-logo" id="another-logo_2">

                                                <input type="radio" required name="scheme-logo_2" value="{{$logo}}"

                                                       id="scheme-logo2_2">

                                                <label for="another-logo"> Use Logo Image</label>

                                            </span>

                                                </div>

                                            </div>

                                        </div>
                                        <span id="rimg_2" style="display:none" class="remove-img">Remove Image</span>
                                        <span class="remove-div">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                              <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    </div>
                                </div>`;

            $(this).hide();
            $(this).parents('form#loyalty_scheme').find('div.main-loyalty-div').after(html);
        });


            $(document).on('click', '.remove-div', function () {
                console.log('shpw');
                $(this).parents('div.main-loyalty-div').remove();
                $('#add_another_image').show();

                $("#ex_2").remove();
            });


            $('#back-step1111').click(function(){
                $('#setup3_lo').hide();
                $('#setup2_lo').show();

            });

        @if($data->plan == 2)
            @if(sizeof($loyalty_scheme)  >= 2)
                $('#add_another_image').hide();
            @else
                $('#add_another_image').show();
            @endif
        @else
            $('#add_another_image').hide();
        @endif



        @if(isset($data->facebook_link) || isset($data->instagram_link))
            @if($data->facebook_link == null && $data->instagram_link == null)
                $("[name=facebook_link]").attr("required", true);
                $("[name=instagram_link]").attr("required", true);

            @elseif($data->facebook_link == null && $data->instagram_link != null)
                $("[name=facebook_link]").removeAttr("required");

            @elseif($data->facebook_link != null && $data->instagram_link == null)
                console.log('kkk');
                $("[name=instagram_link]").removeAttr("required");

            @elseif($data->facebook_link != null && $data->instagram_link != null)
                $("[name=instagram_link]").removeAttr("required");
                $("[name=facebook_link]").removeAttr("required");
            @endif

        @endif


            $('#step1-next').click(function () {

                var isChecked = $('#card').is(':checked');

                if (!isChecked) {
                    $("body").append("<span class='error-msg'>Please Select Payment Method</span>");
                    return false;
                }

                var cardNumber = $('#card_number').val();
                if (!cardNumber) {
                    $("body").append("<span class='error-msg'>Please Enter Card Number</span>");
                    return false;
                }

                var month = $('#month').val();
                if (!month) {
                    $("body").append("<span class='error-msg'>Please Enter Card Expiry Month</span>");
                    return false;
                }

                var year = $('#year').val();
                if (!year) {
                    $("body").append("<span class='error-msg'>Please Enter Card Expiry Year</span>");
                    return false;
                }

                var cvc = $('#cvc').val();
                if (!cvc) {
                    $("body").append("<span class='error-msg'>Please Enter Card CVC Number</span>");
                    return false;
                }

                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });
                var url =  $(this).data('url');

                {{--var stripe = Stripe("{{env('STRIPE_KEY')}}");--}}
                var stripe = Stripe.setPublishableKey("{{env('STRIPE_KEY')}}");
//        console.log($('#cvc').val());
                Stripe.card.createToken({
                    number: $('#card_number').val(),
                    cvc: $('#cvc').val(),
                    exp_month: $('#month').val(),
                    exp_year: $('#year').val(),
                }, stripeResponseHandler);

                function stripeResponseHandler(status, response) {


                    if (response.error) {
                        $.unblockUI();

                        if (response.error.message == 'Missing required param: card[exp_month].') {
                            $("body").append("<span class='error-msg'>Expiry Month is required</span>");
                            // errorMsg("Expiry Month is required");
                        }
                        if (response.error.message == 'Missing required param: card[exp_year].') {
                            $("body").append("<span class='error-msg'>Expiry Year is required</span>");
                            // errorMsg("Expiry Year is required");
                        }

                        if (response.error.message == 'Could not find payment information') {
                            $("body").append("<span class='error-msg'>"+response.error.message+"</span>");
                            // errorMsg(response.error.message);
                        }
                        if (response.error.message == 'The card number is not a valid credit card number.') {
                            $("body").append("<span class='error-msg'>"+response.error.message+"</span>");

                        }
                        if (response.error.message == 'Your card\'s security code is invalid.') {
                            $("body").append("<span class='error-msg'>"+response.error.message+"</span>");

                        }

                        if(response.error.code == 'card_declined' || response.error.code == 'invalid_expiry_year' ||
                            response.error.code == 'invalid_expiry_month' )
                        {
                            $("body").append("<span class='error-msg'>"+response.error.message+"</span>");
                            // errorMsg(response.error.message);
                        }



                    }
                    else {

                        var token = response.id;

                        $.ajax({
                            type: 'GET',
                            url: url,
                            data: {'token':token},

                            success: function (response, status) {
                                $.unblockUI();

                                if (response.result == 'success') {
                                    $('#exampleModalCenter').modal('show');

                                } else if (response.result == 'error') {
                                    console.log('abc');
                                    $("body").append("<span class='error-msg'>"+response.message+"</span>");

                                }
                            }


                        });


                    }
                }


            });


    </script>





@stop

