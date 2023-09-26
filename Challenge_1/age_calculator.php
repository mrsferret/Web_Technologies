<?php
//Age Calculator

$age = 25;
$days = $age * 365;
$hours = $days * 24;
$min = $hours * 60;

echo "<h1>Age Calculator</h1>
  <h2>Your age: $age </h2>
  <h2> You have been alive for:</h2>
<ul> 
  <li>$days days</li>
  <li>$hours hours</li>
  <li>$min minutes</li>
<ul>";
?>