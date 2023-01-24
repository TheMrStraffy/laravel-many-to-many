<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css' integrity='sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==' crossorigin='anonymous'/>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

     <!-- CK EDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


       @include('admin.partials.header')

        <main class="d-flex row w-100">
            <div class="aside-menu col-2 bg-dark p-3">
                <ul>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a class="text-white" href="{{route('admin.project.create')}}"><i class="fa-regular fa-file"></i> New Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white" href="{{route('admin.types.index')}}">Projects grouped by Type</a>
                    </li>
                    @endguest
                </ul>
            </div>
            <div class="container col-10 p-5">

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
