<?php

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ){

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

    if ( empty( $errors ) ) {       
        // Check if the email already exists in the database
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists. Please choose a different email address.";
            exit();
        }
    }
    # Check if email address already registered.
    if ( empty( $errors ) )
    {
        $q = "SELECT user_id FROM users WHERE email='email'" ;
        $r = @mysqli_query ( $link, $q ) ;
        // Echo the value of $r for debugging
        //echo 'Debug: ' . $r;

        // Check if the query was successful
        if ($r) {
            // Fetch the result and display it
            while ($row = mysqli_fetch_assoc($r)) {
                echo 'Debug: ' . $row['user_id'];
            }

            if (mysqli_num_rows($r) != 0) {
                $errors[] = 'Email address already registered. <a class="alert-link" href="login.php">Sign In Now</a>';
            }
        }
        if ( mysqli_num_rows( $r ) != 0 ) 
        {$errors[] = 'Email address already registered. <a class="alert-link" href="login.php">Sign In Now</a>' ;
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

            exit();
        }
    }
    # Close database connection.
    mysqli_close($link);
}
?>
