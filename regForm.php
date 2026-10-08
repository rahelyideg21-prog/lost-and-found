<?php
include 'db.php';
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        $msg = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $msg = "Error: Username might already exist.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Lost and Found</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
    function validateForm() {
        let user = document.forms["regForm"]["username"].value; 
        let pass = document.forms["regForm"]["password"].value; 
        if (user == "" ǁ pass== ""){
            alert("All fields must be filled out!"); return false;
        }
    }
</script>
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

    <h2>Register</h2>
    <p style=""color:red;><?php echo $msg; ?></p>
    <form name="regForm" method="POST" action="" onsubmit="return validateForm()">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
