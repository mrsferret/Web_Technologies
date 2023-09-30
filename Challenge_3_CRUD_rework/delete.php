<?php
// Database connection (Update credentials accordingly)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_db';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Check if an ID is provided in the URL
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Delete the user with the provided ID
    $query = "DELETE FROM products WHERE item_id = $item_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Item ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>