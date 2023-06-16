<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not specified.";
    exit;
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update user data
    $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $user_id]);

    // Redirect to admin panel
    header("Location: admin.php");
    exit;
}

if (isset($_POST['delete'])) {
    // Delete user
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);

    // Redirect to admin panel
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My App - Admin User Update</title>
</head>
<body>
    <h1>Admin User Update</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" value="<?php echo $user['username']; ?>" required><br><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required><br><br>
        <input type="submit" name="update" value="Update User">
        <input type="submit" name="delete" value="Delete User" onclick="return confirm('Are you sure you want to delete this user?')">
    </form>
    <br>
    <a href="admin.php">Back to Admin Panel</a>
</body>
</html>
