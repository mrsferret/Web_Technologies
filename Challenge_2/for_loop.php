<!--A PHP program to display the multiplication table of a given number, input 
by the user using a FOR loop. 
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
    </style>
</head>
<body>

<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $number = isset($_POST['number']) ? $_POST['number'] : 0;

    // Display the multiplication table
    echo "<h2>Multiplication table of $number:</h2>";

    // display the result on screen
    for ($i = 1; $i <= 10; $i++) {
        $result = $number * $i;
        echo "$number x $i = $result<br>";
    }
}
?>

<!-- htmlspecialchars($_SERVER["PHP_SELF"]) - this PHP code is used to retrieve the current 
    script's filename and escape any special characters in it to prevent potential security issues 
    such as cross-site scripting (XSS) attacks. -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="number">Enter a number:</label>
    <input type="number" name="number" required>
    <button type="submit">Generate Table</button>
</form>

</body>
</html>
