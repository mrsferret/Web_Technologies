<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your meta tags, styles, and Bootstrap links here -->
    <title>Home</title>
</head>
<body>
    <?php include('includes/header.php'); ?>

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
                    echo '<p class="card-text">$' . $row['price'] . '</p>';
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
