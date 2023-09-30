<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $item_name = $_POST['item_name'];
    $item_desc = $_POST['item_desc'];
    $item_img = $_POST['item_img'];
    $item_price = $_POST['item_price'];

    # Connect to the database.
	  require ('connect_db.php'); 

    # Initialize an error array.
    $errors = array();

    # Check for item name .
    if ( empty( $_POST[ 'item_name' ] ) )
    { $errors[] = 'Enter product name.' ; }
    else
    { $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ; }

    # Check for item description
    if (empty( $_POST[ 'item_desc' ] ) )
    { $errors[] = 'Enter product description.' ; }
    else
    { $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ; }

    # Check for item image.
    if (empty( $_POST[ 'item_img' ] ) )
    { $errors[] = 'Enter product image.' ; }
    else
    { $i = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ; }
 
    # Check for item price.
    if (empty( $_POST[ 'item_price' ] ) )
    { $errors[] = 'Enter item price.' ; }
    else
    { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ; }
    
    // If no errors, Insert user into the database
    #$query = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    #$result = mysqli_query($conn, $query);

    # On success data into my_table on database.
    if ( empty( $errors ) ) 
    {
        $q = "INSERT INTO products (item_name, item_desc, item_img, item_price) 
	    VALUES ('$n','$d', '$i', '$p')";
        $r = @mysqli_query ( $link, $q ) ;
    if ($r)
        { echo '<p>New record created successfully</p> 
			<a href="read.php"></a>'; }
  
        # Close database connection.
        mysqli_close($link); 

        exit();
    }
   
# Or report errors.
else 
  {
    echo '<p>The following error(s) occurred:</p>' ;
    foreach ( $errors as $msg )
    { echo "$msg<br>" ; }
    echo '<p>Please try again.</p></div>';

    # Close database connection.
    mysqli_close( $link );

    exit();
	
  }  
}
?>