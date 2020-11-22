<?php

namespace App\Models;

use App\Core\Application;

abstract class DbModel extends Model {



  public abstract function table():string;


  public  function  findOne(array $where) {

    $table = static::table();
    $attributes = array_keys($where);
    $sql =  implode('AND ', array_map(fn($attribute) => "{$attribute}=:{$attribute}", $attributes));
    
     $statement = self::prepareStatement("SELECT * FROM $table WHERE $sql");
   

     foreach($where as $key => $value) {
       $statement->bindParam(":{$key}", $value);
     }


     $statement->execute();
     return $statement->fetchObject(static::class);
  }

  public function save() {
    $tableName = $this->table();
    $attributes = $this->attributes();

    $preparedBindAttribute = implode(',', array_map(fn($attribute) => ":$attribute" , $attributes));

    $prepareColumnAttribute = implode(',', $attributes);
    


    $statement = $this->prepareStatement("INSERT INTO $tableName ($prepareColumnAttribute) 
      VALUES($preparedBindAttribute)");
    
    
    foreach($attributes as $attribute) {
      $statement->bindParam(":$attribute", $this->{$attribute});
    }



      return $statement->execute();
  
    
  }


  public abstract function primaryKey():string;


  protected function prepareStatement($sql) {

    return Application::$app->db->getPDO()->prepare($sql);

  }

  public abstract function attributes():array;

}