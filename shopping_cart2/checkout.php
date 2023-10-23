<?php # DISPLAY CHECKOUT PAGE.

// Start or resume the session
session_start();

/*if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  // debugging
  echo "User ID: " . $_SESSION['user_id'];
  
} */

/*if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
  // debugging
  // Display the contents of the session cart array
  echo '<pre>';
  print_r($_SESSION['cart']);
  echo '</pre>';
} */

// Retrieve the total from the query parameter
if (isset($_GET['total'])) {
  $cartTotal = floatval($_GET['total']);
  #echo "$cartTotal";
  // Now you can use $cartTotal in your checkout.php file
} else {
  // Handle the case where total is not set
  echo "Total not provided.";
}
# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) )
{
  # Open database connection.
  require ('config/connect_db.php');
    
  # Store buyer and order total in 'orders' database table.
  $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";
  $r = mysqli_query ($link, $q);
  
  # Retrieve current order number.
  $order_id = mysqli_insert_id($link) ;

  #echo "Order ID: " . $order_id . "<br>";
  
  # Retrieve cart items from 'products' database table.
  $q = "SELECT * FROM products WHERE id IN (";
  #echo "q(1): " . $q . "<br>";

  $firstIteration = true;  // Initialize a flag for the first iteration
  foreach ($_SESSION['cart'] as $id => $value) {
    // Check if $id is valid
    if (!empty($id) && is_numeric($id)) {
        #echo "Id: " . $id . "<br>";
        if ($firstIteration) {
            $q .= $id;
            echo "q(2): " . $q . "<br>";
            $firstIteration = false;
        } else {
            $q .= ',' . $id;
        }
        #echo "q(3): " . $q . "<br>";
    }
  } 
  // Add the closing bracket
  $q .= ")";
  // Now $q should have the closing bracket
  echo "q(4): " . $q . "<br>";
  $r = mysqli_query ($link, $q);
  
  # Store order contents in 'order_content' database table.
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  { 
    $item_id = $row['id']; // Retrieve the item_id from the product table
    $quantity = $_SESSION['cart'][$item_id]['quantity'];
    $price = $row['price']; // Retrieve the price from the product table

    $query = "INSERT INTO order_content (order_id, item_id, quantity, price)
              VALUES ($order_id, $item_id, $quantity, $price)";
    
    $result = mysqli_query($link, $query);
    #=======================================================================
    #$query = "INSERT INTO order_content ( order_id, item_id, quantity, price )
    #VALUES ( $order_id, ".$row['id'].",".$_SESSION['cart'][$row['id']]['quantity'].",".[$row['id']]['price'].")" ;
    #$result = mysqli_query($link,$query);
  }
  
  # Close database connection.
  mysqli_close($link);

  # Display order number.
  echo "Thanks for your order. Your Order Number Is # ".$order_id."</p> ";

  # Remove cart items.  
  $_SESSION['cart'] = NULL ;
}
# Or display a message.
else 
#{ echo '<p>There are no items in your cart.</p> ' ; }
?>