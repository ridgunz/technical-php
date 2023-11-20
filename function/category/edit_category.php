<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle the form submission for editing the product
  require_once '../../controller/category_controller.php';

  $id = $_POST['id'];
  $name = $_POST['editName'];

  $category = new category();
  $result = $category->update($id, $name);

  if ($result) {
    session_start();
    $_SESSION['success_message'] = "Category updated successfully!";

    // Redirect to the category page
    header("Location: ../../views/category/category.php");
    exit();
  } else {
    echo "Failed to update category.";
  }
}
?>