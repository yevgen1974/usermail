@layout("default")
@section("content")


@if (isset($user))
 <ul>


         <li>Title:{{ $user->profile->title}}</li>
                  <br>
         <li>Gender:{{ $user->profile->gender}}</li>
                  <br>
         <li>First Name:{{ $user->firstname}}</li>
                  <br>
          <li>Last Name:{{ $user->lastname}}</li>
                  <br> 
          
         <li>Street:{{ $user->profile->street}}</li>
                  <br>

          <li>Zip:{{ $user->profile->zip}}</li>
                  <br> 

           <li>State:{{ $user->profile->state}}</li>
                  <br>  
         <li>Phone:{{ $user->profile->phone}}</li>
                  <br>  

         <li>Web:{{ $user->profile->web}}</li>
                  <br> 

   </ul>

{{ HTML::link('users/edit/'.$user->id, 'Edit User') }}


@endif





@stop
