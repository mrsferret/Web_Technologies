<?php
// Database connection 
include "connect_db.php";

$sql = "SELECT item_id, item_name, item_desc, item_img, item_price FROM products";
$r = @mysqli_query($link, $sql);

if (mysqli_num_rows($r) != 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Products</title>
</head>
<body>
    <h1>Products List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['item_id'] . '</td>';
            echo '<td>' . $row['item_name'] . '</td>';
            echo '<td>' . $row['item_desc'] . '</td>';
			// Trim leading and trailing spaces from the URL stored in item_img
            $imageUrl = trim($row['item_img']);
            // Displaying the image as a thumbnail
            //echo '<td><img src="' . $row['item_img'] . '" alt="' . $row['item_name'] . '"></td>';
			//echo '<td><img src="gianny.jpeg" alt="' . $row['item_name'] . '"></td>';
			//echo '<td><img src="gianny.jpeg" alt="' . $row['item_name'] . '" width="100" //height="100"></td>';
			// Displaying the image as a smaller size while maintaining aspect ratio
            //echo '<td><img src="gianny.jpeg" alt="' . $row['item_name'] . '" width="50"></td>';
			
			// Display the image with the trimmed URL
            echo '<td><img src="' . $imageUrl . '" alt="' . $row['item_name'] . '" width="100"></td>';
            
            echo '<td>' . $row['item_price'] . '</td>';
            echo '<td><a href="update.php?id=' . $row['item_id'] . '">Edit</a></td>';
            echo '<td><a href="delete.php?id=' . $row['item_id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <a href="create_form.html">Add Product</a>
</body>
</html>
<?php
}

// Close the database connection
mysqli_close($link);
exit();
?>
