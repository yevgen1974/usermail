<?php

class UsersController extends BaseController {

public $restful = true;
protected $layout = "layouts.default";

  public function __construct() {
             
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getProfile')));
  
        }



public function getIndex()
{

  $this->layout->content = View::make('users.index');

}

public function getRegister() {

   $this->layout->content = View::make('users.register');
}


public function getForgot() {

   $this->layout->content = View::make('users.forgot');
}


public function __call ($method, $parameters) {

 return Response::error('404');

}





 public function postCreate() {
                $validator = Validator::make(Input::all(), User::$rules);
               
               if(!$validator->passes())
                      {
                      return Redirect::to('users.reset'); 
                      }

                if ($validator->passes()) {
                         $user = new User;
                         $profile = new Profile;
                         $profile->save();
                         $user->username = Input::get('username');
                         $user->firstname = Input::get('firstname');
                         $user->lastname = Input::get('lastname');
                         $user->email = Input::get('email');
                         $activatedCode = sha1(mt_rand(10000,99999).time());
                         $user->activation_code = $activatedCode;
                         $password=Input::get('password');
                         $user->password = Hash::make($password);
                         $user->save(); 
                         $email=Input::get('email');
                         $firstname = Input::get('firstname');
                         $lastname = Input::get('lastname');
                         $data = array(
                            'password' => $password,
                            'authCode' => $activatedCode,
                            'firstname' => $firstname,
                            'lastname' => $lastname
                            );

                        Mail::send('emails.auth.activation', $data, function ($message) use ($email) {
                        $message->subject('Account Activation');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                   
                        });

                        return Redirect::to('users/login')->with('message', 'Thank you for registration!');
                     }

                else {
                       
                       return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
                }
        }


public function postResetPassword() {
                $validator = Validator::make(Input::all(), User::$rules);

                if ($validator->passes()) {
                        $user = new User;
                        $user->email = Input::get('email');
                        $random_str1 = sha1(mt_rand(10000,99999).time());
                        $password=Input::get('password');
                        $salt=md5(strrev($activatedCode));
                        $user->salt = $salt;
                        $user->password = Hash::make($password);
                        $username = $user->where('email', '=', $email)->first()->username;
                        $user->save(); 
                        $data = array(
                            'username' => $username,
                            'password' => $password
                            );

                        Mail::send('emails.auth.password', $data, function ($message) use ($email) {
                        $message->subject('Password was reset');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                   
                        });

                        return Redirect::to('users/login')->with('message', 'Your password was changed');
                     }

                else {
                       
                       return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
                }
        }





        public function getLogin() {
                $this->layout->content = View::make('users.login');
        }

          




        public function postLogin() {

                        $attempt = new Attempt;
                        $ip= $_SERVER['REMOTE_ADDR'];
                        $browser=$_SERVER['HTTP_USER_AGENT'];
                        $attempt->addLogin($ip, $browser); 
                       if ($attempt->loginDetect($ip,$browser)==true) {
                        Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')));
                        return Redirect::to('users/profile')->with('message', 'You are now logged in!');
                } else {
                      
                        $attempt->addLogin($ip, $browser);  
                        return Redirect::to('users/login')
                                ->with('message', 'Your username/password  incorrect, please, try again')
                                ->withInput(); 


                }
        }







        public function getReset($token) {
                $this->layout->content = View::make('users.reset')->with('token', $token);
        }




        public function postForgot() {
               $email= Input::get('email');
               $user = new User;
               if ($user->findEmail($email)==true) {
                   $username = $user->where('email', '=', $email)->first()->username;
                        $data = array(
                            'username' => $username);

                        Mail::send('emails.auth.password_reset', $data, function ($message) use ($email) {
                        $message->subject('Reset Password');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                   
                        });

                        return Redirect::to('users/forgot_sent')->with('message', 'The password was sent you by email');
                } else {
                        return Redirect::to('users/login')
                               ->with('message', 'You are not registered at us, sorry')
                               ->withInput();
               }

        }



       public function getForgotSent() {
                $this->layout->content = View::make('users.forgot_sent');
        }






       public function getActivated () {
                        $code= Input::get('activation_code');
                        $user = new User;
                        if ($user->getActivation($code)==true) {
                        $username = $user->where('activation_code', '=', $code)->first()->username;
                        $data = array(
                            'username' => $username);

                        Mail::send('emails.auth.activatied', $data, function ($message) use ($email) {
                        $message->subject('Account Activation');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                           return Redirect::to('users/login')->with('message', 'Your account was just activated');
                   
                        });

                        }

                            else {

                           return Redirect::to('/')
                               ->with('message', 'The entered code is not valid, sorry')
                               ->withInput();

                        }


       }

 


   public function getUpdate($id) {
 
     $user =  User::find($id);
     $user->firstname = Input::get('firstname');
     $user->lastname = Input::get('lastname');
     $user->username = Input::get('username');
     $user->password = Input::get('password');
     $user->email = Input::get('email');
     $user->save();

   }



public function getEdit($id){

 return \View::make (users.edit)->with('user', User::find($id));

}


public function getShow($id){

 return \View::make (users.show)->with('user', User::find($id));

}



        public function getProfile() {
                $uid=Auth::user()->id;
                $user = new User;
                $usr=$user->findUserID($uid); 
                $this->layout->content = View::make('users.profile')->with('usr',$usr);
        }




        public function getLogout() {
                Auth::logout();
                return Redirect::to('users/login')->with('message', 'Your are logged out');
        }




}