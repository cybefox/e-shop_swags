<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit;
}

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Delete the product from the database
  $sql = "DELETE FROM products WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$product_id]);

  // Redirect to product management page
  header("Location: admin.php");
  exit;
} else {
  echo "Product ID not specified.";
  exit;
}
?>
