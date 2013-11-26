@layout("default")
@section("content")
  {{ Form::open(array('url'=>'users/login')) }}
        <h4>Login</h4>
         <br> 
        {{ Form::text('username', null, array('placeholder'=>'Username')) }}
        <br>
        {{ Form::password('password', array('placeholder'=>'Password')) }}
        <br>

    {{ Form::submit("login") }}
    {{ Form::close() }}
<br>
<br>
{{ HTML::link('users/forgot', 'Forgot Password') }}

@stop
