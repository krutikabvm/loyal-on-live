@extends('admin_dashboard.master_layout')

@section('title', 'Customers')

@section('content')
<style>
    .business-search{display: none;}
    .customer-search{display: block;}
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
             
        <ul class="business1-ul">
            @if(!empty($business))
                @foreach($business as $key => $b)
                    @if($b->email_verified_at != "")
                        <li>
                            <div class="busi-left">
                                <span class="p-img">
                                     @if(!empty($b->img) )
                                        <img src="{{url($b->img)}} " id="previewImg" alt="cover-img">
                                    @else
                                        <img src="{{asset('admin_dashboard/assets/images/girl.png') }}" alt="no img">
                                    @endif

                                </span>
                                <div class="about-person">
                                    <span class="p-info">Name: <strong>{{@$b->name}}</strong></span>
                                    <span class="p-info">Loyalty Cards: <strong>{{@$b->loyality_cards}}</strong></span>
                                   
                                    <span class="p-info">Platform: 
                                        @if($b->device_type == "android")    
                                            <img src="{{asset('admin_dashboard/assets/images/android-icon.png') }}" alt="no img">
                                        @elseif($b->device_type == "ios")
                                            <img src="{{asset('admin_dashboard/assets/images/apple-icon.png') }}" alt="no img">
                                        @endif  
                                    </span>
                                </div>
                            </div>
                            <div class="busi-right2">
                                
                                <a href="{{route('admin.customer_details',encrypt($b->id) )}}" class="view-pro">View Profile</a>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <p>No record found</p>
            @endif

        </ul>
        <div class="custom-pagination">
            <?php echo $business->render(); ?>
        </div>
    </div>
@endsection