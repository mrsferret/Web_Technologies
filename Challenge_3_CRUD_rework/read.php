<?php

// This code generates a web page that lists products from the database and provides links for editing and deleting them.

// Database connection (Update credentials accordingly)

include "connect_db.php";

//SQL query to retrieve data from the "products" table
$sql = "SELECT item_id, item_name, item_desc, item_img, item_price FROM products";

// record(s) retrieved from the using the mysqli_query function and stored in variable $r
$r = @mysqli_query ( $link, $sql ) ;
    // check if rows have been returned
    if ( mysqli_num_rows( $r ) != 0 ) 
        // num rows returned not 0
        // so carry on and display them
        // otherwise nothing is displayed

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Products</title>
</head>
<body>
    <h1>Items List</h1>
    <table border="1">
        <tr>
        <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
        </tr>
        <?php
        // iterate through the rows of data fetched from database using mysqli_fetch_array
        // fetches rows from a MySQL query result set ($r) and assigns each row to the variable $row
        // MYSQLI_ASSOC - specifies that the type of array returned is an associated array
        // ie. uses column names as keys so can access the data using column names
        
        while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
        
            {
            // Inside the while loop that displays user data
				echo '<tr>';
				echo '<td>' . $row['item_id'] . '</td>';
                echo '<td>' . $row['item_name'] . '</td>';
				echo '<td>' . $row['item_desc'] . '</td>';
                // Display the image with the trimmed URL
                //echo '<td>' . $row['item_img'] . '</td>';
                //echo 'item_img, ' . $row['item_img']; 
                $imageUrl = trim($row['item_img']);
                // Display the image with the trimmed URL
                echo '<td><img src="' . $imageUrl . '" alt="' . $row['item_name'] . '" width="50"></td>';
                echo '<td>' . $row['item_price'] . '</td>';
				echo '<td><a href="update.php?item_id=' . $row['item_id'] . '">Edit</a></td>';
                echo '<td><a href="delete.php?item_id=' . $row['item_id'] . '">Delete</a></td>';
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
