<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the form data
    $errors = array();

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'Error: All fields are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Error: Invalid email format.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Error: Passwords do not match.';
    }

    if (empty($errors)) {
        // Connect to the database
        $mysqli = new mysqli('localhost', 'root', '', 'codespace');

        if ($mysqli->connect_error) {
            die('Connection failed: ' . $mysqli->connect_error);
        }

        // Check if the email already exists in the database
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result = $mysqli->query($check_email_query);

        if ($result->num_rows > 0) {
            $errors[] = 'Error: Email already exists.';
        } else {
            // Insert user data into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$first_name', '$last_name', '$email', '$hashed_password',NOW())";
            //$insert_query = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$first_name', '$last_name', '$email', '$password', NOW())";
            if ($mysqli->query($insert_query) === true) {
                echo 'Registration successful!';
            } else {
                $errors[] = 'Error: ' . $mysqli->error;
            }
        }

        $mysqli->close();
    }

    if (!empty($errors)) {
        // Output error messages as JSON data
        echo json_encode($errors);
    }
}
?>
