<?php
//read file into an array, each element corresponds to a line
$read = file('input.txt');

// 1. Put the lines in an associative array
foreach ($read as $line) {
   $pos = strpos($line, ',');
   $key = substr($line, 0, $pos);
   $value = substr($line, $pos+1);
   $elem[$key] = $value;
 }

// 2. Sort the array on the values
// 3. Put the sorted array in a new file called 'output.txt'
