<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit;
}

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Upload product image
  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $image_path = 'uploads/' . $image;
  move_uploaded_file($image_tmp, $image_path);

  // Insert new product into the database
  $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$name, $description, $price, $image_path]);

  // Redirect to product management page
  header("Location: admin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My App - Add Product</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>Add Product</h1>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control" required step="0.01">
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control-file" required accept="image/*">
      </div>
      <input type="submit" name="submit" value="Add Product" class="btn btn-primary">
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
