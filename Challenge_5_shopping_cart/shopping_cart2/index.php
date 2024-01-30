<?php
// start or resume session
session_start();
// For debugging - Display the contents of the session
#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
if(array_key_exists('user_id',$_SESSION) && !empty($_SESSION['user_id'])) {
    // we must have come here after successful login (login.php)
    // so we want to keep this session
    #echo 'Set and not empty, and no undefined index error!';
}else {
    # we have not come here from successful login so we don't
    # want the SESSION to start yet until they have logged in successfully
    #header("Location: destroy_session.php");
    # Get connection, load, and validate functions.
    require ( 'destroy_session.php' ) ;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <title>My SHopping Cart App</title>
  </head>
<body>
    <?php include('includes/header.php'); ?>

    <!-- Hero -->
    <!--
    <div class="p-5 text-center bg-image rounded-3" style="
        background-image: url('/images/Lovely_AI_flower_pattern.png');
        height: 400px;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3">Heading</h1>
                    <h4 class="mb-3">Subheading</h4>
                    
                </div>
            </div>
        </div>
    </div> -->
    <!-- Hero -->
    <!-- Hero -->
    <div class="bg-image d-flex justify-content-center align-items-center" style="background-image: url('images/Lovely_AI_flower_pattern.png'); background-size: cover; background-position: center center; height: 600px;">
        <div class="p-5 text-white justify-content-center align-items-center text-center ">
            <h1>Dogs with Hats</h2>
            <h2>Essential Gadgets for the Discerning Canine</h4>
        </div>
    </div>
<!-- Hero -->
    <!-- Hero -->
    <!-- <div class="bg" style="background-image: url('images/Lovely_AI_flower_pattern.png');">
        <div class="p-5 text-white rounded-3">
            <h2>Hero Section</h2>
            <h4>It's easy to set a background image with Torus Kit</h4>
        </div>
    </div> -->
    <!-- Hero -->
    <!-- Hero -->
    <!-- <div class="has-bg-img p-5 rounded-3">
        <h2>Hero Section</h2>
        <h4>It's easy to set background image with Torus Kit</h4>
        <img class="bg-img" src="images/Lovely_AI_flower_pattern.png" alt="">
    </div> -->

    <!-- Hero -->

    <div class="container mt-5">
        <h2>Recent Products</h2>
        <div class="row">
            <?php
            // Include your database connection code here
            include('config/connect_db.php');

            // Fetch the 4 most recent products from the database
            $query = "SELECT * FROM products ORDER BY date_added DESC LIMIT 4";
            $result = mysqli_query($link, $query);

            // Check if there are any products
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Display product information
                    echo '<div class="col-md-3 mb-3">';
                    echo '<div class="card">';
                    echo '<img src="images/' . $row['img'] . '" class="card-img-top" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">£' . $row['price'] . '</p>';
                    echo '<a href="product.php?id=' . $row['id'] . '" class="btn btn-primary">View Product</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No recent products available.</p>';
            }

            // Close the database connection
            mysqli_close($link);
            ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
