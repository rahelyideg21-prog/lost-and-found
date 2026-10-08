<?php
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Simple confirmation message (can also be saved to database if needed)
    $msg = "Thank you, $name! Your message has been sent successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact - Campus Lost and Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .nav { margin-bottom: 20px; }
    </style>
    <link rel="stylesheet" href="style.css">
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

    <h1>Contact Us</h1>
    <p>Have questions or feedback? Send us a message below.</p>

    <p style="color:green;"><?php echo $msg; ?></p>

    <form method="POST" action="">
        <label>Your Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Your Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Message:</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>
        
        <button type="submit">Send Message</button>
    </form>

</body>
</html>
