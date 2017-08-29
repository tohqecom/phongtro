@extends('layouts.error')

@section('title') Page Not Found @endsection

@section('content')
<h2>Page Not Found</h2>
<a href="{{ route('home') }}" title="Go to Home" style="text-decoration: none;">Go to Home</a>
@endsection