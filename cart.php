<?php
require_once 'config.php';

// Check if the cart array exists in the session
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Get the cart items
$cartItems = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>My App - Cart</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Cart</h1>
    <?php if (empty($cartItems)) : ?>
      <p>Your cart is empty.</p>
    <?php else : ?>
      <table class="table">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cartItems as $item) : ?>
            <tr>
              <td><?php echo $item['name']; ?></td>
              <td>$<?php echo $item['price']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    <?php endif; ?>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
