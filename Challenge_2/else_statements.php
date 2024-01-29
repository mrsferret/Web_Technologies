<?php
// exercise using if/else statements

// Set the value of $age
$age = 25;

// Check the age group and display a message
if ($age < 13) {
    echo "You are a child.";
} elseif ($age >= 13 && $age <= 17) {
    echo "You are a teenager.";
} elseif ($age >= 18 && $age <= 64) {
    echo "You are an adult.";
} else {
    echo "You are a senior citizen.";
}
?>
