@layout("default")
@section("content")
<h5>Hello, {{ Auth::user()->username }}</h5>
<br>

@if (isset($usr))
 <ul>

         <li>First Name:{{ $usr->firstname}}</li>
                  <br>

          <li>Last Name:{{ $usr->lastname}}</li>
                  <br> 
           <li>E-mail:{{ $usr->email}}</li>
                  <br>
   </ul>

{{ HTML::link('users/edit/'.$usr->id, 'Edit User') }}


@endif




@stop
