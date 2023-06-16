<?php
require_once 'config.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all products
$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the cart array exists in the session
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Get the count of items in the cart
$cartItemCount = count($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Hacker Swags - Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .dropdown-menu {
      min-width: 150px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hacker Swags</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            Cart
            <?php if ($cartItemCount > 0) : ?>
              <span class="badge badge-primary"><?php echo $cartItemCount; ?></span>
            <?php endif; ?>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $user['username']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
      <a href="admin.php" class="btn btn-primary">Admin Panel</a>
    </div>
  </nav>

  <div class="container mt-5">
    <h1>Welcome to Hacker Swags!</h1>

    <form method="GET" action="search.php" class="mt-4">
      <div class="input-group">
        <input type="text" name="query" class="form-control" placeholder="Search for products...">
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </form>

    <h2 class="mt-4">Best Swags for You!!</h2>
    <div class="row mt-4">
      <?php foreach ($products as $product) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $product['name']; ?></h5>
              <p class="card-text"><?php echo $product['description']; ?></p>
              <p class="card-text">$<?php echo $product['price']; ?></p>
              <a href="product_details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

