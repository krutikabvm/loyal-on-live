@extends('business.master')

@section('title', 'Steps')

@section('content')

    <div class="steps-main">
        <div class="step-container">
            <a href="#" class="logout-btn"> <img src="{{asset('business/assets/images/log-out1.svg')}}" alt="icon"> Logout</a>
            <div class="flex-main">
                <div class="sidebar-main">
                    <ul class="nav nav-tabs">
                        <li id="step1_li" class="active" ><a data-toggle="tab" href="#step1" class="">
                            <span class="step-num">1</span>
                            <div class="number-right">
                                <span>Step One</span>
                                <h4>Contact Info</h4>
                            </div>
                        </a></li>
                        <li id="step2_li"><a data-toggle="tab" href="#step2" class="">
                            <span class="step-num">2</span>
                            <div class="number-right">
                                <span>Step Two</span>
                                <h4>Choose Plan</h4>
                            </div>
                        </a></li>
                        <li id="step3_li" ><a data-toggle="tab" href="#step3" class="">
                            <span class="step-num">3</span>
                            <div class="number-right">
                                <span>Step Three</span>
                                <h4>Your Business</h4>
                            </div>
                        </a></li>
                        <li id="step4_li"><a data-toggle="tab" href="#step4" class="">
                            <span class="step-num">4</span>
                            <div class="number-right">
                                <span>Step Four</span>
                                <h4>Loyalty Scheme</h4>
                            </div>
                        </a></li>
                        <li id="step5_li"><a data-toggle="tab" href="#step5">
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
                            <div id="step1" class="tab-pane fade in active">
                                <div class="contact-info">
                                    <h1 class="contact-heading">Contact Info</h1>
                                    <form id="step1_form" method="POST" action="{{route('business.contactinfo')}}">
                                        @csrf
                                       <div class="row">
                                           <div class="col-md-6">
                                                <label class="contact-label">Business Name</label>
                                                <input class="contact-field"  name="business_name" required type="text" placeholder="Enter here">
                                           </div>
                                           <div class="col-md-6">
                                                <label class="contact-label">Your Name</label>
                                                <input class="contact-field" name="name" type="text" required placeholder="Enter here">
                                           </div>
                                           <div class="col-md-6">
                                                <label class="contact-label">Business Email Address</label>
                                                <input class="contact-field" name="business_email" required type="email" placeholder="Enter here">
                                           </div>
                                           <div class="col-md-6">
                                                <label class="contact-label">Contact Number</label>
                                                <input class="contact-field" name="business_number"required type="tel" placeholder="Enter here">
                                           </div>
                                           <div class="col-12" style="margin: 0px 15px;">
                                                <label class="contact-label">Business Address</label>
                                                <input id="ship-address" required name="business_address"class="contact-field" type="text" autocomplete="off" placeholder="Enter here">
                                               
                                           </div>
                                           <div class="col-12" style="margin: 0px 15px;">
                                              
                                                <button href="#" id="step1_submit"
                                                type="submit"
                                                class="continue-btn">Save and Continue 
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                    </svg>
                                                </button>
                                             
                                            </div>
                                       </div>
                                          
                                    </form>
                                </div>
                            </div>
                            
                            <div id="step2" class="tab-pane fade">
                                 <!--<form id="step2_form" method="POST" action="{{route('business.plans')}}">-->
                                 <!--    @csrf-->
                                <div class="choose-plan">
                                    <h1 class="contact-heading">Choose Plan </h1>
                                    <div class="billing-main">
                                        <span class="m-billing">Monthly Billing</span>
                                        <div class="switch-main">
                                            <label class="switch">
                                                <input id="checkbox" type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="annual-text">
                                            <span>Annual Billing</span>
                                            <p>Get 2 months free!</p>
                                        </div>
                                    </div>
                                    <div class="pkg-outer">
                                        <div class="pkg-main">
                                            <h3 class="pkg-title">Basic</h3>
                                            <span class="pkg-sub-title">(1 Location)</span>
                                            <ul class="pkg-ul">
                                                <li>
                                                    <span>1 Digital loyalty card</span>
                                                </li>
                                                <li>
                                                    <span>Basic analytics</span>
                                                </li>
                                                <li>
                                                    <span>Loyal IOM branded <br> social media pack</span>
                                                </li>
                                                <li>
                                                    <span>Onboarding Support</span>
                                                </li>
                                                <li>
                                                    <span>Unlimited users</span>
                                                </li>
                                                <li></li>
                                                <li></li>
                                            </ul>
                                            <span class="pkg-price-basic">£19.99 per month</span>
                                            <a href="#" class="pkg-btn basic" id="3">Get 30 days Free <br> Cancel anytime</a>
                                        </div>
                                        <div class="pkg-main">
                                            <h3 class="pkg-title">Premium</h3>
                                            <span class="pkg-sub-title">(Up to 3 Locations)</span>
                                            <ul class="pkg-ul">
                                                <li>
                                                    <span>Everything in Basic +</span>
                                                </li>
                                                <li>
                                                    <span>Up to 2 extra digital loyalty cards</span>
                                                </li>
                                                <li>
                                                    <span>Extended Analytics</span>
                                                </li>
                                                <li>
                                                    <span>Custom branded social  media pack</span>
                                                </li>
                                                <li>
                                                    <span>*Coming Soon*</span>
                                                    <p> Send push notifications to your customers</p>
                                                    <p>Digital voucher market place</p>
                                                </li>
                                            </ul>
                                            <span class="pkg-price-premium">
                                                £24.99 per month
                                                </span>
                                            <a href="#" class="pkg-btn premium" id="4">Get 30 days Free <br> Cancel anytime</a>
                                        </div>
                                    </div>
                                    <a class="continue-btn step2_button">Save and Continue 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>
                                </div>
                                
                                <!--</form>-->
                            </div>
                            
                            <div id="step3" class="tab-pane fade">
                                <form>
                                <div class="ur-busines-main" id="busines1">
                                    <h1 class="contact-heading">Your Business</h1>
                                    <div class="upload-img-main">
                                        <div class="logo-left">
                                            <span>Your Logo</span>
                                            <input type="image" src="{{asset('business/assets/images/up-img.svg')}}"/>
                                            <input type="file" id="my_file" style="display: none;" />
                                        
                                        </div>
                                        <div class="cover-right">
                                            <span>Your Cover Photo</span>
                                            <input type="image" src="{{asset('business/assets/images/cover.svg')}}"/>
                                            <input type="file" id="my_file" style="display: none;" />
                                        </div>
                                    </div>
                                    <label class="customer-text"><strong>Bio</strong> (Visible to your customers)</label>
                                    <textarea class="customer-rev" placeholder="Enter business description..."></textarea>
                                    <label class="customer-text"><strong>Social Links</strong> (Please add at least one)</label>
                                    <ul class="busines-ul">
                                        <li>
                                            <a href="#">
                                                <img src="{{asset('business/assets/images/fb.svg')}}" alt="logo"> <span>Facebook Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{asset('business/assets/images/insta.svg')}}" alt="logo"> <span>Instagram Account</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <input type="hidden" id="pkg_id" name="plan" value="4" required>
                                    <ul class="bullets-ul">
                                        <li class="active"></li>
                                        <li id="show-step2"></li>
                                    </ul>
                                    <a href="#" class="continue-btn" id="step1-next">Next 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <!-- business step 2 -->
                                <div class="business-step2" id="business2">
                                    <h1 class="contact-heading">Your Business</h1>
                                    <span class="loc-sub-heading">Location  (where will stamps be collected by customers?):</span>
                                    <span class="busines-check">
                                        <input type="checkbox" id="" name="vehicle1" value="Bike">
                                        <label for="vehicle1">Same as registered business address</label>
                                    </span>
                                    <div class="search-addres-field">
                                        <span class="loc-icon"><img src="{{asset('business/assets/images/location.svg')}}" alt="location"></span>
                                        <input type="text" placeholder=" Search other Address">
                                    </div>
                                    <h2 class="opening-text">Opening Hours</h2>
                                    <div class="opening-table1">

                                        <table class="table table-striped">
                                            <thead style="background: #F7FAFF;">
                                                <tr>
                                                  <th scope="col">
                                                    Autofill
                                                  </th>
                                                  <th scope="col">
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                  </th>
                                                  <th scope="col">
                                                    <input type="time" value="2020-12-31">
                                                  </th>
                                                  <th scope="col">
                                                    To
                                                  </th>
                                                  <th scope="col">
                                                    <input type="time">
                                                </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <tr>
                                                <th scope="row">
                                                    Sunday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Monday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Tuesday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Wednesday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Thursday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Friday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                              <tr>
                                                <th scope="row">
                                                    Saturday
                                                </th>
                                                <td>
                                                    <div class="custom-radio open">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Open</span>
                                                        </label>
                                                     </div>
                                                     
                                                     <div class="custom-radio closed">
                                                        <label>
                                                           <input type="checkbox" value="1"><span>Closed</span>
                                                        </label>
                                                     </div>
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                                <td>
                                                    To
                                                </td>
                                                <td>
                                                    <input type="time">
                                                </td>
                                              </tr>
                                            </tbody>
                                        </table>
                                       
                                    </div>
                                    <ul class="bullets-ul">
                                        <li></li>
                                        <li class="active"></li>
                                        <li id="show-step3"></li>
                                    </ul>
                                    <a href="#" id="step2-next" class="continue-btn">Next 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>


                                </div>
                                <!-- business step 3 -->
                                <div class="business-step3" id="business3">
                                    <h1 class="contact-heading">Your Business</h1>
                                    <div class="loc-site-box">
                                        <div class="loc-site-text-drop">
                                            <span>Locations / Sites</span>
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>
                                        <span class="busines-check2">
                                            <input type="checkbox" id="" name="vehicle1" value="Bike">
                                            <label for="vehicle1">Same as registered business address</label>
                                        </span>
                                        <div class="search-addres-field2">
                                            <span class="loc-icon2"><img src="{{asset('business/assets/images/location.svg')}}" alt="location"></span>
                                            <input type="text" placeholder="Input other Address">
                                        </div>
                                    </div>

                                    <div class="opening-loc-main1">
                                        <h2 class="opening-text">Location 1 - Opening Hours</h2>
                                        <div class="loc1-table">
                                            <table class="table table-striped">
                                                <thead style="background: #F7FAFF;">
                                                    <tr>
                                                    <th scope="col">
                                                        Autofill
                                                    </th>
                                                    <th scope="col">
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="time" value="2020-12-31">
                                                    </th>
                                                    <th scope="col">
                                                        To
                                                    </th>
                                                    <th scope="col">
                                                        <input type="time">
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <th scope="row">
                                                        Sunday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Monday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Tuesday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Wednesday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Thursday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Friday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Saturday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                           
                                        </div>
                                    </div>

                                    <div class="opening-loc-main2">
                                        <div class="location2-box">
                                            <label><strong>Location 2</strong> (Where will stamps be collected by cusotmers?):</label>
                                            <div class="search-addres-field2">
                                                <span class="loc-icon2"><img src="{{asset('business/assets/images/location.svg')}}" alt="location"></span>
                                                <input type="text" placeholder="Input other Address">
                                            </div>
                                        </div>
                                        <h2 class="opening-text">Location 2 - Opening Hours</h2>
                                        <div class="loc1-table">
                                            <table class="table table-striped">
                                                <thead style="background: #F7FAFF;">
                                                    <tr>
                                                    <th scope="col">
                                                        Autofill
                                                    </th>
                                                    <th scope="col">
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">
                                                        <input type="time" value="2020-12-31">
                                                    </th>
                                                    <th scope="col">
                                                        To
                                                    </th>
                                                    <th scope="col">
                                                        <input type="time">
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <th scope="row">
                                                        Sunday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Monday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Tuesday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Wednesday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Thursday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Friday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Saturday
                                                    </th>
                                                    <td>
                                                        <div class="custom-radio open">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Open</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="custom-radio closed">
                                                            <label>
                                                            <input type="checkbox" value="1"><span>Closed</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                    <td>
                                                        To
                                                    </td>
                                                    <td>
                                                        <input type="time">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <ul class="bullets-ul">
                                        <li></li>
                                        <li></li>
                                        <li class="active"></li>
                                    </ul>
                                    <a href="#" class="continue-btn">Next 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>

                                </div>
                                </form>

                            </div>
                            <div id="step4" class="tab-pane fade">
                               <div class="loyalty-scheme-main">
                                <h1 class="contact-heading">Loyalty Scheme</h1>
                                    <ul class="loyalty-sec1">
                                        <li>
                                            <span>
                                                How many stamp does a customer need to collect to earn a reward? (a complete loyalty card)
                                            </span>
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </li>
                                        <li>
                                            <span>
                                                What reward does a customer earn when they complete the card.
                                            </span>
                                            <select>
                                                <option>1 Free Coffee</option>
                                                <option>1 Free Cup</option>
                                            </select>
                                        </li>
                                    </ul>
                                    <div class="loyalty-sec2">
                                        <span class="loy-text">Loyalty Card Preview:</span>
                                        <div class="stamp-main">
                                            <div class="logo-text-main">
                                                <img src="{{asset('business/assets/images/stamp.svg')}}" alt="logo">
                                                <span>Collect X stamps to Earn: Y</span>
                                            </div>
                                            <div class="upi-main">
                                                <div class="img-upi">
                                                    <input type="image" src="{{asset('business/assets/images/up-img2.svg')}}"/>
                                                    <input type="file" id="my_file" style="display: none;" />
                                                </div>    
                                                <span class="or-text">or</span>

                                                <span class="another-logo">
                                                    <input type="radio" id="another-logo">
                                                    <label for="another-logo"> Use Logo Image</label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-another-logo">
                                        <a href=""> <img src="{{asset('business/assets/images/plus.svg')}}" alt="icon"> Add Another Card</a>
                                    </div>
                                    <a href="#" class="continue-btn">Save and Continue 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>
                               </div>
                            </div>
                            <div id="step5" class="tab-pane fade">
                               <div class="complete-setup-main">
                                <form>
                                   <div class="complete-setup1" id="setup1">
                                       <h1 class="contact-heading">Complete Set Up</h1>
                                        <div class="loyal-tag">
                                            <span class="tag-headi">Where should we send your Loyal IOM tag (s)?</span>
                                            <ul class="input-rad-main">
                                                <li>
                                                    <input type="radio" id="man" name="fav_language" value="Man">
                                                    <label for="man">Isle of Man</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="foxdale" name="fav_language" value="Foxdale">
                                                    <label for="foxdale">Foxdale, Isle of Man</label>
                                                </li>
                                            </ul> 
                                        </div>
                                        <div class="another-addres">
                                            <span class="tag-headi">Where should we send your Loyal IOM tag (s)?</span>
                                            <div class="search-addres-field3">
                                                <span class="loc-icon3"><img src="{{asset('business/assets/images/location.svg')}}" alt="location"></span>
                                                <input type="text" placeholder=" Search other Address">
                                            </div>
                                        </div>
                                        <ul class="bullets-ul">
                                            <li class="active"></li>
                                            <li id="setup2-show"></li>
                                            <li></li>
                                        </ul>
                                        <a href="#" class="continue-btn" id="setup2-btn">Next 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                            </svg>
                                        </a>
                                   </div>
                                   <div class="complete-setup2" id="setup2">
                                    <h1 class="contact-heading">Complete Set Up</h1>
                                    <span class="contract-head">Please review the terms of our contract</span>
                                    <div class="terms-div">
                                        <p>* Interpretation</p>
                                        <p>* In these Conditions:</p>
                                        <p> “App” means the mobile application made available to Users to implement the Retailer's digital loyalty card.
                                            “Commencement Date” means the date from which the Services shall be provided and as set out on the Order Form.
                                            “Conditions” means Squid Rewards’ terms and conditions as
                                            set out in this document and that apply to the Retailer.</p>
                                        <p>“Free Trial Period” shall be as set out on the Order Form.</p>
                                        <p> “Initial Subscription Period” shall be as set out on the Order Form.</p>
                                    </div>
                                    <div class="chec-main">
                                        <input type="checkbox" id="terms" name="fav_language" value="Foxdale">
                                        <label for="terms">I have read and agree to the Terms and Conditions of the Loyal IOM Free Trial and Subscription Plan</label>
                                    </div>
                                    <ul class="bullets-ul">
                                        <li></li>
                                        <li  class="active"></li>
                                        <li id="setup3-show"></li>
                                    </ul>
                                    <a href="#" class="continue-btn" id="setup3-btn">Next 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg>
                                    </a>
                                   </div>
                                   <div class="complete-setup3" id="setup3">
                                        <h1 class="contact-heading">Summary</h1>

                                        <div class="summary-sec1">
                                            <div class="billing-1">
                                                <div class="billing-left">
                                                    <h3>Basic - Monthly Billing</h3>
                                                    <p>You won't be billed until 30 days after you activate your Loyal IOM account. You can cancel your plan at any time.</p>
                                                </div>
                                                <div class="billing-right">
                                                    <h4>FREE for 30 Days</h4>
                                                    <p>£19.99/ month thereafter</p>
                                                </div>
                                            </div>
                                            <div class="billing2">
                                                <div class="bil2-left">
                                                    <h3>Loyal IOM Tags (s)+ Loyal IOM Marketing Pack</h3>
                                                    <span>Shipped to: isle of Man</span>
                                                </div>
                                                <div class="bil2-right">
                                                    <span class="pric-text">£4.99</span>
                                                    <span class="fre-ship">Free Shipping</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="total-pay-main">
                                            <span>Total to pay now: </span>
                                            <span>£4.99</span>
                                        </div>
                                        <div class="pay-card">
                                            <div class="card-outer">
                                                <input type="radio" id="card" name="fav_language" value="Card">
                                                <label for="card">Pay By Card</label>
                                            </div>
                                            <div class="card-number-main">
                                                <img src="{{asset('business/assets/images/card.png')}}" alt="icon">
                                                <input type="text" placeholder="Card number">
                                            </div>
                                        </div>

                                        <ul class="bullets-ul">
                                            <li></li>
                                            <li></li>
                                            <li class="active"></li>
                                        </ul>
                                        <a href="#" class="continue-btn" id="step1-next" data-toggle="modal" data-target="#exampleModalCenter">SUBMIT APPLICATION</a>
                                   </div>
                                </form>
                               </div>
                            </div>
                        </div>
                </div>
            </div>
            
                
        </div>
    </div>

<script>
    // fileupload
    $("input[type='image']").click(function() {
    $("input[id='my_file']").click();
    });

    // business steps
    $( document ).ready(function() {
        $("#show-step2, #step1-next").click(function(){
            $("#busines1").hide();
            $("#business2").show();
        });

        $("#show-step3, #step2-next").click(function(){
            $("#business2").hide();
            $("#business3").show();
        });

        // complete setup steps
        $("#setup2-show, #setup2-btn").click(function(){
            $("#setup1").hide();
            $("#setup2").show();
        });

        $("#setup3-show, #setup3-btn").click(function(){
            $("#setup2").hide();
            $("#setup3").show();
        });





        // card show
        $('input[type="radio"]').click(function() {
        if ($(this).attr('id') == 'card') {
            $('.card-number-main').show();
        } else {
            $('.card-number-main').hide();
        }
        });
        

    });

</script>

<!-- Thank you popup -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-style" role="document">
      <div class="modal-content">
       
        <div class="modal-body">
            <img src="{{asset('business/assets/images/check-star.svg')}}" alt="img">
            <h1>Your application has been submitted!</h1>
            <p class="rec-text">Once you receive you Loyal IOM tags you can return to this page to activate your account!</p>
            <span class="trial-text">(30 days free trial will start <br> account activation)</span>

        </div>
        <div class="modal-footer popup-footer">
            <span>If you do not recieve your tags within the next 7 business days please contact:</span>
            <a href="#">support@loyal-iom.com</a>
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>


<script src="{{asset('business/assets/js/custom.js')}}"></script>
@stop
