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
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user with the provided ID
    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "User ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>