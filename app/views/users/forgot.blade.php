@layout("default")
@section("content")
  {{ Form::open(array('url'=>'users/forgot_password')) }}
        <h4>Enter your email:</h4>
         <br> 
        {{ Form::text('email', null, array('placeholder'=>'Email Address')) }}
        <br>
      

    {{ Form::submit("Get!") }}
    {{ Form::close() }}


@stop
