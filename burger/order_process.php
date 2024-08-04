<?php
// Database configuration
$servername = "jdbc:mysql://localhost:3306/burger";
$username = "root";
$password = "";
$dbname = "burger";

// Create connection
$conn = new mysqli($burger, $root, $password, $burger);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $burger = $conn->real_escape_string(htmlspecialchars($_POST['burger']));
    $quantity = intval($_POST['quantity']);

    // Basic validation
    if ($quantity < 1 || $quantity > 10) {
        echo "Quantity must be between 1 and 10.";
        $conn->close();
        exit;
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (burger, quantity) VALUES (?, ?)");
    $stmt->bind_param("si", $burger, $quantity);

    // Execute statement
    if ($stmt->execute()) {
        echo "<h1>Order Confirmation</h1>";
        echo "<p>Thank you for your order!</p>";
        echo "<p>Burger: " . htmlspecialchars($burger) . "</p>";
        echo "<p>Quantity: " . $quantity . "</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
