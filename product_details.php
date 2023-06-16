<?php
require_once 'config.php';

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];

  // Fetch product data
  $sql = "SELECT * FROM products WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$product_id]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$product) {
    echo "Product not found.";
    exit;
  }
} else {
  echo "Product ID not specified.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My App - Product Details</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Product Details</h1>
    <div class="row">
      <div class="col-md-6">
        <img src="<?php echo $product['image']; ?>" alt="Product Image" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h2><?php echo $product['name']; ?></h2>
        <p><?php echo $product['description']; ?></p>
        <h4>Price: $<?php echo $product['price']; ?></h4>
        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
