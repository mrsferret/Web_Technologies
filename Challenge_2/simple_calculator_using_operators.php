<!--  A simple calculator that takes two numbers as input and performs basic arithmetic operations on them using PHP operators. 
The program displays the results of each operation. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Function to perform the selected operation
function calculateResult($num1, $num2, $operator) {
    switch ($operator) {
        case '+':
            return $num1 + $num2;
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2;
        case '/':
            // Check if the denominator is not zero
            if ($num2 != 0) {
                return $num1 / $num2;
            } else {
                return "Cannot divide by zero";
            }
        default:
            return "Invalid operator";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    // Calculate the result
    $result = calculateResult($num1, $num2, $operator);
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="num1">Enter Number 1:</label>
    <input type="number" name="num1" required>

    <label for="num2">Enter Number 2:</label>
    <input type="number" name="num2" required>

    <label for="operator">Select Operation:</label>
    <select name="operator" required>
        <option value="+">Addition (+)</option>
        <option value="-">Subtraction (-)</option>
        <option value="*">Multiplication (*)</option>
        <option value="/">Division (/)</option>
    </select>

    <button type="submit">Calculate</button>
</form>

<?php
// Display the result if it is set
if (isset($result)) {
    echo "<h2>Result:</h2>";
    echo "<p>$num1 $operator $num2 = $result</p>";
}
?>

</body>
</html>
