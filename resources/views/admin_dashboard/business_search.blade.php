@extends('admin_dashboard.master_layout')

@section('title', 'Businesses Search')

@section('content')
    <style>
        .business-search{display: block;}
        .customer-search{display: none;}
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
    <div class="busines1-main">
        <!-- <div class="switch-field">
            <input type="radio" id="radio-one" name="switch-one" value="yes" checked/>
            <label for="radio-one">Profiles</label>
            <input type="radio" id="radio-two" name="switch-one" value="no" />
            <label for="radio-two">Review  </label>
        </div> -->
        @if(count($business) > 0 )
            <ul class="business1-ul">
                @foreach($business as $key => $b)
                    <li>
                        <div class="busi-left">
                            <span class="p-img">
                                @if(!empty($b->image) )
                                    <img src="{{env('APP_URL').$b->image}}" alt="no img">
                                    
                                @else
                                    <img src="{{asset('admin_dashboard/assets/images/cafe.png') }}" alt="no img">

                                @endif
                            </span>
                            <div class="about-person">
                                <span class="p-info">Name: <strong>{{ @$b->business_name }}</strong></span>
                                <span class="p-info">Account Type: <strong class="premium">@if($b->plan == 1 ) Free @else Premium @endif</strong> </span>
                                <span class="p-info">Loyalty Cards: <strong>{{ @$b->loyality_cards }}</strong></span>
                                @if($b->account_status == "active" )
                                    <span class="p-info">Status: <strong class="active">Active</strong></span>
                                @else
                                    <span class="p-info">Status: <strong class="text text-danger">Pending</strong></span>
                                @endif
                                @if(!empty($b->created_at) )
                                    <span class="p-info">Account Created: <strong>{{ date('d-m-Y',strtotime(@$b->created_at)) }}</strong></span>
                                @else
                                    <span class="p-info">Account Created: <strong>NULL</strong></span>
                                @endif
                                <span  class="p-info">Customers: <strong>{{ @$b->customers }}</strong></span>
                            </div>
                        </div>
                        <div class="busi-right">
                            <!-- <div class="platform-main">
                                <span>Platform: </span>
                                <span><img src="{{asset('admin_dashboard/assets/images/android.png') }}" alt="no img"></span>
                                <span><img src="{{asset('admin_dashboard/assets/images/apple.png') }}" alt="no img"></span>
                            </div> -->
                            <a href="{{route('admin.business_details',encrypt(@$b->id))}}" class="view-pro">View Profile</a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="custom-pagination">
                <?php echo $business->render(); ?>
                <p>
                    Displaying {{$business->count()}} of {{ $business->total() }} business(s).
                </p>
            </div>
        @else
            <h3>No record found</h3>
        @endif
    </div>
@endsection