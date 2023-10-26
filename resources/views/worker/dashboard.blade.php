@extends('layouts.workerLayout')
@section('content')

<style>
    @import url("{{asset('css/worker/dashboard.css')}}");
</style>

<div class="main-container container-fluid d-flex justify-content-between px-2">
    <!-- left panel -->
    <div class="col-9 m-0 p-0 pr-2">
        <!-- header -->
        <div class="header container col-4 d-flex justify-content-between align-items-center mt-2 py-0 px-3 border-bottom">
            <h5 class="m-0">
                Dashboard
            </h5>

            <h6 class="p-0 m-0">
                {{ date("j F Y");}}
            </h6>
        </div>

        <!-- row 1 -->
        <div class="row1 mt-4">
            <!-- heading -->
            <h4 class="mb-2 ml-4">Overview</h4>
            <!-- data -->
            <div class="wrapper row m-0 d-flex justify-content-between px-4">
                <div class="overviews">
                    <h4>{{ Session::get('data')->status }}</h4>
                    <small><i class="fa fa-gear"></i> Working Status</small>
                </div>
                <div class="overviews">
                    <h4>{{ Session::get('data')->category }}</h4>
                    <small><i class="fa fa-filter"></i> Category</small>
                </div>
                <div class="overviews">
                    <h4>{{$avg_rating}} stars</h4>
                    <small><i class="fa fa-star"></i> Average Rating</small>
                </div>
            </div>
        </div>

        <!-- row 2 -->
        <div class="row2 container-fluid m-0 mt-4 px-4 pt-0">
            <!-- heading -->
            <h4 class="mb-2">Pending Orders</h4>
            <div class="scroll-wrapper">
                <!-- current orders -->

                @foreach($pending_orders as $order)
                <div class="current-orders col-12 mb-2 px-4 py-3">
                    <div class="row m-0 p-0">
                        <h6 class="mr-3 py-1 px-2"><small>Placed by</small> <br> {{$order->name}}</h6>
                        <h6 class=" py-1 px-2"><small>Placed on</small> <br> {{$order->date}}</h6>
                    </div>
                    <!-- orders -->
                    <p class="col-12 p-0">
                        {{$order->description}}
                    </p>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- right panel -->
    <div class="col-3 m-0 p-0 py-5 border-left">
        <!-- info container -->
        <div class="info-container container col-10 h-100 p-0">
            <!-- info -->
            <div class="info p-3 py-5">
                <!-- image -->
                <img class="user-image container mb-3" src="{{ asset('images/user-image1.png') }}" alt="user image">

                <!-- text -->
                <h5 class="text-center mt-3 mb-0 ">{{ Session::get('data')->name }}</h5>
                <h6 class="text-center m-0">{{ Session::get('data')->phone }}</h6>
                <h6 class="text-center m-0">{{ Session::get('data')->email }}</h6>
            </div>

            <!-- completed orders -->
            <div class="completed-orders col-12 mt-3">
                <h6 class="pt-3 pb-2 text-center">Completed Orders</h6>
                <h6 class="orders-number">{{ $completed_orders }}</h6>
            </div>

            <!-- pending orders -->
            <div class="pending-orders col-12 mt-3">
                <h6 class="pt-3 pb-2 text-center">Pending Orders</h6>
                <h6 class="orders-number">{{$pending_orders_count}}</h6>
            </div>

        </div>
    </div>
</div>

@endsection