@layout("default")
@section("content")

{{ Form::open(array('url'=>'users/reset_password', 'class'=>'form-signup')) }}
   <h4>Reset Password:</h4>
 <br> 
   <ul>
      @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
   </ul>
    <br> 
   {{ Form::text('email', null, array('placeholder'=>'Email Address')) }}
   <br> 
    <br> 
   {{ Form::password('password', array('placeholder'=>'Password')) }}
   <br> 
    <br> 
   {{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password')) }}
 <br> 
  <br> 
   {{ Form::submit('Submit')}}
{{ Form::close() }}


@stop
