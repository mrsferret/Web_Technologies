<?php
// Include the database connection file
require_once 'config\connect_db.php';

// Define the number of products to display per page and the number of columns
$productsPerPage = 4;
$columns = 4;

// Get the current page number from the query string
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $productsPerPage;

// Query to retrieve products with pagination
$sql = "SELECT * FROM products LIMIT $productsPerPage OFFSET $offset";
$result = mysqli_query($link, $sql);

// Check if there are products to display
if ($result && mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Free the result set
    mysqli_free_result($result);
} else {
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>

    <!-- Add Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Optional: Include Bootstrap's JavaScript and Popper.js for components that require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php
// Include the header
include 'includes\header.php';
?>

<div class="container">
    <h1 class="py-4 text-center">Products</h1>
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-<?php echo 12 / $columns; ?>">
                <div class="card">
                    <img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text">Price: &pound;<?= $product['price'] ?></p>
                        <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Pagination: Calculate the number of pages and generate page links
$sql = "SELECT COUNT(*) as total FROM products";
$result = mysqli_query($link, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total'];
    mysqli_free_result($result);
}

$totalPages = ceil($totalProducts / $productsPerPage);

echo '<div class="container">';
echo '<div class="row justify-content-end mt-3">';
if ($currentPage > 1) {
    echo '<a href="products.php?page=' . ($currentPage - 1) . '" class="btn btn-primary" p-2>Previous</a>';
}
if ($currentPage < $totalPages) {
    echo '<a href="products.php?page=' . ($currentPage + 1) . '" class="btn btn-primary p-2">Next</a>';
}
echo '</div>';
echo '</div>';

// Include the footer
include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>

</body>
</html>
