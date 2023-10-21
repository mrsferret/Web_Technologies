<?php
// Include the database connection file
include('config/connect_db.php');

// Initialize or retrieve the shopping cart from the session
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

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

// Handle adding the product to the cart after button clicked
if ($product && isset($_POST['add_to_cart'])) {
    $cartItem = [
        'id' => $product['id'],
        
    ];
    $_SESSION['cart'][] = $cartItem;
    // Optionally, you can provide a message to confirm the product has been added to the cart
    $cart_message = 'Product added to the cart';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>

    <!-- Add Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <form method="POST">
                            <div class="input-group">
                                <input type="number" class="form-control" name="quantity" value="1" min="1">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <p>Product not found or invalid product ID.</p>
            <?php endif; ?>

            <?php if (isset($cart_message)) : ?>
                <div class="alert alert-success mt-3">
                    <?= $cart_message ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php

// Include the footer
include 'includes\footer.php';
?>

<!-- Include Bootstrap's JavaScript and Popper.js for components that require it -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
