@extends('layouts.adminLayout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    @import url("{{asset('css/admin/dashboard.css')}}");
</style>

<div class="header">
    <h3>
        Dashboard
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="top">
    <!--  -->
    <div class="box top__box1">
        <div class="box__header">Orders Placed Per Category</div>
        <canvas id="top_box1Chart" width="100%" height="40%"></canvas>
    </div>
    <!--  -->
    <div class="box top__box2">
        <div class="box__header">Orders Completed Per Month</div>
        <canvas id="top_box2Chart" width="100%" height="35%"></canvas>
    </div>
    <!--  -->
    <div class="box top__box3">
        <div class="box__header">Best Category</div>
        <h4>Cleaners</h4>
    </div>
</div>

<div class="center">
    <div class="box center__box1">
        <div class="first">
            <div class="box__header--sm">Total Users</div>
            <h3>{{$total_users}}</h3>
        </div>
        <div class="second">
            <div class="box__header--sm">Total Orders</div>
            <h3>{{$total_orders}}</h3>
        </div>
        <div class="third">
            <div class="box__header--sm">Orders Completed</div>
            <h3>{{$orders_completed}}</h3>
        </div>
        <div class="fourth">
            <div class="box__header--sm">Orders Cancelled</div>
            <h3>{{$orders_cancelled}}</h3>
        </div>
    </div>
    <div class="box center__box2">
        <div class="left">
            <div class="box__header">No Of Service Providers </div>

            <div class="headings">
                @foreach($categories as $ctg)
                <div class="box__header--sm">
                    {{$ctg}}
                </div>
                @endforeach
            </div>

            <div class="values">
                @foreach($no_of_workers as $wkr)
                <h5>
                    {{$wkr}}
                </h5>
                @endforeach
            </div>

        </div>

        <div class="right">
            <div class="box__header">Biggest Categories</div>

            <div class="biggest__top"><i class="fa-solid fa-arrow-up-right-dots"></i> Cleaners</div>
            <div class="biggest__bottom"><i class="fa-solid fa-arrow-up-right-dots"></i> Plumbers</div>
        </div>
    </div>
</div>

<div class="bottom">
    <div class="box bottom__box1">
        <div class="box__header">Orders Cancelled Per Month</div>
        <canvas id="bottom_box1Chart" width="100%" height="30%"></canvas>
    </div>

    <div class="box bottom__box2">
        <div class="box__header">Category Feedback Average</div>

        <div class="headings">
            @foreach($categories as $ctg)
            <div class="box__header--sm">
                {{$ctg}}
            </div>
            @endforeach
        </div>

        <div class="values">
            @foreach($category_feedback_avg as $avg)
            <h5>
                {{$avg}} <i class="fa fa-star"></i>
            </h5>
            @endforeach
        </div>

    </div>

    <div class="box bottom__box3">
        <div class="box__header">Best Service Provider</div>

        <span>Abdul Hameed <br>
            <small>abdulhameed234@gmail.com</small>
        </span>
    </div>
</div>

<!-- Graphs/Charts -->
<script>
    // Canvas Variables //
    const ctx_top_box1Chart = document.getElementById('top_box1Chart').getContext('2d');
    const ctx_top_box2Chart = document.getElementById('top_box2Chart').getContext('2d');
    const ctx_bottom_box1Chart = document.getElementById('bottom_box1Chart').getContext('2d');
    // Top Box_1_Chart //
    const top_box1Chart = new Chart(ctx_top_box1Chart, {
        type: 'line',
        data: {
            labels: @json($categories),
            datasets: [{
                label: "",
                data: @json($category_orders),
                backgroundColor: [
                    'rgb(148,83,255,0.05)',
                ],
                borderColor: [
                    'rgb(148,83,255)',
                ],
                borderWidth: 0.5,
                fill: true,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: function(context) {
                            return 'rgb(62,58,80)';
                        },
                    },
                },
                x: {
                    grid: {
                        color: function(context) {
                            return 'rgb(62,58,80)';
                        },
                    },
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Top Box_2_Chart //
    const top_box2Chart = new Chart(ctx_top_box2Chart, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: "",
                data: @json($month_orders),
                backgroundColor: [
                    'rgb(148,83,255,0.2)',
                    'rgb(20,163,240,0.2)'
                ],
                borderColor: [
                    'rgb(148,83,255)',
                    'rgb(20,163,240)'
                ],
                borderWidth: 0.5,
                hoverBorderWidth: 1,
                barThickness: 25,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: function(context) {
                            return 'rgb(62,58,80)';
                        },
                    },
                },
                x: {
                    grid: {
                        color: function(context) {
                            return 'transparent';
                        },
                    },

                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Bottom Box_1_Chart //
    const bottom_box1Chart = new Chart(ctx_bottom_box1Chart, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: "",
                data: @json($month_orders_cancelled),
                backgroundColor: 'rgb(228,96,119,0.2)',
                borderColor: 'rgb(228,96,119)',
                borderWidth: 0.5,
                pointBackgroundColor: "rgb(228,96,119,0.6)",
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: function(context) {
                            return 'rgb(62,58,80)';
                        },
                    },
                },
                x: {
                    grid: {
                        color: function(context) {
                            return 'rgb(62,58,80)';
                        },
                    },
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>


@endsection