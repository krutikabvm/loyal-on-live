@extends('admin_dashboard.master_layout')

@section('title', 'Plans')

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
    <div class="plan-main">
        <h2 class="customer-head">Edit Plans</h2>
      
        <div class="plan-outer">
            <div class="pkg-outer">
                @foreach($plans as $plan)
                    @php 
                        $features = unserialize($plan->plan_features);
                        $upcoming = unserialize($plan->upcoming_features);
                    @endphp
                    <div class="pkg-main">
                        <span class="edit-plan" data-toggle="modal" data-target="#exampleModalCenter{{$plan->id}}"> <img src="{{asset('admin_dashboard/assets/images/round-e.png') }}" alt="icon"> </span>
                        <h3 class="pkg-title">{{$plan->plan_name}}</h3>
                        <span class="pkg-sub-title">({{$features[0]}})</span>
                        <ul class="pkg-ul">
                            @for($i = 1; $i <= sizeof($features)-1; $i++ )
                                <li>
                                    <span>{{$features[$i]}}</span>
                                </li>
                            @endfor

                            @if(!empty($upcoming))
                                 <li>
                                    <span>*Coming Soon*</span>
                                     @for($i = 0; $i < sizeof($upcoming); $i++ )
                                        <p> {{ $upcoming[$i] }}</p>
                                    @endfor
                                </li>
                            @endif
                        </ul>
                        <span class="pkg-price">{{$plan->plan_price}}</span>
                    </div>
                        <!-- popup -->
                    <div class="modal fade remove-pad" id="exampleModalCenter{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$plan->id}}" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered custom-style" role="document">
                        
                            <div class="modal-content">
                        
                        
                        
                                <div class="modal-body">
                                
                                    <div class="p-3">
                                        <form action="{{route('admin.save_plan') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{encrypt($plan->id)}}" name="id">
                                            <div class="form-group">
                                                <label for="">Plan</label>
                                                <input type="text" value="{{$plan->plan_name}}" name="plan_name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Features</label>
                                                @for($i = 0; $i < sizeof($features); $i++ )
                                                    <input type="text" value="{{$features[$i]}}" name="features[]" class="form-control">
                                                @endfor
                                            </div>
                                            @if(!empty($upcoming))
                                                <div class="form-group">
                                                    <label for="">Upcoming Features</label>
                                                    @for($i = 0; $i < sizeof($upcoming); $i++ )
                                                        <input type="text" value="{{$upcoming[$i]}}" name="upcoming[]" class="form-control">
                                                    @endfor
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="">Plan Price</label>
                                                <input type="text" value="{{$plan->plan_price}}" name="plan_price" class="form-control">
                                            </div>
                                            <div class="form-group text-center">
                                                <button class="btn btn-success btn-lg"> Update Plan</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                                
                              
                        
                            </div>
                        
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
    </script>
@endsection