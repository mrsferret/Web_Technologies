<?php
include "connect_db.php";

$sql = "SELECT id, name, email, phone FROM users";
$r = @mysqli_query ( $link, $sql ) ;
    if ( mysqli_num_rows( $r ) != 0 ) 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
	<style>
table{
  border: 1px solid black;
  border-spacing: 30px;
  
}
td {
  border-bottom: 1px solid #ddd;
}
</style>
</head>
<body>
    <h1>Users List</h1>
    <a href="create.php">Create User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
			{
			echo'<tr>
			<td>'.$row['id'].' </td><td>'.$row['name'].' </td><td>'.$row['email'].'</td><td>'.$row['phone'].'</td><td><a href="delete.php">Delete  | </a> <a href="update.php">Update</a></td>
				</tr>
			';
}
		
	
    # Close database connection.
    mysqli_close($link); 

    exit();
?>
</body>
</html> 