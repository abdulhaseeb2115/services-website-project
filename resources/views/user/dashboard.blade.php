@extends('layouts.userLayout')
@section('content')

<style>
    @import url("{{asset('css/user/dashboard.css')}}");
</style>

<div class="main-container container-fluid d-flex justify-content-between px-2">
    <!-- left panel -->
    <div class="col-9 m-0 p-0 pr-2">
        <!-- header -->
        <div class="header container col-6 d-flex justify-content-between align-items-center mt-2 py-0 px-3 border-bottom">
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
                <div class="overviews col">
                    <h2>{{$total_orders}}</h2>
                    <small><i class="fa-solid fa-cart-shopping"></i> Total Orders</small>
                </div>
            </div>
        </div>

        <!-- row 2 -->
        <div class="row2 container-fluid m-0 mt-4 px-4 pt-0">
            <!-- heading -->
            <h4 class="mb-2">Pending Orders</h4>
            <div class="scroll-wrapper">

                @foreach($pending_orders as $order)
                <!-- current orders -->
                <div class="current-orders col-12 mb-3 px-4 py-3">
                    <div class="row m-0 p-0">
                        <h6 class="mr-3 py-1 px-2"><small>Worker</small> <br> {{$order->name}}</h6>
                        <h6 class=" py-1 px-2"><small>Placed on</small> <br> {{$order->date}}</h6>
                    </div>
                    <!-- orders -->
                    <p class="col-12 p-0">
                        {{$order->description}}
                    </p>

                    <!-- button -->
                    <button class="open-feedback">
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>

                    <!-- form -->
                    <form action="/userAddFeedback" method="POST" id="feedback-form" class="p-0 m-0 mt-4 col-12">
                        @csrf
                        <hr>
                        <input type="hidden" name="order_id" id="osder_id" value="{{ $order->id }}">

                        <!-- rating -->
                        <h5>Rating & feedback</h5>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1"><i class="fa-solid fa-star"></i> 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2"><i class="fa-solid fa-star"></i> 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3" checked>
                            <label class="form-check-label" for="inlineRadio3"><i class="fa-solid fa-star"></i> 3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value="4">
                            <label class="form-check-label" for="inlineRadio4"><i class="fa-solid fa-star"></i> 4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value="5">
                            <label class="form-check-label" for="inlineRadio5"><i class="fa-solid fa-star"></i> 5</label>
                        </div>
                        <!-- feedback -->
                        <textarea class="p-2 mt-2" name="feedback" id="feedback" placeholder="Add feedback(optional)"></textarea>
                        <button type="submit" class="mt-2">Submit</button>
                    </form>
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
                <h5 class="text-center mt-3 mb-0 ">{{ Session::get('user')->name }}</h5>
                <h6 class="text-center m-0">{{ Session::get('user')->phone }}</h6>
                <h6 class="text-center m-0">{{ Session::get('user')->email }}</h6>
            </div>

            <!-- completed orders -->
            <div class="completed-orders col-12 mt-3">
                <h6 class="pt-3 pb-2 text-center"><i class="fa-solid fa-circle-check text-success"></i> Orders Completed </h6>
                <h6 class="orders-number">{{$completed_orders}}</h6>
            </div>

            <!-- pending orders -->
            <div class="pending-orders col-12 mt-3">
                <h6 class="pt-3 pb-2 text-center"><i class="fa-solid fa-clock text-warning"></i> Orders Pending </h6>
                <h6 class="orders-number">{{$pending_orders_count}}</h6>
            </div>

        </div>
    </div>
</div>

<script>
    $(".open-feedback").click(function() {
        if ($(".open-feedback i").hasClass("fa-chevron-down")) {
            $("#feedback-form").slideDown();
            $(".open-feedback i").removeClass("fa-chevron-down");
            $(".open-feedback i").addClass("fa-chevron-up");
        } else {
            $("#feedback-form").slideUp();
            $(".open-feedback i").addClass("fa-chevron-down");
            $(".open-feedback i").removeClass("fa-chevron-up");
        }
    });
</script>
@endsection