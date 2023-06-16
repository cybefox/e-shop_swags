<?php
session_start();

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Check if the product exists in the database
  $sql = "SELECT * FROM products WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$product_id]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($product) {
    // Check if the cart array exists in the session
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }

    // Add the product to the cart
    $_SESSION['cart'][] = $product;

    // Redirect back to the shop page
    header("Location: shop.php");
    exit;
  } else {
    echo "Product not found.";
    exit;
  }
} else {
  echo "Product ID not specified.";
  exit;
}
?>
