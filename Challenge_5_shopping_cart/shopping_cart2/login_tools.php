<?php # LOGIN HELPER FUNCTIONS.
//debugging
echo '<br>' . 'login_tools.php' . '<br>';

# Function to load specified or default URL.
//function load( $page = 'login.php' )
function load( $page = 'login.html' )
{
    echo '<br>' . 'function load' . '<br>'; //debugging

  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page ;

  # Execute redirect then quit. 
  header( "Location: $url" ) ; 
  exit() ;
}

# Function to check email address and password. 
function validate( $link, $email = '', $pwd = '')
{
    echo '<br>' . 'function validate' . '<br>'; //debugging
    echo 'email passed in: ' . $email . '<br>';
    echo 'pwd passed in: ' . $pwd . '<br>';
  # Initialize errors array.
  $errors = array() ; 

  # Check email field.
  if ( empty( $email ) ) 
  
  { echo 'email empty' . '<br>'; //debugging
    $errors[] = 'Enter your email address.' ; } 
  else { echo 'email not empty' . '<br>'; //debugging
    $e = mysqli_real_escape_string( $link, trim( $email ) ) ; }

  # Check password field.
  if ( empty( $pwd ) ) 
  { echo 'pwd empty' . '<br>'; //debugging
    $errors[] = 'Enter your password.' ; } 
  else { echo 'pwd not empty' . '<br>'; //debugging
    $p = mysqli_real_escape_string( $link, trim( $pwd ) ) ; }

  # On success retrieve user_id, first_name, and last name from 'users' database.
  if ( empty( $errors ) ) 
  { echo 'no errors so far' . '<br>'; //debugging
    #$q = "SELECT user_id, first_name, last_name FROM users WHERE email='$e' AND pass=SHA2 ('$p', 256)" ;  
    $q = "SELECT user_id, first_name, last_name FROM users WHERE email='$e' AND pass='$p'" ;  
    echo 'query: ' . $q . '<br>'; //debugging
    $r = mysqli_query ( $link, $q ) ;
    if ( @mysqli_num_rows( $r ) == 1 ) 
    { echo 'matching row found' . '<br>'; //debugging
      $row = mysqli_fetch_array ( $r, MYSQLI_ASSOC ) ;
      return array( true, $row ) ; 
    }
    # Or on failure set error message.
    else { echo 'no matching row found' . '<br>'; //debugging
        $errors[] = 'Email address and password not found.' ; }
  }
  # On failure retrieve error message/s.# On failure retrieve error message/s.
    $result = array( false, $errors );
    if (!$result[0]) {
        echo "Validation failed. Errors:<br>";

        foreach ($result[1] as $error) {
            echo $error . "<br>";
        }
    } else {
    echo "Validation succeeded.<br>";
    }

  return array( false, $errors ) ; 
}