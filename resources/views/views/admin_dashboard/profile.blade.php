@extends('business_dashboard.master_layout')
@section('title', 'Profile')
@section('content')
<div class="profile-main">
    @if(session('success'))
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-success">
                            <h4>{{session('success')}}</h4>
                    </div>
                
            </div>  
        </div>  
    @endif
    @if(session('error'))
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-danger">
                            <h4>{{session('error')}}</h4>
                    </div>
                
            </div>  
        </div>  
    @endif
    <div class="row">
        <div class="col-md-7">
            <div class="profile-pic">
                <div class="cover-photo" style="min-height: 150px;">
                    <form class="images-form" action="{{ route('upload-images') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="business_id" value="{{ $business->id }}">
                        <input accept="image/*" type='file' id="coverInput" name="coverInput" @if($business) @if($business->cover_img)
                        src="{{env('APP_URL').$business->cover_img}}"
                        @else
                        src="{{asset('business_dashboard')}}/assets/images/cover.svg"
                        @endif

                        @else

                        src="{{asset('business_dashboard')}}/assets/images/cover.svg"

                        @endif

                        alt="cover-img" style="    opacity: 0; padding: 1px; font-size: 2.6rem; width: 52px; height: 40px; position: absolute; top: 0px; right: 0px; cursor: pointer; display: block; border-radius: 13px 0px 0px; z-index: 1;">
                        <img id="coverImagePreview" @if($business) @if($business->cover_img)
                        src="{{url($business->cover_img)}}"
                        @else
                        src="{{asset('business_dashboard')}}/assets/images/cover.svg"
                        @endif

                        @else

                        src="{{asset('business_dashboard')}}/assets/images/cover.svg"

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
                    <form class="images-form" action="{{ route('upload-images') }}" method="post" enctype="multipart/form-data">
                    <input accept="image/*" type='file' id="profilePicInput" name="profilePicInput" @if($business) @if($business->cover_img)
                    src="{{env('APP_URL').$business->image}}"
                    @else
                    src="{{asset('business_dashboard')}}/assets/images/profile-pic.svg"
                    @endif

                    @else

                    src="{{asset('business_dashboard')}}/assets/images/profile-pic.svg"

                    @endif





                    alt="cover-img" style="opacity: 0; padding: 4px !important; position: absolute; right: 0; bottom: 0; padding: 0px; font-size: 15px; width: 29px; height: 28px; cursor: pointer; z-index: 1; float: right; border-radius: 0;">
                    <img id="profileImagePreview"  @if($business) @if($business->cover_img)
                    src="{{url($business->image)}}"
                    @else
                    src="{{asset('business_dashboard')}}/assets/images/profile-pic.svg"
                    @endif

                    @else

                    src="{{asset('business_dashboard')}}/assets/images/profile-pic.svg"

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
            </div>
            <div class="profile-bio-sec ">
                <form id="bio_form" class="general_form">
                    <span class="edit-bio bio_e true"><img src="{{asset('business_dashboard')}}/assets/images/cover-edit.svg" alt="icon"></span>
                    <button type="submit" class="btn btn-success bio_u" style="
                                      padding: 1px; font-size: 2.6rem; width: 51px; height: 40px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;
                                      border-radius: 0px;border-top-left-radius: 13px;">
                        ✔
                    </button>
                    <h2 id="">Bio</h2>
                    @if($business)

                    <p class="bio_te">{{$business->description}}</p>
                    @endif
                    <div id="bio_form_container" style="display:none" >
                        <input type="hidden" name="id" value="{{$business->id}}">
                        <input type="hidden" name="field" value="description">
                        <input type="hidden" name="table" value="business">
                        <input type="text" required placeholder="Description" value="{{@$business->description}}" name="description" class="custom-input" autocomplete="off" autofill= "off">
                        <!-- <button type="submit" class="btn btn-primary" style="display:none" disabled>Update</button> -->
                    </div>
                </form>
            </div>
            <div class="loyality-card">
                <span class="loyality-text">Your Loyalty Cards
                    @if($business->plan == 2)
                        @if(count($loyalties) < 2)
                            <a href="#" class="float-right" data-toggle="modal" data-target="#exampleModalCenter">Add Scheme</a>
                        @endif
                    @endif
                </span>
            </div>
            @foreach(@$loyalties as $key=>$loyalty)
                <div class="loyality-main">
                   

                        <div class="stamp-collect">
                            <div class="stamp-collect-text-main">
                                <span class="stamp-tex">Set Stamp Collection Limit:</span>
                                <div class="stamp-dropright">
                                    <select name="stamps_per_day" data-id="{{@$loyalty['id']}}" class="stamps_per_day" id="stamps_per_day{{$key}}" data-stamp-id="{{$key}}">
                                        @for($i=1;$i<11;$i++) <option @if(@$loyalty['stamps_per_day']==$i) selected @endif value="{{$i}}">{{$i}} Stamp per day</option>
                                            @endfor
                                        <option value="5000" @if(@$loyalty['stamps_per_day']==5000) selected @endif >Unlimited</option>
                                    </select>
                                    <span class="questions"><img src="{{asset('business_dashboard')}}/assets/images/questions.svg" alt="img" onclick="alert('Set how many stamps can be collected for a card in a 24 hour period')"></span>
                                </div>
                            </div>
                            <div class="stamp-select-img-main">
                                <div class="stamp-pad">
                                    <form class="images-form1" data-id="{{$key}}" action="{{ route('upload-images') }}" method="post" enctype="multipart/form-data">
                                        <div class="logo-text-main">
                                            <!-- <img src="{{asset('business_dashboard')}}/assets/images/cafe.png" alt="logo"> -->
                                           
                                            <img src="{{url($business->image)}}" alt="logo" id="bussiness_logo{{$key}}">
                                            
                                            <span id="stamps_text{{$key}}">@if(@$loyalty['stamps_per_day'] == 5000 ) Unlimited @else {{$loyalty['stamps_per_day']}} @endif </span> <span>&nbsp;Stamp per day to Earn: </span><span id="stamp_description_text">{{$loyalty['description']}}</span>
                                            
                                            <div class="edit-icon4">
                                                <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="noimg" style="border-top-right-radius: 8px;margin-right:0px;" onclick="alert('Please e-mail contact@loyal-iom.com to change your loyalty scheme')">
                                            </div>
                                            <input accept="image/*" type='file' id="cardInput{{$key}}" data-id="{{$key}}" class="cardInput" name="cardInput"  style="opacity: 0; padding: 1px; font-size: 2.6rem; width: 31px; height: 29px; position: absolute; top: 60px; right: 0px; cursor: pointer; display: block; border-radius: 13px 0px 0px; z-index: 9999;">
                                            
                                           <!--  <div class="edit-icon3" id="edit-icon3{{$key}}" style="@if(empty($loyalty['img']) ) display: none; @endif">
                                                <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="noimg" style="border-top-right-radius: 8px;">
                                            </div> -->
	                                            <button type="submit" class="btn btn-success loyalty-card-image-update" id="loyalty-card-image-update{{$key}}" style="
	                                                padding: 1px; font-size: 1.6rem; width: 30px; height: 29px; position: absolute; top: 60px; right: 0; cursor: pointer; display: none; border-radius: 4px; border-top-right-radius: 8px;z-index: 9999">
	                                                ✔
	                                            </button>
	                                       
                                            <input type="hidden" name="loyality_id" value="{{@$loyalty['id']}}">
                                           
                                        </div>

                                        <div class="upi-main2" id="cardImagePreview{{$key}}" style="@if(empty($loyalty['img']) ) display: none; @endif background-image:url('@if(!empty($loyalty['img']) ) {{ url(@$loyalty['img']) }}  @endif') ">
                                    
                                            <ul class="nft-logo3" id="days_logo2{{$key}}" >
                                                @for($stamps = 0; $stamps< @$loyalty['number_stamps']; $stamps++ )
                                                    @if($stamps + 1 == @$loyalty['number_stamps'])
                                                        <li class="active"><img src="{{ asset("business/assets/images/gift.svg") }}"></li>
                                                    @else
                                                        <li class="active"><img src="{{ asset("business/assets/images/all.svg") }}"></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                        </div>
	                                    @if(empty($loyalty['img']) )
	                                        <div class="upi-main2 upi-main3" id="newSchemeImgPreview{{$key}}" >
	                    
	                                            <ul class="nft-logo3" id="days_logo2_new">
	                                            
	                                            </ul>
	                                            
	                                            <div class="img-upi" id="img-upi">
	        
	                                                <label for="my_file3">
	                                                <img class="my_file3_upload" data-id="{{$key}}" id="my_file3_upload{{$key}}" src="{{ asset('business/assets/images/up-img2.svg') }}">
	                                                </label>
	                                                <span class="or-text" style="display: block;">or</span>
	                                                <span class="another-logo" style="display: block;">
	    
	                                                <input type="radio"  name="scheme-logo" value="{{$business->image}}" class="scheme-logo" data-id="{{$key}}" data-loyality_id="{{@$loyalty['id']}}">
	                                                <label for="another-logo"> Use Logo Image</label>
	        
	                                            </span>
	                                                
	                                            </div> 
	                                        </div>
                                        @endif
                                    </form>
                                </div>
                                <!-- <div class="del-icon" id="del-icon{{$loyalty['id']}}" data-loyality="{{$loyalty['id']}}">
                                    <svg xmlns="http://www.w3.org/2000/svg"  onclick="deleLoyality({{@$loyalty['id']}})" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div> -->
                            </div>
                        </div>
                    
                    	<a href="{{route('remove_image',encrypt($loyalty['id']) )}}" class="remove-scheme" id="remove-scheme{{$key}}" style="@if(empty($loyalty['img']))  display: none; @endif"> Remove Image</a>
                	
                </div>
                @if($business->plan == 1)
                    @break
                @endif
            @endforeach

        </div>
        <div class="col-md-5">
            <ul class="social-ul">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                    <form id="fb_form" class="general_form">
                        <div id="fb_form_container" style="display:none;">
                            <input type="hidden" name="id" value="{{$business->id}}">
                            <input type="hidden" name="field" value="facebook_link">
                            <input type="hidden" name="table" value="business">
                            <input type="text" required placeholder="Facebook Link" value="{{$business->facebook_link}}" name="facebook_link" class="custom-input" style="float: left;">
                            <!-- <button type="submit" class="btn btn-primary" style="display:none" disabled>Update</button> -->
                            <button type="submit" class="btn btn-success fb_submit" style="
                                      padding: 0px; font-size: 15px; width: 25px; height: 25px; cursor: pointer; display:none;float:right" id="location_update">
                                ✔
                            </button>
                        </div>

                    </form>

                    <input id="fb_te" type="text" readonly @if($business) placeholder="{{$business->facebook_link}}" @else placeholder="Facebook link" @endif>
                    <span class="edit-input fb_e true"> <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="edit"> </span>

                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                    <form id="insta_form">
                        <div id="insta_form_container" style="display:none;">

                            <input type="hidden" name="id" value="{{$business->id}}">
                            <input type="hidden" name="field" value="instagram_link">
                            <input type="hidden" name="table" value="business">
                            <input type="text" required placeholder="Instagram Link" value="{{$business->instagram_link}}" name="instagram_link" class="custom-input" style="float: left;">
                            <!-- <button type="submit" class="btn btn-primary" style="display:none" disabled>Update</button> -->
                            <button type="submit" class="btn btn-success insta_submit" style="
                                      padding: 0px; font-size: 15px; width: 25px; height: 25px; cursor: pointer; display:none;float:right" id="location_update">
                                ✔
                            </button>
                        </div>

                    </form>

                    <input id="insta_te" type="text" readonly @if($business) placeholder="{{$business->instagram_link}}">

                    @else
                    placeholder="Instagram link"
                    @endif

                    <span class="edit-input insta_e true"> <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="edit"> </span>
                </li>
            </ul>   
        </div>
    </div>
</div>
<!-- popup -->
    <!-- popup -->
    <div class="modal fade remove-pad" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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
                           <form action="{{ route('addNewScheme') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="stamp-collect-text-main">
                                    <span class="stamp-tex">How many stamp does a customer need to collect to earn a reward? (a complete loyality card)</span>
                                    <div class="stamp-dropright">
                                        <select name="number_stamps" class="stamps_per_day" id="stamps_per_day_new">
                                            @for($i=1;$i<11;$i++) <option value="{{$i}}" @if($i == 7) selected @endif >{{$i}} </option>
                                            @endfor
                                        </select>
                                        <span class="questions"><img src="{{asset('business_dashboard')}}/assets/images/questions.svg" alt="img" onclick="alert('Set how many stamps can be collected for a card in a 24 hour period')"></span>
                                    </div>
                                </div>
                                <div class="stamp-collect-text-main">
                                    <span class="stamp-tex">What reward does a customer earn when they complete the card </span>
                                    <div class="stamp-dropright">
                                        <select name="description" required  id="stamp_description_add_new">

                                            <option value="1 Free Coffee" >1 Free Coffee</option>

                                             <option value="1 Free Hot Drink">1 Free Hot Drink </option>
                                            
                                             <option value="1 Free Sandwich"  >1 Free Sandwich </option>
                                            
                                             <option value="1 Free Coffee and Snack" >1 Free Coffee and Snack</option>
                                            
                                             <option value="1 Free Meal" >1 Free Meal</option>
                                            
                                             <option value="1 Free Side with Meal" >1 Free Side with Meal </option>
                                            
                                             <option value="1 Free Lunch"  >1 Free Lunch </option>
                                            
                                             <option value="1 Free Smoothie">1 Free Smoothie</option>
                                            
                                             <option value="1 Free Ice cream"  >1 Free Ice cream </option>
                                            
                                             <option value="1 Free Haircut" >1 Free Haircut</option>
                                            
                                             <option value="1 Free Drink" >1 Free Drink </option>
                                             <!-- <option id="sel_other">Other</option> -->

                                        </select>
                                        <span class="questions"><img src="{{asset('business_dashboard')}}/assets/images/questions.svg" alt="img"></span>
                                    </div>
                                </div>
                                
                                <div class="stamp-select-img-main">
                                    <div class="stamp-pad">
                                        <div class="logo-text-main">
                                            <img id="newSchemebussiness_logo" src="{{url($business->image)}}" alt="logo">
                                            <span>Collect  &nbsp;</span><span id="stamp-collection">7&nbsp;</span> <span>stamp to Earn: </span><span id="stamp-description">1 Free Coffee</span>

                                            <!-- <div id="edit-icon-new" class="edit-icon3" style="display: none">
                                                <img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="noimg">
                                            </div> -->
                                            <input accept="image/*" type='file' id="newSchemeImg" name="newSchemeImg"  style="opacity: 0; padding: 1px; font-size: 2.6rem; width: 31px; height: 29px; position: absolute; top: 60px; right: 0px; cursor: pointer; display: block; border-radius: 13px 0px 0px; z-index: 9999;">
                                        </div>
                                        <div class="upi-main2" id="newSchemeImgPreview" >
                    
                                            <ul class="nft-logo3" id="days_logo2_new">
                                            
                                            </ul>
                                            
                                            <div class="img-upi" id="img-upi">
        
                                                <label for="my_file3">
                                                <img id="my_file3_upload" src="{{ asset('business/assets/images/up-img2.svg') }}">
                                                </label>
                                                <span class="or-text" style="display: block;">or</span>
                                                <span class="another-logo" style="display: block;">
    
                                                <input type="radio"  name="scheme-logo" value="{{$business->image}}" id="scheme-logo2">
                                                <label for="another-logo"> Use Logo Image</label>
        
                                            </span>
                                                
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="remove-scheme" id="remove-scheme-img-new" style="display:none;"> Remove Image</button>
                                <div class="modal-footer popup-footer">  
                                    <button type="submit" class="btn btn-success btn-primary">Create new loyalty card</button>
                                </div>
                            </form>
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
    $("input[type='image']").click(function() {
    $("input[id='my_file2']").click();
    });
    $("#my_file3_upload").click(function() {
        $("#newSchemeImg").click();
    });
    $(".cardInput").on("change",function(){
        previewImage($(this).data('id'));
    });
    $(".my_file3_upload").on("click",function(){
        let id = $(this).data('id');
        $("#cardInput"+id).click();
    });
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    // $('.edit-profile').on('click', function (){
    //     alert('yasdeah');
    // });

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
    function previewImage(id){
        var file = $("#cardInput"+id).get(0).files[0];
        if (file) {
            $('#edit-icon3'+id).hide();
            $('#cardInput'+id).hide();
            $('#loyalty-card-image-update'+id).css('display', 'block');

            var reader = new FileReader();

            reader.onload = function (e) {
                $("#newSchemeImgPreview"+id).css("display","none");
        		$("#cardImagePreview"+id).css("display","block");
        		$('#cardImagePreview'+id).css('background', 'url('+e.target.result +')');
                $('#bussiness_logo'+id).attr('src', e.target.result );
            }

            reader.readAsDataURL(file);
            


            // cardImagePreview.src = URL.createObjectURL(file)
            // $("#cardImagePreview").css("background-image", "url(" + file + ")");
        }
    }

    newSchemeImg.onchange = evt => {
        const [file] = newSchemeImg.files
        if (file) {
           
            if (newSchemeImg.files && newSchemeImg.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#newSchemeImgPreview').css('background', 'url('+e.target.result +')');
                    $('#newSchemebussiness_logo').attr('src', e.target.result );
                }

                reader.readAsDataURL(newSchemeImg.files[0]);
            }
            $("#img-upi").css("display","none");
            $("#edit-icon-new").css("display","block");
            $("#remove-scheme-img-new").css("display","block");
            $("#days_logo2_new").css("display","flex");
            // cardImagePreview.src = URL.createObjectURL(file)
            // $("#cardImagePreview").css("background-image", "url(" + file + ")");
        }
    }
    $(document).ready(function (e) {
  

    $('.images-form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            type:'POST',
            url: "{{route('upload-images')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        $('.edit-profile2').show();
        $('#profilePicInput').show();
        $('.profile-pic-update').css('display', 'none');

        $('.edit-profile').show();
        $('#coverInput').show();
        $('.cover-update').css('display', 'none');

        $('.edit-icon3').show();
        $('#cardInput').show();
        $('.loyalty-card-image-update').css('display', 'none');
    }));
    $('.images-form1').on('submit',(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            type:'POST',
            url: "{{route('upload-images')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });

        $('#edit-icon3'+id).show();
        $('#cardInput'+id).show();
        $('#loyalty-card-image-update'+id).css('display', 'none');
    }));        
});

    
    

    // fileupload
    $("input[type='image']").click(function() {
        $("input[id='my_file']").click();
    });
    $("input[type='image']").click(function() {
        $("input[id='my_file2']").click();
    });


    //   timepicker
    $(function() {
        $('#time1').timepicker();
        $('#time2').timepicker();
        $('#time3').timepicker();
        $('#time4').timepicker();
        $('#time5').timepicker();
        $('#time6').timepicker();
        $('#time7').timepicker();
        $('#time8').timepicker();
        $('#time9').timepicker();
        $('#time10').timepicker();
        $('#time11').timepicker();
        $('#time12').timepicker();
        $('#time13').timepicker();
        $('#time14').timepicker();
        $('#time15').timepicker();
        $('#time16').timepicker();
    });



    // $(document).ready(function() {
    //     if ($(window).width() < 991) {
    //         $(".admin-right").addClass("full-width-side");
    //         $("#mySidenav").hide(0);
    //     }
    //     $("#show-menu").click(function() {
    //         $("#mySidenav").slideToggle(0);
    //         if ($(".admin-right").hasClass("full-width-side")) {
    //             $(".admin-right").removeClass("full-width-side");
    //         } else {
    //             $(".admin-right").addClass("full-width-side");
    //         }
    //     });


    // });


    $("body").on('click', '.bio_e', function() {
        edit = $(".bio_e").hasClass("true");

        // if (edit) {
        $(".bio_e").removeClass("true");
        $(".bio_te").css("display", "none");
        $("#bio_form_container").css("display", "block");
        $("#bio_form_container button").css("display", "block");
        $("#bio_form_container button").attr("disabled", false);
        // } 
        // else {
        //     $(".bio_e").addClass("true");
        //     $(".bio_te").css("display", "block");
        //     $("#bio_form_container").css("display", "none");
        //     $("#bio_form_container button").css("display", "none");
        //     $("#bio_form_container button").attr("disabled", true);
        // }
        $(this).hide();
        $(".bio_u").css("display", "block");


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
        })
        


    });

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

        // if (edit) {
        $(".insta_e").removeClass("true");
        $("#insta_te").css("display", "none");
        $("#insta_form_container").css("display", "block");
        $("#insta_form_container button").css("display", "block");
        $("#insta_form_container button").attr("disabled", false);
        // } 
        // else {
        //     $(".insta_e").addClass("true");
        //     $("#insta_te").css("display", "block");
        //     $("#insta_form_container").css("display", "none");
        //     $("#insta_form_container button").css("display", "none");
        //     $("#insta_form_container button").attr("disabled", true);
        // }
        $(this).hide();
        $('#insta_form').css('width', '90%');
        $('.insta_submit').css('display', 'block');

    });

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

    $('#stamp_description').on('change', function() {
        str = "stamp_description=" + this.value + "&table=loyalty_scheme&field=stamp_description&id=" + $(this).attr("data-id");
        url = "{{route('update_data')}}";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: str, // post data || get data
            success: function(result) {
                // console.log(result);
                $("#stamp_description_text").html(result.stamp_description);
            },
            error: function(xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })
    });

    $('#stamp_description_add_new').on('change', function() {
       
        $("#stamp-description").html($(this).val());
            
    });
     $('#stamps_per_day_new').on('change', function() {
       stamps_per_day = $(this).val();
        $("#stamp-collection").html(stamps_per_day+"&nbsp;");
        var output = "";
       for (var i = 0; i < stamps_per_day; i++) {
            if(i + 1 == stamps_per_day){
                output += '<li class="active"><img src="{!! asset("business/assets/images/gift.svg") !!}"></li>';
            }else{
                output += '<li class="active"><img src="{!! asset("business/assets/images/all.svg") !!}"></li>';
            }
       }
       $("#days_logo2_new").html(output);
       if($("#newSchemeImgPreview").attr('style') == undefined ){
            $("#days_logo2_new").css('display','none');
       }else{  $("#days_logo2_new").css('display','flex');}
    });

    $("#scheme-logo2").on("click", function() {
    	let stamps_per_day = $("#stamps_per_day_new").val();
        let url = "{!! url('') !!}/"+$("#scheme-logo2").val();
        $("#img-upi").css("display","none");
        $("#newSchemeImgPreview").css('background', 'url('+url +')');
        $("#newSchemeImgPreview").css('background-position', 'center center');
        $("#edit-icon-new").css("display","block");
        $("#days_logo2_new").css("display","flex");
        var output = "";
        for (var i = 0; i < stamps_per_day; i++) {
            if(i + 1 == stamps_per_day){
                output += '<li class="active"><img src="{!! asset("business/assets/images/gift.svg") !!}"></li>';
            }else{
                output += '<li class="active"><img src="{!! asset("business/assets/images/all.svg") !!}"></li>';
            }
       } console.log(output);
       $("#days_logo2_new").html(output);
       $("#remove-scheme-img-new").css("display","block");
    });
    $(".scheme-logo").on("click", function() {
    	let logo = $(this).val();
    	let loyality_id = $(this).data('loyality_id');
        let url = "{!! url('') !!}/"+$(this).val();
        let id =  $(this).data('id');
        $.ajax({
            url: "{{route('upload-images')}}",
            type:'POST',
            dataType: 'json', // data type
            data: {useLogo:logo,loyality_id:loyality_id},
            success:function(data){
                
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        $("#newSchemeImgPreview"+id).css("display","none");
        $("#cardImagePreview"+id).css('background', 'url('+url +')');
        $("#cardImagePreview"+id).css('background-position', 'center center');
        $("#cardImagePreview"+id).css("display","block");
        $("#edit-icon3"+id).css("display","block");
        $("#remove-scheme"+id).css("display","block");
    });

    function deleLoyality(LoyalityID){
        let text = "Are you sure to delete the loyality card";
        if (confirm(text) == true) {
           url = "{{route('delete_loyality')}}";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: {id:LoyalityID}, // post data || get data
            success: function(result) {
                //   console.log(result);
                if(result.msg == "deleted"){
                    alert("Loyalty card is deleted successfully");
                }
                window.location.href = "{!! url('') !!}/business/profile";
            },
            error: function(xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })
        }
    }
    $("#remove-scheme-img-new").on('click',function(){
    	$("#newSchemeImgPreview").css("background","");	
    	$("#img-upi").css("display","block");	
    	$("#days_logo2_new").css("display","none");	
    	$("#scheme-logo2").prop('checked', false);	
    	$("#remove-scheme-img-new").css("display","none");	
    });
</script>

@endsection