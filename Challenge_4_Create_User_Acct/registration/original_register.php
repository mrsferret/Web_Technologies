<?php
#echo 'REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD'] . '<br>';

/*foreach ($_POST as $key => $value) {
    echo "$key: $value<br>";
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Connect to the database.
  //echo "about to connect to db";
  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();
    
  // Get user input
  #echo "Get user input";
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  /*echo "first_name: $first_name";
  echo "last_name: $last_name";
  echo "email: $email";
  echo "password: $password"; */


  // Handle form submission to check user data
  /*echo "handle form submission <br>";*/

  if ($_POST['password'] != $_POST['confirm_password']){
    // display error msg if input password and confirmed password don't match
        
    $errors[] = 'Passwords do not match.' ; 
    #exit();
  }

  if ( $_POST[ 'password' ] != $_POST[ 'confirm_password' ] )
        { $errors[] = 'Passwords do not match.' ; }
  else

    #echo "about to trim password <br>";
      { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'password' ] ) ) ; }

  if ( empty( $errors ) ) {     
    #echo "about to check if email already registered <br>" ; 
      // Check if the email already exists in the database
      $query = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($link, $query);
      if (mysqli_num_rows($result) > 0) {
        $errors[] = 'Password already registered.' ;
        
        #echo "Output error messages as JSON data";
        // Output error messages as JSON data
        $error_messages = json_encode($errors);
        #echo "<script>document.getElementById('result_msg').innerHTML = 'Error: ' + JSON.parse('$error_messages').join('<br>');</script>";
        #echo "Email already exists. Please choose a different email address.";
        #exit();
      }
    }
    
    if ( empty( $errors ) ) {
        // Insert user data into the database
        $insert_query = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$first_name', '$last_name', '$email', '$password', NOW())";
        if (mysqli_query($link, $insert_query)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($link);
            # Close database connection.
            mysqli_close($link); 

            #exit();
        }
    } else {
        #echo "Output error messages as JSON data";
        // Output error messages as JSON data
        #$error_messages = json_encode($errors);
        #echo "<script>document.getElementById('result_msg').innerHTML = 'Error: ' + JSON.parse('$error_messages').join('<br>');</script>";
        if (!empty($errors)) {
            // Construct an HTML list of error messages
            $error_list = '<ul>';
            foreach ($errors as $error) {
                $error_list .= "<li>$error</li>";
            }
            $error_list .= '</ul>';
    
            // Output error messages to the error_messages <div> element
            echo '<script>document.getElementById("error_messages").innerHTML = "' . $error_list . '";</script>';
        } else {
            echo 'Registration successful!';
            #echo '<script>document.getElementById("error_messages").innerHTML = "' . $error_list . '";</script>';
        }
    }

    # Close database connection.
    mysqli_close($link);
}
?>