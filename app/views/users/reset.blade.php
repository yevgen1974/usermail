@layout("default")
@section("content")

{{ Form::open(array('url'=>'users/password', 'class'=>'form-signup')) }}
   <h4>Reset Password</h4>
 <br> 
   <ul>
      @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
   </ul>

  <br> 
   {{ Form::text('email', null, array('placeholder'=>'Email Address')) }}
    <br> 
   {{ Form::password('password', array('placeholder'=>'Password')) }}
   <br> 
    <br> 

      
   {{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password')) }}
 <br> 

   {{ Form::submit('Submit')}}
{{ Form::close() }}


@stop
