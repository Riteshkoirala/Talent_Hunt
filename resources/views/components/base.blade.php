<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<section class="container">
    <div class="header">
        <div class="logo">
            <h2>TalentHunt</h2>
        </div>
        <div class="nave">
            <ul>
                @if(Auth::User() && Auth::user()->role == "recruiter")

                    <li><a href="{{ route('dashboardRe') }}">Dashboard</a></li>
                    <li><a href="{{ route('jobs.create') }}">Add Job</a></li>
                    <li><a href="https://docs.google.com/forms/u/0/" target="_blank">Create Exam</a></li>
                    <li><a href="{{ route('user.search') }}">Seekers</a></li>
                    <li><a href="{{ route('profile.index') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>

                    @elseif(Auth::User() && Auth::user()->role == "seeker")
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('application.index') }}">Applied Job</a></li>
                    <li><a href="{{ route('profiles.show',Auth::User()->id) }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li>
                    <a href="#">HOME</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">SIGN UP</a>
                </li>
                <li>
                    <a href="{{ route('login') }}">SIGN IN</a>
                </li>
                <li>
                    <a href="#">SERVICE</a>
                </li>
                @endif
            </ul>

        </div>
    </div>

    <div class="body">
        @yield('content')
    </div>
</section>
<footer class="foot">
    @Ritesh Koirala
</footer>
</body>
</html>
