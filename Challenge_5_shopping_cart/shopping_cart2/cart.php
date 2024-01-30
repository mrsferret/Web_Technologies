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
    // debugging
    // Display the contents of the session cart array
    #echo '<pre>';
    #print_r($_SESSION['cart']);
    #echo '</pre>';
}
#-------------------------------
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    // debugging
    #echo "User ID: " . $_SESSION['user_id'] ."<br>";
    
  }
?> 

<?php
if (isset($_POST['update_cart'])){
    /*echo "update_cart<br>";
    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';
    echo "<br>";

    echo "$SESSION values<br>";
    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';
    echo "<br>";
    echo '<pre>';

    echo "$_POST values<br>";
    echo '<pre>';
    print_r($_POST);
    echo '</pre>'; */

    if (isset($_SESSION['cart'])) {
        #echo "SESSION(cart) is set <br>";
        
        // Loop through the post data to update the quantities for every product in the cart
        foreach ($_POST as $key => $value) {
            #echo "in foreach loop<br>";
            #echo "Key: $key, Value: ";
            
            if (is_array($value)) {
                echo "Array<br>";
                // You're dealing with an array here
                foreach ($value as $id => $quantity) {
                    echo "ID: " . $id . "<br>";
                    echo "Quantity: " . $quantity . "<br>";
                    // Validate the quantity and ensure it's not negative
                    $quantity = (int) $quantity;
                    if ($quantity >= 0) {
                        if ($quantity === 0) {
                            // If the quantity is set to 0, remove the product from the cart
                            unset($_SESSION['cart'][$id]);
                        } else {
                            // Update the quantity for the product
                            $_SESSION['cart'][$id]['quantity'] = $quantity;
                        }
                    }
                }
            } else {
                #echo $value . "<br>";
            }
        }
    }
}
// handle the form submission and update the cart
/*if (isset($_POST['update_cart']) && isset($_SESSION['cart'])) {
    // Loop through the post data to update the quantities for every product in the cart
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity-') !== false) {
            $id = str_replace('quantity-', '', $key);
            $quantity = (int) $value;
            // Validate the quantity and ensure it's not negative
            if ($quantity >= 0) {
                if ($quantity === 0) {
                    // If the quantity is set to 0, remove the product from the cart
                    unset($_SESSION['cart'][$id]);
                } else {
                    // Update the quantity for the product
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    }
    // Redirect back to the cart page to reflect the updated quantities
    // header('location: index.php?page=cart');
    header('location: cart.php');
    #exit;
}*/
?>

<?php
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
    <h1 class="text-center py-4 ">Shopping Cart</h1>
    <div class="row">
        <div class="col-12">
            <p><?php echo $cartMessage; ?></p>
        </div>
        <div class="col-12">
            <form action="cart.php" method="post">
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
                                    echo '<td>' . $product['name'] . '</td>'; // Corrected this line
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
                        <button type="submit" class="btn btn-primary" name="update_cart">Update Cart</button> 
                        <!--<input type="button" value="Update Cart" id="updateCart"> -->
                    </div>
                    <div class="col-3">
                        <p>Total: &pound;<?php echo $cartTotal; ?></p>
                    </div>
                </div>
                <div class="col-3">
                    <?php
                    // Check if cart is empty 
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) ) {
                        // Cart not empty, enable the Checkout Now button
                        echo '<a href="checkout.php?total=' . $cartTotal . '" class="btn btn-warning btn-block">Checkout Now</a>';
                    } else {
                        // User is not logged in, disable the Checkout Now button
                        echo '<button class="btn btn-warning btn-block" disabled>Checkout Now</button>';
                    }
                ?>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script>
// Event listener for the "Update" button to trigger a JavaScript function 
// that submits the form
//  document.getElementById('updateCart').addEventListener('click', function() {
//    // Submit the form when the button is clicked
//    console.log('Button clicked for cart update'); // debugging
//    document.querySelector('form').submit();
//  });
</script>
<?php
// Include the footer
include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>

</body>
<?php
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
if (isset($_POST['update_cart'])) {
    echo "update_cart";
    foreach($_POST['quantity'] as $key => $val) {
        if($val==0) {
            unset($_SESSION['cart'][$key]);
        }else{
            $_SESSION['cart'][$key]['quantity']=$val;
        }
    }
}
*/
?> 


</html>
