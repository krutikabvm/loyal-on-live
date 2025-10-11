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

        .select2-container {
                width: 100% !important; /* Ensures Select2 stretches to full container width */
            }

        /* If needed, adjust the dropdown width */
        .select2-selection{
            padding:1px 12px;
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

            .dropdown-calendar-container {
            position: relative;
            width: 300px;
            margin: 6px 16px;
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
            background:#ffb423;
            /* padding:0 50px; */
            -webkit-mask:
            radial-gradient(circle 3px,#fff 97%, transparent 100%) bottom/9px 200% space content-box,
            linear-gradient(#fff 0 0);
            -webkit-mask-composite:destination-out;
            mask-composite: exclude;
        }

        .box2 {
            height:8px;
            background:#FF870D;
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
            background-image: radial-gradient(circle at 6px 0, rgba(255,255,255,0) 0.4em, #FF9514 0.3em);
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
        .perk-container {
            background: linear-gradient(to bottom, #FFB523, #FF870D);
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
            border-radius: 20px;
            background: #fec074;
            height: 22px;
            width: 42.14px;
            margin-right: 3px;
            line-height: 25px;
            text-align: center;
            /* cursor: pointer; */
            color:#FF9514;
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
            /* .perk-ticket{
                margin: 16px 16px!important;
            } */

             .ticket{
                margin:18px 25px!important;
             }
        }



        .weekDays-selector input[type=checkbox]:checked + label {
        background: #ffffff;
        color: #FF9514;
        }

        .weekDays-selector1 input[type=checkbox] + label {
            height: 30px;
            width: 28px;
            margin-right: 1px;
            line-height: 32px;
        }
        .select2-search__field{
            width: 100%!important;
        }
        .perk-ticket {
            background-image: url('/admin_dashboard/assets/images/mask_group.png');
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
            padding: 8px 15px;
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

    </style>
    <div class="busines1-main">

        <div class="switch-field">

            <a href="{{ url()->previous()}}" class="back-btn"> <img src="{{asset('admin_dashboard/assets/images/back.png')}}" alt="img" style="width:auto!important">  Perks Portal / Create Limited time perk</a>

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
            <form action="{{ route('limited_perk.update',$ongoingPerk->id) }}" method="POST" id="limited_perks_form">
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
                        <li>Design to get customers in the door!
                            <br>
                            e.g 'Buy 1 get 1 Free ice cream, for this weekend only!
                        </li>
                        <li>Have up to 2 Limited time perks running at same time
                        </li>
                        <li>Set limit on how many are available in total</li>
                        <li>Run for up to 14 days</li>
                        </ul>
                    </div>

                    <div class="account-type-main" style="margin-top:25px">
                            <div style="">
                                <div style="display:flex;justify-content: space-between">
                                    <label for="description">Perk description</label>
                                    <div data-toggle="tooltip" data-placement="top" title="Deal Description">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                    </div>
                                </div>
                                <textarea id="description" name="description" class="form-control" placeholder="Input perk description…">{{$ongoingPerk->description}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4" style="margin-top:6px">
                                    <div class="">

                                        <div style="display:flex;justify-content: space-between">
                                            <label for="limit">Set availability limit</label>
                                            <div data-toggle="tooltip" data-placement="top" title="Set availability limit">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                                </svg>
                                            </div>

                                        </div>
                                    
                                        <select id="limit" name="limit" class="form-control">
                                            <option {{$ongoingPerk->limit == 'No Limit' ?'selected':''}}>No Limit</option>
                                            @for($i=1;$i<=100;$i++)
                                                <option {{$ongoingPerk->limit == $i ?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top:6px">
                                    <div class="">
                                        <div style="display:flex;justify-content: space-between">
                                            <label for="setTime">Set time of day available</label>
                                            <div data-toggle="tooltip" data-placement="top" title="SeTime of day available">
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

                                        <div style="display:flex;justify-content: space-between">
                                            <label for="week_days">Week days available</label>
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
                            <div class="row">
                            <div class="dropdown-calendar-container">
                                <div style="display:flex;justify-content: space-between">
                                    <label>Expires/Schedule </label>
                                    <div data-toggle="tooltip" data-placement="top" title="Expires/Schedule">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                        </svg>
                                    </div>
                                </div>
                                <!-- Input with Dropdown and Calendar -->
                                <div id="input" class="dropdown-calendar">
                                <input type="hidden" name="expiration_date" class="expiration_date" value="{{$ongoingPerk->expiration_date}}">

                                <span id="selected-text">{{$ongoingPerk->date_range}} - {{$ongoingPerk->expiration_date}} <i class="fa arrow-down"></i></span>

                                <button id="toggle-calendar" class="dateRange" type="button" style="background-color:white;border:none">📅</button>
                                </div>

                                <!-- Dropdown Menu for Quick Add -->
                                <div class="dropdown-menu" id="dropdown-menu">
                                <ul>
                                    <li data-days="14">14 Days</li>
                                    <li data-days="13">13 Days</li>
                                    <li data-days="12">12 Days</li>
                                    <li data-days="11">11 Days</li>
                                    <li data-days="10">10 Days</li>
                                    <li data-days="9">9 Days</li>
                                    <li data-days="8">8 Days</li>
                                    <li data-days="7">7 Days</li>
                                    <li data-days="6">6 Days</li>
                                    <li data-days="5">5 Days</li>
                                    <li data-days="4">4 Days</li>
                                    <li data-days="3">3 Days</li>
                                    <li data-days="2">2 Days</li>
                                    <li data-days="1">1 Day</li>
                                    <li data-days="0.5">12 Hours</li>
                                    <li data-days="0.4583333333333333">11 Hours</li>
                                    <li data-days="0.4166666666666667">10 Hours</li>
                                    <li data-days="0.375">9 Hours</li>
                                    <li data-days="0.3333333333333333">8 Hours</li>
                                    <li data-days="0.2916666666666667">7 Hours</li>
                                    <li data-days="0.25">6 Hours</li>
                                    <li data-days="0.20833333333333334">5 Hours</li>
                                    <li data-days="0.16666666666666666">4 Hours</li>
                                    <li data-days="0.125">3 Hours</li>
                                    <li data-days="0.08333333333333333">2 Hours</li>
                                    <li data-days="0.041666666666666664">1 Hour</li>
                                </ul>
                                </div>

                                <!-- Calendar Input -->
                                <input type="text" id="date-range-picker" value="{{$ongoingPerk->date_range}}" name="date_range" class="calendar" placeholder="Select custom date range">
                            </div>

                            </div>
                            <a class="advance">Advanced options</a>
                            <a class="hideOption hide">Hide options</a>

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
                                    <div style="display:flex;justify-content: space-between">
                                        <label>T&Cs Text </label>
                                        <div data-toggle="tooltip" data-placement="top" title="Expires/Schedule">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                            </svg>
                                        </div>
                                    </div>



                                        <textarea class="form-control" name="terms">{{$ongoingPerk->terms}}</textarea>
                                    </div>
                                </div>
                            </div>


                    </div>

                    <a class="btn runLimited btn-primary xs-hidden" onclick="openModal()">Run Limited Time Perk → </a>
                </div>

                <div class="col-md-5">
                  <div class="account-type-main" style="align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                        <div>
                            <div style="display:flex;justify-content: space-between">
                                <h4 style="font-weight:bold">Perk review:</h3>
                                <div data-toggle="tooltip" data-placement="top" title="Perk review">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="perk-ticket" style="padding-bottom:24px">
                                <div class="header">
                                <span class="perk-text" style="display:flex;align-items:center;gap:2px;font-size: 10.48px;">
                                    <svg style="" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.242188" y="0.378906" width="15.7263" height="15.7263" rx="7.86316" fill="white"/>
                                    <path d="M8.45336 4.32339C8.54337 4.17884 8.74212 4.25189 8.74212 4.42953V7.51169H10.3432C10.4726 7.51169 10.5479 7.67957 10.4727 7.80045L7.75728 12.1608C7.66724 12.3053 7.46852 12.2323 7.46852 12.0547V8.97247H5.86749C5.738 8.97247 5.66268 8.80463 5.73794 8.68375L8.45336 4.32339Z" fill="#E301E7"/>
                                    </svg>
                                    Limited time perk
                                    </span>
                                    <span class="timer" style="font-size: 11.79px;">00h 00m 00s</span>
                                </div>
                                <div class="content" style="margin-top: 26px;margin-left: 12px;margin-right: 12px;">
                                    <h3 style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px;line-height:20px;margin-top:32px" class="title">Perk Description...</h3>
                                    <div style="text-align:left;margin-top: 22px;margin-bottom: 12px;">
                                    <span class="est hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Est Saving: <span style="color:white;font-weight:bold" class="est_saving">£-</span></span>
                                    <span class="min hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Min spend: <span style="color:white;font-weight:bold" class="min_spend">£-</span></span>
                                    </div>

                                    <div style="color:#ffffffab;text-align:left;font-size:10px;margin-top:52px" class="timeAvailable">Time available:
                                        <span class="availableTime" style="font-weight:bold;color:white"> </span>
                                    </div>
                                    <div class="weekDays-selector" style="display: flex;justify-content: space-between;margin-top:4px;">
                                        <input type="checkbox" id="weekday-mon" class="weekday" data-day="mon"/>
                                        <label >M</label>
                                        <input type="checkbox" id="weekday-tue" class="weekday" data-day="tue"/>
                                        <label>T</label>
                                        <input type="checkbox" id="weekday-wed" class="weekday" data-day="wed" />
                                        <label >W</label>
                                        <input type="checkbox" id="weekday-thu" class="weekday" data-day="thu"/>
                                        <label >T</label>
                                        <input type="checkbox" id="weekday-fri" class="weekday" data-day="fri"/>
                                        <label >F</label>
                                        <input type="checkbox" id="weekday-sat" class="weekday" data-day="sat" />
                                        <label >S</label>
                                        <input type="checkbox" id="weekday-sun" class="weekday" data-day="sun"/>
                                        <label >S</label>
                                    </div>
                                </div>
                                <button style="background-color:white;border-radius:15px;color:#FF3D5A;border-color:white;width:95%;padding:6px;border-bottom:white;border-right:white;font-size:10px;font-weight:bold;margin:6px 10px;margin-bottom:6px">Claim Perk <span style="font-size:8px;font-weight:100"> Only <span class="count" >-</span> available!</span></button>
                            </div>

                            <div style="margin-top:12px">
                                <div class="">
                                <div style="display:flex;justify-content: space-between">
                                    <label for="pin-display" class="form-label">Perk Pin</label>
                                    <div data-toggle="tooltip" data-placement="top" title="Perk Pin">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                        </svg>
                                    </div>
                                </div>
                                    <div id="input" class="dropdown-calendar">
                                        <input id="pin-display" name="pin" value="0000" style="border:none;font-weight:bold;width:50%">
                                        <div class="regenerate-btn" style="background-color:white; border:none;display: flex;align-items: center;gap: 4px;">
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.00343 11.151C3.42609 11.151 1.33675 9.06171 1.33675 6.48438C1.33675 3.90705 3.42609 1.81771 6.00343 1.81771C7.86503 1.81771 9.4721 2.90778 10.221 4.48444H8.53676C8.16856 4.48444 7.8701 4.78292 7.8701 5.15111C7.8701 5.51931 8.16856 5.81778 8.53676 5.81778H11.8701C12.0469 5.81778 12.2165 5.74751 12.3415 5.62251C12.4665 5.49751 12.5368 5.32791 12.5368 5.15111V1.81778C12.5368 1.44958 12.2383 1.15111 11.8701 1.15111C11.5019 1.15111 11.2034 1.44958 11.2034 1.81778V3.48904C10.1666 1.69306 8.22616 0.484375 6.00343 0.484375C2.68971 0.484375 0.00341797 3.17067 0.00341797 6.48438C0.00341797 9.79811 2.68971 12.4844 6.00343 12.4844C8.56623 12.4844 10.7538 10.8776 11.6136 8.61644C11.7656 8.21664 11.4476 7.81771 11.0198 7.81771H10.974C10.679 7.81771 10.4236 8.01371 10.3097 8.28578C9.60483 9.96871 7.94223 11.151 6.00343 11.151Z" fill="black" fill-opacity="0.5"/>
                                        </svg>

                                        Regenerate pin
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="account-type-main" style="align-items:Center;gap:12px;border-radius:12px;padding:21px 20px;">
                        <div>
                            <div style="display:flex;justify-content: space-between">
                                <h4 style="font-weight:bold">What customer sees when they tap the perk in the app:</h3>
                                <div data-toggle="tooltip" data-placement="top" title="What customer sees when they tap the perk in the app:">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 7.00016C13.6668 10.682 10.682 13.6668 7.00016 13.6668C3.31826 13.6668 0.333496 10.682 0.333496 7.00016C0.333496 3.31826 3.31826 0.333496 7.00016 0.333496C10.682 0.333496 13.6668 3.31826 13.6668 7.00016ZM6.51723 8.0045C6.33236 8.0045 6.1753 7.8531 6.1997 7.6699C6.21323 7.56856 6.23436 7.49663 6.26316 7.3987C6.26876 7.3795 6.27483 7.3591 6.28103 7.33743C6.3471 7.11583 6.44296 6.9369 6.5687 6.8005C6.69443 6.66416 6.8457 6.54056 7.02256 6.42976C7.15463 6.34456 7.2729 6.2561 7.3773 6.1645C7.4817 6.0729 7.56483 5.9717 7.62656 5.8609C7.68836 5.74796 7.7193 5.62225 7.7193 5.48376C7.7193 5.33674 7.6841 5.20783 7.61383 5.09704C7.5435 4.98624 7.4487 4.90102 7.32936 4.84136C7.21216 4.7817 7.08223 4.75187 6.93943 4.75187C6.80096 4.75187 6.6699 4.78276 6.54636 4.84455C6.42276 4.90421 6.32156 4.9937 6.2427 5.11302C6.2169 5.15134 6.19503 5.19274 6.17696 5.23722C6.10956 5.40343 5.97283 5.55087 5.7935 5.55087H5.15266C4.9653 5.55087 4.81155 5.39568 4.84135 5.21071C4.88594 4.93385 4.97806 4.69568 5.11771 4.49618C5.3116 4.21706 5.56835 4.00932 5.88796 3.87296C6.20756 3.73446 6.56016 3.66522 6.94583 3.66522C7.36983 3.66522 7.74483 3.73553 8.07083 3.87616C8.39683 4.01465 8.6525 4.216 8.8379 4.4802C9.02323 4.74441 9.11596 5.06295 9.11596 5.43582C9.11596 5.6851 9.07436 5.9067 8.9913 6.10056C8.9103 6.29236 8.79636 6.46283 8.6493 6.61196C8.5023 6.75896 8.32863 6.89216 8.12836 7.01143C7.96003 7.11163 7.82156 7.21603 7.7129 7.3247C7.60636 7.43336 7.52643 7.55903 7.47316 7.70183C7.4693 7.71263 7.46556 7.72356 7.4619 7.7345C7.4113 7.8877 7.2759 8.0045 7.11456 8.0045H6.51723ZM6.81476 10.3832C6.6017 10.3832 6.41956 10.3087 6.2683 10.1596C6.1191 10.0082 6.04563 9.82716 6.04776 9.61623C6.04563 9.40743 6.1191 9.22843 6.2683 9.0793C6.41956 8.93016 6.6017 8.85556 6.81476 8.85556C7.01723 8.85556 7.1951 8.93016 7.34856 9.0793C7.50196 9.22843 7.5797 9.40743 7.58183 9.61623C7.5797 9.75683 7.54243 9.88576 7.46996 10.003C7.3997 10.118 7.30696 10.2107 7.1919 10.281C7.0769 10.3492 6.95116 10.3832 6.81476 10.3832Z" fill="black" fill-opacity="0.5"/>
                                    </svg>
                                </div>
                            </div>
                            <div style="background-color:#fafbff;display:flex;flex-direction:column;align-items:center">
                                <div>
                                    <div class="perk-ticket ticket" style="background-image: url('/admin_dashboard/assets/images/mask_group_1.png');margin-top:16px;padding:10px;margin:16px 72px">
                                        <div class="header" style="margin-top:3px;padding:5px 15px;">
                                            <span class="perk-text" style="display:flex;align-items:center;gap:2px;font-size: 10.48px;">
                                            <svg style="" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.242188" y="0.378906" width="15.7263" height="15.7263" rx="7.86316" fill="white"/>
                                            <path d="M8.45336 4.32339C8.54337 4.17884 8.74212 4.25189 8.74212 4.42953V7.51169H10.3432C10.4726 7.51169 10.5479 7.67957 10.4727 7.80045L7.75728 12.1608C7.66724 12.3053 7.46852 12.2323 7.46852 12.0547V8.97247H5.86749C5.738 8.97247 5.66268 8.80463 5.73794 8.68375L8.45336 4.32339Z" fill="#E301E7"/>
                                            </svg>
                                            Limited time perk
                                            </span>
                                            <span class="timer" style="font-size: 11.79px;">00h 00m 00s</span>
                                        </div>

                                        <div class="content" style="margin-top: 26px;margin-left: 10px;margin-right: 1px;margin-bottom:12px">
                                            <h3 style="color:#ffffffb3;text-align:left;font-family:Rammetto One,cursive!important;;font-size:14px" class="title">Perk Description...</h3>
                                            <div style="text-align:left;margin-top: 88px;margin-bottom: 16px;"  class="saving">
                                            <span class="est hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Est Saving: <span style="color:white;font-weight:bold" class="est_saving">£-</span></span>
                                            <span class="min hidden" style="font-size:10px;color:#ffffffab;text-align:left;">Min spend: <span style="color:white;font-weight:bold" class="min_spend">£-</span></span>
                                            </div>

                                            <div style="color:#ffffffab;text-align:left;font-size:10px">Time available:
                                                <span class="availableTime" style="font-weight:bold;color:white"> </span>
                                            </div>


                                            <div class="weekDays-selector weekDays-selector1" style="margin-top:12px;">
                                                <input type="checkbox" id="weekday-mon" class="weekday" data-day="mon" />
                                                <label >M</label>
                                                <input type="checkbox" id="weekday-tue" class="weekday" data-day="tue" />
                                                <label >T</label>
                                                <input type="checkbox" id="weekday-wed" class="weekday" data-day="wed" />
                                                <label>W</label>
                                                <input type="checkbox" id="weekday-thu" class="weekday" data-day="thu" />
                                                <label>T</label>
                                                <input type="checkbox" id="weekday-fri" class="weekday" data-day="fri" />
                                                <label>F</label>
                                                <input type="checkbox" id="weekday-sat" class="weekday" data-day="sat" />
                                                <label>S</label>
                                                <input type="checkbox" id="weekday-sun" class="weekday" data-day="sun"/>
                                                <label>S</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            <!-- </div> -->



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

                            <div style="padding:96px 26px 20px 26px" class="xs-hidden">Limited Time perks are subject to <a>Terms and condition</a></div>
                            </div>

                        </div>
                    </div>

                    <a class="btn runLimited btn-primary xs-block hidden" onclick="openModal()">Run Limited Time Perk → </a>

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
                    <span class="time-picker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <input id="basicExampleho"  value="9:00am" class="auto_time ui-timepicker-input from basicExampleho">
                      </span>
                    <div>

                        <span class="mx-2">To</span>

                    </div>
                    <div class="" style="margin-bottom:0">
                    <span class="time-picker">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <input id="basicExampleho1"  value="9:00am" class="auto_time ui-timepicker-input from basicExampleho">
                      </span>
                    </div>
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
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
        $('#description').trigger('keyup');

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

        function generatePin() {
                const pin = Math.floor(1000 + Math.random() * 9000); // Generates a number between 1000 and 9999
                document.getElementById('pin-display').value = pin;
                }

    $('.regenerate-btn').on('click',function(){
        const pin = Math.floor(1000 + Math.random() * 9000); // Generates a number between 1000 and 9999
            document.getElementById('pin-display').value = pin;
    })
            window.onload = generatePin();
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
            const liText = event.target.textContent.trim(); // Get the text and trim any extra spaces

            const days = parseFloat(event.target.getAttribute('data-days')); // Read fractional days
            const now = new Date();
            const futureDate = new Date();

            // Convert days to hours and add to the current time

            if(days >1){
                futureDate.setDate(now.getDate() + days);

                // Set end time to 23:59:59
                futureDate.setHours(23, 59, 59);

            }
            else{
                const hoursToAdd = days * 24;
                futureDate.setHours(now.getHours() + hoursToAdd);
            }


            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };


            // Update selected text with hours and dates

            const formattedStart = now.toLocaleString('en-GB', options).replace(',', '');
            const formattedEnd = futureDate.toLocaleString('en-GB', options).replace(',', '');

            // selectedText.textContent = `${hoursToAdd.toFixed(1)} Hour(s): ${now.toLocaleString()} - ${futureDate.toLocaleString()}`;
            selectedText.textContent = `${liText}: ${formattedStart} - ${formattedEnd}`;


            $('.expiration_date').val(formattedEnd);

            // Calculate the difference in milliseconds
            const diffInMs = futureDate - now; // Difference in milliseconds

            // Convert milliseconds to seconds
            const diffInSec = Math.floor(diffInMs / 1000);

            // Calculate hours, minutes, and seconds
            const hours = Math.floor(diffInSec / 3600); // Total hours
            const minutes = Math.floor((diffInSec % 3600) / 60); // Remaining minutes
            const seconds = diffInSec % 60; // Remaining seconds

            // Format the result
            
            const remainingHours = hours % 24;

            const duration = days > 1
            ? `${days} days`
            : `${hours}h ${minutes}m ${seconds}s`;
            $('.timer').text(duration);
            $('#date-range-picker').val(duration);

            // Update a timer element (optional, ensure `.timer` exists in your HTML)

            // Hide the dropdown menu
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
            selectedText.textContent = `Selected Range: ${start.format('DD/M/Y hh:mm:00 A')} - ${end.format('DD/M/Y hh:mm:00 A')}`;
            $('.expiration_date').val(end.format('DD/M/Y hh:mm:00 A'));

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


            const days = Math.floor(hours / 24);
            const remainingHours = hours % 24;

            const duration = days > 0
            ? `${days} days`
            : `${hours}h ${minutes}m ${seconds}s`;
            

            // Format the result
            // const duration = `${hours}h ${minutes}m ${seconds}s`;

            $('.timer').text(duration);
            $('#date-range-picker').val(duration);

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

            // $('.title').text(description);
        $('.title').css('color','white');
        }

    });

    $('#limit').on('change',function(){
        var limit = $('#limit').val();
        $('.count').text(limit);
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
                $('.timeAvailable').css('margin-top','12px');
                $('.saving').css('margin-top','60px');
            }

            $('.min').addClass('hidden');
        }
        else{
            $('.timeAvailable').css('margin-top','12px');
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
                $('.timeAvailable').css('margin-top','12px');
                $('.saving').css('margin-top','60px');
            }

            $('.est').addClass('hidden');
        }
        else{
            $('.timeAvailable').css('margin-top','12px');
            $('.saving').css('margin-top','60px');
            $('.est').removeClass('hidden');
        $('.est_saving').text('£'+est_saving);
        }
        
    });



    // $('.runLimited').on('click',function(){
    //     var min_spend= $('#minimum_spend').val();
    //     var est_saving= $('#estimated_savings').val();
    //     if(min_spend == '')

    //         $('.min').css('display','none');

    //     if(est_saving == '')

    //         $('.est').css('display','none');
    // })
  </script>

@endsection
