@extends('layouts.workerLayout')
@section('content')

<style>
    @import url("{{asset('css/worker/settings.css')}}");
</style>

<div class="main-container container-fluid py-0 px-2">
    <!-- header -->
    <div class="header container col-4 d-flex justify-content-between align-items-center mt-2 py-0 px-3 border-bottom">
        <h5 class="m-0">
            Settings
        </h5>

        <h6 class="p-0 m-0">
            {{ date("j F Y");}}
        </h6>
    </div>

    <!-- form -->
    <form class="settings-form container p-4" action="/addCategory" method="POST" autocomplete="off">
        <h4 class="text-center">Change Password</h4>

        @csrf
        <input type="text" name="oldPass" id="oldPass" placeholder="Old Password">

        <input type="text" name="newPass" id="newPass" placeholder="New Password">

        <input type="text" name="confirmPass" id="confirmPass" placeholder="Confirm New Password">

        <button type="submit">Update</button>
    </form>
</div>

@endsection