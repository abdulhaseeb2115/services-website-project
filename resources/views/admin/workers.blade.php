@extends('layouts.adminLayout')
@section('content')
<style>
    @import url("{{asset('css/admin/workers.css')}}");
</style>

<div class="header">
    <h3>
        Workers
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="mainContainer">
    <div class="add">
        <div class="heading">Add New Worker</div>

        <form class="addWorkerForm" action="/addWorker" method="POST" autocomplete="off">
            @csrf
            <input type="text" name="name" id="name" placeholder="Name">

            <input type="email" name="email" id="email" placeholder="Email">

            <input type="text" name="phone" id="phone" placeholder="Phone">

            <input type="text" name="address" id="address" placeholder="Address">

            <select name="category" id="category">
                @foreach($categories as $category)
                <option value={{$category->name}}>{{$category->name}}</option>
                @endforeach
            </select>

            <button type="submit">Add</button>
        </form>
    </div>

    <div class="suspend">
        <div class="heading">Suspend Worker</div>

        <div class="suspendWorker">
            <form class="top" action="/getWorker" method="get">
                @csrf
                <input type="text" placeholder="Worker Id" name="searchId" id="searchId">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>


            @if(@isset($workerData))
            <form class="bottom" action="" method="">
                <input readonly type="text" name="id" id="id" value='ID: {{$workerData[0]->id}}'>

                <input readonly type="text" name="name" id="name" value="Name: {{$workerData[0]->name}}">

                <input readonly type="text" name="category" id="category" value="Category: {{$workerData[0]->category}}">

                <input readonly type="text" name="status" id="suspended" value="Status : {{$workerData[0]->status}}">

                <button type="submit">Change Status</button>
            </form>
            @endif

        </div>

    </div>
</div>



@endsection