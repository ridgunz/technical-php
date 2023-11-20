<?php
require_once '../../connection.php';

class users extends connection
{
  public function read()
  {
    $query = "SELECT * FROM users";

    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function roles()
  {
    $query = "SELECT distinct role FROM users";

    $roles = $this->conn->query($query);
    return $roles->fetch_all(MYSQLI_ASSOC);
  }

  public function update($id, $roles)
  {
    $stmt = $this->conn->prepare("UPDATE users SET role = ? WHERE id = ?");

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('si', $roles, $id);

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }

}