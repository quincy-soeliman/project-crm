<nav class="navbar col-xs-12 col-md-12 navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>

                @if( $role === 'student' )
                    <li><a href="{{ url('/home') }}">Student 1</a></li>
                    <li><a href="{{ url('/home') }}">Student 2</a></li>
                @elseif( $role === 'teacher' )
                    <li><a href="{{ url('/home') }}">Teacher 1</a></li>
                    <li><a href="{{ url('/home') }}">Teacher 2</a></li>
                @elseif( $role === 'college' )
                    <li><a href="{{ url('/home') }}">College 1</a></li>
                    <li><a href="{{ url('/home') }}">College 2</a></li>
                @elseif( $role === 'reviewer' )
                    <li><a href="{{ url('/home') }}">College 1</a></li>
                    <li><a href="{{ url('/home') }}">College 2</a></li>
                @elseif( $role === 'company' )
                    <li><a href="{{ url('/home') }}">Company 1</a></li>
                    <li><a href="{{ url('/home') }}">Company 2</a></li>
                @elseif( $role === 'administrator' )
                    <li><a href="{{ url('/home') }}">Administrator 1</a></li>
                    <li><a href="{{ url('/home') }}">Administrator 2</a></li>
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @foreach ($data as $profile)
                                <p>{{ $profile->first_name }} {{ $profile->last_name }} {{ $profile->name }} <span class="caret"></span></p>
                            @endforeach
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>