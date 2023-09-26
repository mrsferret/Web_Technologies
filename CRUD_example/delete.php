<?php
# Open database connection.
require ( 'connect_db.php' ) ;

if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ;    
    $sql = "DELETE FROM users WHERE id='$id'";
 if ($link->query($sql) === TRUE) {
       header("Location: read.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
	
?>