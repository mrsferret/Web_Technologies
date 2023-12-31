<?php
// Database connection 

include "connect_db.php";

$sql = "SELECT item_id, item_name, item_desc, item_img, item_price FROM products";
$r = @mysqli_query ( $link, $sql ) ;
    if ( mysqli_num_rows( $r ) != 0 ) 

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Products</title>
</head>
<body>
    <h1>Users List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        <?php
        #while ($row = mysqli_fetch_assoc($result)) 
        while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
        
            {
            // Inside the while loop that displays user data
				echo '<tr>';
				echo '<td>' . $row['item_id'] . '</td>';
                echo '<td>' . $row['item_name'] . '</td>';
				echo '<td>' . $row['item_desc'] . '</td>';
				echo '<td>' . $row['item_img'] . '</td>';
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
// Close the database connection
mysqli_close($link);

exit()
?>
