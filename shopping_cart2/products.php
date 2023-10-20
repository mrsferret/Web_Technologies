<?php
// Include the database connection file
require_once 'config/connect_db.php';

// Define the number of products to display per page
$productsPerPage = 4;

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

// Include the header
include 'includes\header.php';
?>

<div class="container">
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text">Price: &pound;<?= $product['price'] ?></p>
                        <p class="card-text"><?= $product['desc'] ?></p>
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
echo '<div class="row justify-content-center">';
if ($currentPage > 1) {
    echo '<a href="products.php?page=' . ($currentPage - 1) . '" class="btn btn-primary">Previous</a>';
}
if ($currentPage < $totalPages) {
    echo '<a href="products.php?page=' . ($currentPage + 1) . '" class="btn btn-primary">Next</a>';
}
echo '</div>';
echo '</div>';

// Include the footer
include 'includes\footer.php';

// Close the database connection
mysqli_close($link);
?>
