@extends('layouts.adminLayout')
@section('content')
<style>
    @import url("{{asset('css/admin/feedbacks.css')}}");
</style>

<div class="header">
    <h3>
        Feedbacks
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="feedbackContainer">

    <!-- feedbacks -->


    @foreach($feedbacks as $feedback)
    <div class="feedback">
        <div class="top">
            <div class="name">
                <h6>Feedback By :</h6>
                <p>{{$feedback->name}}</p>
            </div>
            <div class="date">
                <h6>Date Posted :</h6>
                <p>{{date("j F Y", strtotime($feedback->date))}}</p>
            </div>
            <div class="service">
                <h6>Worker ID :</h6>
                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$feedback->assigned_worker_id}}</p>
            </div>
        </div>

        <div class="center">
            <h3>Rating: &nbsp; {{$feedback->rating}} <i class="fa fa-star"></i> </h3>
            <h5 class="description">{{$feedback->feedback}}</h5>
        </div>
    </div>
    @endforeach

</div>

@endsection