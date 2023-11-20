<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once '../../controller/product_controller.php'; // Include the ProductController class

  $name = $_POST['addName'];
  $category = $_POST['addCategory'];
  $price = $_POST['addPrice'];
  $description = $_POST['addDescription'];

  // Handle image upload
  $uploadDir = "../../images/"; // Set your desired upload directory

  // Get the current date and time
  $currentDateTime = date("YmdHis");

  // Get the file extension
  $fileExtension = pathinfo($_FILES["addImage"]["name"], PATHINFO_EXTENSION);

  // Construct the new image name
  $newImageName = "image-" . $currentDateTime . "." . $fileExtension;

  // Set the full path for the new image
  $uploadFile = $uploadDir . $newImageName;

  if (move_uploaded_file($_FILES["addImage"]["tmp_name"], $uploadFile)) {
    // File uploaded successfully
    $productController = new products();
    $result = $productController->create($name, $category, $price, $description, $uploadFile);

    if ($result) {
      $_SESSION['message'] = ['type' => 'success', 'text' => 'Product added successfully!'];
    } else {
      $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to add product.'];
    }
  } else {
    // File upload failed
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Error uploading file.'];
  }

  header("Location: ../../views/product/product_page.php");
  exit();
}
?>