<?php
// Database connection (Update credentials accordingly)

include "connect_db.php";

$sql = "SELECT id, name, email, phone FROM users";
$r = @mysqli_query ( $link, $sql ) ;
    if ( mysqli_num_rows( $r ) != 0 ) 

#$host = 'localhost';
#$username = 'root';
#$password = '';
#$database = 'crud_db';

#$conn = mysqli_connect($host, $username, $password, $database);

#if (!$conn) {
#    die('Database connection error: ' . mysqli_connect_error());
#}

// Retrieve users from the database
#$query = "SELECT * FROM users";
#$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Users</title>
</head>
<body>
    <h1>Users List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
        #while ($row = mysqli_fetch_assoc($result)) 
        while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
        
            {
            // Inside the while loop that displays user data
				echo '<tr>';
				echo '<td>' . $row['name'] . '</td>';
				echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['phone'] . '</td>';
				echo '<td><a href="update.php?id=' . $row['id'] . '">Edit</a></td>';
				echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
				echo '</tr>';
			}
        ?>
    </table>
    <a href="create_form.html">Add User</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($link);

exit()
?>
