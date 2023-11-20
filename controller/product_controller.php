<?php
require_once '../../connection.php';

class products extends connection
{
  public function create($name, $category, $price, $description, $imagePath)
  {
    $stmt = $this->conn->prepare("INSERT INTO product (name, category_id, price, description, image) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('ssdss', $name, $category, $price, $description, $imagePath);

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }


  public function read()
  {
    $query = "SELECT product.*, category.category_name 
                FROM product
                INNER JOIN category ON product.category_id = category.id";

    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  function getCategories()
  {
    $connection = new Connection();
    $conn = $connection->getConnection();

    $categories = array();

    // Fetch categories from the database
    $query = "SELECT id, category_name FROM category";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
      }
    }

    // Close the database connection
    $conn->close();

    return $categories;
  }

  public function update($id, $name, $category, $price, $description, $imagePath = null)
  {
    // Fetch the current image path from the database
    $currentImagePath = $this->getImagePathById($id);

    if ($imagePath === null) {
      // If $imagePath is not provided, update only product details
      $stmt = $this->conn->prepare("UPDATE product SET name = ?, category_id = ?, price = ?, description = ? WHERE id = ?");
      $stmt->bind_param('ssdsi', $name, $category, $price, $description, $id);
    } else {
      // If $imagePath is provided, update both product details and image
      $stmt = $this->conn->prepare("UPDATE product SET name = ?, category_id = ?, price = ?, description = ?, image = ? WHERE id = ?");
      $stmt->bind_param('ssdssi', $name, $category, $price, $description, $imagePath, $id);

      // Delete the old image file
      if ($currentImagePath && file_exists($currentImagePath)) {
        unlink($currentImagePath);
      }
    }

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $result = $stmt->execute();

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }

  private function getImagePathById($id)
  {
    $stmt = $this->conn->prepare("SELECT image FROM product WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['image'];
    }

    return null;
  }

  public function delete($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM product WHERE id = ?");

    $currentImagePath = $this->getImagePathById($id);

    if (!$stmt) {
      die("Error in SQL query: " . $this->conn->error);
    }

    $stmt->bind_param('i', $id);

    $result = $stmt->execute();
    // Delete the old image file
    if ($currentImagePath && file_exists($currentImagePath)) {
      unlink($currentImagePath);
    }

    if (!$result) {
      die("Error executing query: " . $stmt->error);
    }

    return $result;
  }

}

// Check the action requested and perform the corresponding operation
if (isset($_GET['action'])) {
  $controller = new products();

  switch ($_GET['action']) {
    case 'create':
      $controller->create($_POST['addName'], $_POST['addCategory'], $_POST['addPrice'], $_POST['addDescription'], $_FILE['addImage']);
      break;
    case 'update':
      $controller->update($_POST['id'], $_POST['editName'], $_POST['editCategory'], $_POST['editPrice'], $_POST['editDescription']);
      break;
    case 'delete':
      $controller->delete($_GET['id']);
      break;
    default:
      $controller->read();
      break;
  }
} else {
  $controller = new products();
  $controller->read();
}