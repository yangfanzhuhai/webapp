<?php

class Destroyer_Auth_Controller extends Base_Controller {

  function __construct() {
    parent::__construct();
  }

  public function action_get_login () {
    return View::make ('destroyer::content.auth.login');
  }

  public function action_post_login () {
    $userdata = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );

    if (Auth::attempt ($userdata)) {
      return Redirect::to('manage_my_website');
    } else {
      return Redirect::to('login')
        ->with('login_errors', true);
    }
  }

  public function action_get_signup () {
    return View::make ('destroyer::content.auth.signup');
  }

  public function action_post_signup () {
    $email          = Input::get('email');
    $password       = Input::get('password');
    $passwordRepeat = Input::get('password_repeat');
    $firstName      = Input::get('firstname');
    $lastName       = Input::get('lastname');

    $quickReturn = Redirect::to('signup')
        ->with('signup_email', $email)
        ->with('signup_firstname', $firstName)
        ->with('signup_lastname', $lastName);

    // Email must be valid
    $validator = Validator::make(
      array ('email' => $email),
      array ('email' => 'required|email')
    );
    if (!$validator->passes ()) {
      return $quickReturn
        ->with('signup_error', 'The given email address is not valid.');
    }

    // Email cannot be registered already
    if (User::findByEmail ($email)) {
      return $quickReturn
        ->with('signup_error', 'The given email address is already registered.');
    }

    // Password and Password repeat must match
    if ($password != $passwordRepeat) {
      return $quickReturn
        ->with('signup_error', 'Password and password repeat do not match.');

    // Password must be atleast 8 characters
    } else if (strlen ($password) < 8) {
      return $quickReturn
        ->with('signup_error', 'Password must be atleast 8 character long.');
    }

    // First and Last name is required
    $validator = Validator::make(
      array (
        'first_name' => $firstName,
        'last_name'  => $lastName,
      ),
      array (
        'first_name' => 'required',
        'last_name'  => 'required',
      )
    );
    if (!$validator->passes ()) {
      return $quickReturn
        ->with('signup_error', 'You must provide a first and last name.');
    }

    // Create user and login as new user
    User::createNew ($email, $password, $firstName, $lastName);
    $userdata = array(
        'username' => $email,
        'password' => $password
    );
    Auth::attempt ($userdata);
    return Redirect::to ('manage_my_website');
  }

  public function action_get_logout () {
    Auth::logout ();
    return View::make ('destroyer::content.auth.logout');
  }
}
