<?php

namespace itstefone\Form;

class Field {



  protected $model;
  protected $attribute;
  protected $type;

  public function __construct($attribute, $model, $type)
  {
    $this->attribute = $attribute;
    $this->type = $type;
    $this->model = $model;
  }


  public function __toString()
  {
    return sprintf('<div class="form-group">
    <label for="exampleInputEmail1">%s</label>
    <input type="%s"  value="%s" name="%s" class="form-control %s" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="validationServer03Feedback" class="invalid-feedback">
       %s
      </div>
  </div>',
  $this->mappingLabels($this->attribute),
  $this->type,
  $this->model->{$this->attribute},
  $this->attribute,
  $this->model->getError($this->attribute) ? 'is-invalid' : '',
  $this->model->getError($this->attribute)
);
  }




  protected function mappingLabels($attribute) {
    

    $mapping = [
      'firstname' => 'First Name',
      'lastname' => 'Last Name',
      'email' => 'Email Address',
      'password' => 'Password',
      'confirmPassword' => 'Confirm Password' 
    ];


    return $mapping[$attribute] ?? '';
    
  }

}