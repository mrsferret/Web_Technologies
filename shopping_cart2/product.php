<?php
// Include the database connection file
include('config/connect_db.php');

// Check if a product ID is provided in the query string
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to retrieve the product details by ID
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        // Check if a product with the given ID exists
        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            // Close the result set
            mysqli_free_result($result);
        } else {
            // Product not found, you can handle this case as needed
            $product = null;
        }
    } else {
        // Error in the SQL query
        echo 'Error: ' . mysqli_error($link);
    }
} else {
    // No product ID provided in the query string, you can handle this case as needed
    $product = null;
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>

    <!-- Add Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Optional: Include Bootstrap's JavaScript and Popper.js for components that require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

// Include the header
include 'includes\header.php';

// Display product details
if ($product) {
    // Output product details here
    echo '<h2>' . $product['name'] . '</h2>';
    echo '<p>Price: &pound;' . $product['img'] . '</p>';
    echo '<p>Price: &pound;' . $product['price'] . '</p>';
    echo '<p>Description: ' . $product['desc'] . '</p>';
    echo '<button>Add to Cart</button>'; // You can link this button to your cart functionality
} else {
    // Product not found or no product ID provided, you can display an error message or redirect
    echo '<p>Product not found or invalid product ID.</p>';
}

// Include the footer
include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>

</body>
</html>

