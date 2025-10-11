@extends('admin_dashboard.master_layout')

@section('title', 'Businesses Details')

@section('content')
    <style>
      .business-search{display: block;}
      .customer-search{display: none;}
      #reviews{ display: none; }
    </style>
    <div class="busines4-main">
      <div class="switch-field">
        <a href="{{route('admin.business_details', encrypt($business_details->id) )}}" class="back-btn"> <img src="{{asset('admin_dashboard/assets/images/back.png')}}" alt="img"> Back</a>
        @if(empty($business_details->activation_code))
          <a href="{{route('admin.active_account',encrypt($business_details->user_id) )}}" class="cancel-btn">Activate Account</a>
        @elseif(!empty($business_details->activation_code) && $business_details->account_status == "pending" )
             <a href="#" class="cancel-btn" id="pending">Pending</a>
        @else
            @if($business_details->delete == 0)
              <a href="{{route('admin.cancel_account',encrypt($business_details->user_id) )}}" class="cancel-btn">Cancel Account</a>
          @else
              <a href="{{route('admin.reactivate_account',encrypt($business_details->user_id) )}}" class="cancel-btn">ReActivate Account</a>
          @endif
        @endif
        <input type="radio" id="radio-one" name="switch-one" value="yes" checked/>
        <label for="radio-one">Profiles</label>
        <input type="radio" id="radio-two" name="switch-one" value="no" />
        <label for="radio-two">Review <sub> {{ count($business_reviews) }} </sub> </label>
      </div>
      <div  id="profiles">

        @foreach ($loyality as $key => $value)
        @php
           // dd($loyality);
        @endphp
         <div class="customer-amount-main">
            <div class="customer-stamp">
               <div class="stamp-main2">
                  <div class="logo-text-main2">
                     <img width="50px" id="m3" src="{{env('APP_URL').$business_details->image}}" alt="logo">
                     <span>
                        <p id="s_days2">Collect {{@$value->number_stamps}}</p>
                        <p id="s_reward2">stamps to Earn: {{@$value->description}}</p>
                     </span>
                  </div>
                  <div class="upi-main2" id="s_bk2" style="@if(empty($value->img ) ) display: none; @endif background-image:url('@if(!empty($value->img) ) {{ url(@$value->img) }}  @endif') ">
                     <ul class="nft-logo" id="days_logo2">
                        @for($stamps = 0; $stamps< @$value->number_stamps ; $stamps++ )
                            @if($stamps + 1 == $value->number_stamps)
                                <li class="active"><img src="{{ asset('business/assets/images/gift.svg') }}"></li>
                            @else
                                <li class="active"><img src="{{ asset('business/assets/images/all.svg') }}"></li>
                            @endif
                        @endfor
                     </ul>

                  </div>
               </div>
            </div>
            <div class="customer-right-content">
               <h2>Amount Of Customers: {{count(@$value->customer_loyalty)}}</h2>
               <div class="customer-outer">
                  <span>Name: <strong>Collected:</strong> </span>
                  @foreach(@$value->customer_loyalty as $customer)
                    <span>{{ $customer->name }} <strong>{{ $customer->collected_stamps }}/{{@$value->number_stamps}}</strong> </span>
                  @endforeach
               </div>
            </div>
         </div>
        @endforeach
        <div class="row">
          <div class="col-sm-4">
             <div class="three-col-text">
                <h2>{{$total_customers}}</h2>
                <p>Total Customers</p>
             </div>
          </div>
          <div class="col-sm-4">
             <div class="three-col-text">
                <h2>{{$total_stamps_collected}}</h2>
                <p>Total Stamps Collected</p>
             </div>
          </div>
          <div class="col-sm-4">
             <div class="three-col-text">
                <h2>{{@$complete_loyality_card}}</h2>
                <p>Completed Loyalty Cards</p>
             </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-4">
              <div class="chart-main">
                <canvas id="myChart3" width="400" height="400"></canvas>
                <h2 style="margin:0px 0px 15px 0px;text-align: center">Age Split</h2>
              </div>
          </div>

          <div class="col-sm-12 col-md-4">
              <div class="chart-main">
                  <canvas id="genderChart" width="600" height="400"></canvas>
                  <h2 style="margin:0px 0px 15px 0px;text-align: center">Gender Split</h2>
              </div>
          </div>

          <div class="col-sm-12 col-md-4">
              <div class="chart-main">
                <canvas id="myChart5" width="400" height="400"></canvas>
                <h2 style="margin:0px 0px 15px 0px;text-align: center">Daily Card Scans</h2>
              </div>
          </div>
        </div>

      </div>
      <div id="reviews">
            <ul class="business1-ul" >
                @if(!empty($business_reviews))
                    @foreach($business_reviews as $key => $b)
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
                                    @if($b->delete == 0 )
                                        <span class="p-info">Status: <strong class="active">Active</strong></span>
                                    @else
                                        <span class="p-info">Status: <strong class="text text-danger">De Active</strong></span>
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
                                <a href="{{route('admin.business_details',encrypt(@$b->id))}}" class="view-pro">View Profile</a>
                            </div>
                        </li>
                    @endforeach
                @endif
                <h3>No record found</h3>
            </ul>
            <div class="custom-pagination">
                <?php echo $business_reviews->render(); ?>
            </div>
      </div>

    </div>
    <div class="modal fade remove-pad" id="pendingCode" tabindex="-1" role="dialog" aria-labelledby="pendingCodeTitle" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered custom-style" role="document">

                <div class="modal-content">



                    <div class="modal-body">

                        <div class="active-body">

                        <h1 class="activ-head">ACTIVATE CODE</h1>

                            <div class="active-key-main">

                                <h1 class="text-center" style="font-weight: 600;font-size: 50px;">{{$business_details->activation_code}}</h1>




                            </div>

                            <button type="submit" class="acti-close-btn" data-dismiss="modal" style="background: #747784;" >Close</button>

                    </div>

                    </div>



                </div>

            </div>

    </div>
  <script>
    $("#pending").on('click',function(){
      $("#pendingCode").modal("show");
    });

  const ctx3 = document.getElementById('myChart3').getContext('2d');
  var ages =
 <?php echo json_encode($ages); ?>;
 var total_customers =
 <?php echo $total_customers; ?>;
   const myChart3 = new Chart(ctx3, {

    type: 'bar',

    data: {

        labels: ['15-24', '25-34', '35-44', '45-54', '55-64', '65-74','75+'],

        datasets: [{

            label: '',

            data: ages,

            backgroundColor: [

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)'

            ],

            borderColor: [

                'rgba(255, 255, 255, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)',

                'rgba(255, 70, 98, 1)'

            ],

            borderWidth: 1

        }]

    },

   options: {

          scales: {

              y: {

                beginAtZero: true,
       			suggestedMin: 0,
       			suggestedMax: 10,
              },

          },
          plugins: {
              legend: {
                  display: false
              }
          }
      }

  });
  var daily_stamps_collected =
 <?php echo json_encode($daily_stamps_collected); ?>;
   var max =
 <?php echo $total_stamps_collected ?>;
  const ctx5 = document.getElementById('myChart5').getContext('2d');
  const myChart5 = new Chart(ctx5, {

      type: 'bar',

      data: {

          labels: ['M', 'T', 'W', 'T', 'F','S','S'],

          datasets: [{

              label: '',

              data: daily_stamps_collected,

              backgroundColor: [

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)'

              ],

              borderColor: [

                  'rgba(255, 255, 255, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)',

                  'rgba(255, 70, 98, 1)'

              ],

              borderWidth: 1

          }]

      },

      options: {

          scales: {

              y: {

                beginAtZero: true,
       			suggestedMin: 0,
       			suggestedMax: max,
              },

          },
          plugins: {
              legend: {
                  display: false
              }
          }
      }

  });


var oilCanvas = document.getElementById("genderChart");
var gender =
 <?php echo json_encode($gender); ?>;

var oilData = {
    labels: [
        "Male",
        "Female",
        "Other",
    ],
    datasets: [
        {
            data: gender,
            backgroundColor: [

              'rgb(255, 99, 132)',

              'rgb(75, 192, 192)',

              'rgb(255, 205, 86)',
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});


 $("#radio-two").click(function(){
    $("#profiles").css("display","none");
    $("#reviews").css("display","block");
  });
  $("#radio-one").click(function(){
    $("#profiles").css("display","block");
    $("#reviews").css("display","none");
  });
  </script>
@endsection
