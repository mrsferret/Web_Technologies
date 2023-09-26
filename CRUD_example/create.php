 <?php 
	if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
	{
	  # Connect to the database.
	  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

  # Check for name .
  if ( empty( $_POST[ 'name' ] ) )
  { $errors[] = 'Enter name.' ; }
  else
  { $n = mysqli_real_escape_string( $link, trim( $_POST[ 'name' ] ) ) ; }

  # Check for email.
  if (empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter email.' ; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }
  
  # Check for phone number.
  if (empty( $_POST[ 'phone' ] ) )
  { $errors[] = 'Enter phone number.' ; }
  else
  { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'phone' ] ) ) ; }
  
   # On success data into my_table on database.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (name, email, phone) 
	VALUES ('$n','$e', '$p' )";
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
	
  }  
}
?>