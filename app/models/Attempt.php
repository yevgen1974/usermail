<?php


class Attempt extends Eloquent  {





	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attempts';
	protected $fillable = array('ip','user_agent', 'attempts');



   	/**
	 * Detects the login attempts times.
	 *
	 * @return boolean
	 */

   public function loginDetect($ip,$browser) {

    $attempts=$this->where('ip', '=', $ip)->or_where('attempts', '=>',3)->or_where('user_agent', '=',$browser)->first()->count()==1) { 

   if($attempts==3) {

    return true;

     }  
        else {

           return false;

        }

      }


    
   	/**
	 * add the login attempts.
	 *
	 * @return void
	 */

public function addLogin($ip,$browser) {

	$this->ip=$ip;
	$this->user_agent=$browser;
	$this->attempts=1;
	$this->save();


}