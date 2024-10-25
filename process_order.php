<?php
// Database connection details
$dbPath = 'C:/xampp/htdocs/Week6-2/resturant.db'; // Path to your SQLite database file

try {
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $item1 = htmlspecialchars($_POST['item1']);
    $item2 = htmlspecialchars($_POST['item2']); // Ensure this matches the form
    $flavor = htmlspecialchars($_POST['flavor']); // Ensure this matches the form

    // Debug: Print POST data
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Insert data into database
    $sql = "INSERT INTO Orders (name, address, phone, email, item1, item2, flavor) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $address, $phone, $email, $item1, $item2, $flavor]);

    // Set the header to redirect to success.html
    header('Location: success.php');
    exit; // Make sure to exit after the header is sent to prevent further script execution

} catch (PDOException $e) {
    die("Could not connect to the database $dbPath :" . $e->getMessage());
}
?>