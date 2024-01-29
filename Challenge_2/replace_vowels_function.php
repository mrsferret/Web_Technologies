<?php
//=====================================================================================
// Function that takes in a string as an argument and returns the string with 
// all vowels replaced with the character "x".
//=====================================================================================
function replaceVowelsWithX($str) {
    // Define an array of vowels (both lowercase and uppercase)
    $vowels = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');

    // Use str_replace to replace all vowels with "x" in the given string
    $modifiedStr = str_replace($vowels, 'x', $str);

    // Return the modified string
    return $modifiedStr;
}

// Example usage
$inputString = "Hello, World!";
$modifiedString = replaceVowelsWithX($inputString);

// Output the modified string
echo "Original String: $inputString<br>";
echo "Modified String: $modifiedString";
?>
