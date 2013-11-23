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
	 * Get the email of user.
	 *
	 * @return  boolean
	 */



   public function findEmail($email) {

    
     if  ($this->where('email', '=', $email)->count()==1) {

      return true;

         } 


         else {

    	return false;

           } 

   } 






   public function changePassword($email,$password) {

  
     $this->where('email', '=', $email)->update(array('password' => $password));


  }


   public function findUsername($username) {

    
     if  ($this->where('username', '=', $username)->count()==1) {

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