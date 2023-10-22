<?php # DISPLAY CHECKOUT PAGE.

// Start or resume the session
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  // debugging
  echo "User ID: " . $_SESSION['user_id'];
  
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
  // debugging
  // Display the contents of the session cart array
  echo '<pre>';
  print_r($_SESSION['cart']);
  echo '</pre>';
}



// Retrieve the total from the query parameter
if (isset($_GET['total'])) {
  $cartTotal = floatval($_GET['total']);
  echo "$cartTotal";
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
  
  # Retrieve cart items from 'products' database table.
  $q = "SELECT * FROM products WHERE id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY id ASC';
  $r = mysqli_query ($link, $q);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_content ( order_id, item_id, quantity, price )
    VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($link,$query);
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