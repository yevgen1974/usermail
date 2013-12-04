<?php class Profile extends Eloquent  {

  
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
protected $table = 'profiles';


 
   public static $rules = array ( 

           'title' =>'required||alpha_dash|min:4',     
           'gender' =>'required|alpha|between:6,10',
           'web' =>'required|alpha_num|between:10,40',
           'photo' =>'required|between:25,225');




 public function user() {


 	return $this->belongsTo('User');
 }


 









}

?>