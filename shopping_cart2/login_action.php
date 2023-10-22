<?php # PROCESS LOGIN ATTEMPT.

echo 'REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD'] . '<br>';

foreach ($_POST as $key => $value) {
    echo "$key: $value<br>";
}
# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Open database connection.
  require ( 'config\connect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;
  # ---------------------------------------------------------------------------------  
  # Check login.
  # ---------------------------------------------------------------------------------
  # validate user's login credentials (email and password) by calling the 'validate' 
  # function (in login_tools.php) and passes in the database connection ($link) and
  # the submitted email and password
  # The list() function is used to assign values to a list of variables
  # in one operation. In this example, the 2 variables returned from validate are 
  # assigned to the variables $check and $data
  # ---------------------------------------------------------------------------------
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;
  if ($check) {
    echo "Validation succeeded 1. Data:<br>";
    foreach ($data as $key => $value) {
        echo "$key: $value<br>";
    }
  } else {
      echo "Validation failed 1. Errors:<br>";
      foreach ($data as $error) {
            echo $error . "<br>";
        }
  }
  # On success set session data and display logged in page.
  if ( $check )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
    $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
    load ( 'index.php' ) ;
  }
  # Or on failure set errors.
  else { $errors = $data;
    # include ( 'include/head.php' ) ;
    # Display any error messages if present.
    if ( isset( $errors ) && !empty( $errors ) )
      {echo 'error set';
      echo '<p id="err_msg">Oops! There was a problem:<br>' ;
      foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
      echo 'Please try again or <a href="create_acct.php">Register</a></p>' ;
      }
  } 

  # Close database connection.
  echo 'closing db connection' . '<br>'; //debugging
  mysqli_close( $link ) ; 
}

# Continue to display login page on failure.
include ( 'login.php' ) ;
//include ( 'login.html' ) ;

?>