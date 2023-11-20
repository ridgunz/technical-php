<?php
include "../../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $connection = new Connection();
  $conn = $connection->getConnection();

  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $confirm_password = $_POST["confirm_password"];

  // Periksa apakah password dan konfirmasi password cocok
  if ($password == $confirm_password) {
    // Hash password sebelum menyimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan data pengguna ke database
    $query = "INSERT INTO users (name, password, email) VALUES ('$username', '$hashed_password', '$email')";
    $result = $conn->query($query);

    if ($result) {
      echo "Registration successful!";
      header("Location: ../../index.php");
    } else {
      echo "Registration failed. Please try again.";
    }
  } else {
    echo "Password and confirm password do not match.";
  }
}
?>