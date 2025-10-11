

var selectedPlan = 0;


$("#step1_form").unbind().submit(function (event) {

    event.preventDefault();

    id = "step1_form";

    form_url = this.action;

    check_status = form_validation(id);

    $(".error-msg").remove();

    if (check_status) {


        $.ajax({

            url: form_url, // url where to submit the request

            type: "POST", // type of action POST || GET

            dataType: 'json', // data type

            data: $("#" + id).serialize(), // post data || get data

            success: function (result) {

                $("#step1").removeClass("active");

                $("#step1").removeClass("in");

                $("#step1_li").removeClass("active");

                $("#step1_li a").addClass("done");

                $("#step1_li a").attr("data-toggle", "tab");

                $("#step2_li a").attr("data-toggle", "tab");

                $("#step2_li").addClass("active");

                $("#step2").addClass("active");

                $("#step2").addClass("in");

                console.log(result['business']['id']);

            },

            error: function (xhr, resp, text) {

                $("body").append("<span class='error-msg'><ol id='ol'></ol></span>");

                var errors = $.parseJSON(xhr.responseText);

                var tc = errors['errors'];


                $.each(tc, function (key, val) {

                    $("#ol").append("<li>" + val + "</li>");

                });

                setTimeout(
                    function () {

                        $(".error-msg").remove();


                    }, 5000);

                console.log(xhr.responseText);

            }

        })

    }


});


$("#back-step2").click(function () {


    $("#busines1").css("display", "inline-block");

    $("#business2").css("display", "none");
    $("#business3").css("display", "none");


});

$("#back-step999").click(function () {


    $("#busines1").css("display", "inline-block");

    $("#business2").css("display", "none");
    $("#business3").css("display", "none");


});

$("#back-step9999").click(function () {


    $("#busines1").css("display", "inline-block");

    $("#business2").css("display", "none");
    $("#business3").css("display", "none");


});


$("#backfinal").click(function () {


    $("#setup1_lo").css("display", "inline-block");

    $("#setup2_lo").css("display", "none");


});


$("#rimg").click(function () {

    $("#is_logo").remove();

    $("#rimg").css("display", "none");

    $("#s_bk").attr("style", '');

    $("[name=scheme-logo]").prop("checked", false);

    $("#days_logo").empty();

    $("#days_logo2").empty();

    $("#img-upi, #another-logo, #or-text").css("display", "block");

    $("#ex").remove();


});


$(document).on('click', "#rimg_2", function () {

    $("#is_logo_2").remove();

    $("#rimg_2").css("display", "none");

    $("#s_bk_2").attr("style", '');

    $("[name=scheme-logo_2]").prop("checked", false);

    $("#days_logo_2").empty();

    $("#days_logo2_2").empty();

    $("#img-upi_2, #another-logo_2, #or-text_2").css("display", "block");

    $("#ex_2").remove();
});


//   var packages=[['Â£ 20 per month','Â£ 25 per month'],['Â£ 100 per month','Â£ 200 per month']];

var packages = [['Free', 'Coming Soon'], ['Free', 'Comming Soon']];

//   var packages_id=[1,2,3,4];

var packages_id = [1, 1, 1, 1];


$('#checkbox').click(function () {

    if ($(this).prop("checked") === true) {

        $(".pkg-price-basic").text(packages[1][0]);

        $(".pkg-price-premium").text(packages[1][1]);


        $(".basic").attr("id", packages_id[2]);

        $(".premium").attr("id", packages_id[3]);


    } else if ($(this).prop("checked") === false) {

        $(".pkg-price-basic").text(packages[0][0]);

        $(".pkg-price-premium").text(packages[0][1]);


        $(".basic").attr("id", packages_id[0]);

        $(".premium").attr("id", packages_id[1]);

    }

});


$(".step2_button").css("display", "flex");


$(".pkg-main").click(function (event) {

    $("#show-step3").remove();

    $(".pkg-main").removeClass("active-pkg");

   // $(this).addClass("active-pkg");

    id = $(this).attr("id");
   
    if (id == "2") {
        // $("#pr").addClass("active");
        // $("#fr").removeClass("active");

        // $("ul.pkg-check").append('<li id="show-step3"></li>');

        // $("ul.fo3").append('<li id="show-step3"></li>');
       // $(".pkg-main,#fr").addClass("active-pkg");
         //$("#pr").removeClass("active");
         //$("#fr").addClass("active")

         
          //free plan always active
        $('div#1').addClass('active-pkg');
  ;
         $("#show-step3").remove();
 
         $("#show-step3").remove();

         $("#pkg_id").val(1);
          //free plan always active
    }

    if (id == "1") {

       // $(".pkg-main,#fr").addClass("active-pkg");
        //$("#pr").removeClass("active");
        //$("#fr").addClass("active");
   //free plan always active
        $('div#'+id).addClass('active-pkg');
        $("#show-step3").remove();

        $("#show-step3").remove();

        $("#pkg_id").val(id);
                //free plan always active
    }

    // $("span.pkg-price-basic").removeClass("active");

    $(this).find("span.f").addClass("active");

    // $("#pkg_id").val('');

   

    $(".step2_button").css("display", "flex");


});


// $(".step2_button").css("display","none");


$(".bi-chevron-down").click(function (event) {


    a = $(this).next();

    a.click();


});


$("[name=facebook_link]").change(function () {

    val = $("[name=facebook_link]").val();
    console.log(val);

    if (val != '') {

        $("[name=instagram_link]").removeAttr("required");

    } else {

        $("[name=instagram_link]").attr("required", true);


    }


});


$("[name=instagram_link]").change(function () {

    val = $("[name=instagram_link]").val();

    if (val != '') {

        $("[name=facebook_link]").removeAttr("required");

    } else {

        $("[name=facebook_link]").attr("required", true);


    }


});


$("#log_link").unbind().submit(function (event) {

    event.preventDefault();

    $(".error-msg").remove();

    id = "log_link";


    form_url = this.action;

    check_status = form_validation(id);

    var my_file1 = document.getElementById("my_file1");

    var my_file2 = document.getElementById("my_file2");

    val1 = $("#my_file1").attr("value");

    val2 = $("#my_file2").attr("value");

    if (!val1) {

        if (my_file1.files.length == 0) {

            $("body").append("<span class='error-msg'>Upload Logo </span>");

            return

        }

    }

    if (!val2) {

        if (my_file2.files.length == 0) {

            $("body").append("<span class='error-msg'>Upload Cover Image</span>");

            return

        }

    }

    if (check_status) {


        $.ajax({

            url: form_url, // url where to submit the request

            type: "POST", // type of action POST || GET

            dataType: 'json', // data type

            data: $("#" + id).serialize(), // post data || get data

            success: function (result) {

                $("#busines1").css("display", "none");

                $("#business2").css("display", "block");

                $("#step3_li a").attr("data-toggle", "tab");

                var plan = result['business']['plan'];

                selectedPlan = plan;


                if ((plan == 1)) {


                    console.log('in functions');

                    $(".success-msg").remove();

                    $("li#show-step3").hide();

                    $("#business3").hide();

                    $("#step2-next").remove();

                    $('button#locations_form').remove();

                    $(".fo3").after(` <button type="submit" class="continue-btn" id="locations_form">Next

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">

                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>

                                        </svg>

                                    </button>`);

                    $('#locations_form').parent('div.next-icon-main').siblings('button.continue-btn').hide();


                } else if (plan == 2) {
                    $('#business2').hide();
                    $("#business3").show();
                    $("li#show-step3").hide();

                    if($('div.main-loyalty-div').length == 2)
                    {
                        $('#add_another_image').hide();
                    }
                    else if($('div.main-loyalty-div').length == 1){
                        $('#add_another_image').show();
                    }

                    // $('#add_another_image').show();
                } else {

                    $("li#show-step3").show();
                    $('#add_another_image').hide();
                    // show

                }

                console.log(result['business']['id']);


            },

            error: function (xhr, resp, text) {

                console.log(xhr, resp, text);

                $("body").append("<span class='error-msg'><ol id='ol'></ol></span>");

                var errors = $.parseJSON(xhr.responseText);

                var tc = errors['errors'];

                $(".success-msg").remove();

                $.each(tc, function (key, val) {

                    $("#ol").append("<li>" + val + "</li>");

                });

                setTimeout(
                    function () {

                        $(".error-msg").remove();


                    }, 5000);

            }

        })

    }


});


$('#same_address').click(function () {

    if ($(this).prop("checked") === true) {

        $("[name=address]").attr("disabled", true);


    } else if ($(this).prop("checked") === false) {

        $("[name=address]").attr("disabled", false);

    }

});


$('#same_address_2').click(function () {

    if ($(this).prop("checked") === true) {

        $("[name=address_2]").attr("disabled", true);


    } else if ($(this).prop("checked") === false) {

        $("[name=address_2]").attr("disabled", false);

    }

});

$('#new_same_address').click(function () {

    if ($(this).prop("checked") === true) {

        $("[name=new_address]").attr("disabled", true);


    } else if ($(this).prop("checked") === false) {

        $("[name=new_address]").attr("disabled", false);

    }

});


$('#same_address_3').click(function () {

    if ($(this).prop("checked") === true) {

        $("[name=address_3]").attr("disabled", true);


    } else if ($(this).prop("checked") === false) {

        $("[name=address_3]").attr("disabled", false);

    }

});


$(document).on('click','[name=send_location]',function () {

    if ($(this).prop("checked") === true) {

        $("[name=search_location2]").attr("disabled", true);


    } else if ($(this).prop("checked") === false) {

        $("[name=search_location2]").attr("disabled", false);

    }

});


$("#s_lo").click(function () {
    $("#s_lo").attr("disabled", false);
    $('[name=send_location]').prop("checked", false)

});


$("#locations").unbind().submit(function (event) {

    event.preventDefault();

    id = "locations";

    form_url = this.action;

    check_status = form_validation(id);

    $(".error-msg").remove();

    console.log($("#" + id).serialize());

    if (check_status) {


        $.ajax({

            url: form_url, // url where to submit the request

            type: "POST", // type of action POST || GET

            dataType: 'json', // data type

            data: $("#" + id).serialize(), // post data || get data

            success: function (result) {

                plan = $("#pkg_id").val();
                if (plan == 1) {

                    $("#step3").removeClass("active");

                    $("#step3").removeClass("in");

                    $("#step3_li").removeClass("active");

                    $("#step3_li a").addClass("done");

                    $("#step3_li a").attr("data-toggle", "tab");


                    $("#step4_li").addClass("active");

                    $("#step4").addClass("active");

                    $("#step4").addClass("in");
                    $('#add_another_image').hide();
                } else {
                    $("#step3").removeClass("active");

                    $("#step3").removeClass("in");

                    $("#step3_li").removeClass("active");

                    $("#step3_li a").addClass("done");

                    $("#step3_li a").attr("data-toggle", "tab");


                    $("#step4_li").addClass("active");

                    $("#step4").addClass("active");

                    $("#step4").addClass("in");

                    $(".business-step3").css("display", "block");
                    $(".business-step2").css("display", "none");


                    if($('div.main-loyalty-div').length == 2)
                    {
                        $('#add_another_image').hide();
                    }
                    else if($('div.main-loyalty-div').length == 1){
                        $('#add_another_image').show();
                    }

                    // $('#add_another_image').show();

                }

                console.log(result['business']['id']);

                // window.location.reload();

            },

            error: function (xhr, resp, text) {

                console.log(xhr, resp, text);

                $("body").append("<span class='error-msg'><ol id='ol'></ol></span>");

                var errors = $.parseJSON(xhr.responseText);

                var tc = errors['errors'];


                $.each(tc, function (key, val) {

                    $("#ol").append("<li>" + val + "</li>");

                });

                setTimeout(
                    function () {

                        $(".error-msg").remove();


                    }, 5000);

            }


        })


    }


});


$("#loyalty_scheme").unbind().submit(function (event) {

    event.preventDefault();

    id = "loyalty_scheme";

    form_url = this.action;

    check_status = form_validation(id);


    if (check_status) {


        $.ajax({

            url: form_url, // url where to submit the request

            type: "POST", // type of action POST || GET

            dataType: 'json', // data type

            data: $("#" + id).serialize(), // post data || get data

            success: function (result) {

                // location.reload();

                $("#step4").removeClass("active");

                $("#step4").removeClass("in");

                $("#step4_li").removeClass("active");

                $("#step4_li a").addClass("done");

                $("#step4_li a").attr("data-toggle", "tab");


                $("#step5_li").addClass("active");

                $("#step5").addClass("active");

                $("#step5").addClass("in");

                console.log(result);

                var html = '<li>';
                html += '<input type="radio" id="send_location" name="send_location" value="'+result.getLocation+'">';
                html += '<label for="'+result.getLocation+'">'+result.getLocation+'</label>';
                html += '</li>';

                $.each(result.bus_location,function(index,value){
                    if(result.getLocation != value.address)
                    {
                        html += '<li>';
                        html += '<input type="radio" id="send_location" name="send_location" value="'+value.address+'">';
                        html += '<label for="'+value.address+'">'+value.address+'</label>';
                        html += '</li>';
                    }

                });

                $('ul.input-rad-main').html(html);



            },

            error: function (xhr, resp, text) {

                console.log(xhr, resp, text);

            }

        })

    }


});


$('[name=sunday_open_close1]').change(function () {

    selected_value = $("input[name='sunday_open_close1']:checked").val();


    if (selected_value == "close") {

        $("#sunday #tso").attr("disabled", true);

        $("#sunday #tsc").attr("disabled", true);


        $("#sunday .open span").css("color", "#707070");

        $("#sunday .close span").css("color", "#ffffff");


        $("#sunday .open span").css("background-color", "#ffffff");


        $("#sunday .close span").css("background-color", "#FF3D5A");


    } else {


        $("#sunday #tso").attr("disabled", false);

        $("#sunday #tsc").attr("disabled", false);


        $("#sunday .open span").css("color", "#ffffff");

        $("#sunday .close span").css("color", "#707070");


        $("#sunday .open span").css("background-color", "#4EADEA");


        $("#sunday .close span").css("background-color", "#ffffff");

    }


});

$('[name=monday_open_close1]').change(function () {

    selected_value = $("input[name='monday_open_close1']:checked").val();


    if (selected_value == "close") {


        $("#monday #tmo").attr("disabled", true);

        $("#monday #tmc").attr("disabled", true);


        $("#monday .open span").css("color", "#707070");

        $("#monday .close span").css("color", "#ffffff");


        $("#monday .open span").css("background-color", "#ffffff");


        $("#monday .close span").css("background-color", "#FF3D5A");


    } else {


        $("#monday .open span").css("color", "#ffffff");

        $("#monday .close span").css("color", "#707070");


        $("#monday .open span").css("background-color", "#4EADEA");


        $("#monday .close span").css("background-color", "#ffffff");


        $("#monday #tmo").attr("disabled", false);

        $("#monday #tmc").attr("disabled", false);

    }


});

$('[name=tuesday_open_close1]').change(function () {

    selected_value = $("input[name='tuesday_open_close1']:checked").val();


    if (selected_value == "close") {


        $("#tuesday #tto").attr("disabled", true);

        $("#tuesday #ttc").attr("disabled", true);


        $("#tuesday .open span").css("color", "#707070");

        $("#tuesday .close span").css("color", "#ffffff");


        $("#tuesday .open span").css("background-color", "#ffffff");


        $("#tuesday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#tuesday #tto").attr("disabled", false);

        $("#tuesday #ttc").attr("disabled", false);


        $("#tuesday .open span").css("color", "#ffffff");

        $("#tuesday .close span").css("color", "#707070");


        $("#tuesday .open span").css("background-color", "#4EADEA");


        $("#tuesday .close span").css("background-color", "#ffffff");


    }


});

$('[name=wednesday_open_close1]').change(function () {

    selected_value = $("input[name='wednesday_open_close1']:checked").val();


    if (selected_value == "close") {

        $("#wednesday #two").attr("disabled", true);

        $("#wednesday #twc").attr("disabled", true);

        $("#wednesday .open span").css("color", "#707070");

        $("#wednesday .close span").css("color", "#ffffff");


        $("#wednesday .open span").css("background-color", "#ffffff");


        $("#wednesday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#wednesday #two").attr("disabled", false);

        $("#wednesday #twc").attr("disabled", false);


        $("#wednesday .open span").css("color", "#ffffff");

        $("#wednesday .close span").css("color", "#707070");


        $("#wednesday .open span").css("background-color", "#4EADEA");


        $("#wednesday .close span").css("background-color", "#ffffff");


    }


});

$('[name=thursday_open_close1]').change(function () {

    selected_value = $("input[name='thursday_open_close1']:checked").val();


    if (selected_value == "close") {


        $("#thursday #ttho").attr("disabled", true);

        $("#thursday #tthc").attr("disabled", true);


        $("#thursday .open span").css("color", "#707070");

        $("#thursday .close span").css("color", "#ffffff");


        $("#thursday .open span").css("background-color", "#ffffff");


        $("#thursday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#thursday #ttho").attr("disabled", false);

        $("#thursday #tthc").attr("disabled", false);


        $("#thursday .open span").css("color", "#ffffff");

        $("#thursday .close span").css("color", "#707070");


        $("#thursday .open span").css("background-color", "#4EADEA");


        $("#thursday .close span").css("background-color", "#ffffff");


    }


});

$('[name=friday_open_close1]').change(function () {

    selected_value = $("input[name='friday_open_close1']:checked").val();


    if (selected_value == "close") {

        $("#friday input[type=time]").attr("disabled", true);


        $("#friday #tfo").attr("disabled", true);

        $("#friday #tfc").attr("disabled", true);


        $("#friday .open span").css("color", "#707070");

        $("#friday .close span").css("color", "#ffffff");


        $("#friday .open span").css("background-color", "#ffffff");


        $("#friday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#friday #tfo").attr("disabled", false);

        $("#friday #tfc").attr("disabled", false);


        $("#friday .open span").css("color", "#ffffff");

        $("#friday .close span").css("color", "#707070");


        $("#friday .open span").css("background-color", "#4EADEA");


        $("#friday .close span").css("background-color", "#ffffff");


    }


});

$('[name=saturday_open_close1]').change(function () {

    selected_value = $("input[name='saturday_open_close1']:checked").val();


    if (selected_value == "close") {

        $("#saturday #tsso").attr("disabled", true);

        $("#saturday #tssc").attr("disabled", true);


        $("#saturday .open span").css("color", "#707070");

        $("#saturday .close span").css("color", "#ffffff");


        $("#saturday .open span").css("background-color", "#ffffff");


        $("#saturday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#saturday #tsso").attr("disabled", false);

        $("#saturday #tssc").attr("disabled", false);


        $("#saturday .open span").css("color", "#ffffff");

        $("#saturday .close span").css("color", "#707070");


        $("#saturday .open span").css("background-color", "#4EADEA");


        $("#saturday .close span").css("background-color", "#ffffff");

    }


});


//  $("[name=send_location]").click(function(){


//       $("#s_lo").attr("disabled",true);

//  });

$("tbody input[value=open]").attr("checked", "");


$("#sunday input[value=close]").attr("checked", "");


$('[name=open_close]').unbind().change(function () {

    selected_value = $("input[name='open_close']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#auto input[type=time]").attr("disabled", true);

        $("tbody input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $("tbody input[value=open]").prop("checked", false).change();

        $("tbody .open span").css("background-color", "#ffffff");

        $("tbody .open span").css("color", "#707070");


        $("tbody .close span").css("background-color", "#FF3D5A");

        $("tbody .close span").css("color", "#ffffff");


        $("tbody .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#auto input[type=time]").attr("disabled", false);


        //   $("tbody input[value=close]").removeAttr("checked");

        $("tbody input[value=close]").prop("checked", false).change();

        $("tbody input[value=open]").prop("checked", true).change();

        $("tbody .open span").css("background-color", "#4EADEA");


        $("tbody .open span").css("color", "#ffffff");


        $("tbody .close span").css("background-color", "#ffffff");


        $("tbody .close span").css("color", "#707070");


        $("tbody .ui-timepicker-input").removeAttr("disabled")

    }


});


$("#step3_shift").click(function () {

    $(".error-msg").remove();

    check = $("#terms").prop("checked");

    if (check) {

        //
        console.log(selectedPlan);


        if(selectedPlan == 0)
        {
            selectedPlan = $(this).data('id')
        }

        if (selectedPlan == 1) {
            $.ajax({
                type: "get",
                url: "/business/finished",
                success: function (response) {
                    console.log(response);
                },
                error:function(response)
                {
                    console.warn(response);
                }
            });
            $("#exampleModalCenter").modal("show");
        } else if (selectedPlan == 2) {
            $("#setup2_lo").css("display", "none");

            $("#setup3_lo").css("display", "inline-block");



            if($('#send_location').is(':checked'))
            {
                var location = $('input[name=send_location]:checked').val();
                $('#shipped').text(location);
            }
            else{
                var location =$("#s_lo").val();

                $('#shipped').text(location);
            }


        }


    } else {


        $("body").append("<span class='error-msg'>Please Accept the terms and conditions</span>");

    }


});




$("#basicExampleho").change(function (event) {


    open_time = $("#basicExampleho").val();


    $("#sunday #tso").val(open_time);

    $("#monday #tmo").val(open_time);

    $("#tuesday #tto").val(open_time);

    $("#wednesday #two").val(open_time);

    $("#thursday #ttho").val(open_time);

    $("#friday #tfo").val(open_time);

    $("#saturday #tsso").val(open_time);


});


$("#basicExamplehc").change(function (event) {


    close_time = $("#basicExamplehc").val();


    $("#sunday #tsc").val(close_time);

    $("#monday #tmc").val(close_time);

    $("#tuesday #ttc").val(close_time);

    $("#wednesday #twc").val(close_time);

    $("#thursday #tthc").val(close_time);

    $("#friday #tfc").val(close_time);

    $("#saturday #tssc").val(close_time);


});


$("#sending_detail").unbind().submit(function (event) {

    event.preventDefault();

    id = "sending_detail";

    form_url = this.action;

    check_status = form_validation(id);


    if (check_status) {


        $.ajax({

            url: form_url, // url where to submit the request

            type: "POST", // type of action POST || GET

            dataType: 'json', // data type

            data: $("#" + id).serialize(), // post data || get data

            success: function (result) {


                $("#setup1_lo").css("display", "none");

                $("#setup2_lo").css("display", "inline-block");


                console.log(selectedPlan);

                if (selectedPlan == 1) {
                    $('#step3_shift').text('SUBMIT APPLICATION');
                    $('#setup3-show').hide();
                } else if (selectedPlan == 2) {
                    $('#step3_shift').text('Next');
                    $('#setup3-show').show();

                }

                console.log(result);

            },

            error: function (xhr, resp, text) {

                console.log(xhr, resp, text);

            }

        })

    }


});


//  $("#step3_shift").hide();

//  $("#terms").click(function(){


//     });


// $('#terms').click(function(){

//             if($(this).prop("checked") === true){

//                  $("#step3_shift").show();


//             }

//             else if($(this).prop("checked") === false){

//              $("#step3_shift").hide();

//             }

//         });

// $("#step3_shift").click(function(){
//
//        $("#setup2_lo").css("display","none");
//
//        $("#setup3_lo").css("display","inline-block");
//
// });


function form_validation(id) {

    var form = document.getElementById(id);

    var check_status = form.checkValidity();

    form.reportValidity();

    return check_status;

}





function initAutocomplete() {


    const input = document.getElementById("business_address");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                // var input = document.createElement("input");

                // input.setAttribute('type', 'hidden');

                // input.setAttribute("name", "lat");

                // input.setAttribute("id", "lat");

                // input.setAttribute("value", results[0].geometry.location.lat());

                $('#lat').val(results[0].geometry.location.lat());


                // var input2 = document.createElement("input");

                // input2.setAttribute('type', 'hidden');

                // input2.setAttribute("name", "lon");

                // input2.setAttribute("value", results[0].geometry.location.lat());

                $('#lon').val(results[0].geometry.location.lng());

                // var parent = document.getElementById("step1_form");

                // parent.appendChild(input);

                // parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete1() {


    const input = document.getElementById("business_address_1");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                console.log(results[0]);

                for (var i = 0; i < results[0].address_components.length; i++) {

                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {


                        if (results[0].address_components[i].types[b] == "country") {

                            //this is the object you are looking for

                            country = results[0].address_components[i];

                            break;

                        }

                    }

                }

                console.log(country);


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "lat1");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "lon1");

                input2.setAttribute("value", results[0].geometry.location.lat());


                var parent = document.getElementById("locations");

                parent.appendChild(input);

                parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete2() {


    const input = document.getElementById("s_lo");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "lat");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "lon");

                input2.setAttribute("value", results[0].geometry.location.lat());


                var parent = document.getElementById("sending_detail");

                parent.appendChild(input);

                parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete1111() {


    const input = document.getElementById("business_address_3");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "lat3");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "lon3");

                input2.setAttribute("value", results[0].geometry.location.lat());


                var parent = document.getElementById("locations");

                parent.appendChild(input);

                parent.appendChild(input2);


                console.log(results[0].geometry.location.lat());

                console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete3() {


    const input = document.getElementById("business_location_bar_2");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                console.log(results[0]);

                for (var i = 0; i < results[0].address_components.length; i++) {

                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {


                        if (results[0].address_components[i].types[b] == "country") {

                            //this is the object you are looking for

                            country = results[0].address_components[i];

                            break;

                        }

                    }

                }

                console.log(country);


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "new_lat");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "new_lon");

                input2.setAttribute("value", results[0].geometry.location.lat());


                var parent = document.getElementById("other_locations");

                parent.appendChild(input);

                parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete567() {


    const input = document.getElementById("business_location_567");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                console.log(results[0]);

                for (var i = 0; i < results[0].address_components.length; i++) {

                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {


                        if (results[0].address_components[i].types[b] == "country") {

                            //this is the object you are looking for

                            country = results[0].address_components[i];

                            break;

                        }

                    }

                }

                console.log(country);


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "lat2");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "lon2");

                input2.setAttribute("value", results[0].geometry.location.lat());


                // $('#business_location_567').append(input);
                // $('#business_location_567').append(input2);

                var parent = document.getElementById("other_locations");

                parent.appendChild(input);

                parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


function initAutocomplete4() {


    const input = document.getElementById("business_location_3");

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

            .geocode({placeId: place.place_id})

            .then(({results}) => {


                console.log(results[0]);

                for (var i = 0; i < results[0].address_components.length; i++) {

                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {


                        if (results[0].address_components[i].types[b] == "country") {

                            //this is the object you are looking for

                            country = results[0].address_components[i];

                            break;

                        }

                    }

                }

                console.log(country);


                var input = document.createElement("input");

                input.setAttribute('type', 'hidden');

                input.setAttribute("name", "lat3");

                input.setAttribute("value", results[0].geometry.location.lat());


                var input2 = document.createElement("input");

                input2.setAttribute('type', 'hidden');

                input2.setAttribute("name", "lon3");

                input2.setAttribute("value", results[0].geometry.location.lat());


                var parent = document.getElementById("other_locations");

                parent.appendChild(input);

                parent.appendChild(input2);


                //   console.log(results[0].geometry.location.lat());

                //   console.log(results[0].geometry.location.lng());


            })

            .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

}


//   new code for clicking disbale


// $("step1_li a , #step2_li a , #step3_li a, #step4_li a, #step5_li a").attr("data-toggle",null);


$("#pwd").click(function () {


    type = $("input[name=password]").attr("type");

    if (type == "text") {


        $("input[name=password]").attr("type", "password");

        $("#pwd").attr("src", "assets/images/eye.svg");

    }

    if (type == "password") {

        $("#pwd").attr("src", "assets/images/eye-slash-fill.svg");

        $("input[name=password]").attr("type", "text");


    }

});


$("#cpwd").click(function () {


    type = $("input[name=c_password]").attr("type");

    if (type == "text") {

        $("input[name=c_password]").attr("type", "password");

        $("#cpwd").attr("src", "assets/images/eye.svg");

    }

    if (type == "password") {

        $("input[name=c_password]").attr("type", "text");

        $("#cpwd").attr("src", "assets/images/eye-slash-fill.svg");


    }

});


$("[name=number_stamps]").change(function () {



    $("#s_days").html("Collect " + this.value);

    logo = parseInt(this.value);

    url = $("#days_logo").data("url");

    gift = $("#days_logo").data("gift");

    var t = logo % 2;

    ch = $("#ex").text();

    console.log(ch);



    if (ch == "1") {

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

            console.log("ok1");

        } else {


            $("#days_logo").attr("style", "margin-left:-20px !important");

            $("#days_logo2").attr("style", "margin-left:25px !important");

            console.log("ok");

            $("#days_logo2").append(`<li class="active"><img  src="${gift}"/></li>`);

        }

    }


});


$("[name=description]").unbind().change(function () {


    if (this.value == "Other") {


        $("#other").attr("type", "text");


    } else {

        $("#s_reward").html(" stamps to Earn: " + this.value);

        $("#other").attr("type", "hidden");


        $("#sel_other").val("Other");

        $("#other").val("");


    }


});


$("#other").keyup(function () {

    $("#s_reward").html(" stamps to Earn: " + this.value);

    // $("#sel_other").val(this.value);

});


$('#new_location_count').change(function () {
    val = $(this).val();
    if (val == 3) {
        $(".opening-loc-main2").css("display", "block");
        $(".opening-loc-main1").css("display", "block");
        $("#business_location_3").attr("required", true);
        $("#business_location_567").attr("required", true);

        $("#exist_2").val("true");
        $("#exist_3").val("true");
    }
    if (val == 2) {
        $(".opening-loc-main2").css("display", "none");
        $(".opening-loc-main1").css("display", "block");
        $("#business_location_3").attr("required", false);
        $("#business_location_567").attr("required", true);

        $("#exist_2").val("true");
        $("#exist_3").val("false");

    } else if (val == 1) {
        $(".opening-loc-main2").css("display", "none");
        $(".opening-loc-main1").css("display", "none");
        $("#business_location_3").attr("required", false);
        $("#business_location_567").attr("required", false);


        $("#exist_2").val("false");
        $("#exist_3").val("false");
    }


});


$("#other_locations").unbind().submit(function (event) {

    event.preventDefault();

    id = "other_locations";

    form_url = this.action;

    $.ajax({

        url: form_url, // url where to submit the request

        type: "POST", // type of action POST || GET

        dataType: 'json', // data type

        data: $("#" + id).serialize(), // post data || get data

        success: function (result) {
            $("#step3").removeClass("active");

            $("#step3").removeClass("in");

            $("#step3_li").removeClass("active");

            $("#step3_li a").addClass("done");

            $("#step3_li a").attr("data-toggle", "tab");


            $("#step4_li").addClass("active");

            $("#step4").addClass("active");

            $("#step4").addClass("in");
            console.log(result.plan);
            if (result.plan == 1) {
                $('#add_another_image').hide();
                $('.add_new_class_div').removeClass('loyalty-sec1');
                $('.add_new_class').addClass('loyalty-sec1');
                $('.add_new_class_in_div').addClass('loyalty-sec2');
            } else {

                if($('div.main-loyalty-div').length == 2)
                {
                    $('#add_another_image').hide();
                }
                else if($('div.main-loyalty-div').length == 1){
                    $('#add_another_image').show();
                }


                $('.add_new_class_div').addClass('loyalty-sec1');
                $('.add_new_class').removeClass('loyalty-sec1');
                $('.add_new_class_in_div').addClass('loyalty-sec2');

            }

            // window.location.reload();
        },

        error: function (xhr, resp, text) {


            console.log(xhr.responseText);

        }

    })


});

//


$('[name=sunday_open_close2]').change(function () {

    selected_value = $("input[name='sunday_open_close2']:checked").val();


    if (selected_value == "close") {

        $("#sunday2 #tso2").attr("disabled", true);

        $("#sunday2 #tsc2").attr("disabled", true);


        $("#sunday2 .open span").css("color", "#707070");

        $("#sunday2 .close span").css("color", "#ffffff");


        $("#sunday2 .open span").css("background-color", "#ffffff");


        $("#sunday2 .close span").css("background-color", "#FF3D5A");


    } else {


        $("#sunday2 #tso2").attr("disabled", false);

        $("#sunday2 #tsc2").attr("disabled", false);


        $("#sunday2 .open span").css("color", "#ffffff");

        $("#sunday2 .close span").css("color", "#707070");


        $("#sunday2 .open span").css("background-color", "#4EADEA");


        $("#sunday2 .close span").css("background-color", "#ffffff");

    }


});

$('[name=monday_open_close2]').change(function () {

    selected_value = $("input[name='monday_open_close2']:checked").val();


    if (selected_value == "close") {


        $("#monday2 #tmo2").attr("disabled", true);

        $("#monday2 #tmc2").attr("disabled", true);


        $("#monday2 .open span").css("color", "#707070");

        $("#monday2 .close span").css("color", "#ffffff");


        $("#monday2 .open span").css("background-color", "#ffffff");


        $("#monday2 .close span").css("background-color", "#FF3D5A");


    } else {


        $("#monday2 .open span").css("color", "#ffffff");

        $("#monday2 .close span").css("color", "#707070");


        $("#monday2 .open span").css("background-color", "#4EADEA");


        $("#monday2 .close span").css("background-color", "#ffffff");


        $("#monday2 #tmo2").attr("disabled", false);

        $("#monday2 #tmc2").attr("disabled", false);

    }


});

$('[name=tuesday_open_close2]').change(function () {

    selected_value = $("input[name='tuesday_open_close2']:checked").val();


    if (selected_value == "close") {


        $("#tuesday2 #tto2").attr("disabled", true);

        $("#tuesday2 #ttc2").attr("disabled", true);


        $("#tuesday2 .open span").css("color", "#707070");

        $("#tuesday2 .close span").css("color", "#ffffff");


        $("#tuesday2 .open span").css("background-color", "#ffffff");


        $("#tuesday2 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#tuesday2 #tto2").attr("disabled", false);

        $("#tuesday2 #ttc2").attr("disabled", false);


        $("#tuesday2 .open span").css("color", "#ffffff");

        $("#tuesday2 .close span").css("color", "#707070");


        $("#tuesday2 .open span").css("background-color", "#4EADEA");


        $("#tuesday2 .close span").css("background-color", "#ffffff");


    }


});

$('[name=wednesday_open_close2]').change(function () {

    selected_value = $("input[name='wednesday_open_close2']:checked").val();


    if (selected_value == "close") {

        $("#wednesday2 #two2").attr("disabled", true);

        $("#wednesday2 #twc2").attr("disabled", true);

        $("#wednesday2 .open span").css("color", "#707070");

        $("#wednesday2 .close span").css("color", "#ffffff");


        $("#wednesday2 .open span").css("background-color", "#ffffff");


        $("#wednesday2 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#wednesday2 #two2").attr("disabled", false);

        $("#wednesday2 #twc2").attr("disabled", false);


        $("#wednesday2 .open span").css("color", "#ffffff");

        $("#wednesday2 .close span").css("color", "#707070");


        $("#wednesday2 .open span").css("background-color", "#4EADEA");


        $("#wednesday2 .close span").css("background-color", "#ffffff");


    }


});

$('[name=thursday_open_close2]').change(function () {

    selected_value = $("input[name='thursday_open_close2']:checked").val();


    if (selected_value == "close") {


        $("#thursday2 #ttho2").attr("disabled", true);

        $("#thursday2 #tthc2").attr("disabled", true);


        $("#thursday2 .open span").css("color", "#707070");

        $("#thursday2 .close span").css("color", "#ffffff");


        $("#thursday2 .open span").css("background-color", "#ffffff");


        $("#thursday2 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#thursday2 #ttho2").attr("disabled", false);

        $("#thursday2 #tthc2").attr("disabled", false);


        $("#thursday2 .open span").css("color", "#ffffff");

        $("#thursday2 .close span").css("color", "#707070");


        $("#thursday2 .open span").css("background-color", "#4EADEA");


        $("#thursday2 .close span").css("background-color", "#ffffff");


    }


});

$('[name=friday_open_close2]').change(function () {

    selected_value = $("input[name='friday_open_close2']:checked").val();


    if (selected_value == "close") {

        $("#friday2 input[type=time]").attr("disabled", true);


        $("#friday2 #tfo2").attr("disabled", true);

        $("#friday2 #tfc2").attr("disabled", true);


        $("#friday2 .open span").css("color", "#707070");

        $("#friday2 .close span").css("color", "#ffffff");


        $("#friday2 .open span").css("background-color", "#ffffff");


        $("#friday2 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#friday2 #tfo2").attr("disabled", false);

        $("#friday2 #tfc2").attr("disabled", false);


        $("#friday2 .open span").css("color", "#ffffff");

        $("#friday2 .close span").css("color", "#707070");


        $("#friday2 .open span").css("background-color", "#4EADEA");


        $("#friday2 .close span").css("background-color", "#ffffff");


    }


});

$('[name=saturday_open_close2]').change(function () {

    selected_value = $("input[name='saturday_open_close2']:checked").val();


    if (selected_value == "close") {

        $("#saturday2 #tsso2").attr("disabled", true);

        $("#saturday2 #tssc2").attr("disabled", true);


        $("#saturday2 .open span").css("color", "#707070");

        $("#saturday2 .close span").css("color", "#ffffff");


        $("#saturday2 .open span").css("background-color", "#ffffff");


        $("#saturday2 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#saturday2 #tsso2").attr("disabled", false);

        $("#saturday2 #tssc2").attr("disabled", false);


        $("#saturday2 .open span").css("color", "#ffffff");

        $("#saturday2 .close span").css("color", "#707070");


        $("#saturday2 .open span").css("background-color", "#4EADEA");


        $("#saturday2 .close span").css("background-color", "#ffffff");

    }


});


//  $("[name=send_location]").click(function(){


//       $("#s_lo").attr("disabled",true);

//  });

$(".t2 input[value=open]").attr("checked", "");


$("#sunday2 input[value=close]").attr("checked", "");


$('[name=open_close2]').unbind().change(function () {

    selected_value = $("input[name='open_close2']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#basicExampleho2").attr("disabled", true);
        $("#basicExamplehc2").attr("disabled", true);

        $(".t2 input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $(".t2 input[value=open]").prop("checked", false).change();

        $(".t2 .open span").css("background-color", "#ffffff");

        $(".t2 .open span").css("color", "#707070");


        $(".t2 .close span").css("background-color", "#FF3D5A");

        $(".t2 .close span").css("color", "#ffffff");

        $(".t2 .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#basicExampleho2").attr("disabled", false);
        $("#basicExamplehc2").attr("disabled", false);


        $(".t2 input[value=close]").prop("checked", false).change();

        $(".t2 input[value=open]").prop("checked", true).change();

        $(".t2 .open span").css("background-color", "#4EADEA");


        $(".t2 .open span").css("color", "#ffffff");


        $(".t2 .close span").css("background-color", "#ffffff");


        $(".t2 .close span").css("color", "#707070");


        $(".t2 .ui-timepicker-input").removeAttr("disabled")

    }


});


$("#basicExampleho2").change(function (event) {


    open_time = $("#basicExampleho2").val();


    $("#sunday2 #tso2").val(open_time);

    $("#monday2 #tmo2").val(open_time);

    $("#tuesday2 #tto2").val(open_time);

    $("#wednesday2 #two2").val(open_time);

    $("#thursday2 #ttho2").val(open_time);

    $("#friday2 #tfo2").val(open_time);

    $("#saturday2 #tsso2").val(open_time);


});


$("#basicExamplehc2").change(function (event) {


    close_time = $("#basicExamplehc2").val();


    $("#sunday2 #tsc2").val(close_time);

    $("#monday2 #tmc2").val(close_time);

    $("#tuesday2 #ttc2").val(close_time);

    $("#wednesday2 #twc2").val(close_time);

    $("#thursday2 #tthc2").val(close_time);

    $("#friday2 #tfc2").val(close_time);

    $("#saturday2 #tssc2").val(close_time);


});

//3


$('[name=sunday_open_close3]').change(function () {

    selected_value = $("input[name='sunday_open_close3']:checked").val();


    if (selected_value == "close") {

        $("#sunday3 #tso3").attr("disabled", true);

        $("#sunday3 #tsc3").attr("disabled", true);


        $("#sunday3 .open span").css("color", "#707070");

        $("#sunday3 .close span").css("color", "#ffffff");


        $("#sunday3 .open span").css("background-color", "#ffffff");


        $("#sunday3 .close span").css("background-color", "#FF3D5A");


    } else {


        $("#sunday3 #tso3").attr("disabled", false);

        $("#sunday3 #tsc3").attr("disabled", false);


        $("#sunday3 .open span").css("color", "#ffffff");

        $("#sunday3 .close span").css("color", "#707070");


        $("#sunday3 .open span").css("background-color", "#4EADEA");


        $("#sunday3 .close span").css("background-color", "#ffffff");

    }


});

$('[name=monday_open_close3]').change(function () {

    selected_value = $("input[name='monday_open_close3']:checked").val();


    if (selected_value == "close") {


        $("#monday3 #tmo3").attr("disabled", true);

        $("#monday3 #tmc3").attr("disabled", true);


        $("#monday3 .open span").css("color", "#707070");

        $("#monday3 .close span").css("color", "#ffffff");


        $("#monday3 .open span").css("background-color", "#ffffff");


        $("#monday3 .close span").css("background-color", "#FF3D5A");


    } else {


        $("#monday3 .open span").css("color", "#ffffff");

        $("#monday3 .close span").css("color", "#707070");


        $("#monday3 .open span").css("background-color", "#4EADEA");


        $("#monday3 .close span").css("background-color", "#ffffff");


        $("#monday3 #tmo3").attr("disabled", false);

        $("#monday3 #tmc3").attr("disabled", false);

    }


});

$('[name=tuesday_open_close3]').change(function () {

    selected_value = $("input[name='tuesday_open_close3']:checked").val();


    if (selected_value == "close") {


        $("#tuesday3 #tto3").attr("disabled", true);

        $("#tuesday3 #ttc3").attr("disabled", true);


        $("#tuesday3 .open span").css("color", "#707070");

        $("#tuesday3 .close span").css("color", "#ffffff");


        $("#tuesday3 .open span").css("background-color", "#ffffff");


        $("#tuesday3 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#tuesday3 #tto3").attr("disabled", false);

        $("#tuesday3 #ttc3").attr("disabled", false);


        $("#tuesday3 .open span").css("color", "#ffffff");

        $("#tuesday3 .close span").css("color", "#707070");


        $("#tuesday3 .open span").css("background-color", "#4EADEA");


        $("#tuesday3 .close span").css("background-color", "#ffffff");


    }


});

$('[name=wednesday_open_close3]').change(function () {

    selected_value = $("input[name='wednesday_open_close3']:checked").val();


    if (selected_value == "close") {

        $("#wednesday3 #two3").attr("disabled", true);

        $("#wednesday3 #twc3").attr("disabled", true);

        $("#wednesday3 .open span").css("color", "#707070");

        $("#wednesday3 .close span").css("color", "#ffffff");


        $("#wednesday3 .open span").css("background-color", "#ffffff");


        $("#wednesday3 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#wednesday3 #two3").attr("disabled", false);

        $("#wednesday3 #twc3").attr("disabled", false);


        $("#wednesday3 .open span").css("color", "#ffffff");

        $("#wednesday3 .close span").css("color", "#707070");


        $("#wednesday3 .open span").css("background-color", "#4EADEA");


        $("#wednesday3 .close span").css("background-color", "#ffffff");


    }


});

$('[name=thursday_open_close3]').change(function () {

    selected_value = $("input[name='thursday_open_close3']:checked").val();


    if (selected_value == "close") {


        $("#thursday3 #ttho3").attr("disabled", true);

        $("#thursday3 #tthc3").attr("disabled", true);


        $("#thursday3 .open span").css("color", "#707070");

        $("#thursday3 .close span").css("color", "#ffffff");


        $("#thursday3 .open span").css("background-color", "#ffffff");


        $("#thursday3 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#thursday3 #ttho3").attr("disabled", false);

        $("#thursday3 #tthc3").attr("disabled", false);


        $("#thursday3 .open span").css("color", "#ffffff");

        $("#thursday3 .close span").css("color", "#707070");


        $("#thursday3 .open span").css("background-color", "#4EADEA");


        $("#thursday3 .close span").css("background-color", "#ffffff");


    }


});

$('[name=friday_open_close3]').change(function () {

    selected_value = $("input[name='friday_open_close3']:checked").val();


    if (selected_value == "close") {

        $("#friday3 input[type=time]").attr("disabled", true);


        $("#friday3 #tfo3").attr("disabled", true);

        $("#friday3 #tfc3").attr("disabled", true);


        $("#friday3 .open span").css("color", "#707070");

        $("#friday3 .close span").css("color", "#ffffff");


        $("#friday3 .open span").css("background-color", "#ffffff");


        $("#friday3 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#friday3 #tfo3").attr("disabled", false);

        $("#friday3 #tfc3").attr("disabled", false);


        $("#friday3 .open span").css("color", "#ffffff");

        $("#friday3 .close span").css("color", "#707070");


        $("#friday3 .open span").css("background-color", "#4EADEA");


        $("#friday3 .close span").css("background-color", "#ffffff");


    }


});

$('[name=saturday_open_close3]').change(function () {

    selected_value = $("input[name='saturday_open_close3']:checked").val();


    if (selected_value == "close") {

        $("#saturday3 #tsso3").attr("disabled", true);

        $("#saturday3 #tssc3").attr("disabled", true);


        $("#saturday3 .open span").css("color", "#707070");

        $("#saturday3 .close span").css("color", "#ffffff");


        $("#saturday3 .open span").css("background-color", "#ffffff");


        $("#saturday3 .close span").css("background-color", "#FF3D5A");


    } else {

        $("#saturday3 #tsso3").attr("disabled", false);

        $("#saturday3 #tssc3").attr("disabled", false);


        $("#saturday3 .open span").css("color", "#ffffff");

        $("#saturday3 .close span").css("color", "#707070");


        $("#saturday3 .open span").css("background-color", "#4EADEA");


        $("#saturday3 .close span").css("background-color", "#ffffff");

    }


});


//  $("[name=send_location]").click(function(){


//       $("#s_lo").attr("disabled",true);

//  });

$(".t3 input[value=open]").attr("checked", "");


$("#sunday3 input[value=close]").attr("checked", "");


$('[name=open_close3]').unbind().change(function () {

    selected_value = $("input[name='open_close3']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#basicExampleho3").attr("disabled", true);
        $("#basicExamplehc3").attr("disabled", true);

        $(".t3 input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $(".t3 input[value=open]").prop("checked", false).change();

        $(".t3 .open span").css("background-color", "#ffffff");

        $(".t3 .open span").css("color", "#707070");


        $(".t3 .close span").css("background-color", "#FF3D5A");

        $(".t3 .close span").css("color", "#ffffff");


        $(".t3 .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#basicExampleho3").attr("disabled", false);
        $("#basicExamplehc3").attr("disabled", false);


        //   $("tbody input[value=close]").removeAttr("checked");

        $(".t3 input[value=close]").prop("checked", false).change();

        $(".t3 input[value=open]").prop("checked", true).change();

        $(".t3 .open span").css("background-color", "#4EADEA");


        $(".t3 .open span").css("color", "#ffffff");


        $(".t3 .close span").css("background-color", "#ffffff");


        $(".t3 .close span").css("color", "#707070");


        $(".t3 .ui-timepicker-input").removeAttr("disabled")

    }


});


$("#basicExampleho3").change(function (event) {


    open_time = $("#basicExampleho3").val();


    $("#sunday3 #tso3").val(open_time);

    $("#monday3 #tmo3").val(open_time);

    $("#tuesday3 #tto3").val(open_time);

    $("#wednesday3 #two3").val(open_time);

    $("#thursday3 #ttho3").val(open_time);

    $("#friday3 #tfo3").val(open_time);

    $("#saturday3 #tsso3").val(open_time);


});


$("#basicExamplehc3").change(function (event) {


    close_time = $("#basicExamplehc3").val();


    $("#sunday3 #tsc3").val(close_time);

    $("#monday3 #tmc3").val(close_time);

    $("#tuesday3 #ttc3").val(close_time);

    $("#wednesday3 #twc3").val(close_time);

    $("#thursday3 #tthc3").val(close_time);

    $("#friday3 #tfc3").val(close_time);

    $("#saturday3 #tssc3").val(close_time);


});


$('[name=open_close3]').unbind().change(function () {

    selected_value = $("input[name='open_close3']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#basicExampleho3").attr("disabled", true);
        $("#basicExamplehc3").attr("disabled", true);

        $(".t3 input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $(".t3 input[value=open]").prop("checked", false).change();

        $(".t3 .open span").css("background-color", "#ffffff");

        $(".t3 .open span").css("color", "#707070");


        $(".t3 .close span").css("background-color", "#FF3D5A");

        $(".t3 .close span").css("color", "#ffffff");


        $(".t3 .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#basicExampleho3").attr("disabled", false);
        $("#basicExamplehc3").attr("disabled", false);


        //   $("tbody input[value=close]").removeAttr("checked");

        $(".t3 input[value=close]").prop("checked", false).change();

        $(".t3 input[value=open]").prop("checked", true).change();

        $(".t3 .open span").css("background-color", "#4EADEA");


        $(".t3 .open span").css("color", "#ffffff");


        $(".t3 .close span").css("background-color", "#ffffff");


        $(".t3 .close span").css("color", "#707070");


        $(".t3 .ui-timepicker-input").removeAttr("disabled")

    }


});


$('[name=new_open_close]').unbind().change(function () {

    selected_value = $("input[name='new_open_close']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#newBasicExampleho").attr("disabled", true);
        $("#newBasicExamplehc").attr("disabled", true);

        $(".newT input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $(".newT input[value=open]").prop("checked", false).change();

        $(".newT .open span").css("background-color", "#ffffff");

        $(".newT .open span").css("color", "#707070");


        $(".newT .close span").css("background-color", "#FF3D5A");

        $(".newT .close span").css("color", "#ffffff");


        $(".newT .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#newBasicExampleho").attr("disabled", false);
        $("#newBasicExamplehc").attr("disabled", false);

        //   $("tbody input[value=close]").removeAttr("checked");

        $(".newT input[value=close]").prop("checked", false).change();

        $(".newT input[value=open]").prop("checked", true).change();

        $(".newT .open span").css("background-color", "#4EADEA");


        $(".newT .open span").css("color", "#ffffff");


        $(".newT .close span").css("background-color", "#ffffff");


        $(".newT .close span").css("color", "#707070");


        $(".newT .ui-timepicker-input").removeAttr("disabled")

    }


});


$("#newBasicExampleho").change(function (event) {


    open_time = $("#newBasicExampleho").val();


    $("#newSunday #newTso").val(open_time);

    $("#newMonday #newTmo").val(open_time);

    $("#newTuesday #newTto").val(open_time);

    $("#newWednesday #newTwo").val(open_time);

    $("#newThursday #newTtho").val(open_time);

    $("#newFriday #newTfo").val(open_time);

    $("#newSaturday #newTsso").val(open_time);


});


$("#newBasicExamplehc").change(function (event) {


    close_time = $("#newBasicExamplehc").val();


    $("#newSunday #newTsc").val(close_time);

    $("#newMonday #newTmc").val(close_time);

    $("#newTuesday #newTtc").val(close_time);

    $("#newWednesday #newTwc").val(close_time);

    $("#newThursday #newTthc").val(close_time);

    $("#newFriday #newTfc").val(close_time);

    $("#newSaturday #newTssc").val(close_time);


});


$(document).on('change', "[name=number_stamps_2]", function () {

    $("#s_days_2").html("Collect " + this.value);

    logo = parseInt(this.value);

    url = $("#days_logo_2").data("url");

    gift = $("#days_logo_2").data("gift");

    var t = logo % 2;

    ch = $("#ex_2").text();


    if (ch == "1") {

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

            console.log("ok1");

        } else {


            $("#days_logo_2").attr("style", "margin-left:-20px !important");

            $("#days_logo2_2").attr("style", "margin-left:25px !important");

            console.log("ok");

            $("#days_logo2_2").append(`<li class="active"><img  src="${gift}"/></li>`);

        }

    }


});


$(document).on('change', '[name=description_2]', function () {

    console.log('hello');
    if (this.value == "Other") {

        $("#other_2").attr("type", "text");

    } else {

        $("#s_reward_2").html(" stamps to Earn: " + this.value);

        $("#other_2").attr("type", "hidden");


        $("#sel_other_2").val("Other");

        $("#other_2").val("");


    }
});


$(document).on('keyup', "#other_2", function () {

    $("#s_reward_2").html(" stamps to Earn: " + this.value);

    $("#sel_other_2").val(this.value);

});


$(".step2_button").unbind().click(function () {


    var pkg_id = $("#pkg_id").val();

    var url = $("#pkg_form").attr("action");

    $(".error-msg").remove();

    $.ajax({

        url: url, // url where to submit the request

        type: "POST", // type of action POST || GET

        dataType: 'json', // data type

        data: $("#pkg_form").serialize(), // post data || get data

        success: function (result) {


            $("#step2").removeClass("active");

            $("#step2").removeClass("in");

            $("#step2_li").removeClass("active");

            $("#step2_li a").addClass("done");

            $("#step2_li a").attr("data-toggle", "tab");

            $("#step3_li").addClass("active");

            $("#step3").addClass("active");

            $("#step3").addClass("in");


            console.log('business1 show');

            if (result.plan == 2) {
                console.log('in 2 plan');
                $('#business2').hide();
                $('#business3').hide();
                $('#busines1').show();

                $("li#show-step3").show();

                if($('div.main-loyalty-div').length == 2)
                {
                    $('#add_another_image').hide();
                }
                else if($('div.main-loyalty-div').length == 1){
                    $('#add_another_image').show();
                }


            } else {
                $('#business3').hide();
                $('#busines1').show();

                $('#add_another_image').hide();
            }


        },

        error: function (xhr, resp, text) {

            $("body").append("<span class='error-msg'><ol id='ol'></ol></span>");

            var errors = $.parseJSON(xhr.responseText);

            var tc = errors['errors'];


            $.each(tc, function (key, val) {

                $("#ol").append("<li>" + val + "</li>");

            });

            setTimeout(
                function () {

                    $(".error-msg").remove();


                }, 5000);

            console.log(xhr, resp, text);

        }

    })


});


$('[name=new_sunday_open_close]').change(function () {

    selected_value = $("input[name='new_sunday_open_close']:checked").val();


    if (selected_value == "close") {

        $("#newSunday #newTso").attr("disabled", true);

        $("#newSunday #newTsc").attr("disabled", true);


        $("#newSunday .open span").css("color", "#707070");

        $("#newSunday .close span").css("color", "#ffffff");


        $("#newSunday .open span").css("background-color", "#ffffff");


        $("#newSunday .close span").css("background-color", "#FF3D5A");


    } else {


        $("#newSunday #newTso").attr("disabled", false);

        $("#newSunday #newTsc").attr("disabled", false);


        $("#newSunday .open span").css("color", "#ffffff");

        $("#newSunday .close span").css("color", "#707070");


        $("#newSunday .open span").css("background-color", "#4EADEA");


        $("#newSunday .close span").css("background-color", "#ffffff");

    }


});

$('[name=new_monday_open_close]').change(function () {

    selected_value = $("input[name='new_monday_open_close']:checked").val();


    if (selected_value == "close") {


        $("#newMonday #newTmo").attr("disabled", true);

        $("#newMonday #newTmc").attr("disabled", true);


        $("#newMonday .open span").css("color", "#707070");

        $("#newMonday .close span").css("color", "#ffffff");


        $("#newMonday .open span").css("background-color", "#ffffff");


        $("#newMonday .close span").css("background-color", "#FF3D5A");


    } else {


        $("#newMonday .open span").css("color", "#ffffff");

        $("#newMonday .close span").css("color", "#707070");


        $("#newMonday .open span").css("background-color", "#4EADEA");


        $("#newMonday .close span").css("background-color", "#ffffff");


        $("#newMonday #newTmo").attr("disabled", false);

        $("#newMonday #newTmc").attr("disabled", false);

    }


});

$('[name=new_tuesday_open_close]').change(function () {

    selected_value = $("input[name='new_tuesday_open_close']:checked").val();


    if (selected_value == "close") {


        $("#newTuesday #newTto").attr("disabled", true);

        $("#newTuesday #newTtc").attr("disabled", true);


        $("#newTuesday .open span").css("color", "#707070");

        $("#newTuesday .close span").css("color", "#ffffff");


        $("#newTuesday .open span").css("background-color", "#ffffff");


        $("#newTuesday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#newTuesday #newTto").attr("disabled", false);

        $("#newTuesday #newTtc").attr("disabled", false);


        $("#newTuesday .open span").css("color", "#ffffff");

        $("#newTuesday .close span").css("color", "#707070");


        $("#newTuesday .open span").css("background-color", "#4EADEA");


        $("#newTuesday .close span").css("background-color", "#ffffff");


    }


});

$('[name=new_wednesday_open_close]').change(function () {

    selected_value = $("input[name='new_wednesday_open_close']:checked").val();


    if (selected_value == "close") {

        $("#newWednesday #newTwo").attr("disabled", true);

        $("#newWednesday #newTwc").attr("disabled", true);

        $("#newWednesday .open span").css("color", "#707070");

        $("#newWednesday .close span").css("color", "#ffffff");


        $("#newWednesday .open span").css("background-color", "#ffffff");


        $("#newWednesday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#newWednesday #newTwo").attr("disabled", false);

        $("#newWednesday #newTwc").attr("disabled", false);


        $("#newWednesday .open span").css("color", "#ffffff");

        $("#newWednesday .close span").css("color", "#707070");


        $("#newWednesday .open span").css("background-color", "#4EADEA");


        $("#newWednesday .close span").css("background-color", "#ffffff");


    }


});

$('[name=new_thursday_open_close]').change(function () {

    selected_value = $("input[name='new_thursday_open_close']:checked").val();


    if (selected_value == "close") {


        $("#newThursday #newTtho").attr("disabled", true);

        $("#newThursday #newTthc").attr("disabled", true);


        $("#newThursday .open span").css("color", "#707070");

        $("#newThursday .close span").css("color", "#ffffff");


        $("#newThursday .open span").css("background-color", "#ffffff");


        $("#newThursday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#newThursday #newTtho").attr("disabled", false);

        $("#newThursday #newTthc").attr("disabled", false);


        $("#newThursday .open span").css("color", "#ffffff");

        $("#newThursday .close span").css("color", "#707070");


        $("#newThursday .open span").css("background-color", "#4EADEA");


        $("#newThursday .close span").css("background-color", "#ffffff");


    }


});

$('[name=new_friday_open_close]').change(function () {

    selected_value = $("input[name='new_friday_open_close']:checked").val();


    if (selected_value == "close") {

        $("#newFriday input[type=time]").attr("disabled", true);


        $("#newFriday #newTfo").attr("disabled", true);

        $("#newFriday #newTfc").attr("disabled", true);


        $("#newFriday .open span").css("color", "#707070");

        $("#newFriday .close span").css("color", "#ffffff");


        $("#newFriday .open span").css("background-color", "#ffffff");


        $("#newFriday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#newFriday #newTfo").attr("disabled", false);

        $("#newFriday #newTfc").attr("disabled", false);


        $("#newFriday .open span").css("color", "#ffffff");

        $("#newFriday .close span").css("color", "#707070");


        $("#newFriday .open span").css("background-color", "#4EADEA");


        $("#newFriday .close span").css("background-color", "#ffffff");


    }


});

$('[name=new_saturday_open_close]').change(function () {

    selected_value = $("input[name='new_saturday_open_close']:checked").val();


    if (selected_value == "close") {

        $("#newSaturday #newTsso").attr("disabled", true);

        $("#newSaturday #newTssc").attr("disabled", true);


        $("#newSaturday .open span").css("color", "#707070");

        $("#newSaturday .close span").css("color", "#ffffff");


        $("#newSaturday .open span").css("background-color", "#ffffff");


        $("#newSaturday .close span").css("background-color", "#FF3D5A");


    } else {

        $("#newSaturday #newTsso").attr("disabled", false);

        $("#newSaturday #newTssc").attr("disabled", false);


        $("#newSaturday .open span").css("color", "#ffffff");

        $("#newSaturday .close span").css("color", "#707070");


        $("#newSaturday .open span").css("background-color", "#4EADEA");


        $("#newSaturday .close span").css("background-color", "#ffffff");

    }


});

$(".newT input[value=open]").attr("checked", "");

$("#newSunday input[value=close]").attr("checked", "checked");


$('[name=new_open_close]').unbind().change(function () {

    selected_value = $("input[name='new_open_close']:checked").val();

    console.log(selected_value);

    if (selected_value == "close") {

        $("#newBasicExampleho").attr("disabled", true);
        $("#newBasicExamplehc").attr("disabled", true);

        $(".newT input[value=close]").prop("checked", true).change();

        // $("tbody input[value=open]").removeAttr("checked").change();

        $(".newT input[value=open]").prop("checked", false).change();

        $(".newT .open span").css("background-color", "#ffffff");

        $(".newT .open span").css("color", "#707070");


        $(".newT .close span").css("background-color", "#FF3D5A");

        $(".newT .close span").css("color", "#ffffff");

        $(".newT .ui-timepicker-input").attr("disabled", "true");

    } else {

        $("#newBasicExampleho").attr("disabled", false);
        $("#newBasicExamplehc").attr("disabled", false);


        $(".newT input[value=close]").prop("checked", false).change();

        $(".newT input[value=open]").prop("checked", true).change();

        $(".newT .open span").css("background-color", "#4EADEA");


        $(".newT .open span").css("color", "#ffffff");


        $(".newT .close span").css("background-color", "#ffffff");


        $(".newT .close span").css("color", "#707070");


        $(".newT .ui-timepicker-input").removeAttr("disabled")

    }


});






