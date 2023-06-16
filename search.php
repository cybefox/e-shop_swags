<?php
require_once 'config.php';

if (isset($_GET['query'])) {
  $searchQuery = $_GET['query'];

  // Fetch products matching the search query
  $sql = "SELECT * FROM products WHERE name LIKE :query OR description LIKE :query";
  $stmt = $conn->prepare($sql);
  $stmt->execute(['query' => '%' . $searchQuery . '%']);
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My App - Search Results</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Search Results for "<?php echo $searchQuery; ?>"</h1>
    <?php if (isset($products) && count($products) > 0) : ?>
      <div class="row">
        <?php foreach ($products as $product) : ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="Product Image">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text"><?php echo $product['description']; ?></p>
                <h6 class="card-price">$<?php echo $product['price']; ?></h6>
                <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <p>No products found.</p>
    <?php endif; ?>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
