<?php
//======================================================================================================
// EXAMPLE only(not working)
//Add To Cart - Session
// Create a PHP script to connect to the MySQL database and fetch product information.
//
// Implement the "Add to Cart" functionality using PHP sessions:
//
// When a user clicks the "Add to Cart" button, add the product to the user's cart stored in the session.
// Update the cart summary section to reflect the updated cart contents.
// use php sessions to manage user data and shopping cart information
//======================================================================================================
# Remember to add Session 
# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ; 

# Rememer to open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'products' database table. 
$q = "SELECT * FROM products WHERE item_id = $id" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

  # Check if cart already contains one of this product id.
  if ( isset( $_SESSION['cart'][$id] ) )
  { 
    # Add one more of this product.
    $_SESSION['cart'][$id]['quantity']++; 
    echo '<p>Another '.$row["item_name"].' has been added to your cart</p>
			<a href="home.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
		 ';
  } 
  else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
    echo '<p>A '.$row["item_name"].' has been added to your cart</p>
		  <a href="home.php">Continue Shopping</a> | <a href="cart.php">View Your Cart</a>
			' ;
  }
}

# Close database connection.
mysqli_close($link);

?> 