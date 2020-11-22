<?php

use App\Core\Application;

class m0001_initial {


  public function up() {
    $db = Application::$app->db;

    $SQL = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email varchar(255) NOT NULL,
        firstname varchar(255) NOT NULL,
        lastname varchar(255) NOT NULL,
        status tinyint NOT NULL,
        created_at timestamp default current_timestamp
    )";

    $db->getPDO()->exec($SQL);
  }


  public function down() {
    $db = Application::$app->db;
    $sql = "DROP TABLE users";

    $db->getPDO()->exec($sql);
  }


}