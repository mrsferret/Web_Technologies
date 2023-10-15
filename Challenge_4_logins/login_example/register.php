<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ){

    // Database connection (Update credentials accordingly)
    //$host = "localhost";
    //$username = "root";
    //$password = "";
    //$database = "codespace";

    //$conn = mysqli_connect($host, $username, $password, $database);
    //if (!$conn) {
    //    die("Connection failed: " . mysqli_connect_error());
    //}
    require ('connect_db.php'); 

     # Initialize an error array.
    $errors = array();

    // Get user input
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please go back and try again.";
        exit();
    }
    if ( $_POST[ 'password' ] != $_POST[ 'confirm_password' ] )
        { $errors[] = 'Passwords do not match.' ; }
    else
        { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'password' ] ) ) ; }

    // Check if the email already exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists. Please choose a different email address.";
        exit();
    }
    # Check if email address already registered.
    if ( empty( $errors ) )
    {
        $query = "SELECT user_id FROM users WHERE email='$email'" ;
        $result = @mysqli_query ( $link, $query ) ;
        if ( mysqli_num_rows( $result ) != 0 ) 
         $errors[] = 'Email address already registered. <a class="alert-link" href="login.php">Sign In Now</a>' ;
    }

    // Insert user data into the database
    $insert_query = "INSERT INTO users (first_name, last_name, email, pass) VALUES ('$first_name', '$last_name', '$email', '$password')";
    if (mysqli_query($conn, $insert_query)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
