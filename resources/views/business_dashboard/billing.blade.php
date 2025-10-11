@extends('business_dashboard.master_layout')
@section('title', 'Account Billing')
@section('content')

<div class="billing-page">
  <h2 class="billing-title">Billing</h2>
  <div class="billing-col-main">
    <div class="billing-col">
      <span class="busi-edit"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="icon"></span>
      <div class="payment-method">
        <h2 class="bus-head">Payment Method</h2>
        <span class="payment-card">
          <img src="{{asset('business_dashboard')}}/assets/images/card.svg" alt="no img">
        </span>
        <ul class="card-details">
          <li>****</li>
          <li>****</li>
          <li>****</li>
          <li>3434</li>
        </ul>
      </div>
    </div>


    <div class="billing-col">
      <form id="location-form">
      <span class="busi-edit bus true"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="icon"></span>
      <button type="submit" class="btn btn-success bus-update" style="
                                      padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;" id="location_update">
          ✔
      </button>
      <h2 class="bus-head">Billing Address</h2>
      <div class="bus-outer main1">
        <span id="ad_b">{{$business->business_address}}</span>


      </div>
      <!-- <form style="display:none" id="location-form"> -->
      <div style="display:none" id="location-form-container">
        <input name="id" name="id" value="{{$business->id}}" type="hidden">
        <input type="hidden" name="field" value="business_address" id="loc_field" disabled>
        <input type="hidden" name="table" value="business">


        <input type="text" placeholder="Enter New Address" required class="custom-input" id="input_address" name="address" value="{{$business->business_address}}">
        <!-- <button type="submit" class="btn btn-primary">Update</button> -->
      </div>
      </form>
    </div>

    @if($locations)
      @foreach($locations as $key=>$location)
        @if($key < 1)
          <div class="billing-col">
            <form id="location2-form{{$key}}" class="location2-form" data-id="{{$key}}">
            <span class="busi-edit loc true" id="loc{{$key}}" data-id="{{$key}}"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="icon"></span>
            <button type="submit" class="btn btn-success loc-update" style="
                                            padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;" id="location_update{{$key}}">
                ✔
            </button>
            <h2 class="bus-head">Invoice Address</h2>
            <div class="bus-outer mainloc{{$key}}">
              <span id="ad_b2_{{$key}}">{{$location->address}}</span>

            </div>
            <!-- <form style="display:none" id="location2-form"> -->
            <div style="display:none" id="location{{$key}}-form-container">
              <input name="id" name="id" value="{{$location->id}}" type="hidden">
              <input type="hidden" name="field" value="address" id="loc_field{{$key}}" disabled>
              <input type="hidden" name="table" value="business_details">


              <input type="text" placeholder="Enter New Address" required class="custom-input" value="{{$location->address}}" id="input_address{{$key}}" name="address" onkeypress=" initAutocomplete2(this, {{$key}} )">
              <!-- <button type="submit" class="btn btn-primary">Update</button> -->
            </div>
            </form>
          </div>
        @endif
      @endforeach
    @endif
  </div>
  <!-- <div class="invoice-main">
    <h2>Invoices</h2>
    <ul class="invoice-ul">
      <li>
        <span class="active">
          <img src="{{asset('business_dashboard')}}/assets/images/active2.svg" alt="icon">
          PAID
        </span>
        <span>August 1, 2021</span>
        <span>$14:95</span>
      </li>
      <li>
        <span class="active">
          <img src="{{asset('business_dashboard')}}/assets/images/active2.svg" alt="icon">
          PAID
        </span>
        <span>August 1, 2021</span>
        <span>$14:95</span>
      </li>
      <li>
        <span class="active">
          <img src="{{asset('business_dashboard')}}/assets/images/active2.svg" alt="icon">
          PAID
        </span>
        <span>August 1, 2021</span>
        <span>$14:95</span>
      </li>
    </ul>
  </div> -->
</div>


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=nl&output=json&key={{env('GOOGLE_MAP_KEY')}}" async defer></script>


<script>
  $.ajaxSetup({

    headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

  });




  $(document).ready(function() {
    if ($(window).width() < 991) {
      $(".admin-right").addClass("full-width-side");
      $("#mySidenav").hide(0);
    }
    $("#show-menu").click(function() {
      $("#mySidenav").slideToggle(0);
      if ($(".admin-right").hasClass("full-width-side")) {
        $(".admin-right").removeClass("full-width-side");
      } else {
        $(".admin-right").addClass("full-width-side");
      }
    });

    // show hide pas div
    $(".edit-pasword").click(function() {
      $(".hide-pas").show();
      $(".view-pas, .edit-pasword").hide();
    });


  });

  function initAutocomplete() {

    initAutocomplete1();
    initAutocomplete2();
  }

  function initAutocomplete1() {

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

  function initAutocomplete2(input = null,id = null) {

    // const input = document.getElementById("input_address2");
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

          var parent = document.getElementById("location2-form"+id);
          parent.appendChild(input);
          parent.appendChild(input2);

          //   console.log(results[0].geometry.location.lat());
          //   console.log(results[0].geometry.location.lng());

        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));
    });
  }

  $(".bus").on("click", function() {
    edit = $(".bus").hasClass("true");
    if (edit) {
      $(".bus").removeClass("true");
      $(".main1").css("display", "none");
      $("#location-form-container").css("display", "block");
      $("#input_address").attr("disabled", false);
      $("#loc_field").attr("disabled", false);

    } else {

      $(".bus").addClass("true");
      $(".main1").css("display", "block");
      $("#location-form-container").css("display", "none");
      $("#input_address").attr("disabled", true);
      $("#loc_field").attr("disabled", true);
    }

    $(this).hide();
    $('.bus-update').css('display', 'block');


  });


  $(".loc").on("click", function() {
    edit = $(this).hasClass("true");
    id= $(this).data('id');
    if (edit) {
      $(this).removeClass("true");
      $(".mainloc"+id).css("display", "none");
      $("#location"+id+"-form-container").css("display", "block");
      $("#location"+id+"-form-container #input_address"+id).attr("disabled", false);
      $("#loc_field"+id).attr("disabled", false);

    } else {

      $(this).addClass("true");
      $(".main"+id).css("display", "none");
      //       $(".main1").css("display","block");
      $("#location"+id+"-form-container").css("display", "none");
      $("#location"+id+"-form-container #input_address"+id).attr("disabled", true);
      $("#loc_field"+id).attr("disabled", true);
    }

    $(this).hide();
    $('#location_update'+id).css('display', 'block');
  });

  $("#location-form").on("submit", function() {
    event.preventDefault();
    url = "{{route('update_data')}}";
    id = "location-form";
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#ad_b").html("<p>" + $("#input_address").val() + "</p>");
        $(".main1").css("display", "block");
        $("#location-form-container").css("display", "none");
        $("#input_address").attr("disabled", true);
        $("#loc_field").attr("disabled", true);
        $(".bus").addClass("true");
      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }  
    })
    $('.bus').show();
    $('.bus-update').css('display', 'none');

  }); 
  $(".location2-form").on("submit", function() {
    event.preventDefault();
    form_id = $(this).data('id');
    url = "{{route('update_data')}}";
    id = "location2-form"+form_id;
    $.ajax({
      url: url, // url where to submit the request
      type: "POST", // type of action POST || GET
      dataType: 'json', // data type
      data: $("#" + id).serialize(), // post data || get data
      success: function(result) {
        //   console.log(result);
        $("#ad_b2_"+form_id).text($("#input_address"+form_id).val());
        $(".mainloc"+form_id).css("display", "block");
        $("#location"+form_id+"-form-container").css("display", "none");
        $("#input_address"+form_id).attr("disabled", true);
        $("#location_update"+form_id).attr("disabled", false);
        $("#loc"+form_id).addClass("true");
      },
      error: function(xhr, resp, text) {

        console.log(xhr.responseText);
      }
    })
    $('.loc').show();
    $("#location_update"+form_id).css('display', 'none');

  });
</script>

@endsection