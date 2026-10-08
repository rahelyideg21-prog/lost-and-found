<?php
include 'db.php';
session_start();
setcookie("last_visit", date("Y-m-d H:i:s"),time()+ 86400, "/");

// Handle adding a lost/found item
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_item'])) {
    $item_name = trim($_POST['item_name']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);

    $stmt = $conn->prepare("INSERT INTO items (item_name, category, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $item_name, $category, $description);
    if ($stmt->execute()) {
        $msg = "Item posted successfully!";
    } else {
        $msg = "Error posting item.";
    }
}

// Fetch all items from the database
$result = $conn->query("SELECT * FROM items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Campus Lost and Found Portal</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .nav { margin-bottom: 20px; }
    </style>
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
    <div class="nav">
        <?php if (isset($_SESSION['user'])): ?>
            <span>Welcome, <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></span> | 
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a> | <a href="regForm.php">Register</a>
        <?php endif; ?>
    </div>

    <h1>Campus Lost and Found Portal</h1>
    <p>Browse or post lost and found items around campus.</p>

    <?php if (isset($_SESSION['user'])): ?>
        <h3>Post a Lost/Found Item</h3>
        <p style="color:green;"><?php echo $msg; ?></p>
        <form method="POST" action="">
            <label>Item Name:</label><br>
            <input type="text" name="item_name" required><br><br>
            <label>Category (e.g., Lost / Found):</label><br>
            <input type="text" name="category" required><br><br>
            <label>Description & Contact Info:</label><br>
            <textarea name="description" required></textarea><br><br>
            <button type="submit" name="add_item">Post Item</button>
        </form>
        <hr>
    <?php else: ?>
        <p><em><a href="login.php">Log in</a> to post a lost or found item.</em></p>
    <?php endif; ?>

    <h3>Reported Items List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Status/Category</th>
            <th>Description</th>
            
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No items found.</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
