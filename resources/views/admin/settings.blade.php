@extends('layouts.adminLayout')
@section('content')
<style>
    @import url("{{asset('css/admin/settings.css')}}");
</style>

<div class="header">
    <h3>
        Settings
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="add">
    <div class="heading">Change Password</div>

    <form class="settingsForm" action="/addCategory" method="POST" autocomplete="off">
        @csrf
        <input type="text" name="oldPass" id="oldPass" placeholder="Old Password">

        <input type="text" name="newPass" id="newPass" placeholder="New Password">

        <input type="text" name="confirmPass" id="confirmPass" placeholder="Confirm New Password">

        <button type="submit">Update</button>
    </form>
</div>



@endsection