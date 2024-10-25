<?php
// Database connection details
$host = 'C:/xampp/htdocs/Week6-2'; // Path to your database file
$db = 'resturant.db';
$dsn = "sqlite:$host/$db";

try {
    $pdo = new PDO($dsn);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Your SQL query to fetch the most recent order
    $stmt = $pdo->query('SELECT * FROM Orders ORDER BY id DESC LIMIT 1');
    
    // Fetch the row as an associative array
    $recentOrder = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to our restaurant</h1>
        <img src="123.png" alt="Restaurant Logo">
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="menu.html">Menu</a></li>
            <li><a href="order.html">Order</a></li>
            <li><a href="about.html">About Us</a></li>
        </ul>
    </nav>

    <?php if ($recentOrder && isset($recentOrder['name'])): ?>
        <p class="success-message">You have successfully ordered, <strong><?php echo htmlspecialchars($recentOrder['name']); ?></strong>!</p>
    <?php else: ?>
        <p class="success-message">You have successfully ordered!</p>
    <?php endif; ?>

    <h2>Order List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Item 1</th>
            <th>Item 2</th>
            <th>Flavor</th>
        </tr>
        <?php
        // Fetch all the rows as an associative array
        $stmt = $pdo->query('SELECT * FROM Orders');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Print table rows
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['item1']); ?></td>
                <td><?php echo htmlspecialchars($row['item2']); ?></td>
                <td><?php echo htmlspecialchars($row['flavor']); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <footer>
        <p>&copy; 2024 James. All rights reserved.</p>
    </footer>
</body>
</html>