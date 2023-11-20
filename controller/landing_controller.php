<?php
require_once 'connection.php';

class products extends connection
{
  public function read()
  {
    $query = "SELECT product.*, category.category_name 
                FROM product
                INNER JOIN category ON product.category_id = category.id";

    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }



}

$controller = new products();
$controller->read();