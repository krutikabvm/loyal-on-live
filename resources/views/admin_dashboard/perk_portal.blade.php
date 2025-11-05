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
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">

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
        /* Custom Toggle Switch Styles */
      .switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
      }

      .switch input {
          opacity: 0;
          width: 0;
          height: 0;
      }

      .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          transition: 0.4s;
          border-radius: 50px; /* Circular edges */
      }

      .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          border-radius: 50px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          transition: 0.4s;
      }

      /* When the switch is checked (enabled), change color to green */
      input:checked + .slider {
          background-color: #4CAF50; /* Green background */
      }

      input:checked + .slider:before {
          transform: translateX(26px); /* Move the slider to the right */
      }

      /* Optional: Add some hover effect */
      .switch:hover .slider {
          background-color: #8bc34a; /* Lighter green when hovered */
      }
    

        ul { list-style-type: disc; }
        .perks-list {
            margin-top: 20px;
            }

            .tabs {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 20px;
            }
            .perk-content {
            display: flex;
            padding: 15px;
            gap: 15px;
            }

            .logo-section {
            /* position: relative; */
            display: flex;
            flex-direction: column;
            align-items: center;
            }

            .perk-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 5px solid #04C764;
            }

            .status-badge {
            /* position: absolute; */
            margin-top: -14px;
            background-color: #4caf50;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 12px;
            }

            .details-section {
            flex: 1;
            }

            .perk-description {
            font-size: 16px;
            font-weight: bold;
            }

            .perk-end-time,
            .perk-created {
            font-size: 14px;
            color: #979797;
            }

            .pin-section {
            text-align: right;
            display:flex
            }

            .pin-number,
            .claimed-number {
            background-color:#525252;
            color:white;
            border-radius:8px;
            padding:4px 8px;
            margin-right:3px;
            }

            .claimed-by-section {
            padding: 15px;
            border-left: 1px solid #ddd;
            }

            .claimed-header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            }

            .claimed-list {
            margin: 0;
            padding: 0;
            list-style: none;
            }

            .claimed-list li {
            font-size: 14px;
            color: #555;
            }

            .action-buttons {
            display: flex;
            justify-content: space-evenly;
            padding: 15px;
            gap:4px
            }

            .btn {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

            .btn.preview {
            background-color: #4caf50;
            color: white;
            }

            .btn.edit {
            background-color: #03a9f4;
            color: white;
            }

            .btn.end {
            background-color: #f44336;
            color: white;
            }
            .box {
            height:8px;
            background:#FF870D;
            box-sizing: content-box;
            /* padding:0 50px; */
            -webkit-mask:
            radial-gradient(circle 3px,#fff 97%, transparent 100%) bottom/9px 200% space content-box,
            linear-gradient(#fff 0 0);
            -webkit-mask-composite:destination-out;
            mask-composite: exclude;
        }

        .box2 {
            height:8px;
            background:#ffb423;
            /* padding:0 50px; */
            -webkit-mask:
            radial-gradient(circle 3px,#fff 97%, transparent 100%) top/9px 200% space content-box,
            linear-gradient(#fff 0 0);
            -webkit-mask-composite:destination-out;
            mask-composite: exclude;
        }
            .ticket-border {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width:100%;
        }
        .perk-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to left, #800080, #FF00FF);
            border-radius: 20px;
            padding: 5px 15px;
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 14px;
            position: relative;
            z-index: 2; /* Ensure the text stays above the wavy border */
            margin: 15px;
        }
        .perk-ongoing-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background: linear-gradient(to left, #0073BC, #009BFF); */
            border-radius: 20px;
            padding: 5px 15px;
            color: white;
            font-weight: bold;
            /* margin-bottom: 10px; */
            font-size: 14px;
            position: relative;
            z-index: 2; /* Ensure the text stays above the wavy border */
            /* margin: 8px; */
        }
        .perk-container {
            background: linear-gradient(to bottom, #FF870D, #FFB523);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* padding: 15px; */
            position: relative;
            overflow: hidden; /* Ensures the decorative top border doesn't overflow */
            /* margin: 0px 40px; */
        }
        .ticketRip{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .circleLeft{
            width: 12px;
            height: 24px;
            background-color: #FFFFFF;
            border-radius: 0 12px 12px 0;
        }
        .ripLine{
            width: 100%;
            border-top: 3px solid #FFFFFF;
            border-top-style: dashed ;
        }
        .circleRight{
            width: 12px;
            height: 24px;
            background-color: #FFFFFF;
            border-radius: 12px 0 0 12px;
        }
        .ticket-shape {
            display: inline-block;
            box-sizing: content-box;
            position: relative;
            height: 10px;
            width: 10px;
            font-size: 16px;
            background-size: 100%;
            background-repeat: no-repeat;
            background-image: radial-gradient(circle at 6px 0, rgba(255,255,255,0) 0.4em, #FF9514 0.3em);
            background-position: top left, top right;
        }
        .perk-ticket {
            background-image: url('/admin_dashboard/assets/images/limited_perk_mobile.png');
            background-size: 100% 100%;
            background-repeat:no-repeat;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            color: #333;
            position: relative;
            overflow: hidden;
        }
        .perk-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to left, #800080, #FF00FF);
            border-radius: 20px;
            padding: 5px 15px;
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 14px;
            position: relative;
            z-index: 2; /* Ensure the text stays above the wavy border */
            margin: 6px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to left, #800080, #FF00FF);
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            margin:7px;
        }
        .weekDays-selector input {
            display: none!important;
        }
        .modal-body{
            padding:0px;
        }

        .weekDays-selector input[type=checkbox] + label {
            display: inline-block;
            border-radius: 20px;
            background: #fec074;
            height: 31px;
            width: 50px;
            margin-right: 3px;
            line-height: 33px;
            text-align: center;
            color:#FF9514;
        }

        .weekDays-selector input[type=checkbox]:checked + label {
        background: #ffffff;
        color: #FF9514;
        }
        .weekDays-selector1 input[type=checkbox] + label {
            height: 30px;
            width: 30px;
            margin-right: 3px;
            line-height: 32px;
        }
        .weekDays-ongoing-selector input {
        display: none!important;
        }

        .weekDays-ongoing-selector input[type=checkbox] + label {
        display: inline-block;
        border-radius: 20px;
        background: #8cc6eb;
        height: 31px;
        width: 50px;
        margin-right: 3px;
        line-height: 33px;
        text-align: center;
        color:#0182D4;
        font-weight: 400;
        }

        .weekDays-ongoing-selector input[type=checkbox]:checked + label {
        background: #ffffff;
        color: #0182D4;
        }
        .weekDays-ongoing-selector1 input[type=checkbox] + label {
            height: 30px;
            width: 30px;
            margin-right: 2px;
            line-height: 32px;
        }
        .bg-orange{
            background-color:#FFB030;
        }

        .bg-blue{
            background-color:#019BFF;
        }
        .ongoingPerk{
            justify-content:end!important;
        }
        @media screen and (max-width: 991px) {
            .modal-data{
                display:block!important;

            }
            .main-modal{
                margin:1px 34px!important;
                justify-items:center!important;
            }
            .modalWidth{
                width:100%!important;
            }
            .modal-width{
                width:89%!important;
                margin:20px;
            }
            .perk-data{
                width:82%!important;
            }
            .dialog{
                margin:10px!important;
            }
            .content{
                width:89%!important;
                margin:0px 11px!important;
            }
            .card-direction{
                margin:0px 28px!important;
            }
        }
        .ended{
            background-color:#FF2055;
        }
        .perk-ended{
            border:5px solid #FF2055;
        }
    </style>
    <div class="busines1-main">

        <div class="switch-field">

            <a href="{{route('admin.business')}}" class="back-btn" style="width:100%">Perks Portal</a>

        </div>

        <div class="business-step1" id="profiles">

            <div class="row sm-hidden xs-hidden" >
                <div style="display:flex;flex-direction:row;gap:8px">
                    <!-- <select class="form-control" style="width:40%">
                        <option>Select business</option>
                    </select> -->
                    <div class="xs-flex sm-flex" style="gap:4px">
                        <a class="btn btn-warning" href="{{route('admin.create_limited_time_perk')}}" style="">Create Limited time Perk</a>
                        <a class="btn btn-primary" href="{{route('admin.create_ongoing_perk')}}" style="">Create Ongoing Perk</a>
                    </div>
                </div>
                
            </div>
            <div class="hidden xs-flex sm-flex" style="gap:4px;flex-direction:column">
                <!-- <select class="form-control">
                    <option>Select business</option>
                </select> -->
                <div class="xs-flex sm-flex" style="gap:4px">
                    <a class="btn btn-warning" href="{{route('admin.create_limited_time_perk')}}" style="margin-top:12px">Create Limited time Perk</a>
                    <a class="btn btn-primary" href="{{route('admin.create_ongoing_perk')}}" style="margin-top:12px">Create Ongoing Perk</a>
                </div>
                
            </div> 
            <div class="row" style="padding:6px">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" href="#all" role="tab">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#limited_time_perk" role="tab">Limited Time Perks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ongoing_perks" role="tab">Ongoing Perks</a>
                    </li>
                
                </ul>
                <div class="tab-content" style="padding:12px">
                    <div class="tab-pane active" id="all" role="tabpanel">
                        @forelse($limitedPerks as $limitedPerk)
                            <div style="border-radius:12px;background-color:white;margin-bottom:20px">
                                <div class="{{$limitedPerk->type  == 'ongoing perk' ? 'bg-blue' :'bg-orange'}} " style="color:white;padding:4px 16px;border-radius:12px 12px 0 0;font-weight:bold">
                                    @if($limitedPerk->type == 'ongoing perk')
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="16" height="16" fill="url(#pattern0_14_9932)"/>
                                        <defs>
                                        <pattern id="pattern0_14_9932" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_14_9932" transform="scale(0.01)"/>
                                        </pattern>
                                        <image id="image0_14_9932" width="100" height="100" xlink:href="data:image/png;base64,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"/>
                                        </defs>
                                    </svg>
                                    @else
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.15333 0.624961C5.32229 0.389802 5.69535 0.508634 5.69535 0.797622V5.81176H8.70067C8.94374 5.81176 9.08509 6.08487 8.9438 6.28152L3.84671 13.375C3.67769 13.6102 3.30468 13.4914 3.30468 13.2024V8.18821H0.299356C0.0562968 8.18821 -0.0850874 7.91515 0.0561893 7.7185L5.15333 0.624961Z" fill="white"/>
                                        </svg>
                                    @endif
                                    {{$limitedPerk->type}} - {{$limitedPerk->business->business_name}}
                                </div>


                                
                            
                                <div class="xs-block" style="display:flex">
                                    <div class="perk-content xs-w-full" style="width:70%">
                                        <div class="logo-section">
                                                @if($limitedPerk->business->image)
                                                <div><img src="{{url('/'.$limitedPerk->business->image)}}" alt="Cafe Elite" class="perk-logo perk-{{$limitedPerk->perkStatus}}" ></div>
                                                @else
                                                <div><img src="{{asset('admin_dashboard/assets/images/cafe.png') }}" class="perk-logo perk-{{$limitedPerk->perkStatus}}" alt="no img"></div>
                                                @endif
                                                <div class="status-badge {{$limitedPerk->perkStatus}}">{{ ucfirst($limitedPerk->perkStatus) }}</div>
                                        </div>
                                        <div class="details-section">
                                            <p class="perk-end-time xs-flex xs-justify-content">Description<img src="{{asset('admin_dashboard\assets\images\preview.png')}}" class="openModalsButton hidden xs-block"  data-id="{{$limitedPerk->id}}"></p>
                                        <p class="perk-description">{{$limitedPerk->description}}</p>
                                        @if($limitedPerk->type == "limited perk")
                                        <p class="perk-end-time">Scheduled to end:</p>
                                        <p class="perk-description"> 
                                            <strong>
                                                {{ $limitedPerk->formatted_expiration_date }}
                                            </strong>
                                        </p>
                                        @else
                                        <p class="perk-end-time">Claimed:</p>
                                        <p class="perk-description"> 
                                            <strong>{{$limitedPerk->perk_users_count}}
                                            </strong>
                                        </p>
                                        @endif
                                        <p class="perk-created xs-hidden">Created:</p>
                                        <p class="perk-description xs-hidden"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>

                                        @if ($limitedPerk->end_date)
                                            <p class="perk-created xs-hidden">Ended:</p>

                                            <p class="perk-description xs-hidden">
                                                <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                            </p>
                                        @endif
                                        </div>
                                        <div class="xs-hidden {{$limitedPerk->type == 'ongoing perk' ?'ongoingPerk' :''}}" style="display:flex;flex-direction: column;justify-content: space-between">
                                           @if($limitedPerk->type != 'ongoing perk')
                                            <div class="pin-section" style="justify-content: space-around">
                                                <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">Pin<span class="pin-number">{{$limitedPerk->pin}}</span></div>
                                                <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">Claimed 
                                                    <div style="display:flex;align-items: center;"><span class="claimed-number">{{$limitedPerk->perk_users_count}}</span> Of {{$limitedPerk->limit}}</div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="action-buttons">
                                                @if($limitedPerk->perkStatus == 'ended')
                                                    <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                                @else
                                                <button class="btn preview openModalsButton" data-id="{{$limitedPerk->id}}"
                                                >Preview Perk</button>
                                                @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)
                                                <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Edit Perk</a>
                                                @endif
                                                <button class="btn btn-danger btn-sm endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}">
                                                End Perk
                                                
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="hidden xs-flex" style="display:flex;flex-direction: column;justify-content: space-between;border-bottom:1px solid #ddd">
                                        <div class="pin-section" style="gap:15px">
                                            @if($limitedPerk->type != 'ongoing perk')
                                            <div style="display:flex;flex-direction:column;text-align:left;align-items:center;width:30%" class="perk-end-time">Pin<span class="pin-number">{{$limitedPerk->pin}}</span></div>
                                            <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">
                                                Claimed 
                                                <div style="display:flex;align-items: center;color:black"><span class="claimed-number">{{$limitedPerk->perk_users_count}}</span> Of {{$limitedPerk->limit}}</div>
                                                <div>
                                                    <p class="perk-created ">Created:</p>
                                                    <p class="perk-description" style="color:black"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                                </div>
                                                @if ($limitedPerk->end_date)
                                                <div>
                                                    <p class="perk-created ">Ended:</p>

                                                    <p class="perk-description">
                                                        <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                                    </p>
                                                </div>  
                                                @endif

                                            </div>
                                            @else
                                            <div style="display:flex;flex-direction:column;text-align:left;align-items:center;width:30%" class=""></div>
                                            <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">
                                                <div>
                                                <p class="perk-created ">Created:</p>
                                                    <p class="perk-description" style="color:black"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                                </div>
                                                @if ($limitedPerk->end_date)
                                                <div>
                                                    <p class="perk-created ">Ended:</p>

                                                    <p class="perk-description">
                                                        <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                                    </p>
                                                </div>  
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="action-buttons">

                                            @if($limitedPerk->perkStatus == 'ended')
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                            @else
                                            <!-- <button class="btn preview openModalsButton">Preview Perk</button> -->
                                            @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Edit Perk</a>
                                            @endif

                                            <button class="btn end endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}"
                                            style="border: 2px solid #f44336;background-color: white;color:#f44336;width:100%">
                                                End Perk
                                            </button>
                                            @endif
                                            <!-- <button class="btn end" style="border: 2px solid #f44336;background-color: white;color:#f44336;width:100%">End Perk</button> -->
                                        </div>
                                    </div>
                                    <div class="claimed-by-section xs-w-full" style="width:30%;border:0px">
                                        <p class="claimed-header">Perk claimed by</p>

                                        <div style="display:flex;justify-content: space-between">
                                            <div class="perk-end-time">User</div>
                                            <div class="perk-end-time">Date and time</div>
                                        </div>
                                        <div >
                                            <div>
                                            @foreach($limitedPerk->perkUsers as $perk)
                                            <div style="display:flex;justify-content: space-between">
                                                <div>{{$perk->user->name}}</div>
                                                <div>{{$perk->created_at->format('d/m/Y, H:m')}}</div>
                                            </div>
                                            @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No perks running at this time.....select ‘Create Limited time perk’ or ‘Create Ongoing Perk’ option above. </p>
                        @endforelse
                        <!-- <p>No perks running at this time.....select ‘Create Limited time perk’ or ‘Create Ongoing Perk’ option above. </p> -->
                    
                    </div>
                    <div class="tab-pane" id="limited_time_perk" role="tabpanel">
                        @forelse($limitedPerks as $limitedPerk)
                            @if($limitedPerk->type == 'limited perk')
                            <div style="border-radius:12px;background-color:white;margin-bottom:20px">
                                <div class="{{$limitedPerk->type  == 'ongoing perk' ? 'bg-blue' :'bg-orange'}} " style="color:white;padding:4px 16px;border-radius:12px 12px 0 0;font-weight:bold">
                                   
                                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.15333 0.624961C5.32229 0.389802 5.69535 0.508634 5.69535 0.797622V5.81176H8.70067C8.94374 5.81176 9.08509 6.08487 8.9438 6.28152L3.84671 13.375C3.67769 13.6102 3.30468 13.4914 3.30468 13.2024V8.18821H0.299356C0.0562968 8.18821 -0.0850874 7.91515 0.0561893 7.7185L5.15333 0.624961Z" fill="white"/>
                                    </svg>
                                    {{$limitedPerk->type}} - {{$limitedPerk->business->business_name}}
                                </div>
                                <div class="xs-block" style="display:flex">
                                    <div class="perk-content xs-w-full" style="width:70%">
                                        <div class="logo-section">
                                            @if($limitedPerk->business->image)
                                                <div><img src="{{url('/'.$limitedPerk->business->image)}}" alt="Cafe Elite" class="perk-logo perk-{{$limitedPerk->perkStatus}}" ></div>
                                                @else
                                                <div><img src="{{asset('admin_dashboard/assets/images/cafe.png') }}" class="perk-logo perk-{{$limitedPerk->perkStatus}}" alt="no img"></div>
                                                @endif
                                                <div class="status-badge {{$limitedPerk->perkStatus}}">{{ ucfirst($limitedPerk->perkStatus) }}</div>
                                        </div>
                                        <div class="details-section">
                                            <p class="perk-end-time xs-flex xs-justify-content">Description<img src="{{asset('admin_dashboard\assets\images\preview.png')}}" class="openModalsButton hidden xs-block"  data-id="{{$limitedPerk->id}}"></p>
                                        <p class="perk-description">{{$limitedPerk->description}}</p>
                                        <p class="perk-end-time">Scheduled to end:</p>
                                        <p class="perk-description">
                                            <strong>
                                                {{ $limitedPerk->formatted_expiration_date }}
                                            </strong>
                                        </strong></p>
                                        <p class="perk-created xs-hidden">Created:</p>
                                        <p class="perk-description xs-hidden"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                        @if ($limitedPerk->end_date)
                                            <p class="perk-created xs-hidden">Ended:</p>

                                            <p class="perk-description xs-hidden">
                                                <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                            </p>
                                        @endif
                                        </div>
                                        <div class="xs-hidden" style="display:flex;flex-direction: column;justify-content: space-between">
                                            <div class="pin-section" style="justify-content: space-around">
                                                <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">Pin<span class="pin-number">{{$limitedPerk->pin}}</span></div>
                                                <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">Claimed 
                                                    <div style="display:flex;align-items: center;"><span class="claimed-number">{{$limitedPerk->perk_users_count}}</span> Of {{$limitedPerk->limit}}</div>
                                                </div>
                                            </div>
                                            <div class="action-buttons">
                                                @if($limitedPerk->perkStatus == 'ended')
                                                    <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                                @else  
                                                <button class="btn preview openModalsButton" data-id="{{$limitedPerk->id}}"
                                                >Preview Perk</button>
                                                @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)
                                                <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Edit Perk</a>
                                                @endif
                                                <button class="btn btn-danger btn-sm endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}">
                                                End Perk
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="hidden xs-flex" style="display:flex;flex-direction: column;justify-content: space-between;border-bottom:1px solid #ddd">
                                        <div class="pin-section" style="gap:15px">
                                            <div style="display:flex;flex-direction:column;text-align:left;align-items:center;width:30%" class="perk-end-time">Pin<span class="pin-number">{{$limitedPerk->pin}}</span></div>
                                            <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">
                                                Claimed 
                                                <div style="display:flex;align-items: center;;color:black"><span class="claimed-number">{{$limitedPerk->perk_users_count}}</span> Of {{$limitedPerk->limit}}</div>
                                                <div>
                                                    <p class="perk-created ">Created:</p>
                                                    <p class="perk-description" style="color:black"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                                </div>
                                                @if ($limitedPerk->end_date)
                                                <div>
                                                    <p class="perk-created ">Ended:</p>

                                                    <p class="perk-description">
                                                        <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                                    </p>
                                                    </div>
                                                @endif
                            
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="action-buttons">
                                            @if($limitedPerk->perkStatus == 'ended')
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                            @else
                                            @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)

                                            <!-- <button class="btn preview openModalsButton">Preview Perk</button> -->
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}"> Edit Perk</a>
                                            @endif
                                            <button class="btn end endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}"
                                            style="border: 2px solid #f44336;background-color: white;color:#f44336;width:100%">
                                                End Perk
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="claimed-by-section xs-w-full" style="width:30%;border:0px">
                                        <p class="claimed-header">Perk claimed by</p>

                                        <div style="display:flex;justify-content: space-between">
                                            <div class="perk-end-time">User</div>
                                            <div class="perk-end-time">Date and time</div>
                                        </div>
                                        <div >
                                            <div>
                                            @foreach($limitedPerk->perkUsers as $perk)
                                            <div style="display:flex;justify-content: space-between">
                                                <div>{{$perk->user->name}}</div>
                                                <div>{{$perk->created_at->format('d/m/Y, H:m')}}</div>
                                            </div>
                                            @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <p>No perks running at this time.....select ‘Create Limited time perk’ or ‘Create Ongoing Perk’ option above. </p>
                        @endforelse
                    </div>
                    <div class="tab-pane" id="ongoing_perks" role="tabpanel">
                    @forelse($limitedPerks as $limitedPerk)
                            @if($limitedPerk->type == 'ongoing perk')
                            <div style="border-radius:12px;background-color:white;margin-bottom:20px">
                                <div class="{{$limitedPerk->type  == 'ongoing perk' ? 'bg-blue' :'bg-orange'}} " style="color:white;padding:4px 16px;border-radius:12px 12px 0 0;font-weight:bold">
                                   
                                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.15333 0.624961C5.32229 0.389802 5.69535 0.508634 5.69535 0.797622V5.81176H8.70067C8.94374 5.81176 9.08509 6.08487 8.9438 6.28152L3.84671 13.375C3.67769 13.6102 3.30468 13.4914 3.30468 13.2024V8.18821H0.299356C0.0562968 8.18821 -0.0850874 7.91515 0.0561893 7.7185L5.15333 0.624961Z" fill="white"/>
                                    </svg>
                                    {{$limitedPerk->type}} - {{$limitedPerk->business->business_name}}
                                </div>
                            
                                <div class="xs-block" style="display:flex">
                                    <div class="perk-content xs-w-full" style="width:70%">
                                        <div class="logo-section">
                                        @if($limitedPerk->business->image)
                                            <div><img src="{{url('/'.$limitedPerk->business->image)}}" alt="Cafe Elite" class="perk-logo perk-{{$limitedPerk->perkStatus}}" ></div>
                                            @else
                                            <div><img src="{{asset('admin_dashboard/assets/images/cafe.png') }}" class="perk-logo perk-{{$limitedPerk->perkStatus}}" alt="no img"></div>
                                            @endif
                                            <div class="status-badge {{$limitedPerk->perkStatus}}">{{ ucfirst($limitedPerk->perkStatus) }}</div>
                                        </div>
                                        <div class="details-section">
                                            <p class="perk-end-time xs-flex xs-justify-content">Description<img src="{{asset('admin_dashboard\assets\images\preview.png')}}" class="openModalsButton hidden xs-block"  data-id="{{$limitedPerk->id}}"></p>
                                        <p class="perk-description">{{$limitedPerk->description}}</p>
                                        <p class="perk-end-time">Claimed:</p>

                                        <p class="perk-description"> <strong>{{$limitedPerk->perk_users_count}}
                                            </strong></p>
                                        <p class="perk-created xs-hidden">Created:</p>
                                        <p class="perk-description xs-hidden"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                        @if ($limitedPerk->end_date)
                                            <p class="perk-created xs-hidden">Ended:</p>

                                            <p class="perk-description xs-hidden">
                                                <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                            </p>
                                        @endif
                                        </div>
                                        <div class="xs-hidden" style="display:flex;flex-direction: column;justify-content: end">
                                            
                                            <div class="action-buttons">
                                                @if($limitedPerk->perkStatus == 'ended')
                                                    <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                                @else
                                                <button class="btn preview openModalsButton" data-id="{{$limitedPerk->id}}"
                                                >Preview Perk</button>
                                                @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)
                                                <a class="btn edit" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Edit Perk</a>
                                                @endif
                                                <button class="btn btn-danger btn-sm endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}">
                                                End Perk
                                                </button>   
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="hidden xs-flex" style="display:flex;flex-direction: column;justify-content: space-between;border-bottom:1px solid #ddd">
                                        <div class="pin-section" style="gap
                                        
                                        :15px">
                                            <div style="display:flex;flex-direction:column;text-align:left;align-items:center;width:30%" class="perk-end-time"></span></div>
                                            <div style="display:flex;flex-direction:column;text-align:left" class="perk-end-time">
                                                <div>
                                                <p class="perk-created ">Created:</p>
                                                <p class="perk-description" style="color:black"> <strong>{{$limitedPerk->updated_at->format('d/m/Y')}}</strong></p>
                                                </div>
                                                @if ($limitedPerk->end_date)
                                                <div>
                                                    <p class="perk-created ">Ended:</p>

                                                    <p class="perk-description">
                                                        <strong> {{ \Carbon\Carbon::parse($limitedPerk->end_date)->format('d-m-Y H:i:s') }}</strong>
                                                    </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="action-buttons">
                                            @if($limitedPerk->perkStatus == 'ended')
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Run Perk Again</a>
                                            @else
                                            <!-- <button class="btn preview openModalsButton">Preview Perk</button> -->
                                            @if($limitedPerk->perk_users_count == null && $limitedPerk->perk_users_count == 0)
                                            <a class="btn edit" style="border: 2px solid #03a9f4;background-color: white;color:#03a9f4;width:100%" href="{{route('admin.edit_ongoing_perk',$limitedPerk->id)}}">Edit Perk</a>
                                            @endif
                                            <button class="btn endPerkModal" data-bs-toggle="modal" data-bs-target="#endPerkModal" data-id="{{ $limitedPerk->id }}"
                                            style="border: 2px solid #f44336;background-color: white;color:#f44336;width:100%">
                                                End Perk
                                            </button>
                                        
                                            @endif
                                        </div>
                                    </div>
                                    <div class="claimed-by-section xs-w-full" style="width:30%;border:0px">
                                        <p class="claimed-header">Perk claimed by</p>

                                        <div style="display:flex;justify-content: space-between">
                                            <div class="perk-end-time">User</div>
                                            <div class="perk-end-time">Date and time</div>
                                        </div>
                                        <div >
                                            <div>
                                            @foreach($limitedPerk->perkUsers as $perk)
                                            <div style="display:flex;justify-content: space-between">
                                                <div>{{$perk->user->name}}</div>
                                                <div>{{$perk->created_at->format('d/m/Y, H:m')}}</div>
                                            </div>
                                            @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                            <p>No perks running at this time.....select ‘Create Limited time perk’ or ‘Create Ongoing Perk’ option above. </p>
                        @endforelse
                    
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <div class="modal fade" id="modal1" tabindex="-1" aria-hidden="false" aria-modal="true" role="dialog"  data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-data"  style="display:flex;align-items: center;justify-content: center">
            <div class="modal-dialog main-modal" style="margin: 30px 60px;justify-items: end;">
                <div class="modal-content modalWidth" style="width:84%">
                
                    <div class="modal-body">
                        <div class="" style="display:flex;align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                            <div style="width:100%">
                                <div style="display:flex;justify-content: space-between">
                                    <h4 style="font-weight:bold">Deal Tile Preview:</h3>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                                <div>
                                    
                                    <div class="perk-ticket">
                                        <div class="header">
                                            <span class="perk-text" style="display:flex;align-items:center;gap:2px;font-size: 10.48px;">
                                                <svg style="" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.242188" y="0.378906" width="15.7263" height="15.7263" rx="7.86316" fill="white"/>
                                                <path d="M8.45336 4.32339C8.54337 4.17884 8.74212 4.25189 8.74212 4.42953V7.51169H10.3432C10.4726 7.51169 10.5479 7.67957 10.4727 7.80045L7.75728 12.1608C7.66724 12.3053 7.46852 12.2323 7.46852 12.0547V8.97247H5.86749C5.738 8.97247 5.66268 8.80463 5.73794 8.68375L8.45336 4.32339Z" fill="#E301E7"/>
                                                </svg> 
                                                Limited time perk
                                            </span>
                                            <span class="timer time" style="font-size: 11.79px;">01h 23m 05s</span>
                                        </div>
                                        <div class="content" style="margin-top: 42px; margin-left: 12px;margin-right: 12px;">
                                            <h3 style="color:white;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;line-height:20px" class="title">Buy 1 Large Ice cream get one free!</h3>
                                            
                                            <div style="text-align:left;margin-top: 30px;margin-bottom: 16px;">
                                            <span class="est hidden" style="font-size:10px;color:white;text-align:left;">Est Saving <span style="color:white" class="est_saving">£2.50</span></span>
                                            <span class="min hidden" style="font-size:10px;color:white;text-align:left;">Min spend <span style="color:white" class="min_spend">£100.00</span></span>
                                            </div>
                                        
                                            <div style="color:white;text-align:left;font-size:10px;margin-top:12px">Available: 
                                                <span class="availableTime" style="font-weight:bold">14:00am to 17:00pm </span>
                                            </div>
                                            
                                            <div class="weekDays-selector" style="margin-top:10px;display: flex;justify-content: space-between;">
                                                <input type="checkbox" id="weekday-mon" class="weekday" data-day="Mon"/>
                                                <label >M</label>
                                                <input type="checkbox" id="weekday-tue" class="weekday" data-day="Tue"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-wed" class="weekday" data-day="Wed" />
                                                <label>W</label>
                                                <input type="checkbox" id="weekday-thu" class="weekday" data-day="Thu"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-fri" class="weekday" data-day="Fri"/>
                                                <label>F</label>
                                                <input type="checkbox" id="weekday-sat" class="weekday" data-day="Sat"/>
                                                <label>S</label>
                                                <input type="checkbox" id="weekday-sun" class="weekday" data-day="Sun"/>
                                                <label>S</label>
                                            </div>
                                            <button style="background-color:white;border-radius:15px;color:#FF3D5A;border-color:white;width:100%;padding:6px;margin-top:10px;border-bottom:white;border-right:white;"><span style="font-weight:bold">Claim Perk </span>  Only <span class="limit_avilable">10 </span> available!</button>

                                        </div>

                                    </div>
                                
                                </div>
                            
                                
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;flex-direction: column;">
                <div class="modal-dialog" style="">
                    <div class="modal-content modal-width" style="width:70%">
        
                        <div class="modal-body">
                            <div class=" " style="display:flex;align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                            <div style="width:100%">
                                <div style="display:flex;justify-content: space-between">
                                    <h4 style="font-weight:bold">What customer sees when they tap the perk in the app:</h3>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                                <div style="background-color:#fafbff;display:flex;flex-direction:column;align-items:center">
                                <div class="perk-ticket perk-data" style="background-image: url('/admin_dashboard/assets/images/mask_group_1.png');margin-top:16px;padding:10px;width:72%">
                                        <div class="header" style="margin:5px 8px">
                                            <span class="perk-text" style="display:flex;align-items:center;gap:2px;font-size: 10.48px;">
                                                <svg style="" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.242188" y="0.378906" width="15.7263" height="15.7263" rx="7.86316" fill="white"/>
                                                <path d="M8.45336 4.32339C8.54337 4.17884 8.74212 4.25189 8.74212 4.42953V7.51169H10.3432C10.4726 7.51169 10.5479 7.67957 10.4727 7.80045L7.75728 12.1608C7.66724 12.3053 7.46852 12.2323 7.46852 12.0547V8.97247H5.86749C5.738 8.97247 5.66268 8.80463 5.73794 8.68375L8.45336 4.32339Z" fill="#E301E7"/>
                                                </svg> 
                                                Limited time perk
                                            </span>
                                            <span class="timer time" style="font-size: 11.79px;">01h 23m 05s</span>
                                        </div>

                                        <div class="content"  style=" margin-top: 42px;margin-left: 12px;margin-right: 12px;margin-bottom:12px">
                                            <h3 style="color:white;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;line-height:20px" class="title">Buy 1 Large Ice cream get one free!</h3>
                                            <div style="text-align:left;margin-top: 88px;margin-bottom: 16px;">
                                            <span class="est hidden" style="font-size:10px;color:white;text-align:left;">Est Saving <span style="color:white" class="est_saving">£-</span></span>
                                            <span class="min hidden" style="font-size:10px;color:white;text-align:left;">Min spend <span style="color:white" class="min_spend">£-</span></span>
                                            </div>
                                            <div style="color:white;text-align:left;font-size:10px">Available:
                                                <span class="availableTime" style="font-weight:bold"> During operating Hours</span>
                                            </div>


                                            <div class="weekDays-selector weekDays-selector1" style="margin-top:12px;margin-bottom:16px;display: flex;justify-content: space-between;">
                                                <input type="checkbox" id="weekday-mon" class="weekday" data-day="Mon"/>
                                                <label >M</label>
                                                <input type="checkbox" id="weekday-tue" class="weekday" data-day="Tue"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-wed" class="weekday" data-day="Wed" />
                                                <label>W</label>
                                                <input type="checkbox" id="weekday-thu" class="weekday" data-day="Thu"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-fri" class="weekday" data-day="Fri"/>
                                                <label>F</label>
                                                <input type="checkbox" id="weekday-sat" class="weekday" data-day="Sat"/>
                                                <label>S</label>
                                                <input type="checkbox" id="weekday-sun" class="weekday" data-day="Sun"/>
                                                <label>S</label>
                                            </div>

                                        </div>

                            </div>
                            
                            <div style="margin:26px">
                                <div class="">
                                    <h4 style="font-weight:bold">How to claim:</h4>
                                    <ul style="list-style-type:auto;margin:12px!important">
                                        <li> Go to <a>(Business name)</a></li>
                                        <li> Show this Screen to staff on arrival</li>
                                        <li> Input pin given by venue below</li>
                                    </ul>

                                    <div style="display:flex;gap:8px;margin:0px 80px">
                                        <input style="width:40%" type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                                        <input style="width:40%" type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                                        <input style="width:40%" type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                                    
                                        <input style="width:40%" type="tel" maxlength="1" pattern="[0-9]" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div style="padding:36px 26px 20px 26px" class="xs-hidden">Limited Time perks are subject to <a>Terms and condition</a></div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-dialog dialog" style="margin:0">
                    <div class="modal-content content" style="width:72%">
                        <div class="modal-header" style="border-bottom:0px">
                            <h5 class="modal-title" style="display:flex;align-items:center;gap:6px">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.97583 15.45C9.69963 15.45 9.47583 15.2261 9.47583 14.95V9.08643C9.47583 8.81023 9.69963 8.58643 9.97583 8.58643H11.018C11.2942 8.58643 11.518 8.81023 11.518 9.08643V14.95C11.518 15.2261 11.2942 15.45 11.018 15.45H9.97583Z" fill="#0188DF"/>
                                <path d="M10.5018 7.13703C10.1982 7.13703 9.93767 7.03635 9.72037 6.835C9.50617 6.63046 9.39917 6.38596 9.39917 6.10151C9.39917 5.82026 9.50617 5.57897 9.72037 5.37762C9.93767 5.17307 10.1982 5.0708 10.5018 5.0708C10.8054 5.0708 11.0643 5.17307 11.2784 5.37762C11.4958 5.57897 11.6044 5.82026 11.6044 6.10151C11.6044 6.38596 11.4958 6.63046 11.2784 6.835C11.0643 7.03635 10.8054 7.13703 10.5018 7.13703Z" fill="#0188DF"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5 10.5C20.5 16.0228 16.0228 20.5 10.5 20.5C4.97715 20.5 0.5 16.0228 0.5 10.5C0.5 4.97715 4.97715 0.5 10.5 0.5C16.0228 0.5 20.5 4.97715 20.5 10.5ZM18.5 10.5C18.5 14.9183 14.9183 18.5 10.5 18.5C6.08172 18.5 2.5 14.9183 2.5 10.5C2.5 6.08172 6.08172 2.5 10.5 2.5C14.9183 2.5 18.5 6.08172 18.5 10.5Z" fill="#0188DF"/>
                                </svg>

                                T&Cs
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div style="margin:6px">
                                <ul class="terms" style="margin-left: 18px!important;padding-left: 1em!important;">
                                    <li>Can only be used by one person</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="modal fade" id="modal2" tabindex="-1" aria-hidden="false" aria-modal="true" role="dialog"  data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-data"  style="display:flex;align-items: center;justify-content: center">
            <div class="modal-dialog main-modal" style="margin: 30px 60px;justify-items: end;">
                <div class="modal-content modalWidth" style="width:90%">
                
                    <div class="modal-body">
                        <div class="" style="display:flex;align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                            <div style="width:100%">
                                <div style="display:flex;justify-content: space-between">
                                    <h4 style="font-weight:bold">Deal Tile Preview:</h3>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="box" style="background-color:#0a95fd"></div>
                                    <div class="perk-container" style="background: linear-gradient(to bottom, #009BFF, #0073BC)">
                                    <div class="perk-ongoing-header">
                                        <span class="perk-text" style="display:flex;align-items:center;gap:2px;color:#199CF1;background-color:white;border-radius:20px;padding:8px;font-size:8px">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="12" height="12" rx="6" fill="#199CF1"/>
                                        <rect x="2" y="2" width="8" height="8" fill="url(#pattern0_14_7977)"/>
                                        <defs>
                                        <pattern id="pattern0_14_7977" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_14_7977" transform="scale(0.01)"/>
                                        </pattern>
                                        <image id="image0_14_7977" width="100" height="100" xlink:href="data:image/png;base64,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"/>
                                        </defs>
                                        </svg>

                                        perk
                                        </span>
                                        <span class="timer uses_per_month" style="border:2px solid white;border-radius:20px;padding:6px;font-size:8px">3 uses per month</span>
                                    </div>

                                        <div class="ticketRip">
                                            <div class="circleLeft"></div>
                                            <div class="ripLine"></div>
                                            <div class="circleRight"></div>
                                        </div>

                                        <div style=" margin: 12px;">
                                            <h3 class="description" style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;margin-top:8px;margin-bottom:18px">10% OFF your Bill</h3>
                                            <div style="text-align:left;margin-top: 30px;margin-bottom: 10px;">
                                            <span class="est hidden" style="font-size:8px;color:white;text-align:left;">Est Saving <span style="color:white" class="est_saving">£2.50</span></span>
                                            <span class="min hidden" style="font-size:8px;color:white;text-align:left;">Min spend <span style="color:white" class="min_spend">£100.00</span></span>
                                            </div>
                                            <div style="color:#ffffff;text-align:left;font-size:8px">Available:<span class="availableTime" style="font-weight:bold">During operating hours</span></div>


                                            <div class="weekDays-ongoing-selector" style="margin-top:10px;display: flex;justify-content: space-between;gap:2px;margin-top:4px">
                                                <input type="checkbox" id="weekday-mon" class="weekday" data-day="Mon"/>
                                                <label >M</label>
                                                <input type="checkbox" id="weekday-tue" class="weekday" data-day="Tue"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-wed" class="weekday" data-day="Wed" />
                                                <label>W</label>
                                                <input type="checkbox" id="weekday-thu" class="weekday" data-day="Thu"/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-fri" class="weekday" data-day="Fri"/>
                                                <label>F</label>
                                                <input type="checkbox" id="weekday-sat" class="weekday" data-day="Sat"/>
                                                <label>S</label>
                                                <input type="checkbox" id="weekday-sun" class="weekday" data-day="Sun"/>
                                                <label>S</label>
                                            </div>
                                            <button style="background-color:white;border-radius:15px;color:#FF3D5A;border-color:white;width:100%;padding:6px;margin-top:12px;font-size:10px;font-weight:bold;border-bottom:white;border-right:white;">Claim Perk</button>

                                        </div>

                                    </div>
                                    <div class="box2" style="background-color:#0074bf">
                                    </div>
                                </div>
                            
                                
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;flex-direction: column;">
                <div class="modal-dialog" style="">
                    <div class="modal-content modal-width" style="width:70%">
        
                        <div class="modal-body">
                            <div class=" " style="display:flex;align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                            <div style="width:100%">
                                <div style="display:flex;justify-content: space-between">
                                    <h4 style="font-weight:bold">What customer sees when they tap the perk in the app:</h3>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                                <div style="background-color:#fafbff">
                                <div class="card-direction" style="display:flex;flex-direction:column;width:80%;margin: 0px 40px;padding-top:20px">
                                <div class="box" style="background-color:#0a95fd">
                                </div>
                                <div class="perk-container" style="background: linear-gradient(to bottom, #009BFF, #0073BC)">
                                    <div class="perk-ongoing-header">
                                    <span class="perk-text" style="display:flex;align-items:center;gap:2px;color:#199CF1;background-color:white;border-radius:20px;padding:8px;font-size:8px">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="12" height="12" rx="6" fill="#199CF1"/>
                                        <rect x="2" y="2" width="8" height="8" fill="url(#pattern0_14_7977)"/>
                                        <defs>
                                        <pattern id="pattern0_14_7977" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_14_7977" transform="scale(0.01)"/>
                                        </pattern>
                                        <image id="image0_14_7977" width="100" height="100" xlink:href="data:image/png;base64,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"/>
                                        </defs>
                                        </svg>

                                        perk
                                        </span>
                                        <span class="timer uses_per_month" style="border:2px solid white;border-radius:20px;padding:6px;font-size:8px">3 uses per month</span>
                                    </div>

                                    <div class="ticketRip">
                                        <div class="circleLeft"></div>
                                        <div class="ripLine"></div>
                                        <div class="circleRight"></div>
                                    </div>

                                    <div style=" margin: 12px;">
                                        <h3 class="description" style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;margin-top:8px;margin-bottom:18px">10% OFF your Bill</h3>                                        
                                        <div style="text-align:left;margin-top: 88px;margin-bottom: 10px;">
                                            <span class="est hidden" style="font-size:8px;color:white;text-align:left;">Est Saving <span style="color:white" class="est_saving">£-</span></span>
                                            <span class="min hidden" style="font-size:8px;color:white;text-align:left;">Min spend <span style="color:white" class="min_spend">£-</span></span>
                                            </div>
                                        <div style="color:#ffffff;text-align:left;font-size:8px">
                                            Available: <span class="availableTime" style="font-weight:bold"> During operating hours:</span>
                                        </div>


                                        <div class="weekDays-ongoing-selector weekDays-ongoing-selector1" style="margin-top:10px;display: flex;justify-content: space-between;gap:2px;margin-top:4px">
                                            <input type="checkbox" id="weekday-mon" class="weekday" data-day="Mon"/>
                                            <label >M</label>
                                            <input type="checkbox" id="weekday-tue" class="weekday" data-day="Tue"/>
                                            <label>T</label>
                                            <input type="checkbox" id="weekday-wed" class="weekday" data-day="Wed" />
                                            <label>W</label>
                                            <input type="checkbox" id="weekday-thu" class="weekday" data-day="Thu"/>
                                            <label>T</label>
                                            <input type="checkbox" id="weekday-fri" class="weekday" data-day="Fri"/>
                                            <label>F</label>
                                            <input type="checkbox" id="weekday-sat" class="weekday" data-day="Sat"/>
                                            <label>S</label>
                                            <input type="checkbox" id="weekday-sun" class="weekday" data-day="Sun"/>
                                            <label>S</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="box2" style="background-color:#0074bf">
                                </div>
                            </div>
                            
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-dialog dialog" style="margin:0">
                    <div class="modal-content content" style="width:72%">
                        <div class="modal-header" style="border-bottom:0px">
                            <h5 class="modal-title" style="display:flex;align-items:center;gap:6px">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.97583 15.45C9.69963 15.45 9.47583 15.2261 9.47583 14.95V9.08643C9.47583 8.81023 9.69963 8.58643 9.97583 8.58643H11.018C11.2942 8.58643 11.518 8.81023 11.518 9.08643V14.95C11.518 15.2261 11.2942 15.45 11.018 15.45H9.97583Z" fill="#0188DF"/>
                                <path d="M10.5018 7.13703C10.1982 7.13703 9.93767 7.03635 9.72037 6.835C9.50617 6.63046 9.39917 6.38596 9.39917 6.10151C9.39917 5.82026 9.50617 5.57897 9.72037 5.37762C9.93767 5.17307 10.1982 5.0708 10.5018 5.0708C10.8054 5.0708 11.0643 5.17307 11.2784 5.37762C11.4958 5.57897 11.6044 5.82026 11.6044 6.10151C11.6044 6.38596 11.4958 6.63046 11.2784 6.835C11.0643 7.03635 10.8054 7.13703 10.5018 7.13703Z" fill="#0188DF"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5 10.5C20.5 16.0228 16.0228 20.5 10.5 20.5C4.97715 20.5 0.5 16.0228 0.5 10.5C0.5 4.97715 4.97715 0.5 10.5 0.5C16.0228 0.5 20.5 4.97715 20.5 10.5ZM18.5 10.5C18.5 14.9183 14.9183 18.5 10.5 18.5C6.08172 18.5 2.5 14.9183 2.5 10.5C2.5 6.08172 6.08172 2.5 10.5 2.5C14.9183 2.5 18.5 6.08172 18.5 10.5Z" fill="#0188DF"/>
                                </svg>

                                T&Cs
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div style="margin:6px">
                                <ul class="terms" style="margin-left: 18px!important;padding-left: 1em!important;">
                                    <li>Can only be used by one person</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- End Perk Modal -->
    <div class="modal fade" id="endPerkModal" tabindex="-1" aria-labelledby="endPerkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('perks.end') }}">
            @csrf
            <input type="hidden" name="perk_id" id="perk_id_to_end">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="endPerkModalLabel">End Perk</h5>
                </div>
                <div class="modal-body" style="padding: 6px;">
                    Are you sure you want to end this perk?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeButton" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">End Perk</button>
                </div>
            </div>
        </form>
    </div>
    </div>

     
    <style>
        .form-group{margin-left:15px;margin-right: 15px}
    </style>
  
     @if(\Session::has('code'))
        <script>
            $("#pendingCode").modal("show");
        </script>
    @endif
    <script>
    $(".openModalsButton").on("click", function (event) {

        const id = $(this).data('id');

        $.ajax({
                url: '/admin/fetch-perk-data/' + id,
                method: 'GET',
                success: function (response) {
                    console.log(response);
                    if(response.type == "ongoing perk"){
                        if(!isNaN(response.uses_per_month)){
                            $('.uses_per_month').text(response.uses_per_month+' Uses Per Month');
                        }
                        else{
                            $('.uses_per_month').text(response.uses_per_month);
                        }
                        $('.description').text(response.description.toUpperCase());
                        let result = response.week_days.split(",");

                        $('.weekDays-ongoing-selector .weekday').each(function () {
                            let day = $(this).data('day');
                            $(this).prop('checked', result.includes(day));
                        });
                        $('.availableTime').text(response.setTime);
                        if(response.estimated_savings != null){
                            $('.est').removeClass('hidden');
                            $('.est_saving').text('£'+parseInt(response.estimated_savings));
                        }
                        if(response.minimum_spend != null){
                            $('.min').removeClass('hidden');
                            $('.min_spend').text('£'+parseInt(response.minimum_spend));
                        }                        
                        $('.terms').text(response.terms);

                        $('#modal2').modal("show");
                    }
                    else{
                    
                        $('.title').text(response.description.toUpperCase());
                        $('.time').text(response.date_range);

                        let result = response.week_days.split(",");

                        $('.weekDays-selector .weekday').each(function () {
                            let day = $(this).data('day');
                            $(this).prop('checked', result.includes(day));
                        });
                        $('.availableTime').text(response.setTime);
                        if(response.estimated_savings != null){
                            $('.est').removeClass('hidden');
                            $('.est_saving').text('£'+parseInt(response.estimated_savings));
                        }
                        if(response.minimum_spend != null){
                            $('.min').removeClass('hidden');

                            $('.min_spend').text('£'+parseInt(response.minimum_spend));
                        }                        
                        $('.terms').text(response.terms);
                        $('.limit_avilable').text(response.limit);


                        $('#modal1').modal("show");
                    }

                    // Update modal content with fetched data
                    $('.timer').text(response.name); // Example field
                },
                error: function () {
                    $('#dynamicData').text('Error fetching data.');
                }
            });
      // Open the first modal

      
    });
    $(".openPerkModalsButton").on("click", function () {
      // Open the first modal
      $('#modal2').modal("show");
      
    });

    $(document).click(function (e) {
        if ($('#modal1').hasClass('in')) {
            $('#modal1').modal("hide");
        }
        if ($('#modal2').hasClass('in')) {
            $('#modal2').modal("hide");
        }
    });

    $(".endPerkModal").on("click", function (event) {
      // Open the first modal
        $('#endPerkModal').modal("show");
    //   const button = event.relatedTarget;
        const perkId = $(this).data('id');
        document.getElementById('perk_id_to_end').value = perkId;
    });
    $(".closeButton").on("click", function (event) {
      // Open the first modal
        $('#endPerkModal').modal("hide");
    //   const button = event.relatedTarget;
    });
    
    // const endPerkModal = document.getElementById('endPerkModal');
    // endPerkModal.addEventListener('show.bs.modal', function (event) {
    //     const button = event.relatedTarget;
    //     const perkId = button.getAttribute('data-id');
    //     document.getElementById('perk_id_to_end').value = perkId;
    // });
    </script>

@endsection