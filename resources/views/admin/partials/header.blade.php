<header class="bg-dark">
    <nav class="navbar  navbar-expand-md navbar-light  shadow-sm mx-3">
        @if (Auth::check())
        <a class="navbar-brand d-flex align-items-center " href="{{ url('/admin')  }}">
            @else
            <a class="navbar-brand d-flex align-items-center " href="{{ url('/')  }}">
        @endif
            <div class="logo text-danger d-flex align-items-center px-3">
                <i class="fa-solid fa-diagram-project fs-5"></i>
                <span class="fs-5 px-2">T.N.P.</span>
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>




            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{url('/admin') }}">{{ __('Home') }}</a>
                    </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url('/') }}">{{ __('Home') }}</a>
                        </li>
                    @endif

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    {{-- Search Bar --}}
                    @if(Route::currentRouteName() === 'admin.project.index')
                    <li class="my-auto">
                        <form  action="{{route('admin.project.index')}}" method="GET">
                        <input type="text" name="search" id="search" class="rounded-3" placeholder="search">
                        </form>
                    </li>
                    @endif
                    <!-- Authentication Links -->
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
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('admin.project.index')}}">Projects</a>
                            <a class="dropdown-item" href="{{route('admin.project.create')}}">Create New Project</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
    </nav>
</header>
