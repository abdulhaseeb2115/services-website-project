@extends('layouts.workerLayout')
@section('content')

<style>
    @import url("{{asset('css/worker/history.css')}}");
</style>

<div class="main-container container-fluid d-flex flex-column align-items-center px-2 h-100">
    <!-- header -->
    <div class="header container col-4 d-flex justify-content-between align-items-center mt-2 py-0 px-3 border-bottom">
        <h5 class="m-0">
            History
        </h5>

        <h6 class="p-0 m-0">
            {{ date("j F Y");}}
        </h6>
    </div>

    <div class="container-fluid scroll-wrapper mt-5">
        <!-- completed orders -->
        @foreach($orders as $order)
        <!-- completed orders -->
        <div class="completed-orders container col-11 mb-3 px-4 py-3">
            <div class="row m-0 p-0 d-flex justify-content-between">
                <div class="row m-0 p-0">
                    <h6 class="mr-3 py-1 px-2"><small>Placed by</small> <br> {{$order->name}}</h6>
                    <h6 class=" py-1 px-2"><small>Placed on</small> <br> {{$order->date}}</h6>
                </div>
                <div class="row m-0 p-0">
                    <h6 class="mr-3 py-1 px-2"><small>Status</small> <br> Completed</h6>
                    <h6 class=" py-1 px-2"><small>Rating</small> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$order->rating}} <i class="fa fa-star"></i></h6>
                </div>
            </div>
            <!-- orders -->
            <p class="col-12 p-0">
                {{$order->description}}
            </p>
        </div>
        @endforeach
    </div>
    <!-- </div> -->
</div>
@endsection