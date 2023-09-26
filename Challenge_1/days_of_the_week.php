<?php
//Numeric Array
# Create and initialise an array 
echo"<h1>Days of the Week</h1>";
$days = array( 'Monday' , 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' , 'Sunday' ) ;

# List element values as a bulleted list.
foreach( $days as $value ) { echo "<ul><li>$value </li></ul> " ; } 
?>