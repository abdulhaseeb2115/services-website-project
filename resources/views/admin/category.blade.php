@extends('layouts.adminLayout')
@section('content')
<style>
    @import url("{{asset('css/admin/category.css')}}");
</style>

<div class="header">
    <h3>
        Category
    </h3>

    <h6>
        {{ date("j F Y");}}
    </h6>
</div>

<div class="add">
    <div class="heading">Add New Category</div>

    <form class="addCategoryForm" action="/addCategory" method="POST" autocomplete="off">
        @csrf
        <input type="text" name="name" id="name" placeholder="Name">

        <input type="text" name="description" id="description" placeholder="Description">

        <button type="submit">Add</button>
    </form>
</div>



@endsection