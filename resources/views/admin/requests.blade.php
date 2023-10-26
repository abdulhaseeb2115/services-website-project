@extends('layouts.adminLayout')
@section('content')
<style>
    @import url("{{asset('css/admin/requests.css')}}");
</style>

<div class="header">
    <h3>
        Pending Requests
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="requestContainer">
    <!-- Requests -->

    @foreach($requests as $request)

    <div class="request">
        <div class="top">
            <div class="name">
                <h6>Requested By :</h6>
                <p>{{$request->name}}</p>
            </div>
            <div class="date">
                <h6>Date Requested :</h6>
                <p>{{date("j F Y", strtotime($request->date))}}</p>
            </div>
            <div class="service">
                <h6>Service :</h6>
                <p>{{$request->service}}</p>
            </div>
        </div>

        <div class="center">
            <div class="info">Phone : <span>{{$request->phone}}</span></div>
            <div class="info">Email : <span>{{$request->email}}</span></div>
            <div class="info">Address : <span>{{$request->address}}</span></div>

            <div class="description">&nbsp; {{$request->description}}</div>
        </div>

        <div class="bottom">
            <!-- reject -->
            <div class="reject">
                <form action="/cancelRequest" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id" value="{{$request->id}}">
                    <button type="submit"><i class="fa-solid fa-xmark"></i> Cancel</button>
                </form>
            </div>
            <!-- approve -->
            <div class="approve">
                <form action="/approveRequest" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id" value="{{$request->id}}">

                    <select name="worker_id" id="worker_id">
                        @foreach($workers as $worker)
                        @if($worker->category == $request->service)
                        <option value={{$worker->id}}>{{$worker->name}}</option>
                        @endif
                        @endforeach
                    </select>

                    <button type="submit"><i class="fa-solid fa-check"></i> Approve</button>
                </form>
            </div>
        </div>
    </div>

    @endforeach


</div>
@endsection