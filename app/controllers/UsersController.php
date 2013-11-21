<?php

class UsersController extends BaseController {

public $restful = true;
protected $layout = "layouts.default";

  public function __construct() {
             
       $this->beforeFilter('csrf', array('on'=>'post'));
  
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
                        $user->password = Hash::make(Input::get('password'));
                        $user->save();
                        $activatedCode = sha1(mt_rand(10000.99999).time());
                        $data = array(
                            'password' => $password,
                            'authCode' => $activatedCode
                            );

                        Mail::send('activation.template', $data, function ($message) use ($email) {
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
                     $password = $user->where('email', '=', $email)->first();
                        $data = array(
                            'password' => $password);

                        Mail::send('forgot.template', $data, function ($message) use ($email) {
                        $message->subject('Account Activated');
                        $message->from('noreply@sendme.com', 'Admin');
                        $message->to($email); 
                   
                        });


                        return Redirect::to('users/forgot')->with('message', 'The password was sent you by email');
                } else {
                        return Redirect::to('users/login')
                               ->with('message', 'You are not registered at us, sorry')
                               ->withInput();
               }

        }



       public function getActivated () {

                        $code= Input::get('code');
                        $email= Input::get('email');
                        $user = new User;
                        if ($user->where('code', '=', $code)->first()->count()==1) {
                        $username = $user->where('email', '=', $email)->first();
                         $data = array(
                            'username' => $username);

                        Mail::send('activation.template', $data, function ($message) use ($email) {
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