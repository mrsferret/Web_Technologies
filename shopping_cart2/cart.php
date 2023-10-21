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
            <form method="POST" action="update_cart.php">
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

                        foreach ($_SESSION['cart'] as $productId => $cartItem) {
                            // Check if $cartItem is an array before accessing 'id'
                            if (is_array($cartItem)) {
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
                                    echo '<td><input type="number" name="qty[' . $productId . ']" value="' . $cartItem['quantity'] . '"></td>';
                                    echo '<td>&pound;' . $productTotal . '</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary" name="update_cart">Update Basket</button>
                    </div>
                    <div class="col-3">
                        <p>Total: &pound;<?php echo $cartTotal; ?></p>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-3">
                        <button type="submit" class="btn btn-success" name="checkout">Checkout Now</button>
                    </div>
                </div>
                
            </form>
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
