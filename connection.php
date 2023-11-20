<?php
class connection
{
  private $host = '127.0.0.1';
  private $username = 'root';
  private $password = '';
  private $database = 'technical_php';
  protected $conn;

  public function __construct()
  {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database, null, '/path/to/mysql.sock');

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
  public function getConnection()
  {
    return $this->conn;
  }

}
?>