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
    //$id = $_GET['id'];
    $item_id = $_GET['item_id']; // Assign the value to $item_id
//if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//    $item_id = $id; // Assign the value to $item_id    

     // Debugging: Output the value of 'id'
     //echo "ID from URL: " . $id;
     echo "ID from URL: " . $item_id;

    # Debugging - Loop through the $_POST array and print each key-value pair
    foreach ($_POST as $key => $value) {
        echo "$key: $value<br>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission to update user data
        $item_name = $_POST['item_name'];
        $item_desc = $_POST['item_desc'];
        $item_img = $_POST['item_img'];
        $item_price = $_POST['item_price'];

        // Update the user record in the database
        $query = "UPDATE products SET item_name = '$item_name', item_desc = '$item_desc', item_img = '$item_img', item_price = '$item_price' WHERE item_id = $item_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Products updated successfully!";
        } else {
            echo "Error updating products: " . mysqli_error($conn);
        }
    }

    // Fetch the user data to pre-fill the edit form
    $query = "SELECT * FROM products WHERE item_id = $item_id";
    $result = mysqli_query($conn, $query);
    $table = mysqli_fetch_assoc($result);

    // Display the edit form
    ?>

    <form method="post">
        <label for="item_name">Name:</label>
        <input type="text" name="item_name" value="<?php echo $table['item_name']; ?>" required><br><br>

        <label for="item_desc">Description:</label>
        <input type="text" name="item_desc" value="<?php echo $table['item_desc']; ?>" required><br><br>
        
        <label for="item_img">Image:</label>
        <input type="text" name="item_img" value="<?php echo $table['item_img']; ?>" required><br><br>
        
        <label for="item_price">Price:</label>
        <input type="number" name="item_price" value="<?php echo $table['item_price']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>

    <?php
} else {
    echo "User ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>
