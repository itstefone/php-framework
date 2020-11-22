<?php
namespace itstefone\Models;

use itstefone\Core\Application;
use itstefone\Core\Request;

class LoginForm extends Model {

  public function rules():array {

    return [
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [self::RULE_REQUIRED]
    ];
  }



    public function login() {
     $user = User::findOne(['email' => $this->email]);
     if(!$user) {
       $this->addError('email', 'User doesn\'t not exist with this email');
       return false;
     }
     if(!password_verify($this->password, $user->password)){
      $this->addError('password', 'Password is incorrect!');
      return false;
     }


     Application::$app->login($user);

      return true;
    }

}