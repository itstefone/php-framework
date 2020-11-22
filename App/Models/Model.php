<?php
namespace itstefone\Models;



abstract class Model {


  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MATCH = 'match';

  protected $data;
  protected $errors;
  public function __construct($data = [])
  {
    $this->data = $data;
    $this->errors = [];
  }

  public function validate() {


      
      foreach($this->rules() as $attribute => $rules) {
        

          foreach($rules as $rule) {

            $value = $this->getValue($attribute);
            if(is_array($rule)) {
              $ruleName = $rule[0];
            } else {
              $ruleName = $rule;
            }


            if($ruleName === self::RULE_REQUIRED && !$value ) {
                  $this->setErrorMessageByRule($rule, $attribute);
            }

            if($ruleName === self::RULE_EMAIL && ! filter_var($value, FILTER_VALIDATE_EMAIL) ) {
              $this->setErrorMessageByRule($rule, $attribute);
        }


        if($ruleName === self::RULE_MATCH && $this->{$attribute} !== $this->{$rule['match']}) {
          $this->setErrorMessageByRule($ruleName, $attribute,$rule);
          dump($this->password, $this->confirmPassword);      
    }


          }
      }
      return empty($this->errors);
    
  }


  public function addError($attribute, $message) {
    $this->errors[$attribute][] = $message;
  }

  public function getError($attribute) {

    return $this->errors[$attribute][0] ?? false;
  }



  public abstract function rules():array;



  protected function setErrorMessageByRule($rule, $attribute, $params = []) {
    $message = $this->getErrorMessages()[$rule] ?? '';
    foreach($params as $key => $value) {
      $message = str_replace("{{$key}}", $value, $message);
    }
    $this->errors[$attribute][] = $message;
  }

  public function getValue($attribute) {
    return $this->data[$attribute] ?? '';
  }



  public function __set($property,$value) {
    $this->data[$property] = $value;
  }



  public function getErrorMessages() {

    return [
      self::RULE_REQUIRED => 'This field is required',
      self::RULE_EMAIL   => 'This field must be in email format',
      self::RULE_MATCH   => 'This field value must match with {match} field'
    ];
  }



  public function __get($property) {
    if(array_key_exists($property, $this->data)) {
      return $this->data[$property];
    }


    if(property_exists($this,$property)) {
      return $this->{$property};
    }
  }
}