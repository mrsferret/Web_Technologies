<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
    $user_id = $_SESSION['user_id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $first_name; ?></h1>
    <p>Your User ID: <?php echo $user_id; ?></p>
    <p>First Name: <?php echo $first_name; ?></p>
    <p>Last Name: <?php echo $last_name; ?></p>
    <a href="logout.php">Log Out</a>
</body>
</html>
