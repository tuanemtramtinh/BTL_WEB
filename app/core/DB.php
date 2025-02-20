<?php

class DB{

  protected $pdo;
  protected $host = '103.140.249.159';
  protected $dbname = 'test';
  protected $username = 'tuanemtramtinh';
  protected $password = 'Anh2004@nh';

  public function __construct(){
    $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", 
    $this->username, 
    $this->password,
    [
    //   PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enable error reporting
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch associative arrays
      PDO::ATTR_EMULATE_PREPARES => false, // Use native prepared statements
    ]);
  } 

  public function getConnection(){
    return $this->pdo;
  }
}