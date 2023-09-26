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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission to update user data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Update the user record in the database
        $query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user: " . mysqli_error($conn);
        }
    }

    // Fetch the user data to pre-fill the edit form
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Display the edit form
    ?>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>

    <?php
} else {
    echo "User ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>
