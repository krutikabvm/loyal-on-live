@extends('admin_dashboard.master_layout')

@section('title', 'Account')

@section('content')
    <style>
        .search-top{display:none;}
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
    <div class="account-tcs-main">

        <h2 class="customer-head">Account / T&amp;Cs</h2>
        <div class="account-form-main1">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="per-info-head">Personal Info</h2>
                    <div class="personal-main">
                        <div class="info1-box personal-box">
                            <form id="personal_form">
                                <span class="edit-inf true"><img src="{{asset('admin_dashboard/assets/images/round-e.png') }}"></span>
                                <button type="submit" class="btn btn-success update-inf" style="
                                              padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;">
                                    ✔
                                </button>
                                <ul class="pi-ul">
                                    <li>
                                        <div> <img src="{{asset('admin_dashboard/assets/images/user-icon.png') }}" alt="no img"> </div>
                                        <span id="name"> {{@$user->name}}</span>
                                    </li>
                                    <li>
                                        <div> <img src="{{asset('admin_dashboard/assets/images/Email.png') }}" alt="no img"> </div>
                                        <span id="email"> {{@$user->email}}</span>
                                    </li>
                                </ul>
                                <div style="display:none" id="personal_form_container">
                                    <input name="id" name="id" value="{{$user->id}}" type="hidden">
                                    <ul class="form">
                                        <li>

                                            <input type="text" name="name" placeholder="Enter Name" class="custom-input" value="{{auth()->user()->name}}" autocomplete="off" autofill="off" required="required">
                                        </li>
                                        <li>

                                            <input type="text" class="custom-input" placeholder="Enter Customer Email" name="business_email" value="{{@$user->email}}" disabled="disabled" autocomplete="off" autofill="off">
                                        </li>
                                       
                                    </ul>




                                    <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h2 class="per-info-head">Password</h2>
                    <div class="info1-box">
                        <span class="edit-pasword true"><img src="{{asset('admin_dashboard/assets/images/round-e.png') }}"></span>
                        <span class="edit-pas">****************</span>
                        <form class="hide-pas">
                            <ul class="show-pas-field">
                                <li>
                                    <input required class="pas-field" name="old_password" id="old_password" type="password" placeholder="Enter Old Password" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eye_old_password" onclick="myFunction('old_password','eye_old_password','eye_slash_old_password')">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill d-none" viewBox="0 0 16 16" id="eye_slash_old_password">
                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                    </svg>
                                </li>
                                <li>
                                    <input required class="pas-field" name="new_password" id="new_password" type="password" placeholder="Enter New Password">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eye_new_password" onclick="myFunction('new_password','eye_old_password','eye_slash_old_password')">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill d-none" viewBox="0 0 16 16" id="eye_slash_new_password">
                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                    </svg>
                                </li>
                                <li>
                                    <button class="sav-pas" type="submit">Save</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <form action="{{route('admin.update_settings')}}" method="post">
        @csrf
            <div class="text-area-main">
                <textarea placeholder="Add T&amp;Cs here..." name="settings">{{$account_settings->terms_conditions}}</textarea>
                <input type="submit" value="Save">
            </div>
        </form>
        <span class="busines-account-btn">
            <a href="#"> <img src="{{asset('admin_dashboard/assets/images/red-user.png') }}" alt="img"> Create Business Test Account </a>
        </span>
        
       </div>

    <script type="text/javascript">
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        function myFunction(fieldid,hide_eye,show_eye) {
          var x = document.getElementById(fieldid);
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        // show hide pas div
        $(".edit-pasword").click(function() {
            $(".hide-pas").show();
            $(".edit-pas, .edit-pasword").hide();
        });

        $(".edit-pasword").on("click", function() {
            edit = $(".edit-pasword").hasClass("true");
            if (edit) {
                $(".edit-pasword").removeClass("true");
                $(".edit-pas").css("display", "none");
                $(".hide-pas").css("display", "block");


            } else {

                $(".edit-pasword").addClass("true");
                $(".edit-pas").css("display", "block");
                $(".hide-pas").css("display", "none");

            }


        });
         $(".hide-pas").on("submit", function() {

            event.preventDefault();
            url = "{{route('update_pwd')}}";
            $("[name=old_password]").css("border", "");
            $("#no-pw").remove();
            id = "hide-pas";
            $.ajax({
                url: url, // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'json', // data type
                data: $("." + id).serialize(), // post data || get data
                success: function(result) {
                    $("#old_password").val($("#new_password").val());
                    $("#new_password").val("");
                    $(".edit-pas").css("display", "block");
                    $(".hide-pas").css("display", "none");
                    $(".edit-pasword").addClass("true");
                    $(".edit-pasword").css("display", "block");


                },
                error: function(xhr, resp, text) {
                    // alert("Password Not Same");
                    $("[name=old_password]").css("border", "2px solid red");
                    $("[name=old_password]").after("<small style='color:red' id='no-pw'>Password Dosen't match</small>");
                    console.log(xhr.responseText);
                }
            })

        });
        $(".edit-inf").on('click', function() {
            edit = $(".edit-inf").hasClass("true");
            if (edit) {
                $(".edit-inf").removeClass("true");
                $(".pi-ul").css("display", "none");
                $("#personal_form_container").css("display", "block");

            } 
            else {
                $(".edit-inf").addClass("true");
                $(".pi-ul").css("display", "block");
                $("#personal_form_container").css("display", "none");
            }
            $(this).hide();
            $('.update-inf').css('display', 'block');

        });
        $("#personal_form").on("submit", function() {
            event.preventDefault();
            url = "{{route('admin.update_profile')}}";
            id = "personal_form";
            $.ajax({
                url: url, // url where to submit the request
                type: "POST", // type of action POST || GET
                dataType: 'json', // data type
                data: $("#" + id).serialize(), // post data || get data
                success: function(result) {
                    //   console.log(result);
                    $("#name").text($("[name=name]").val());
                    $("#email").text($("[name=business_email]").val());
                    $('.update-inf').css('display', 'none');
                    $(".edit-inf").show();

                },
                error: function(xhr, resp, text) {

                    console.log(xhr.responseText);
                }
            })

            $('.update-inf').css('display', 'none');
            $(".edit-inf").show();


        });
    </script>
@endsection