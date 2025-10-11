@extends('business_dashboard.master_layout')
@section('title', 'Setting')
@section('content')


<style>
    .form .custom-input {
        margin-bottom: 10px;
    }

    .d-none {
        display: none;
    }

    .d-block {
        display: block;
    }

</style>
<div class="account-details-main">
    <div class="row">
        <div class="col-md-8">
            <div class="account-outer">
                <h2 class="acco-hea">Account Details</h2>
                <div class="personal-main">
                    <h3>Personal Info</h3>
                    <div class="personal-box">
                        <form id="personal_form">
                            <span class="edit-inf true"><img
                                    src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="edit"></span>
                            <button type="submit" class="btn btn-success update-inf"
                                style="
                                      padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;">
                                ✔
                            </button>
                            <ul class="persomal-ul ">
                                <li>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path
                                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        </svg>
                                    </span>
                                    <h4 id="name">{{auth()->user()->name}}</h4>
                                </li>
                                <li>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg>
                                    </span>
                                    <h4 id="business_email">{{$business->business_email}}</h4>
                                </li>
                                <li>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>
                                    </span>
                                    <h4 id="business_number">{{$business->business_number}}</h4>
                                </li>
                            </ul>
                            <!-- <form style="display:none" id="personal_form"> -->
                            <div style="display:none" id="personal_form_container">
                                <input name="id" name="id" value="{{$business->id}}" type="hidden">
                                <ul class="form">
                                    <li>

                                        <input type="text" name="name" placeholder="Enter Name" class="custom-input"
                                            value="{{auth()->user()->name}}" autocomplete="off" autofill="off"
                                            required="required">
                                    </li>
                                    <li>

                                        <input type="text" class="custom-input" placeholder="Enter Business Email"
                                            name="business_email" value="{{$business->business_email}}"
                                            disabled="disabled" autocomplete="off" autofill="off">
                                    </li>
                                    <li>
                                        <input type="text" class="custom-input" placeholder="Enter Business Number"
                                            name="business_number" value="{{$business->business_number}}"
                                            autocomplete="off" autofill="off" required="required">
                                    </li>
                                </ul>




                                <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                            </div>
                        </form>
                    </div>
                </div>
                <style>
                    @media only screen and (min-width: 320px) and (max-width: 786px){
                        .show-pas-field {
	display: block;
}.show-pas-field li {
	width: 100%;
	float: left;
	max-width: 100%;
	margin-left: 0 !important;
	margin-bottom: 10px;
}
                    }
                </style>
                <div class="pas-main">
                    <h3 class="pas-text">Password</h3>
                    <div class="pas-outer">
                        <span class="edit-pasword true"><img
                                src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="no img"></span>
                        <span class="view-pas">****************</span>
                        <form class="hide-pas">
                            <ul class="show-pas-field">
                                <li>
                                    <input required class="pas-field" name="old_password" id="old_password"
                                        type="password" placeholder="Enter Old Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16" id="eye_old_password"
                                        onclick="myFunction('old_password','eye_old_password','eye_slash_old_password')">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-slash-fill d-none" viewBox="0 0 16 16"
                                        id="eye_slash_old_password">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                    </svg>
                                </li>
                                <li>
                                    <input required class="pas-field" name="new_password" id="new_password"
                                        type="password" placeholder="Enter New Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16" id="eye_new_password"
                                        onclick="myFunction('new_password','eye_old_password','eye_slash_old_password')">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-slash-fill d-none" viewBox="0 0 16 16"
                                        id="eye_slash_new_password">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
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
<style>.btnds {
	width: 193px;
	margin: 0 auto;
	margin-top: 20px;
}</style>
            <div class="account-outer" style="margin-top: 20px;">
                <div class="personal-main">
                    <h2 style="margin: 0;padding: 15px;padding-top: 26px;">Have a question? Get in touch with our <a href="mailto:contact@loyal-iom.com" style="color: #FF2055;">Support team!</a></h2>
                </div>
                <div class="btnds">
                    <a href="javascript://" class="cancel-amount" onclick="alert('To cancel account please message contact@loyal-iom.com')">Cancel Account</a>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="display: none">
            <div class="busi-address-main">
                <form id="location-form">
                    <span class="busi-edit add"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg"
                            alt="icon"></span>
                    <button type="submit" class="btn btn-success busi-update"
                        style="
                                      padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;"
                        id="location_update">
                        ✔
                    </button>
                    <h2 class="bus-head">Registered Business Address</h2>
                    <div class="bus-outer">
                        <span id="b-t">{{$business->business_address}}</span>

                    </div>
                    <!-- <form style="display:none" id="location-form"> -->
                    <div style="display:none" id="location-form-container">
                        <input name="id" name="id" value="{{$business->id}}" type="hidden">
                        <input type="hidden" name="field" value="business_address" id="loc_field" disabled>
                        <input type="hidden" name="table" value="business">


                        <input type="text" placeholder="Enter New Address" required class="custom-input"
                            id="input_address" disabled name="address" value="{{$business->business_address}}"
                            autocomplete="off" autofill="off">
                        <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                    </div>
                </form>
            </div>
            <a href="#" class="cancel-amount" data-toggle="modal" data-target="#exampleModalCenter">Cancel Account</a>
        </div>
    </div>
    <!--  data-toggle="modal" data-target="#exampleModalCenter2" -->
    <!-- <div class="question-main">
        <span>Have a question? Get in touch with our <a href="#">Support team!</a></span>
    </div> -->

</div>

<!-- popup cancel account-->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-style" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <h2 class="cancel-acccount">Are you sure you want to cancel you account?</h2>
                <p class="popup-desc">Cancelling your account will remove your profile from the <br> Loyal IOM app and
                    will stop your reward scheme.</p>
                @if($business->plan == 2)
                <span class="popup-last">(Billing will end after next payment)</span>
                @endif
            </div>
            <div class="modal-footer popup-footer">
                <div class="row" style="width: 100%;">
                    <div class="col-sm-6">
                        <a href="{{route('cancel_account')}}" class="btn btn-danger btn-lg btn-block">YES</a>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal">NO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- popup reactive account-->

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-style" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <h2 class="cancel-acccount">REACTIVATE YOU ACCOUNT?</h2>
                <p class="popup-desc">By reactivating your account you will have access to the dashboard and your
                    loyalty scheme will automticallty start</p>
                <span class="popup-last"></span>

            </div>
            <div class="modal-footer popup-footer">
                <a href="{{route('reactivate_account')}}" class="btn btn-success btn-lg btn-block">Reactivate now!</a>
                <a href="{{route('end')}}" class="logout-btn"> <img
                        src="{{asset('business_dashboard/assets/images/log-out1.svg')}}" alt="icon"> Logout</a>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->delete == 1)
<script type="text/javascript">
    $(document).ready(function () {
        $("#exampleModalCenter2").modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
    });

</script>
@endif


<script
    src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=nl&output=json&key={{env('GOOGLE_MAP_KEY')}}"
    async defer></script>

<script>
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });




    $(document).ready(function () {
        if ($(window).width() < 991) {
            $(".admin-right").addClass("full-width-side");
            $("#mySidenav").hide(0);
        }
        $("#show-menu").click(function () {
            $("#mySidenav").slideToggle(0);
            if ($(".admin-right").hasClass("full-width-side")) {
                $(".admin-right").removeClass("full-width-side");
            } else {
                $(".admin-right").addClass("full-width-side");
            }
        });

        // show hide pas div
        $(".edit-pasword").click(function () {
            $(".hide-pas").show();
            $(".view-pas, .edit-pasword").hide();
        });


    });



    function initAutocomplete() {

        const input = document.getElementById("input_address");
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

                    var parent = document.getElementById("location-form");
                    parent.appendChild(input);
                    parent.appendChild(input2);

                    //   console.log(results[0].geometry.location.lat());
                    //   console.log(results[0].geometry.location.lng());

                })
                .catch((e) => window.alert("Geocoder failed due to: " + e));
        });
    }

    $(".busi-edit").on("click", function () {
        edit = $(".busi-edit").hasClass("add");
        if (edit) {
            $(".busi-edit").removeClass("add");
            $(".bus-outer").css("display", "none");
            $("#location-form-container").css("display", "block");
            $("#input_address").attr("disabled", false);
            $("#loc_field").attr("disabled", false);

        } else {

            $(".busi-edit").addClass("add");
            $(".bus-outer").css("display", "block");
            $("#location-form-container").css("display", "none");
            $("#input_address").attr("disabled", true);
            $("#loc_field").attr("disabled", true);
        }
        $(this).hide();
        $('.busi-update').css('display', 'block');


    });

    $(".edit-pasword").on("click", function () {
        edit = $(".edit-pasword").hasClass("true");
        if (edit) {
            $(".edit-pasword").removeClass("true");
            $(".view-pas").css("display", "none");
            $(".hide-pas").css("display", "block");


        } else {

            $(".edit-pasword").addClass("true");
            $(".view-pas").css("display", "block");
            $(".hide-pas").css("display", "none");

        }


    });



    $("#location-form").on("submit", function () {
        event.preventDefault();
        url = "{{route('update_data')}}";
        id = "location-form";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: $("#" + id).serialize(), // post data || get data
            success: function (result) {
                //   console.log(result);
                $("#b-t").html("<p>" + $("#input_address").val() + "</p>");
                $(".bus-outer").css("display", "block");
                $("#location-form-container").css("display", "none");
                $("#input_address").attr("disabled", true);
                $("#loc_field").attr("disabled", true);

            },
            error: function (xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })

        $('.busi-edit').show();
        $('.busi-update').css('display', 'none');

    });

    $("#personal_form").on("submit", function () {
        event.preventDefault();
        url = "{{route('update_profile')}}";
        id = "personal_form";
        $.ajax({
            url: url, // url where to submit the request
            type: "POST", // type of action POST || GET
            dataType: 'json', // data type
            data: $("#" + id).serialize(), // post data || get data
            success: function (result) {
                //   console.log(result);
                $("#name").text($("[name=name]").val());
                $("#business_email").text($("[name=business_email]").val());
                $("#business_number").text($("[name=business_number]").val());
                $(".edit-inf").click();

            },
            error: function (xhr, resp, text) {

                console.log(xhr.responseText);
            }
        })

        $('.update-inf').css('display', 'none');
        $(".edit-inf").show();


    });



    $(".hide-pas").on("submit", function () {

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
            success: function (result) {
                $("#old_password").val($("#new_password").val());
                $("#new_password").val("");
                $(".view-pas").css("display", "block");
                $(".hide-pas").css("display", "none");
                $(".edit-pasword").css("display", "block");


            },
            error: function (xhr, resp, text) {
                // alert("Password Not Same");
                $("[name=old_password]").css("border", "2px solid red");
                $("[name=old_password]").after(
                    "<small style='color:red' id='no-pw'>Password Dosen't match</small>");
                console.log(xhr.responseText);
            }
        })

    });

    $(".edit-inf").on('click', function () {
        edit = $(".edit-inf").hasClass("true");
        if (edit) {
            $(".edit-inf").removeClass("true");
            $(".persomal-ul").css("display", "none");
            $("#personal_form_container").css("display", "block");

        } else {
            $(".edit-inf").addClass("true");
            $(".persomal-ul").css("display", "block");
            $("#personal_form_container").css("display", "none");
        }
        $(this).hide();
        $('.update-inf').css('display', 'block');

    });

    function myFunction(fieldid, hide_eye, show_eye) {
        var x = document.getElementById(fieldid);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

@endsection
