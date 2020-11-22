<?php

use itstefoneCore\Application;

class m0002_add_new_user_column {


  public function up() {
    $db = Application::$app->db;

    $SQL = "ALTER TABLE users
    ADD COLUMN password VARCHAR(255) NOT NULL AFTER email;";

    $db->getPDO()->exec($SQL);
  }


  public function down() {
    $db = Application::$app->db;
    $sql = "ALTER TABLE users
    DROP COLUMN password;";
    $db->getPDO()->exec($sql);
  }


}