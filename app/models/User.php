<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {


 
   public static $rules = array ( 

           'username' =>'required|unique:users|alpha_dash|min:4',     
           'password' =>'required|alpha_num|between:4,12|confirmed',
           'password_confirmation' =>'required|alpha_num|between:4,12',
           'email' =>'required|unique:users|between:3,64|Email');



	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

   
   	/**
	 * Make the full name of user from the first name and last name string.
	 *
	 * @return string
	 */

   public function FullName() {

   return $this->first_name . ' ' . $this->last_name;     


   } 

   public function profile() {

   return $this->has_one('Profile');

   }


	/**
	 * Get the activation code of the new user.
	 *
	 * @return boolean
	 */

   public function getActivation($code) {


     if  ($this->where('activation_code', '=', $code)->count()==1) {
     	 $this->update(array('activated' => 1)); 

      return true;

          }

    else  {


    	return false;

           } 


   } 



   	/**
	 * Get the  user info by its ID.
	 *
	 * @return  string
	 */

   public function getUser($id) {


     return $this->where('id', '=', $id)->first();

  


   } 



   

	/**
	 * Get the email of user.
	 *
	 * @return  boolean
	 */



   public function findEmail($email) {

    
     if  ($this->where('email', '=', $email)->first()->count()==1) {

         return true;

          }

         else  {

    	     return false;

           } 

   } 


 
	/**
	 * Get the username of user.
	 *
	 * @return  mixed
	 */


     public function findUsername($username) {

     return $this->where('username', '=', $username)->first();

   } 




  
	/**
	 * Get the get of user info.
	 *
	 * @return  mixed
	 */


     public function findUser($email) {

     return $this->where('email', '=', $email)->first();

   } 


  

   /**
	 * Get the ID of user.
	 *
	 * @return  mixed
	 */


     public function findUserID($id) {

     return $this->where('id', '=', $id)->first();

   } 




  	/**
	 * Login the  user via username and password
	 *
	 * @return  void
	 */


     public function loginUser($username, $password) {

     if ($this->where('username', '=', $username)->where('password', '=', $password)->where(array('activated' => 1))->count()) {

       return true;

          }

         else {

     return false;

       } 




   } 


 

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}