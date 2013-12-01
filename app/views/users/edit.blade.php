
    <h4>Edit User</h4>
      <br> 
 
<form name="edit" action="users/update/{{$user->id}}" method="get">
Username: <input type="text" name="username" value="{{$user->username}}" >
<br>
First Name: <input type="text" name="firstname" value="{{$user->firstname}}" >
<br>
Last Name: <input type="text" name="lastname" value="{{$user->lastname}}" >
<br>
E-mail: <input type="text" name="email" value="{{$user->email}}" >
<br>
Password: <input type="password" name="email" value="{{$user->password}}" >
<br>
<br>
<input type="submit" value="Update">
</form> 