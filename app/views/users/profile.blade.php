@layout("default")
@section("content")
<h5>Hello, {{ Auth::user()->username }}</h5>
<br>


@if($user) {
	
@foreach ($user as $us)

{{ $us->first_name; }}

{{ $us->last_name; }}


{{ $us->emai; }}


@endforeach

}
@endif






@stop
