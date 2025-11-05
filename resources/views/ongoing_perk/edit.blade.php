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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

      .select2-container {
            width: 100% !important; /* Ensures Select2 stretches to full container width */
        }

        /* If needed, adjust the dropdown width */
       .select2-selection{
        padding:1px 12px;
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

            .dropdown-calendar-container {
            position: relative;
            width: 300px;
            margin: 20px;
            }

        .dropdown-calendar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        }

        .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 4px;
        z-index: 10;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu.show {
        display: block;
        }

        .dropdown-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        }

        .dropdown-menu li {
        padding: 10px;
        cursor: pointer;
        }

        .dropdown-menu li:hover {
        background-color: #f0f0f0;
        }

        #date-range-picker {
        display: none;
        margin-top: 10px;
        }

        #date-range-picker.show {
        display: block;
        }


        .box {
            height:8px;
            background:#0a95fd;
            /* padding:0 50px; */
            -webkit-mask:
            radial-gradient(circle 3px,#fff 97%, transparent 100%) bottom/9px 200% space content-box,
            linear-gradient(#fff 0 0);
            -webkit-mask-composite:destination-out;
            mask-composite: exclude;
        }

        .box2 {
            height:8px;
            background:#0074bf;
            /* padding:0 50px; */
            -webkit-mask:
            radial-gradient(circle 3px,#fff 97%, transparent 100%) top/9px 200% space content-box,
            linear-gradient(#fff 0 0);
            -webkit-mask-composite:destination-out;
            mask-composite: exclude;
        }
            .ticket-shape {
        display: inline-block;
        box-sizing: content-box;
        position: relative;
        height: 10px;
        width: 20px;
        font-size: 16px;
        background-size: 100%;
        background-repeat: no-repeat;
        background-image: radial-gradient(circle at 6px 0, rgba(255,255,255,0) 0.4em, #199CF1 0.3em);
        background-position: top left, top right;
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
        .perk-ticket {
            background-image: url('/admin_dashboard/assets/images/perk_portal_mask.png');
            background-size: 100% 100%;
            background-repeat:no-repeat;
            /* border-radius: 10px; */
            text-align: center;
            padding: 15px;
            color: #333;
            position: relative;
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background: linear-gradient(to left, #800080, #FF00FF); */
            color: #fff;
            padding: 0px px;
            border-radius: 20px;
            margin:0px 7px;
        }

        .header .icon {
            font-size: 20px;
        }

        .header .limited-perk {
            font-weight: bold;
        }

        .header .timer {
            font-weight: bold;
        }

        .perk-container {
            background: linear-gradient(to bottom, #009BFF, #0073BC);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* padding: 15px; */
            position: relative;
            overflow: hidden; /* Ensures the decorative top border doesn't overflow */
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
        .weekDays-selector input {
        display: none!important;
        }

        .weekDays-selector input[type=checkbox] + label {
        display: inline-block;
        border-radius: 15px;
        background: #8cc6eb;
        height: 22px;
        width: 42.14px;
        margin-right: 3px;
        line-height: 25px;
        text-align: center;
        /* cursor: pointer; */
        color:#0182D4;
        font-size:10px;
        }

        @media screen and (max-width: 670px) {
            .weekDays-selector input[type=checkbox] + label {
                height: 22px;
                width: 42.14px;
                font-weight: 500;
                font-size: 11px;
                line-height:25px;
            }
            .claim-perks{
                margin-left:100px!important;
            }
        }
        @media screen and (max-width: 460px) {
            .weekDays-selector input[type=checkbox] + label {
                height: 27px;
                width: 40px;
                font-weight: 500;
                font-size: 11px;
                line-height:30px;
            }
            .weekDays-selector1 input[type=checkbox] + label {
            height: 26px!important;
            width: 27px!important;
            margin-right: 1px;
            line-height: 28px!important;
            }
            .card2{
                width:80%!important;
            }
            
            .ticket{
                margin:18px 25px!important;
             }
        }

        .weekDays-selector input[type=checkbox]:checked + label {
        background: #ffffff;
        color: #0182D4;
        }
        .weekDays-selector1 input[type=checkbox] + label {
            height: 30px;
            width: 28px;
            margin-right: 1px;
            line-height: 32px;
        }
        .select2-search__field{
            width:100%!important;
        }

        .custom-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ff3c5a;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 4px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width:86%;
        margin-bottom: 25px;
        }

        .custom-button .icon {
        display: flex;
        align-items: center;
        justify-content: center;
        /* width: 30px; */
        /* height: 30px; */
        /* background-color: white; */
        /* color: #ff6b81; */
        border-radius: 50%;
        
        }

        .custom-button .text {
        flex: 1;
        text-align: center;
        }

    </style>
    <div class="busines1-main">

        <div class="switch-field">

            <a href="{{ url()->previous()}}" class="back-btn"> <img src="{{asset('admin_dashboard/assets/images/back.png')}}" alt="img" style="width:auto!important"> Deals Portal / Create ongoing perk</a>

        </div>

        <div class="business-step1" id="profiles">

            <div class="row">
            @if ($errors->any())
                <div style="color: red;margin-left:16px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('ongoing_perk.update',$ongoingPerk->id) }}" method="POST" id="limited_perks_form">
                @csrf

                <div class="col-md-7 ">
                    <select class="form-control" name="business_id" style="width:100%">
                        <option value="">Select business</option>
                        @foreach($business as $key => $b) 
                        <option {{$ongoingPerk->business_id == $b->id ?'selected':''}} value="{{$b->id}}">{{$b->business_name}}</option>
                        @endforeach
                    </select>
                    <div class="" style="background-color:#e8f6ff;border:2px solid #6db4d7;border-radius: 6px;padding:14px;margin-top:12px">
                        <ul style="margin-left: 2px!important;padding-left: 1em!important;">
                          <li>Perfect for running monthly offers!
                            eg 10% OFF Your bill when you spend over £80' or 1 Free coffee when you buy a piece of cake
 
                          </li>
                          <li>Set monthly limit on how many times it can be used

                          </li>
                          <li>Have up to 3 Ongoing Perks running at same time</li>
                          <li>Perk will run until you end it</li>
                        </ul>
                    </div>
                    
                    <div class="account-type-main" style="margin-top:25px">
                            <div style="margin-bottom:6px">
                                <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                    <label for="description">Perk Description</label>
                                    <div data-toggle="tooltip" data-placement="top" title="Perk Description">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                        </svg>
                                    </div>
                                </div>
                                <textarea id="description" name="description" class="form-control" placeholder="Input perk description…">{{$ongoingPerk->description}}</textarea>
                            </div>
                            <div class="row" style="margin-bottom:15px">
                                <div class="col-md-4">
                                    <div class="">

                                        <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                            <label for="limit">Uses per month</label>
                                            <div data-toggle="tooltip" data-placement="top" title="Uses per month">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <select id="limit" name="uses_per_month" class="form-control">
                                            <option {{$ongoingPerk->uses_per_month == 'No Limit' ?'selected':''}}>No Limit</option>
                                            <option {{$ongoingPerk->uses_per_month == 'Reusable daily' ?'selected':''}}>Reusable daily</option>
                                            <option {{$ongoingPerk->uses_per_month == 'One time use' ?'selected':''}}>One time use</option>
                                            @for($i=1;$i<=35;$i++)
                                                <option {{$ongoingPerk->uses_per_month == $i ?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top:6px">
                                    <div class="">
                                        <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                            <label for="setTime">Set time of day available</label>
                                            <div data-toggle="tooltip" data-placement="top" title="Time of day available">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        <select id="setTime" name="setTime" class="form-control">
                                            <option value="During operating hours">During operating hours</option>
                                            <option value="Manual">Manual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top:6px">
                                    <div class="">
                                        
                                        <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                            <label for="limit">Week days available</label>
                                            <div data-toggle="tooltip" data-placement="top" title="Week days available">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <select id="week_days" name="week_days[]" class="form-control" multiple>
                                            <option>On days when open</option>
                                                @php
                                                    $daysArray = explode(',', $ongoingPerk->week_days);
                                                @endphp
                                            <option value="Mon" data-day="mon"  {{in_array('Mon',$daysArray)? 'selected':''}}>Mon</option>
                                            <option value="Tue" data-day="tue"  {{in_array('Tue',$daysArray)? 'selected':''}}>Tue</option>
                                            <option value="Wed" data-day="wed"  {{in_array('Wed',$daysArray)? 'selected':''}}>Wed</option>
                                            <option value="Thu" data-day="thu"  {{in_array('Thu',$daysArray)? 'selected':''}}>Thu</option>
                                            <option value="Fri" data-day="fri"  {{in_array('Fri',$daysArray)? 'selected':''}}>Fri</option>
                                            <option value="Sat" data-day="sat"  {{in_array('Sat',$daysArray)? 'selected':''}}>Sat</option>
                                            <option value="Sun" data-day="sun" {{in_array('Sun',$daysArray)? 'selected':''}}>Sun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <a class="advance" style="cursor:pointer;margin-top:4px">Advanced options</a>
                            <a class="hideOption hide" style="cursor:pointer;margin-top:4px">Hide options</a>

                            <div class="row hidden optional" style="margin-top:10px">
                                <div class="col-md-3" style="margin-top:6px">
                                    <div class="">
                                        <label for="minimum_spend">Minimum spend</label>
                                        <input type="text" class="form-control" name="minimum_spend" id="minimum_spend" value="{{$ongoingPerk->minimum_spend}}">
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-top:6px">
                                    <div class="">
                                        <label for="estimated_savings">Estimated savings</label>
                                        <input type="text" class="form-control" name="estimated_savings" id="estimated_savings" value="{{$ongoingPerk->estimated_savings}}">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:6px">
                                    <div class="">
                                        <div style="display:flex;justify-content: space-between;">
                                            <label for="limit">T&Cs Text</label>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                            </svg>
                                        </div>
                                        

                                        <textarea class="form-control" name="terms">{{$ongoingPerk->terms}}</textarea>
                                    </div>
                                </div>
                            </div>
                    
                        
                    </div>

                    <a class="btn runLimited btn-primary xs-hidden" onclick="openModal()">Run Ongoing Perk → </a>
                </div>

                <div class="col-md-5">
                  <div class="account-type-main" style="align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                        <div>
                            <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                <h4 style="font-weight:bold">Perk review:</h3>
                                <div data-toggle="tooltip" data-placement="top" title="Perk review">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                            </div>
                            <!-- <div class="box">
                            </div> -->
                            <div class="perk-ticket" style="padding-bottom:24px">
                                <div class="header">
                                
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
                                    <span class="timer" style="border:2px solid white;border-radius:20px;padding:6px;font-size:8px">Uses not set</span>
                                </div>
<!-- 
                                <div class="ticketRip">
                                    <div class="circleLeft"></div>
                                    <div class="ripLine"></div>
                                    <div class="circleRight"></div>
                                </div> -->

                                <div class="content" style=" margin-top: 40px;margin-left: 12px;margin-right: 12px;">
                                    <h3 style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;margin-top:8px;margin-bottom:24px" class="title">
                                        {{$ongoingPerk->description}}
                                    </h3>

                                    <div style="color:#ffffffab;text-align:left;margin-bottom:15px;font-size:11px">
                                    <span class="est hidden">Est Saving: <span style="color:white" class="est_saving">£-</span></span>
                                    <span class="min hidden">Min spend: <span style="color:white" class="min_spend">£-</span></span>
                                    </div>
                                    <div style="color:#ffffffab;text-align:left;font-size:8px;margin-top:52px" class="timeAvailable">Time available: 
                                        <span class="availableTime" style="font-weight:bold;color:white"> </span>
                                    </div>
                                    <!-- <div style="color:#ffffffd9;text-align:left;font-weight:700;padding:6px;margin-top:40px">Available:<span class="availableTime" style="font-weight:500"> During operating hours</span></div> -->


                                    <div class="weekDays-selector" style="margin-top:4px;display: flex;justify-content: space-between;">
                                        @php
                                            $daysArray = explode(',', $ongoingPerk->week_days);
                                        @endphp
                                        <input type="checkbox" id="weekday-mon" class="weekday" data-day="mon" {{in_array('Mon',$daysArray)? 'checked':''}} />
                                        <label >M</label>
                                        <input type="checkbox" id="weekday-tue" class="weekday" data-day="tue" {{in_array('Tue',$daysArray)? 'checked':''}}/>
                                        <label >T</label>
                                        <input type="checkbox" id="weekday-wed" class="weekday" data-day="wed" {{in_array('Wed',$daysArray)? 'checked':''}}/>
                                        <label>W</label>
                                        <input type="checkbox" id="weekday-thu" class="weekday" data-day="thu" {{in_array('Thu',$daysArray)? 'checked':''}}/>
                                        <label>T</label>
                                        <input type="checkbox" id="weekday-fri" class="weekday" data-day="fri" {{in_array('Fri',$daysArray)? 'checked':''}}/>
                                        <label>F</label>
                                        <input type="checkbox" id="weekday-sat" class="weekday" data-day="sat" {{in_array('Sat',$daysArray)? 'checked':''}}/>
                                        <label>S</label>
                                        <input type="checkbox" id="weekday-sun" class="weekday" data-day="sun" {{in_array('Sun',$daysArray)? 'checked':''}}/>
                                        <label>S</label>
                                    </div>
                                    <button style="background-color:white;border-radius:15px;color:#FF3D5A;border-color:white;width:100%;padding:6px;margin:6px 0px;border-bottom:white;border-right:white;font-size:10px;font-weight:bold">Claim Perk</button>

                                </div>

                            </div>
                            <!-- <div class="box2">
                            </div> -->
                            
                        
                        </div>  
                    </div>


                    <div class="account-type-main" style="align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                        <div>
                            <div style="display:flex;justify-content: space-between;align-items: flex-end;">
                                <h4 style="font-weight:bold">What customer sees when tapping on deal tile in the app:</h3>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                </svg>
                            </div>
                            <div style="background-color:#fafbff;display:flex;flex-direction:column;align-items:center">
                            <div>
                                    <div class="perk-ticket ticket" style="background-image: url('/admin_dashboard/assets/images/mobile_perk_mask.png');margin-top:16px;padding:10px;margin:16px 72px">
                                        <div class="header" style="margin-top:3px">
                                        <span class="perk-text" style="display:flex;align-items:center;gap:2px;color:#199CF1;background-color:white;border-radius:20px;padding:8px;font-size:8px">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="12" height="12" rx="6" fill="#199CF1"/>
                                            <rect x="2" y="2" width="8" height="8" fill="url(#pattern0_14_7977)"/>
                                            <defs>
                                            <pattern id="pattern0_14_7977" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0_14_7977" transform="scale(0.01)"/>
                                            </pattern>
                                            <image id="image0_14_7977" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAJ9klEQVR4nO2de6xdRRWHN49eCj6gFKsIlFBBFAwq+ocJSsujvKGARiRCxaC0kphKYn0gNTcUjFEEBBNRChREFCkPRQUpUSJqBC1Rq2hApWKqtKXXSqHtLfR+ZNF1YN/p7H1mZs+cs885+5fcpOnZs2bNnj0za61Zjyxr0KBBHwOYCgwDc4Edu83PQAMYAp7gFVzWbZ4GGsApjMf/gYnd5mtgAXyHbTGr23wNJICdgHWWCbml27wNJICTseM54NXd5q9vAewIvB3Ywfj/GynGGcazeyqNRgoLlJymA5cAvwE2AH+yPPO/kgm503j+DcALwEalKbRnCB1vBgcBwATgRP3qbS96gfG8PFuGTcCuRpv7Lc9JX4uVXrN6VKlbCPynzQt+q/Fy5SW2wzlGm4+1eX6l8jI1GzQABwE3AZsdXuxyz+2qhXuNdrsDow7tNutKPTgbkBVxM7ClzUt5DrgbON/8YoETcMPzwOuMttOU5o+A9W3ab9GPpv9WDLCzHqRyqBZhFPgecGyZtg3cgDvmltCRlXYM8P02K2ejbmX9YQEAjgIeLxnwP4DPAlMcaMlLHPGYkAcceZwCfKYNn/LbkVmPa9KXA2MFAxSj4FnA9h40T8APsu3s5UF/e2C2YbDMQ8ZymYwt6yXoXv1IwaDWAPNCBgVcjz8uCPyYhMfVBTRlbPtlvQBgJvB0wUAWmfqBp64yEjAhD1UYy64lH4GM8eiszgA+rhqxif8CJ1WkfTxhkG1mWgS7mYzBJsl9NKsjgC8UnBd3AHtEoH8d4fh8hP4ni0mmYMIr048K4OKCF/F1n0O7zXa1tsKE/DGLAGA7vS62fXhfzOoA4KICW9LsiH0cR3UcFJGf2TpGE91dKQX2oWeAwyP3c12ECbk4Mk+HW7T9sa6dKarlyqFmmjxiT8aEittVC4/F5Et5m6HXA6YtbGbsvtoxsq9FtBXzw4kJ+jqOeHhXIjHf3L5Gqkp2vnapRywa8WmJ+lsUcUK+mojH0ywG02UdsX8BV1sGelGiviaUKJkheFIkpUS8ivRl4vIUfeU7PdIi8i0177sj9ncs8XFYIl7FDvZToy9ZNUdkiTrcxWJ0WyEXP0k6zF7q89oEE3J1Qn4n6zsxrdk7p+hM7jPyGEv1teW8TcQQGRtPpVrRyvf7LLvIcOxO3mSRJBZF7cQuvaRCUqOgRW/aGNU6rNeueayNYZ/qwnbVwrWJed/dYrpfHIv4wRaR7twoxDu/XeU/qKQ+WeL1ovpI60/Gs3/WiyDtdtVCpeuAgQLw7Q5MyM3dHmdPgK3bVdHVaUw8C7yq2+OtPYCj6RzOBibV5G+7vNxc5v6S6uscKfjbwGBCor8+nJV4hzToPNbJhPyhCx03sGN1prEYIe41DeJCblpPbp0j+wC/iNxBA3c8DBxg86iY5+iy3yAOxtQzp9hqINecwN8iddig/LJsus81rcxcgzRYEnSPpA4GNhfKBuEH93neE2FMyuuBnwQy0KDs4HacgG2cAPTAv6DAW69BOcT5/FJx2AhdERIy9t6Su5FGkYxwcEtkMXCFy4QsU4/EL9tmVXyN9Ld2gZuDjiW2g1t3m/PUy3OZy4TkDY2/KjJRa7yGOAw02PbgPqdEev1x7tm/u0yIeRdRKJ5J2DHwQ+P5QcbDZQe3ugnlscplQsyDe8jRPV9M6oOKsbYa9ytRxHlscpkQ03TiJB0Ab9HzZ9DwpKvGHTohpuv/JJfOcr64wwN04C/x0bgtW9Yal0amK+Q+rh0aPsD/pn/xTIjGrWEcefzTpdHyGKFg+jXcTv/hoVD/KtXj/GIfVdTN46iQznP0znVI9NL/GndmdeD4ZUimzzmhDORo7meZ6P40lZcA+IRB90aXRguMRl/J4vlbDRckFug/U7kFwNcM2he6NPqg0eiuLH706r/oYY07FJqnK4/3uzR6h9FoZTAHxX3cSv3xaIJxSxrBPN7m0miiJdHYtMiRWL2i1R8YcdwHGLQ3OGdEsnigxMzKYG6JdcbnIo5bpM08lvo0Ng/2GyIydhu9g99GHLfkb/Q70HONxd83j5EYAS5iyu+h7aplNNw7UTaK9/gQGFLn3zyOj8DYh+g9nB9h3CcZNNd5J262ZFKrvG0V5JuqO+5LEKPpHzArAe8GEVkxr63A1GvapImtKzb7WLwL0gSKTpPH9NDMBGIyqJRQMkdPMpD2Ks6qMO75Bq0VwUndgC8ZxJ4IDbrv8aveJRUOc/OjviSEVovgGy1XumcELtte9ul6NiQ9hkREGXQ2+eQRLiJ6jSV3h1fOXeAj9D5O8RzzkCVU8JveE1CQFNnMHDfPk0be9aVXcb3nmD9ttH8+WnoNi5b5tKvkoRGm/RBzssZVd9Db0pEkqTW0g70tt36LPVJMpMYLdAYzHMds1sdaH+Kb0K4TqWBg4nSHdvckfkl/0YJfsztwVXylw3hnWdrNjzYRxiH1V6MjiR2Z3CYrjksVnVA701X5vIbqG5YyzHtFWYpALXuxyvLBBN/Dl0Ijdk2fq3uLdBOLyTkWVknpisAyGVVxaEG/OwA/M57d4rrNBUOrzZiwFgUWO1CCF3Kf6EeOHh7mDR2pEjJLaIHl2UtjvHMXZ4UHHYo57mERl6tgo0YJO2cV1S0kdvTXckfB5cGOleLTuHbTvj8uxbbGQMTCn4FDAnlthXvHtBSMc5QDfmARkSvfo4R4j7Sst6OmXlJQyNEXY8A3YmT1VElMDtgYGCc1AWfmfhvtWq0qrWcuOsDdlriRqtvV6pdTTcTjd6KGDVQ98H9tsdWNKt2zs25CvfHGMaG1AqtgqcvBXYHnUytmzBbpaU+Dpkibn8rqAPPwqpA3ZZNG+yZJB27wuBfw8wqTMsf0bM/qiFxlZl88Cryzw7xWye9yT9YLAD4ZMLibupn/EHi31Bfx5FksELtldUeBjlKENb73DKmgd/7f8pyUM7M6Qw46j3C2+yvfniUA8AGPhG63ZnWGSBmOS304RvW2VNDQM5eVvr7WRYtFPg89uFNWLKhgIlroIKBEL/MU05xSpnDJ3fwuBVbSBer3dYtW1Uyalz2nJJ6qJcN/J5p8YDxL0sT+wVD9oejgnuW5NawFvqulXN8ckUdJ+DJHJ0HcOU0dyGq81Gvo20quAmq1ul+CFop31ri1Jol5mVOElVpO6Aq1DIhp/RB1wJikl2dD+u9p+tsxajG4Ui2+rnlZ7ipaoVq30eYsPjWrGwxzyah67JUe3Grzmt+FzNo2PKZF7qe04flAI2PF4x0zs/tCrZ4LnUK1ttWYZ2qurk6mFHxK+zzC855FVuNcqX9bR9E9Ktg6OYdKQIvEcUd20JZz4gGpWSvSXidsZn0Htkph+2vxRikRLgeyGAV/r16UYqaXFy1/IkDI/8lv8oxIbTKx0lZi/Op3+Bp4ERZ/Sj2QhFbUAAAAAElFTkSuQmCC"/>
                                            </defs>
                                            </svg>

                                            perk
                                            </span>
                                            <span class="timer" style="border:2px solid white;border-radius:20px;padding:6px;font-size:8px">Uses not set</span>

                                        </div>

                                        <div class="content" style="margin-top: 26px;margin-left: 10px;margin-right: 1px;margin-bottom:12px">
                                            <h3 style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px" class="title">
                                                {{$ongoingPerk->description}}
                                            </h3>
                                            <div style="text-align:left;margin-top: 88px;margin-bottom: 16px;" class="saving">
                                            <span class="est hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Est Saving: <span style="color:white;font-weight:bold" class="est_saving">£-</span></span>
                                            <span class="min hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Min spend: <span style="color:white;font-weight:bold" class="min_spend">£-</span></span>
                                            </div>

                                            <div style="color:#ffffffab;text-align:left;font-size:10px;">Time available:
                                                <span class="availableTime" style="font-weight:bold;color:white">{{$ongoingPerk->setTime}} </span>
                                            </div>


                                            <div class="weekDays-selector weekDays-selector1" style="margin-top:12px;">
                                                @php
                                                    $daysArray = explode(',', $ongoingPerk->week_days);
                                                @endphp
                                                <input type="checkbox" id="weekday-mon" class="weekday" data-day="mon" {{in_array('Mon',$daysArray)? 'checked':''}} />
                                                <label >M</label>
                                                <input type="checkbox" id="weekday-tue" class="weekday" data-day="tue" {{in_array('Tue',$daysArray)? 'checked':''}}/>
                                                <label >T</label>
                                                <input type="checkbox" id="weekday-wed" class="weekday" data-day="wed" {{in_array('Wed',$daysArray)? 'checked':''}}/>
                                                <label>W</label>
                                                <input type="checkbox" id="weekday-thu" class="weekday" data-day="thu" {{in_array('Thu',$daysArray)? 'checked':''}}/>
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-fri" class="weekday" data-day="fri" {{in_array('Fri',$daysArray)? 'checked':''}}/>
                                                <label>F</label>
                                                <input type="checkbox" id="weekday-sat" class="weekday" data-day="sat" {{in_array('Sat',$daysArray)? 'checked':''}}/>
                                                <label>S</label>
                                                <input type="checkbox" id="weekday-sun" class="weekday" data-day="sun" {{in_array('Sun',$daysArray)? 'checked':''}}/>
                                                <label>S</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                
                                
                                <div style="margin:26px">
                                    <div class="">
                                        <h4 style="font-weight:bold">How to claim:</h4>
                                        <ul style="list-style-type:auto;margin:12px!important">
                                            <li> Go to <a>(Business name)</a></li>
                                            <li> Show this Screen to staff on arrival</li>
                                            <li> Swipe below once perk's claimed</li>
                                        </ul>

                                        <div style="margin:-3px;border:1px solid lightgray;border-radius:14px;padding:10px;display:flex;align-items: flex-start;gap:6px">
                                        <svg width="24" height="24" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.97583 15.45C9.69963 15.45 9.47583 15.2261 9.47583 14.95V9.08643C9.47583 8.81023 9.69963 8.58643 9.97583 8.58643H11.018C11.2942 8.58643 11.518 8.81023 11.518 9.08643V14.95C11.518 15.2261 11.2942 15.45 11.018 15.45H9.97583Z" fill="#0188DF"/>
                                        <path d="M10.5018 7.13703C10.1982 7.13703 9.93767 7.03635 9.72037 6.835C9.50617 6.63046 9.39917 6.38596 9.39917 6.10151C9.39917 5.82026 9.50617 5.57897 9.72037 5.37762C9.93767 5.17307 10.1982 5.0708 10.5018 5.0708C10.8054 5.0708 11.0643 5.17307 11.2784 5.37762C11.4958 5.57897 11.6044 5.82026 11.6044 6.10151C11.6044 6.38596 11.4958 6.63046 11.2784 6.835C11.0643 7.03635 10.8054 7.13703 10.5018 7.13703Z" fill="#0188DF"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5 10.5C20.5 16.0228 16.0228 20.5 10.5 20.5C4.97715 20.5 0.5 16.0228 0.5 10.5C0.5 4.97715 4.97715 0.5 10.5 0.5C16.0228 0.5 20.5 4.97715 20.5 10.5ZM18.5 10.5C18.5 14.9183 14.9183 18.5 10.5 18.5C6.08172 18.5 2.5 14.9183 2.5 10.5C2.5 6.08172 6.08172 2.5 10.5 2.5C14.9183 2.5 18.5 6.08172 18.5 10.5Z" fill="#0188DF"/>
                                        </svg>

                                            Do not swipe 'Claim Perk' until after following instructions above or you will not be able claim this perk.
                                        </div>
                                    </div>
                                </div>
<!-- 
                                <div style="margin-top:12px;margin-top:12px;background-color:#ff3c5a;color:white;width:100%;padding:6px;border-radius:24px;display:flex;align-items:center">
                                    <svg fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="35px" height="35px" viewBox="0 0 31.334 31.334"
                                        xml:space="preserve">
                                    <g>
                                        <path d="M15.667,0C7.029,0,0.001,7.028,0.001,15.667c0,8.64,7.028,15.667,15.666,15.667c8.639,0,15.666-7.027,15.666-15.667
                                            C31.333,7.028,24.306,0,15.667,0z M18.097,23.047c-0.39,0.393-0.902,0.587-1.414,0.587s-1.022-0.194-1.414-0.587
                                            c-0.781-0.779-0.781-2.047,0-2.827l2.552-2.553H8.687c-1.104,0-2-0.896-2-2c0-1.104,0.896-2,2-2h9.132l-2.552-2.552
                                            c-0.781-0.781-0.781-2.047,0-2.828c0.78-0.781,2.048-0.781,2.828,0l7.381,7.381L18.097,23.047z"/>
                                    </g>
                                    </svg>
                                    <a style="color:white;margin-left:150px" class="claim-perks">Claim Perk</a>
                                </div> -->

                                <button class="custom-button">
                                <span class="icon">
                                <svg fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        width="35px" height="35px" viewBox="0 0 31.334 31.334"
                                        xml:space="preserve">
                                    <g>
                                        <path d="M15.667,0C7.029,0,0.001,7.028,0.001,15.667c0,8.64,7.028,15.667,15.666,15.667c8.639,0,15.666-7.027,15.666-15.667
                                            C31.333,7.028,24.306,0,15.667,0z M18.097,23.047c-0.39,0.393-0.902,0.587-1.414,0.587s-1.022-0.194-1.414-0.587
                                            c-0.781-0.779-0.781-2.047,0-2.827l2.552-2.553H8.687c-1.104,0-2-0.896-2-2c0-1.104,0.896-2,2-2h9.132l-2.552-2.552
                                            c-0.781-0.781-0.781-2.047,0-2.828c0.78-0.781,2.048-0.781,2.828,0l7.381,7.381L18.097,23.047z"/>
                                    </g>
                                </svg>
                                </span>
                                <span class="text" style="margin-right:10px">Claim Perk</span>
                                </button>
                                
                            </div>
                        </div>  
                    </div>
                    <a class="btn runLimited btn-primary xs-block hidden" onclick="openModal()">Run Ongoing Perk → </a>
                </div>
            </form>

            </div>
        
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="perkModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <p>Are you sure you want to run perk?</p>
                    <button class="yes" onclick="confirmPerk()">Yes</button>
                    <button class="no" onclick="closeModal()">No</button>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <!-- Bootstrap Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto Open Modal Using jQuery -->
    <script>
        $(document).ready(function () {
            $("#errorModal").modal('show');
        });
    </script>
    @endif
    <div class="modal fade" id="timeModal" tabindex="-1" aria-labelledby="timeModalLabel" aria-hidden="false" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
            <div class="modal-body">
                <div class="" style="border-bottom:0;display:flex;justify-content:space-between">
                <!-- <h5 class="modal-title" id="timeModalLabel"> -->
                    <a href="#" onclick="setOperatingHours()">During operating hours</a>
                <!-- </h5> -->
                <button type="button" class="btn-close" style="background-color:white;border:none;">X</button>
                </div>
                <span style="font-weight:bolder">or</span>
                <div class="row mb-3" style="margin:4px">
                <label for="startTime" class="form-label">Set time of day available:</label>
                <div style="display:flex;gap:4px;align-items:center;background-color:aliceblue;border:2px solid gray;border-radius:6px;padding:12px">
                    @php
                    $setTime = $ongoingPerk->setTime ?? ''; // Ensure it's not null
                    if (strpos($setTime, ' to ') !== false) {
                        [$start_time, $end_time] = explode(' to ', $setTime);
                    } else {
                        $start_time = $end_time = null; // Set default values to prevent errors
                    }
                    @endphp
                    <span class="time-picker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <input id="basicExampleho"  value="{{ $start_time }}" class="auto_time ui-timepicker-input from basicExampleho">
                    </span>
                    <div>
                    
                        <span class="mx-2">To</span>

                    </div>
                    <span class="time-picker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <input id="basicExampleho1"  value="{{ $end_time}}" class="auto_time ui-timepicker-input from basicExampleho">
                    </span>
                </div>
                
                </div>
                <!-- <div class="text-end">
                <button type="button" class="btn btn-primary" onclick="submitTime()">Set Time</button>
                </div> -->
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <script>
        function openModal() {
            $('#perkModal').modal('show');

            // document.getElementById('perkModal').style.display = 'flex';
        }

        function closeModal() {
            $('#perkModal').modal('hide');

            // document.getElementById('perkModal').style.display = 'none';
        }
        function confirmPerk() {
            // alert('Perk is now live and visible in the app!');
            const form = document.getElementById('limited_perks_form');
            form.submit();
            closeModal();
            // Add code to make the perk live here
        }
    $(document).ready(function () {
        submitTime();
        $('#estimated_savings').trigger('keyup');
        $('#minimum_spend').trigger('keyup');

        $('#limit').trigger('change');
        


        $('#week_days').select2({
            placeholder: "Select weekdays",
            allowClear: true
        }); 
        
        $(' #basicExampleho').timepicker({
      'showDuration': true
    });
    $(' #basicExampleho1').timepicker({
      'showDuration': true
    });
        
    const dropdownMenu = document.getElementById('dropdown-menu');
    const calendarInput = document.getElementById('date-range-picker');
    const toggleCalendar = document.getElementById('toggle-calendar');
    const dropdownInput = document.getElementById('input');
    const selectedText = document.getElementById('selected-text');

    // Show/hide dropdown menu
    dropdownInput.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show');
        calendarInput.classList.remove('show'); // Hide calendar if dropdown is opened
    });

    // Handle dropdown selection for quick ranges
    dropdownMenu.addEventListener('click', (event) => {
        if (event.target.tagName === 'LI') {
            const days = event.target.getAttribute('data-days');
            const now = new Date();
            const futureDate = new Date();
            if(days >1){
                futureDate.setDate(now.getDate() + days);

                // Set end time to 23:59:59
                futureDate.setHours(23, 59, 59);

            }
            else{
                const hoursToAdd = days * 24;
                futureDate.setHours(now.getHours() + hoursToAdd);
            }

            // Update text and hide dropdown
            selectedText.textContent = `${days} Day(s): ${now.toLocaleDateString()} - ${futureDate.toLocaleDateString()}`;
            const dateRangePicker = $('.dateRange').data('daterangepicker');
            const startDate = dateRangePicker.startDate;
            const endDate = dateRangePicker.endDate;

            // Calculate the difference in milliseconds
            const diffInMs = endDate.diff(startDate); // Difference in milliseconds

            // Convert milliseconds to seconds
            const diffInSec = Math.floor(diffInMs / 1000);

            // Calculate hours, minutes, and seconds
            const hours = Math.floor(diffInSec / 3600); // Total hours
            const minutes = Math.floor((diffInSec % 3600) / 60); // Remaining minutes
            const seconds = diffInSec % 60; // Remaining seconds

            const remainingHours = hours % 24;

            const duration = days > 0
            ? `${days} days`
            : `${hours}h ${minutes}m ${seconds}s`;
            $('.timer').text(duration);

            // Format the result
            //const duration = `${hours}h ${minutes}m ${seconds}s`;

            $('.timer').text(duration);
            dropdownMenu.classList.remove('show');
        }
    });

    // Initialize Date Range Picker
    $('.dateRange').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'M/DD hh:mm A'
        }
    }, function (start, end, label) {
        selectedText.textContent = `Selected Range: ${start.format('M/DD hh:mm A')} - ${end.format('M/DD hh:mm A')}`;
        const dateRangePicker = $('.dateRange').data('daterangepicker');
        const startDate = dateRangePicker.startDate;
        const endDate = dateRangePicker.endDate;

        // Calculate the difference in milliseconds
        const diffInMs = endDate.diff(startDate); // Difference in milliseconds

        // Convert milliseconds to seconds
        const diffInSec = Math.floor(diffInMs / 1000);

        // Calculate hours, minutes, and seconds
        const hours = Math.floor(diffInSec / 3600); // Total hours
        const minutes = Math.floor((diffInSec % 3600) / 60); // Remaining minutes
        const seconds = diffInSec % 60; // Remaining seconds

        // Format the result
        const days = Math.floor(hours / 24);
        const remainingHours = hours % 24;

        const duration = days > 0
        ? `${days} days`
        : `${hours}h ${minutes}m ${seconds}s`;

        $('.timer').text(duration);
    });

    // Show/hide calendar
    toggleCalendar.addEventListener('click', (event) => {
        event.stopPropagation();
        calendarInput.focus(); // Trigger date range picker
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdownMenu.contains(event.target) && !dropdownInput.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
});
    // const limitSelect = document.getElementById('setTime');
    // const timeModal = new bootstrap.Modal(document.getElementById('timeModal'));

    // Listen for changes to the dropdown
    $('#setTime').on('click', function (e) {
         var targetValue = e.target.value;
    //   if (targetValue === 'Manual') {
        console.log('hello');
        // Open the modal when 'Manual' is selected
        $('#timeModal').modal('show');

    //   }
    });

    $('.btn-close').on('click',function(){
        $('#timeModal').modal('hide');
    });
    document.getElementById('setTime').addEventListener('mousedown', function(event) {
        // Prevent dropdown from showing up
        event.preventDefault();
    });
    // Function to set operating hours (if needed, you can define behavior)
    function setOperatingHours() {
      $('#setTime').val('During operating hours');
      $('.availableTime').text('During operating hours');

      $('#timeModal').modal('hide');
    }

    // Function to handle form submission
    function submitTime() {
    // Get selected start and end times
    var startTime = $('#basicExampleho').val();
    var endTime = $('#basicExampleho1').val();

        // Create the time range string
        var timeRange = `${startTime} to ${endTime}`;

        // Add the new option to the select dropdown
        if (!$('#setTime option[value="' + timeRange + '"]').length) {
            $('#setTime').append(`<option value="${timeRange}">${timeRange}</option>`);
        }

        // Set the selected value
        $('#setTime').val(timeRange);
        $('.availableTime').text(timeRange);
        // Close the modal
        $('#timeModal').modal('hide');
    }

    $('#basicExampleho1').on('change',function(){
    submitTime();
    
    });
    // $('#timeModal').on('hide.bs.modal', function () {
    // submitTime();
    // });


    // $('#minimum_spend').on('keyup',function(){

    //    var min_spend= $('#minimum_spend').val();
    //     $('.min_spend').text(min_spend);
    // });

    // $('#estimated_savings').on('keyup',function(){

    //     var est_saving= $('#estimated_savings').val();
    //     $('.est_saving').text(est_saving);
    // });

    $('#description').on('keyup',function(){
        var description = $('#description').val();
        if(description == ''){
            $('.title').text('Perk Description...');
            $('.title').css('color','#ffffffb3');
        }
        else{

            const words = description.split(' ');
            const limitedWords = words.slice(0, 15).join(' ');
           var text = limitedWords + (words.length > 15 ? '...' : '');
            $('.title').text(text);
            $('.title').css('color','white');
        }

    });

    $('#limit').on('change',function(){
        var limit = $('#limit').val();
        console.log(limit);
        if(limit == 'Reusable daily' || limit == 'One time use'){
            $('.timer').text(limit);
        }
        else{
            $('.timer').text(limit + ' uses per month');
        }
    });
    $('.advance').on('click',function(){
        $('.optional').removeClass('hidden');   
        $('.advance').addClass('hide');
        $('.hideOption').removeClass('hide');
    });

    $('.hideOption').on('click',function(){
        $('.optional').addClass('hidden');   
        $('.hideOption').addClass('hide');
        $('.advance').removeClass('hide');
    });
    $('#week_days').on('change',function(){
        let selectedDays = [];
        $('#week_days option:selected').each(function () {
            selectedDays.push($(this).data('day'));
        });

        // Update checkboxes
        $('.weekDays-selector .weekday').each(function () {
            let day = $(this).data('day');
            $(this).prop('checked', selectedDays.includes(day));
        });
    });

    $('#minimum_spend').on('keyup',function(){
        var min_spend= $('#minimum_spend').val();
        if(min_spend == ''){
            var est_saving= $('#estimated_savings').val();
            if(est_saving == ''){
                $('.timeAvailable').css('margin-top','52px');
                $('.saving').css('margin-top','88px');
            }
            else{
                $('.timeAvailable').css('margin-top','0px');
                $('.saving').css('margin-top','60px');
            }
            $('.min').addClass('hidden');
        }
        else{
            $('.timeAvailable').css('margin-top','0px');
            $('.saving').css('margin-top','60px');


            $('.min').removeClass('hidden');

        $('.min_spend').text('£'+min_spend);
        }

        
    });

    $('#estimated_savings').on('keyup',function(){
        var est_saving= $('#estimated_savings').val();

        if(est_saving == ''){
            var min_spend= $('#minimum_spend').val();
            if(min_spend == ''){
                $('.timeAvailable').css('margin-top','52px');
                $('.saving').css('margin-top','88px');

            }
            else{
                $('.timeAvailable').css('margin-top','0px');
                $('.saving').css('margin-top','60px');
            }

            $('.est').addClass('hidden');
        }
        else{
            $('.timeAvailable').css('margin-top','0px');
            $('.saving').css('margin-top','60px');

            $('.est').removeClass('hidden');
        $('.est_saving').text('£'+est_saving);
        }
        
    });

//     $('.runLimited').on('click',function(){
//        var description = $('#description').val();

//         $('.title').text(description);
//         $('.title').css('color','white');

//         var limit = $('#limit').val();

//         $('.timer').text(limit + ' uses per month');

//         let selectedDays = [];
//         $('#week_days option:selected').each(function () {
//             selectedDays.push($(this).data('day'));
//         });

//         // Update checkboxes
//         $('.weekDays-selector .weekday').each(function () {
//             let day = $(this).data('day');
//             $(this).prop('checked', selectedDays.includes(day));
//         });

    
//         // Create the time range string
//         var timeRange = $('#setTime').val();
//         $('.availableTime').text(timeRange);

//         const dateRangePicker = $('.dateRange').data('daterangepicker');
//         const startDate = dateRangePicker.startDate;
//         const endDate = dateRangePicker.endDate;

//         // Calculate the difference in milliseconds
//         const diffInMs = endDate.diff(startDate); // Difference in milliseconds

//         // Convert milliseconds to seconds
//         const diffInSec = Math.floor(diffInMs / 1000);

//         // Calculate hours, minutes, and seconds
//         const hours = Math.floor(diffInSec / 3600); // Total hours
//         const minutes = Math.floor((diffInSec % 3600) / 60); // Remaining minutes
//         const seconds = diffInSec % 60; // Remaining seconds

//         // Format the result
//         const duration = `${hours}h ${minutes}m ${seconds}s`;

//         $('.timer').text(duration);

//         var min_spend= $('#minimum_spend').val();
//         $('.min_spend').text(min_spend);
//         var est_saving= $('#estimated_savings').val();
//         $('.est_saving').text(est_saving);
//         if(min_spend == '')
        
//             $('.min').css('display','none');
        
//         if(est_saving == '')
        
//             $('.est').css('display','none');
        
        


//     })

//   </script>

@endsection