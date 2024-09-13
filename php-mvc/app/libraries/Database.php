<?php

class Database {

  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $dbh;

  public function __construct()
  {
    $dsn = "mysql:host=$this->host;dbname=$this->dbname";
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch(PDOException $e){
      echo $e->getMessage();

    }
  }

  public function getConnect()
  {
    return $this->dbh;
  }
  
}