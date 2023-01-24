@extends('layouts.guest')

@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <h1 class="display-5 fw-bold">
            Welcome to The New Projects!
        </h1>
        <p>Click <a class="" href="{{ route('login') }}">Here</a> to Log In!</p>
        <p>If you're not registered click <a class="" href="{{ route('register') }}">Here</a>!</p>
    </div>

@endsection
