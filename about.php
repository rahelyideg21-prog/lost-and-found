<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>About - Campus Lost and Found</title>
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

    <h1>About This Project</h1>
    <h3>Developer Information</h3>
    <ul>
        <li><b>Full Name:</b> [Rahel- Yideg]</li>
        <li><b>ID Number:</b> [031/2016]</li>
        <li><b>Department:</b> Department of Computer Science</li>
    </ul>

    <h3>Personal Write-up</h3>
    <p>Hello! I am a computer science student passionate about web development.
       I chose the Lost and Found Portal project to help students easily recover lost items around
        campus and streamline communication.</p>

    <h3>System Description</h3>
    <p>The Campus Lost and Found Portal is a web application designed to allow registered users to post,
         browse, and track lost or found items efficiently, preventing items from getting permanently lost.</p>

</body>
</html>
