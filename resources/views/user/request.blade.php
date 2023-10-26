@extends('layouts.userLayout')
@section('content')

<style>
    @import url("{{asset('css/user/request.css')}}");
</style>

<div class="main-container container-fluid py-0 px-2">
    <!-- header -->
    <div class="header container col-4 d-flex justify-content-between align-items-center mt-2 py-0 px-3 border-bottom">
        <h5 class="m-0">
            Place Order
        </h5>

        <h6 class="p-0 m-0">
            {{ date("j F Y");}}
        </h6>
    </div>

    <!-- form -->
    <form class="settings-form container p-4" action="/addRequest" method="POST" autocomplete="off">
        @csrf
        <h4 class="text-center">Place Order</h4>

        <input type="hidden" name="user_id" id="user_id" value="{{ Session::get('user')->id }}">

        <select name="service" id="service">
            <option value="0" selected disabled>Select a Category</option>
            @foreach($categories as $ctg)
            <option value="{{$ctg->name}}">{{$ctg->name}}</option>
            @endforeach
        </select>

        <textarea name="description" id="description" placeholder="Add Description"></textarea>

        <button type="submit">Confirm Order</button>
    </form>
</div>

@endsection