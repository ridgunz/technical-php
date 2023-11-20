<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle the form submission for editing the product
  require_once '../../controller/users_controller.php';

  $id = $_POST['id'];
  $roles = $_POST['editRoles'];

  $users = new users();
  $result = $users->update($id, $roles);

  if ($result) {
    session_start();
    $_SESSION['success_message'] = "Users updated successfully!";

    // Redirect to the category page
    header("Location: ../../views/users/users.php");
    exit();
  } else {
    echo "Failed to update category.";
  }
}
?>