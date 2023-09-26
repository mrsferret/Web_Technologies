<?php
// Check if the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Initialize an array to store error messages
   $errors = [];

   // Validate and sanitize the input data
   $item_name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
   $item_desc = filter_input(INPUT_POST, 'item_desc', FILTER_SANITIZE_STRING);
   $item_img = filter_input(INPUT_POST, 'item_img', FILTER_SANITIZE_URL);
   $item_price = filter_input(INPUT_POST, 'item_price', FILTER_VALIDATE_FLOAT);

   // Validate required fields
   if (empty($item_name) || empty($item_desc) || empty($item_img) || $item_price === false) {
       $errors[] = "All fields are required and must be valid.";
   }

   // If there are no errors, proceed to insert the record into the database
   if (empty($errors)) {
       // Database connection information
       $db_host = 'local';
       $db_user = 'root';
       $db_pass = '';
       $db_name = 'crudchallenge';

       // Create a database connection
       $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

       // Check if the connection was successful
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       // SQL query to insert data into 'products' table
       $sql = "INSERT INTO products (item_name, item_desc, item_img, item_price) VALUES (?, ?, ?, ?)";

       // Prepare the SQL statement
       $stmt = $conn->prepare($sql);

       if ($stmt) {
           // Bind parameters and execute the statement
           $stmt->bind_param("sssd", $item_name, $item_desc, $item_img, $item_price);

           if ($stmt->execute()) {
               echo "Record inserted successfully!";
           } else {
               $errors[] = "Error inserting record: " . $stmt->error;
           }

           // Close the statement
           $stmt->close();
       } else {
           $errors[] = "Error preparing statement: " . $conn->error;
       }

       // Close the database connection
       $conn->close();
   }
}

// Output any errors
if (!empty($errors)) {
   foreach ($errors as $error) {
       echo $error . "<br>";
   }
}
?>