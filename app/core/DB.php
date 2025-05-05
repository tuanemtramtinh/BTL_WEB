<?php

class DB{

  protected $conn;
  protected $host = '103.140.249.159';
  protected $dbname = 'PERFUME';
  protected $username = 'tuanemtramtinh';
  protected $password = 'Anh2004@nh';


  // Uncomment the following lines to use local database connection
  // protected $host = 'localhost';
  // protected $dbname = 'PERFUME';
  // protected $username = 'root';
  // protected $password = '';

  public function __construct(){
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

  } 

  public function getConnection(){
    return $this->conn;
  }

  public function closeConnection() {
    if ($this->conn) {
      $this->conn->close();
    }
  }
}