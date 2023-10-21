// Example checkout.php

<?php # DISPLAY CHECKOUT PAGE.
// ======================================================================================
// EXAMPLE only - NOT WORKING
// Store orders in 'orders' and 'order_conten't tables
// When a user proceeds to checkout, retrieve their cart contents (stored in a PHP session).
// Insert a new row into the 'orders' table with the user's information (user_id), the calculated total 
// amount and order_date.
// Insert a new row into the 'order_content' table with order_id, item_id, quantity and price.
// ======================================================================================

# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) )
{
  # Open database connection.
  require ('connect_db.php');
  
  # Store buyer and order total in 'orders' database table.
  $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";
  $r = mysqli_query ($link, $q);
  
  # Retrieve current order number.
  $order_id = mysqli_insert_id($link) ;
  
  # Retrieve cart items from 'products' database table.
  $q = "SELECT * FROM products WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($link, $q);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
    VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($link,$query);
  }