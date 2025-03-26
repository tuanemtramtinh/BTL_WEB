<?php

class DB{

  protected $conn;
  protected $host = '103.140.249.159';
  protected $dbname = 'PERFUME';
  protected $username = 'tuanemtramtinh';
  protected $password = 'Anh2004@nh';

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