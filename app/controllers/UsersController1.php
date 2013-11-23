<?php

class UsersController extends BaseController {

public $restful = true;
protected $layout = "layouts.default";

  public function __construct() {
             
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getProfile')));
  
        }



public function getHome()
{

  $this->layout->content = View::make('users.login');
	
}

public function getRegister() {

   $this->layout->content = View::make('users.register');
}


public function getForgot() {

   $this->layout->content = View::make('users.forgot');
}




 public function postCreate() {
                $validator = Validator::make(Input::all(), User::$rules);

                if ($validator->passes()) {
                        $user = new User;
                        $user->username = Input::get('username');
                        $user->firstname = Input::get('firstname');
                        $user->lastname = Input::get('lastname');
                        $user->email = Input::get('email');
                        $activatedCode = sha1(mt_rand(10000,99999).time());
                        $user->activation_code = $activatedCode;
                        $password=Input::get('password');
                        $random_str=substr(md5(strrev($activatedCode)),-3);
                        $user->password = Crypt::encrypt($password.$random_str);
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

        public function getLogin() {
                $this->layout->content = View::make('users.login');
        }

          

        public function postLogin() {
                if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
                        return Redirect::to('users/profile')->with('message', 'You are now logged in!');
                } else {
                        return Redirect::to('users/login')
                                ->with('message', 'Your username/password  incorrect, please, try again')
                                ->withInput();
                }
        }



        public function postForgot() {
               $email= Input::get('email');
               $user = new User;
               if ($user->findEmail($email)==true) {
                     $password = $user->where('email', '=', $email)->first()->password;
                     $decrypted_password =Crypt::decrypt($password);
                        $data = array(
                            'password' => $decrypted_password);

                        Mail::send('emails.auth.forgot', $data, function ($message) use ($email) {
                        $message->subject('Forgot Password');
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

                        $code= Input::get('code');
                        $email= Input::get('email');
                        $user = new User;
                        if ($user->where('code', '=', $code)->first()->count()==1) {
                        $username = $user->where('email', '=', $email)->first();
                         $data = array(
                            'username' => $username);

                        Mail::send('emails.auth.activatied', $data, function ($message) use ($email) {
                        $message->subject('Account Activation');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                   
                        });

                        }

                            else {

                           return Redirect::to('/')
                               ->with('message', 'The entered code is not valid, sorry')
                               ->withInput();

                        }


       }

 


        public function getProfile() {
                $this->layout->content = View::make('users.profile');
        }




        public function getLogout() {
                Auth::logout();
                return Redirect::to('users/login')->with('message', 'Your are logged out');
        }




}