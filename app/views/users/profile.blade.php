@layout("default")
@section("content")
<h5>Hello, {{ Auth::user()->username }}</h5>
@stop
