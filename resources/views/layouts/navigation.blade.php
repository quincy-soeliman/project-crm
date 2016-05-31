<nav class="navbar col-xs-12 col-md-12 navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <?php $current_user = App\User::find(Auth::id()) ?>

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
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

                @if( $current_user->role == 'student' )
                    <li><a href="{{ url('/home') }}">Student 1</a></li>
                    <li><a href="{{ url('/home') }}">Student 2</a></li>
                @elseif( $current_user->role == 'teacher' )
                    <li><a href="{{ url('/home') }}">Teacher 1</a></li>
                    <li><a href="{{ url('/home') }}">Teacher 2</a></li>

                @elseif( $role === 'college' )
                    <li><a href="{{ url('/analyses') }}">Analyses overzicht</a></li>
                    <li><a href="{{ url('/analyses/aanmaken') }}">Analyses toevoegen</a></li>
                @elseif( $role === 'reviewer' )
                    <li><a href="{{ url('/home') }}">Reviewer 1</a></li>
                    <li><a href="{{ url('/home') }}">Reviewer 2</a></li>
                @elseif( $role === 'company' )

                @elseif( $current_user->role == 'college' )
                    <li><a href="{{ url('/home') }}">College 1</a></li>
                    <li><a href="{{ url('/home') }}">College 2</a></li>
                @elseif( $current_user->role == 'reviewer' )
                    <li><a href="{{ url('/home') }}">College 1</a></li>
                    <li><a href="{{ url('/home') }}">College 2</a></li>
                @elseif( $current_user->role == 'company' )

                    <li><a href="{{ url('/home') }}">Company 1</a></li>
                    <li><a href="{{ url('/home') }}">Company 2</a></li>
                @elseif( $current_user->role == 'administrator' )
                    <li><a href="{{ url('/kerntaak') }}">Kerntaken aanmaken</a></li>
                    <li><a href="{{ url('/werkproces') }}">Werkprocessen aanmaken</a></li>
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

                            @if( $role === 'administrator' )
                                <p>Administrator <span class="caret"></span></p>
                            @else
                                @foreach ($data as $profile)
                                    <p>{{ $profile->first_name }} {{ $profile->last_name }} {{ $profile->name }} <span class="caret"></span></p>
                                @endforeach
                            @endif

                            @if( $role == 'administrator' )
                                <p>Administrator <span class="caret"></span></p>
                            @else
                                <?php
                                    switch($current_user->role) {
                                        case 'student':
                                            $student = $current_user->student()->get();
                                            print $student[0]->first_name . ' ' . $student[0]->last_name;
                                            break;
                                        case 'teacher':
                                            $teacher = $current_user->teacher()->get();
                                            print $teacher[0]->first_name . ' ' . $teacher[0]->last_name;
                                            break;
                                        case 'college':
                                            $college = $current_user->college()->get();
                                            print $college[0]->name;
                                            break;
                                        case 'reviewer':
                                            $reviewer = $current_user->reviewer()->get();
                                            print $reviewer[0]->first_name . ' ' . $reviewer[0]->last_name;
                                            break;
                                        case 'company':
                                            $company = $current_user->company()->get();
                                            print $company[0]->name;
                                            break;
                                        case 'administrator':
                                            $administrator = $current_user->administrator()->get();
                                            print $administrator[0]->first_name . ' ' . $administrator[0]->last_name;
                                            break;
                                    }
                                ?>
                            @endif

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