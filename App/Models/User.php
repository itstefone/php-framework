<?php


namespace App\Models;



class User extends DbModel {


  public $email;
  public $id;
  public $password;
  public $firstname;
  public $lastname;

  protected const STATUS_INACTIVE = 0;
  protected const STATUS_ACTIVE = 1;
  protected const STATUS_DELETED = 2;

  public function register() {
      return  $this->save();
  }


  public function primaryKey():string {
    return 'id';
  }



  public function save() {
    $this->data['password'] = password_hash($this->password, PASSWORD_DEFAULT);
    $this->data['status'] = self::STATUS_DELETED;

    return parent::save();
  }

  public  function table():string {
    return 'users';
  }




  public  function attributes():array {
    return [
      'email',
      'firstname',
      'lastname',
      'password',
      'status'
    ];
  }


  public function rules():array {

    return [
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [self::RULE_REQUIRED],
      'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
      'firstname' => [self::RULE_REQUIRED],
      'lastname' => [self::RULE_REQUIRED]
    ];
  }
}