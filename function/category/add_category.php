<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once '../../controller/category_controller.php';

  $name = $_POST['addName'];

  $categoryController = new category();
  $result = $categoryController->create($name);

  if ($result) {
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Product added successfully!'];
  } else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to add category.'];
  }

  header("Location: ../../views/category/category.php");
  exit();
}
?>