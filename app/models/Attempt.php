<?php


class Attempt extends Eloquent  {





	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attemps';
	protected $fillable = array('ip','user_agent', 'attempts');

   

   	/**
	 * Detects the login attempts times.
	 *
	 * @return boolean
	 */

   public function loginDetect($ip,$browser) {

    $attempts=$this->select(DB::raw('count(attempts) as attempt_count'))->where('ip', '=', $ip)->where('user_agent', '=',$browser)->count();

   if($attempts >=1 or $attempts >= 5 ) {

   	$this->update(array('login_ok' => 1)); 
    $this->update(array('login_failed' => 0));
    $i=0; 
    $this->update(array('attempts' => $i++)); 
    if ($i==5) {
    break;
    $this->update(array('attempts' => 0)); 
     }

    return true;


     }  
        else {

      $this->update(array('login_ok' => 0)); 
      $this->update(array('login_failed' => 1)); 

    
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
	$this->save();


  }


}