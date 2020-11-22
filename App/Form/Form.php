<?php


namespace App\Form;


class Form {

  public static function begin($method, $action) {
        echo sprintf("<form method='%s' action='%s'>", $method, $action);

        return new Form();
  }


  public function createField($attribute, $model, $type = 'text') {

    return new Field($attribute, $model, $type);
  }



  public static function end() {
      echo '</form>';
  }

}