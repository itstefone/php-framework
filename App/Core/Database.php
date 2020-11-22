<?php

namespace itstefoneCore;

use PDO;

class Database {


  protected $pdo;


  public function __construct(array $config)
  {
    $dns =   $config['dns'] ?? '';
    $user = $config['user'] ?? '';
    $password= $config['password'] ?? '';
    $this->pdo = new PDO($dns, $user, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }





  public function applyMigrations() {
  

    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigration();


    $migrationsPath = Application::$app->rootPath . '/App/migrations';

    $migrations  = scandir($migrationsPath);

    $toApplyMigrations = array_diff($migrations, $appliedMigrations);

    $newMigrations = [];
      foreach($toApplyMigrations as $migration) {

        if($migration === '.' || $migration === '..') {
          continue;
        }

          require_once Application::$app->rootPath . '/App/migrations/' . $migration;
          $className = pathinfo($migration, PATHINFO_FILENAME);      
          
          $object = new $className();

          echo  $this->log("Applaying migration $className.");
          $object->up();
          echo  $this->log("Applied migration $className");
          $newMigrations[] = $migration;
      }


      if(!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
      } else {
        echo  $this->log('All Migrations already applied.');
      }
  }


  public function getPDO() {
    return $this->pdo;
  }


  
  public function saveMigrations($newMigrations) {

    $newMigrations = array_map(fn($migration) => "('$migration')", $newMigrations);
    $migrations = implode(', ', $newMigrations);
    
    $statement = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES $migrations");

    $statement->execute();

  }


  public function createMigrationsTable() {
   $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS migrations (

  `id` int(11)  auto_increment PRIMARY KEY,       
  `migration` varchar(250)  NOT NULL default '',     
  `created_AT`  timestamp default current_timestamp
   )");
$statement->execute();
  }


  public function getAppliedMigration() {
    $statement = $this->pdo->prepare('SELECT migration FROM migrations');

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_COLUMN);

  }


  public function log($message) {
    return "[". date('Y-m-d h:i:s') ."] " . $message . PHP_EOL; 
   }
}



