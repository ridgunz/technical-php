<?php
require_once '../../controller/category_controller.php';

class deleteCategory
{

  public function delete($id)
  {
    $category = new category();
    $result = $category->delete($id);

    if ($result) {
      $_SESSION['message'] = ['type' => 'success', 'text' => 'Category deleted successfully!'];
    } else {
      $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to delete category.'];
    }

    header("Location: ../../views/category/category.php");
    exit();
  }
}

// Check if delete action is requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $controller = new deleteCategory();
  $controller->delete($_GET['id']);
}
?>