@extends('business_dashboard.master_layout')

@section('title', 'Dashboard')

@section('content')
    @if (@$business[0]->plan == 2)
        <div class="drop-main">

            <span class="drop1">

                <img src="{{ asset('business_dashboard/assets/images/loc-icon.svg') }}" alt="icon">

                <select>

                    <option checked>Select </option>

                    @foreach ($locations as $location)
                        <option>{{ $location->address }}</option>
                    @endforeach

                </select>

            </span>

            <span class="drop1">

                <img src="{{ asset('business_dashboard/assets/images/Shape1.svg') }}" alt="icon">

                <select>

                    <option checked>Select </option>

                    @foreach ($locations as $location)
                        <option>{{ $location->address }}</option>
                    @endforeach

                </select>

            </span>

        </div>
    @endif
    <div class="row customer-outer">

        <div class="col-md-4">

            <div class="customer-main">

                <span class="customer-count">{{ $data['customers'] }}</span>

                <p>Total Customers</p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="customer-main">

                <span class="customer-count">{{ $data['stamps'] }}</span>

                <p>Total Stamps Collected</p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="customer-main">

                <span class="customer-count">{{ $data['comp'] }}</span>

                <p>Loyalty cards completed this week</p>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="chart-main">
                <h2 style="margin:0px 0px 15px 0px;">Stamps collected this week</h2>
                <canvas id="myChart" width="400" height="400"></canvas>

                <!--<img src="{{ asset('business_dashboard') }}/assets/images/chart.png" alt="chart">-->

            </div>

        </div>

        <div class="col-md-6">

            <div class="chart-main">
                <h2 style="margin:0px 0px 15px 0px;">Loyalty cards completed this week</h2>

                <canvas id="myChart2" width="400" height="400"></canvas>

                <!--<img src="{{ asset('business_dashboard') }}/assets/images/chart.png" alt="chart">-->

            </div>

        </div>

    </div>
    @if (@$business[0]->plan == 2)
        <div class="row">


            <div class="col-sm-12 col-md-4">

                <div class="chart-main">

                    <canvas id="myChart3" width="400" height="400"></canvas>
                    <h2 style="margin:0px 0px 15px 0px;text-align: center">Age Split</h2>

                    <!--<img src="{{ asset('business_dashboard') }}/assets/images/chart2.png" alt="chart">-->

                </div>

            </div>



            <div class="col-sm-12 col-md-4">

                <div class="chart-main">
                    <canvas id="oilChart" width="600" height="400"></canvas>

                    <h2 style="margin:0px 0px 15px 0px;text-align: center">Gender Split</h2>


                    <!--<img src="{{ asset('business_dashboard') }}/assets/images/chart2.png" alt="chart">-->

                </div>

            </div>



            <div class="col-sm-12 col-md-4">

                <div class="chart-main">

                    <canvas id="myChart5" width="400" height="400"></canvas>
                    <h2 style="margin:0px 0px 15px 0px;text-align: center">Daily Card Scans</h2>

                    <!--<img src="{{ asset('business_dashboard') }}/assets/images/chart2.png" alt="chart">-->

                </div>

            </div>


        </div>
    @endif
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');



        // Access the array elements
        var daily_stamps_collected =
            <?php echo json_encode($data['daily_stamps_collected']); ?>;


        const myChart = new Chart(ctx, {

            type: 'bar',

            data: {

                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],

                datasets: [{

                    label: 'Daily Stamps Collected',

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

                        'rgba(255, 99, 132, 1)',

                        'rgba(54, 162, 235, 1)',

                        'rgba(255, 206, 86, 1)',

                        'rgba(75, 192, 192, 1)',

                        'rgba(153, 102, 255, 1)',

                        'rgba(255, 159, 64, 1)',

                        'rgba(255, 159, 64, 1)'

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
                    }

                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });

        const ctx2 = document.getElementById('myChart2').getContext('2d');
        // Access the array elements
        var daily_redeemed_points =
            <?php echo json_encode($data['daily_redeemed_points']); ?>;
        const myChart2 = new Chart(ctx2, {

            type: 'bar',

            data: {

                labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],

                datasets: [{

                    label: 'Rewards Redeemed',

                    data: daily_redeemed_points,

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

                        'rgba(255, 99, 132, 1)',

                        'rgba(54, 162, 235, 1)',

                        'rgba(255, 206, 86, 1)',

                        'rgba(75, 192, 192, 1)',

                        'rgba(153, 102, 255, 1)',

                        'rgba(255, 159, 64, 1)',

                        'rgba(255, 159, 64, 1)'

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
                    }

                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });



        const ctx3 = document.getElementById('myChart3').getContext('2d');



        const myChart3 = new Chart(ctx3, {

            type: 'bar',

            data: {

                labels: ['15-24', '25-34', '35-44', '45-54', '55-64', '65-74', '75+'],

                datasets: [{

                    label: '',

                    data: [0, 20, 30, 40, 45],

                    backgroundColor: [

                        'rgba(255, 255, 255, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)'

                    ],

                    borderColor: [

                        'rgba(255, 255, 255, 1)',

                        'rgba(54, 162, 235, 1)',

                        'rgba(255, 206, 86, 1)',

                        'rgba(75, 192, 192, 1)',

                        'rgba(153, 102, 255, 1)',

                        'rgba(255, 159, 64, 1)',

                        'rgba(255, 159, 64, 1)'

                    ],

                    borderWidth: 1

                }]

            },

            options: {

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });



        // const ctx4 = document.getElementById('myChart4').getContext('2d');

        // const myChart4 = new Chart(ctx4, {

        //     type: 'polarArea',

        //    data:{

        //   labels: [

        //     'Male',

        //     'Female',

        //     'Other',

        //     // 'Grey',

        //     // 'Blue'

        //   ],

        //   datasets: [{

        //     label: 'Gender Split',

        //     data: [11, 16,20],

        //     backgroundColor: [

        //       'rgb(255, 99, 132)',

        //       'rgb(75, 192, 192)',

        //       'rgb(255, 205, 86)',

        //       // 'rgb(201, 203, 207)',

        //       // 'rgb(54, 162, 235)'

        //     ]

        //   }]

        // },

        //     options: {

        //          plugins: {

        //             title: {

        //                 display: false,

        //                 text: 'Gender Split'

        //             }

        //         },

        //         scales: {

        //             y: {

        //                 beginAtZero: true,
        //                 display: false,

        //             }

        //         }

        //     }

        // })



        const ctx5 = document.getElementById('myChart5').getContext('2d');

        // const myChart5 = new Chart(ctx5, {

        //     type: 'polarArea',

        //    data:{

        //   labels: [

        //     'Red',

        //     'Green',

        //     'Yellow',

        //     'Grey',

        //     'Blue'

        //   ],

        //   datasets: [{

        //     label: 'Daily Card Scans',

        //     data: [11, 16, 7, 3, 14],

        //     backgroundColor: [

        //       'rgb(255, 99, 132)',

        //       'rgb(75, 192, 192)',

        //       'rgb(255, 205, 86)',

        //       'rgb(201, 203, 207)',

        //       'rgb(54, 162, 235)'

        //     ]

        //   }]

        //     },

        //         options: {

        //              plugins: {

        //                 title: {

        //                     display: false,

        //                     text: 'Daily card Scans'

        //                 }

        //             },

        //             scales: {

        //                 y: {

        //                     beginAtZero: true

        //                 }

        //             }

        //         }

        // })

        const myChart5 = new Chart(ctx5, {

            type: 'bar',

            data: {

                labels: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],

                datasets: [{

                    label: '',

                    data: [20, 30, 40, 50, 60, 20],

                    backgroundColor: [

                        'rgba(255, 255, 255, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)',

                        'rgba(255, 70, 98, 1)'

                    ],

                    borderColor: [

                        'rgba(255, 255, 255, 1)',

                        'rgba(54, 162, 235, 1)',

                        'rgba(255, 206, 86, 1)',

                        'rgba(75, 192, 192, 1)',

                        'rgba(153, 102, 255, 1)',

                        'rgba(255, 159, 64, 1)',

                        'rgba(255, 159, 64, 1)'

                    ],

                    borderWidth: 1

                }]

            },

            options: {

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });


        var oilCanvas = document.getElementById("oilChart");

        var oilData = {
            labels: [
                "Male",
                "Female",
                "Other",
            ],
            datasets: [{
                data: [100, 50, 10],
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
    </script>



@endsection
