@extends('layouts.app')


@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3 text-center">

        <h2 class="display-7 fw-bold">
            Hello {{Auth::user()->name}}!
        </h2>
        <p>Welcome to your Admin Page</p>

        <a href="{{route('admin.project.index')}}">Lists of Projects</a>


</div>


@endsection
