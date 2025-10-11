@extends('business_dashboard.master_layout')
@section('title', 'Locations')
@section('content')


@php
$count=DB::table("business")->join("business_details","business.id","business_details.business_id")
->where("business.user_id",auth()->user()->id)->count();
$o=DB::table("business")
->where("user_id",auth()->user()->id)->first();
@endphp

<div class="row">
   @if (\Session::has('success'))
    <div class="col-md-12">
      <div class="alert alert-success">
          <ul>
              <li>{!! \Session::get('success') !!}</li>
          </ul>
      </div>
    </div>
    @endif
</div>
@php
$location=@$locations[0]; 
$time=@$times[0]; 
@endphp
@foreach(@$locations as $key => $location)
  <div class="row">
     
    <div class="location_1 col-md-4">
        <div class="loc-main">
            <form class="location-form" id="location-form-{{$key}}" data-form-key = "{{$key}}" >
              <span class="edit-img location_update add" id="location_update{{$key}}" data-id="address_{{$key}}" data-key="{{$key}}"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="no img"></span>
              <button type="submit" class="btn btn-success" style="
                                            padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;" id="location_update_{{$key}}">
                ✔
              </button>
              <h2>Location {{$key + 1}}</h2>
              <h2>Address</h2>
              <div id="address-box-{{$key}}" class="loc-summery">
               
                <p>{{@$location->address}}</p>

              </div>
              <!-- <form style="display:none" id="location-form"> -->
              <div style="display:none" id="location-form-container-{{$key}}">
                <input name="id" value="{{$location->id}}" type="hidden">
                <input type="hidden" name="field" value="address" id="loc_field">
                <input type="hidden" name="table" value="business_details">


                <input type="text" placeholder="Enter New Address" required class="custom-input" onkeypress="initAutocomplete1(this)" class="input_address" id="input_address_{{$key}}" data-form-id="{{$key}}" name="address" value="{{@$location->address}}">
                <!-- <button type="submit" class="btn btn-primary">Update</button> -->
              </div>
            </form>
        </div>
        @if($key == 1 || $key == 2)
          <button id="remove_location" data-id="{{encrypt(@$location->id)}}" class="remove-scheme"> Remove Location</button>
        @endif
    </div>
    <div class="location_1 col-md-8">

      @php $time = @$times[$key] @endphp

        <div class="open-table-main">
          <form class="time_table1" id="time_table_{{$key}}"  data-form-id="{{$key}}">

            <span class="edit-img table_time1" id="table_time1{{$key}}" data-id="{{$key}}"><img src="{{asset('business_dashboard')}}/assets/images/edit.svg" alt="no img"></span>
            <button type="submit" class="btn btn-success time_submit1Btn" style="
                                          padding: 2px; font-size: 16px; width: 28px; height: 28px;position: absolute; top: 0; right: 0; cursor: pointer; display:none;" hidden disabled id="time_submit{{$key}}">
              ✔
            </button>

            <h2 class="opening-text">Opening Hours</h2>
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
  @if($o->plan==1) @break; @endif
@endforeach
@if($o->plan==2)
  @if($count<3) 
    <div class="col-md-12">
      <button class="btn btn-primary" data-location-count="{{$count}}" id="add_location">Add Location</button>
    </div>
  @endif
@endif

<!-- Modal -->
<div class="modal fade" id="insert_modal_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-header">Add New Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <style>
        .pac-container {
          z-index: 10000 !important;
        }
      </style>
      <div class="modal-body row">
        <div class="col-md-12">
          <form id="insert_location" action="{{route('add_location')}}" method="POST">
            @csrf
            <input type="hidden" name="business_id" value="{{$o->id}}" <label>Location</label>
            <input type="text" name="address" class="custom-input" onkeypress="insert_location(this)" id="insert_address" autocomplete="off" placeholder="Enter Address" required="required">
            <div class="open-table-main">

              <h2 class="opening-text">Opening Hours</h2>
              <div class="opening-table1">

                <table class="table t1 table-striped">
                  <thead style="background: #F7FAFF;">
                    <tr class="disabled_table" id="auto">

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
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="basicExampleho" value="9:00am">
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
                          <input id="basicExamplehc" value="5:00pm">
                        </span>

                      </th>

                    </tr>
                  </thead>
                  <tbody>

                    <tr class="disabled_table" id="monday">

                      <th scope="row">

                        Monday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" name="monday_open_close1" value="open"><span>Open</span>
 
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
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="tmo" name="monday_open_time1" @if($time[0]['status']=="close" ) disabled @endif @if($time[0]['status']=="open" ) value="{{$time[0]['open_time']}}" @else value="9:00am" @endif required>
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
                          <input id="tmc" name="monday_close_time1" @if($time[0]['status']=="close" ) disabled @endif @if($time[0]['status']=="open" ) value="{{$time[0]['close_time']}}" @else value="5:00pm" @endif required>

                        </span>
                      </td>

                    </tr>

                    <tr class="disabled_table" id="tuesday">

                      <th scope="row">

                        Tuesday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if($time[1]['status']=="open" ) checked @endif name="tuesday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if($time[1]['status']=="close" ) checked @endif name="tuesday_open_close1" value="close"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>
                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="tto" name="tuesday_open_time1" @if($time[1]['status']=="close" ) disabled @endif @if($time[1]['status']=="open" ) value="{{$time[1]['open_time']}}" @else value="9:00am" @endif required>
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
                          <input id="ttc" name="tuesday_close_time1" @if($time[1]['status']=="close" ) disabled @endif @if($time[1]['status']=="open" ) value="{{$time[1]['close_time']}}" @else value="5:00pm" @endif required>
                        </span>

                      </td>

                    </tr>

                    <tr class="disabled_table" id="wednesday">

                      <th scope="row">

                        wednesday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if($time[2]['status']=="open" ) checked @endif name="wednesday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if($time[2]['status']=="close" ) checked @endif value="close" name="wednesday_open_close1"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>
                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="two" name="wednesday_open_time1" @if($time[2]['status']=="close" ) disabled @endif @if($time[2]['status']=="open" ) value="{{$time[2]['open_time']}}" @else value="9:00am" @endif required>
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
                          <input id="twc" name="wednesday_close_time1" @if($time[2]['status']=="close" ) disabled @endif @if($time[2]['status']=="open" ) value="{{$time[2]['close_time']}}" @else value="5:00pm" @endif required>

                        </span>
                      </td>

                    </tr>





                    <tr class="disabled_table" id="thursday">

                      <th scope="row">

                        Thursday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if($time[3]['status']=="open" ) checked @endif name="thursday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if($time[3]['status']=="close" ) checked @endif name="thursday_open_close1" value="close"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>

                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="ttho" name="thrusday_open_time1" @if($time[3]['status']=="close" ) disabled @endif @if($time[3]['status']=="open" ) value="{{$time[3]['open_time']}}" @else value="9:00am" @endif required>

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
                          <input id="tthc" name="thrusday_close_time1" @if($time[3]['status']=="close" ) disabled @endif @if($time[3]['status']=="open" ) value="{{$time[3]['close_time']}}" @else value="5:00pm" @endif required>

                        </span>

                      </td>

                    </tr>





                    <tr class="disabled_table" id="friday">

                      <th scope="row">

                        Friday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if($time[4]['status']=="open" ) checked @endif name="friday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if($time[4]['status']=="close" ) checked @endif name="friday_open_close1" value="close"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>

                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="tfo" name="friday_open_time1" @if($time[4]['status']=="close" ) disabled @endif @if($time[4]['status']=="open" ) value="{{$time[4]['open_time']}}" @else value="9:00am" @endif required>

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
                          <input id="tfc" name="friday_close_time1" @if($time[4]['status']=="close" ) disabled @endif @if($time[4]['status']=="open" ) value="{{$time[4]['close_time']}}" @else value="5:00pm" @endif required>

                        </span>



                      </td>

                    </tr>



                    <tr class="disabled_table" id="saturday">

                      <th scope="row">

                        Saturday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if($time[5]['status']=="open" ) checked @endif name="saturday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if($time[5]['status']=="close" ) checked @endif name="saturday_open_close1" value="close"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>
                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="tsso" name="saturday_open_time1" @if($time[5]['status']=="close" ) disabled @endif @if($time[5]['status']=="open" ) value="{{$time[5]['open_time']}}" @else value="9:00am" @endif required>

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
                          <input id="tssc" @if($time[5]['status']=="close" ) disabled @endif @if($time[5]['status']=="open" ) value="{{$time[5]['close_time']}}" @else value="5:00pm" @endif name="saturday_close_time1" required>

                        </span>

                      </td>

                    </tr>

                    <tr class="disabled_table" id="sunday">

                      <th scope="row">

                        Sunday

                      </th>

                      <td>

                        <div class="custom-radio open">

                          <label>

                            <input type="radio" @if(@$time[6]['status']=="open" ) checked @endif name="sunday_open_close1" value="open"><span>Open</span>

                          </label>

                        </div>



                        <div class="custom-radio closed">

                          <label>

                            <input type="radio" @if(@$time[6]['status']=="close" ) checked @endif value="close" name="sunday_open_close1"><span>Closed</span>

                          </label>

                        </div>

                      </td>

                      <td>
                        <span class="time-picker">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                          </svg>
                          <input id="tso" @if(@$time[6]['status']=="close" ) disabled @endif @if(@$time[6]['status']=="open" ) value="{{$time[6]['open_time']}}" @else value="9:00am" @endif name="sunday_open_time1" required>

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
                          <input id="tsc" @if(@$time[6]['status']=="close" ) disabled @endif @if(@$time[6]['status']=="open" ) value="{{$time[6]['close_time']}}" @else value="5:00pm" @endif name="sunday_close_time1" required>
                        </span>


                      </td>

                    </tr>


                  </tbody>
                </table>

              </div>
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_modal">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=nl&output=json&key={{config('key.GOOGLE_MAP_KEY')}}" async defer></script>

<script>
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



  // $(document).ready(function() {
  //   if ($(window).width() < 991) {
  //     $(".admin-right").addClass("full-width-side");
  //     $("#mySidenav").hide(0);
  //   }
  //   $("#show-menu").click(function() {
  //     $("#mySidenav").slideToggle(0);
  //     if ($(".admin-right").hasClass("full-width-side")) {
  //       $(".admin-right").removeClass("full-width-side");
  //     } else {
  //       $(".admin-right").addClass("full-width-side");
  //     }
  //   });


  });


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

  $(".time_table1").on("submit", function() {
    event.preventDefault();
    var form_id = $(this).data('form-id');
    url = "{{route('update_data')}}";
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
  // end table functions
</script>


@endsection