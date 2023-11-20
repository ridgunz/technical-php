<?php
require_once '../../controller/product_controller.php';

class deleteProduct
{

  public function delete($id)
  {
    $product = new Products();
    $result = $product->delete($id);

    if ($result) {
      $_SESSION['message'] = ['type' => 'success', 'text' => 'Product deleted successfully!'];
    } else {
      $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to delete product.'];
    }

    header("Location: ../../views/product/product_page.php");
    exit();
  }
}

// Check if delete action is requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $controller = new deleteProduct();
  $controller->delete($_GET['id']);
}
?>