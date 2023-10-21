<?php
// Include the database connection file
require_once 'config\connect_db.php';

// Start or resume the session
session_start();

// Initialize the cart array if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    $cartMessage = 'Your cart is empty.';
} else {
    $cartMessage = '';
}

// Include the header
include 'includes\header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    
    <!-- Add Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Optional: Include Bootstrap's JavaScript and Popper.js for components that require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="text-center">Shopping Cart</h1>
    <div class="row">
        <div class="col-12">
            <p><?php echo $cartMessage; ?></p>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Calculate the cart total
                    $cartTotal = 0;

                    // Display the contents of the session cart array
                    echo '<pre>';
                    print_r($_SESSION['cart']);
                    echo '</pre>';

                    foreach ($_SESSION['cart'] as $cartItem) {
                        $productId = $cartItem['id'];
                        // Display the product ID for each cart item
                        echo 'Product ID2: ' . $productId . '<br>';

                    }

                    foreach ($_SESSION['cart'] as $cartItem) {
                        // Check if $cartItem is an array before accessing 'id'
                        if (is_array($cartItem)) {
                            $productId = $cartItem['id'];
                            
                            // Display the product ID for each cart item
                            echo 'Product ID2: ' . $productId . '<br>';
                        
                            // Query to retrieve product details by ID
                            $sql = "SELECT * FROM products WHERE id = $productId";
                            $result = mysqli_query($link, $sql);
                        
                            if ($result && mysqli_num_rows($result) > 0) {
                                $product = mysqli_fetch_assoc($result);
                                $productPrice = $product['price'];
                                $productTotal = $productPrice * $cartItem['quantity'];
                                $cartTotal += $productTotal;
                        
                                echo '<tr>';
                                echo '<td>' . $product['name'] . '</td>';
                                echo '<td>&pound;' . $productPrice . '</td>';
                                echo '<td>' . $cartItem['quantity'] . '</td>';
                                echo '<td>&pound;' . $productTotal . '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-6">
            <p>Total: &pound;<?php echo $cartTotal; ?></p>
        </div>
    </div>
</div>

<?php
// Include the footer
include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>
</body>
</html>
