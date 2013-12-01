@layout("default")
@section("content")

{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
   <h4>Registration</h4>
 <br> 
   <ul>
      @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
      @endforeach
   </ul>



    <br> 
   {{ Form::text('username', null, array('placeholder'=>'UserName')) }}
   <br> 
  <br> 
   {{ Form::text('firstname', null, array('placeholder'=>'First Name')) }}
   <br> 
    <br> 
   {{ Form::text('lastname', null, array('placeholder'=>'Last Name')) }}
   <br> 
    <br> 
   {{ Form::text('email', null, array('placeholder'=>'Email Address')) }}
   <br> 
    <br> 
   {{ Form::password('password', array('placeholder'=>'Password')) }}
   <br> 
    <br> 
   {{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password')) }}
 <br> 

   {{ Form::submit('Register')}} {{ Form::submit('Reset')}}
{{ Form::close() }}


@stop
