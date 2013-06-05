<?php

class Json_Auth_Controller extends Base_Controller {

  function __construct() {
    parent::__construct();
  }

  public function action_login () {
    $userdata = array (
      'username' => Input::get ('email'),
      'password' => Input::get ('password'),
    );

    if (Auth::attempt ($userdata)) {
      return json_encode (Status::auth_login_success ());
    } else {
      return json_encode (Status::auth_login_failure ());
    }
  }

  public function action_logout () {
    Auth::logout ();
    return json_encode (Status::auth_logout_success ());
  }

  public function action_signup () {
    $email      = Input::get ('email');
    $password   = Input::get ('password');
    $password_r = Input::get ('password_repeat');
    $first_name = Input::get ('first_name'); 
    $last_name  = Input::get ('last_name');    

    $error = Status::auth_signup_failure ();

    // Invalid email address
    $validator = Validator::make (
      array (
        'email' => $email,
      ),
      array (
        'email' => 'email|required',
      )
    );
    if (!$validator->passes ()) {
      $error["status_message"] = "The provided email address is invalid.";
      return json_encode ($error);
    }

    // Email address already in use
    if (User::find_by_email ($email) != false) {
      $error["status_message"] = "The provided email address is already registered.";
      return json_encode ($error);
    }

    // Password and password repeat don't match
    if ($password != $password_r) {
      $error["status_message"] = "The given password and repeated password do not match.";
      return json_encode ($error);
    }

    // Password must be atleast 8 chars
    if (strlen ($password) < 8) {
      $error["status_message"] = "The given password must be atleast 8 character in length.";
      return json_encode ($error);
    }

    // First name and last name are required
    $validator = Validator::make (
      array (
        'first_name' => $first_name,
        'last_name'  => $last_name,
      ),
      array (
        'first_name' => 'required',
        'last_name'  => 'required',
      )
    );
    if (!$validator->passes ()) {
      $error["status_message"] = "The first and last name are required.";
      return json_encode ($error);
    }

    // Validation complete - let's make an account already
    if (User::create_new ($email, $password, $first_name, $last_name)) {
      return json_encode (Status::auth_signup_success ());
    } else {
      return json_encode (Status::auth_signup_failure ());
    }
  }

}
