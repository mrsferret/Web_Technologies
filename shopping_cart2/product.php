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
?>

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

<?php
// Include the header
include 'includes\header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if ($product) : ?>
                <div class="card">
                    <img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h2 class="card-title"><?= $product['name'] ?></h2>
                        <p class="card-text">Price: &pound;<?= $product['price'] ?></p>
                        <p class="card-text"><?= $product['desc'] ?></p>
                        <a href="#" class="btn btn-primary">Add to Cart</a> <!-- You can link this button to your cart functionality -->
                    </div>
                </div>
            <?php else : ?>
                <p>Product not found or invalid product ID.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php>

include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>

</body>
</html>
