<?php
require_once '../../connection.php';

class category extends connection
{
  public function create($name)
  {
    $stmt = $this->conn->prepare("INSERT INTO category (category_name) VALUES (?)");

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('s', $name);

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }


  public function read()
  {
    $query = "SELECT * FROM category";

    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }


  public function update($id, $name)
  {
    $stmt = $this->conn->prepare("UPDATE category SET category_name = ? WHERE id = ?");

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('si', $name, $id);

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM category WHERE id = ?");

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('i', $id);

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }

}

// Check the action requested and perform the corresponding operation
if (isset($_GET['action'])) {
  $controller = new category();

  switch ($_GET['action']) {
    case 'create':
      $controller->create($_POST['addName']);
      break;
    case 'update':
      $controller->update($_POST['id'], $_POST['editName']);
      break;
    case 'delete':
      $controller->delete($_GET['id']);
      break;
    default:
      $controller->read();
      break;
  }
} else {
  $controller = new category();
  $controller->read();
}