@extends('layouts.app')

@section('title') Admid Dashboard @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
@include('includes.showsuccess')
<h2>Admin Dashboard</h2>
</div>
@endsection