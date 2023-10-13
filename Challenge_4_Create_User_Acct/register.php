<?php
echo 'REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD'] . '<br>';

foreach ($_POST as $key => $value) {
    echo "$key: $value<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Connect to the database.
  require ('connect_db.php'); 

  # Initialize an error array.
  $errors = array();

    // Handle form submission to check user data

    # Debugging - Loop through the $_POST array and print each key-value pair
    foreach ($_POST as $key => $value) {
        echo "$key: $value<br>";
    }

    if ($_POST['inputPwd'] != $_POST['confirmPwd']){
        // display error msg if input password and confirmed password don't match
        
        $errors[] = 'Passwords do not match.' ; 
    
    }
}
?>