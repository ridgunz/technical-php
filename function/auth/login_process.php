<?php
session_start();

include "../../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $connection = new Connection();
  $conn = $connection->getConnection();

  $identifier = $_POST["email"];
  $password = $_POST["password"];

  // Periksa apakah input adalah email atau username
  $loginField = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? "email" : "name";

  // Periksa email/username dan password dari database
  $query = "SELECT * FROM users WHERE $loginField=?";

  // Add error handling for query preparation
  $stmt = $conn->prepare($query);
  if (!$stmt) {
    die("Error in query preparation: " . $conn->error);
  }

  // Bind parameters and execute the query
  $stmt->bind_param("s", $identifier);
  $stmt->execute();

  // Check for errors during query execution
  if ($stmt->error) {
    die("Error in query execution: " . $stmt->error);
  }

  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row["password"];

    // Verifikasi password menggunakan password_verify
    if (password_verify($password, $stored_password)) {
      // Login berhasil
      $_SESSION[$loginField] = $identifier;

      $role = $row['role'];
      $_SESSION['role'] = $role;

      // Regenerate session ID for security
      session_regenerate_id(true);


      header("Location: ../../index.php");
      exit();
    } else {
      // Password tidak sesuai
      echo "Login failed. Check your email/username and password.";
    }
  } else {
    // Email/username tidak ditemukan
    echo "Login failed. Check your email/username and password.";
  }

  $stmt->close();
  $conn->close();
}
?>