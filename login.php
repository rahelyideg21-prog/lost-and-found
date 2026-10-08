<?php
include 'db.php';
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $msg = "Invalid password!";
        }
    } else {
        $msg = "No user found with that username!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Lost and Found</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav class="navbar" style="background: #333; padding: 1rem; color: white;">
    <a href="index.php" style="color: white; margin-right: 15px; text-decoration: none;">Home</a>
    <a href="about.php" style="color: white; margin-right: 15px; text-decoration: none;">About</a>
    <a href="contact.php" style="color: white; margin-right: 15px; text-decoration: none;">Contact</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="logout.php" style="color: white; margin-right: 15px; text-decoration: none;">Logout</a>
    <?php else: ?>
        <a href="login.php" style="color: white; margin-right: 15px; text-decoration: none;">Login</a>
        <a href="regForm.php" style="color: white; margin-right: 15px; text-decoration: none;">Register</a>
    <?php endif; ?>
</nav>
    <h2>Login</h2>
    <p style="color:red;"><?php echo $msg; ?></p>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="regForm.php">Register</a></p>
</body>
</html>
