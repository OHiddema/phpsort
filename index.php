<?php
//read file into an array, each element corresponds to a line
$read = file('input.txt');

// 1. Put the lines in an associative array
foreach ($read as $line) {
   $pos = strpos($line, ';');
   $key = substr($line, 0, $pos);
   $value = substr($line, $pos+1);
   // remove spaces
   $value = str_replace(' ', '', $value);
   // explicitly convert to value
   $value = (int)$value;
   $elem[$key] = $value;
 }

// 2. Sort the array on the values
arsort($elem);

// 3. Put the sorted array in a new file called 'output.txt'
$myfile = fopen("output.txt", "w");
foreach ($elem as $key=>$value) {
   $txt = $key.','.$value;
   fwrite($myfile,$txt);
}
fclose($myfile);