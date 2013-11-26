@layout("default")
@section("content")
<h5>Hello, {{ Auth::user()->username }}</h5>
<h4>{{ HTML::route('logout', 'Logout ('.Auth::user()->username.')') }}</h4>
@stop
