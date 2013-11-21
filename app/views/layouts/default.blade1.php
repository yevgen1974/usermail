<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

    <title>User E-Mails</title>
    {{ HTML::style('/css/style.css') }}
     {{ HTML::style('/css/main.css') }}
</head>

<body>


    <div id="container">
        <div id="nav">
            <ul>
                <li>{{ HTML::linkRoute('home', 'Home') }}</li>

                @if(Auth::check())
                    <li>{{ HTML::linkRoute('profile', 'Profile' ) }}</li>
                    <li>{{ HTML::linkRoute('logout', 'Logout ('.Auth::user()->username.')') }}</li>
                @else
                    <li>{{ HTML::linkRoute('login', 'Login') }}</li>
                @endif

            </ul>
        </div>


    <div class="container">
      @if(Session::has('message'))
         <p class="alert">{{ Session::get('message') }}</p>
      @endif
    </div>

        @yield('content')
    </div>
</body>
</html>