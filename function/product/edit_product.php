<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once '../../controller/product_controller.php';

  $id = $_POST['id'];
  $name = $_POST['editName'];
  $category = $_POST['editCategory'];
  $price = $_POST['editPrice'];
  $description = $_POST['editDescription'];

  // Check if a new image is uploaded
  if (!empty($_FILES['editImage']['name'])) {
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

    if (move_uploaded_file($_FILES["editImage"]["tmp_name"], $uploadFile)) {
      // File uploaded successfully
      $imagePath = $uploadFile;
    } else {
      // File upload failed
      echo "Error uploading image.";
      exit();
    }
  } else {
    // No new image uploaded, keep the existing image path or set it to NULL if needed
    $imagePath = null;
  }

  // Update the product with the new information
  $product = new products();
  $result = $product->update($id, $name, $category, $price, $description, $imagePath);

  if ($result) {
    session_start();
    $_SESSION['success_message'] = "Product updated successfully!";

    // Redirect to the product page
    header("Location: ../../views/product/product_page.php");
    exit();
  } else {
    echo "Failed to update product.";
  }
}
?>