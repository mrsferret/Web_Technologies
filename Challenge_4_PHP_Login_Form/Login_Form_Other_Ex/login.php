<?php
// Start a PHP session
echo "login.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection code
    require('connect_db.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform basic validation (you can add more as needed)
    if (empty($email) || empty($password)) {
        echo "Both email and password are required.";
    } else {
        // Check if the email and password match in the database
        # $query = "SELECT user_id, first_name, last_name FROM users WHERE email='$email' AND pass=SHA2('$password', 256)";
        $query = "SELECT user_id, first_name, last_name FROM users WHERE email='$email' AND pass='$password'";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            // User is authenticated
            $row = mysqli_fetch_assoc($result);

            // Store user information in the session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];

            // Redirect to a welcome page or member's area
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    }

    // Close the database connection
    mysqli_close($link);
}
?>

<!-- You can display the login form here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
