<?php

function getAvgVal($str, $line_num, $line) {
   $pos = strpos($str,'-');
   if (!$pos) {
      $num1 = $line_num + 1; //start counting lines at 1
      die ("- is missing in line $num1: " . htmlspecialchars($line) . "<br>No output file generated");
   }
   $val1 = substr($str,0,$pos);
   $val2 = substr($str,$pos+1);
   $val1 = str_replace(' ', '', $val1);
   $val2 = str_replace(' ', '', $val2);
   if (!is_numeric($val1) or !is_numeric($val2)) {
      $num1 = $line_num + 1;
      die ("Line number $num1 does not contain two valid numbers");
   }
   return ($val1+$val2)/2;
};

//read input file into an array, each element corresponds to a line
//empty lines are skipped (don't return an error)
$inputfile = "input.txt";
if(!file_exists($inputfile)) {
   die("File $inputfile not found.<br>No output file generated.");
 } else {
   $read = file($inputfile, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
 }

// 1. Put the lines in an associative array
foreach ($read as $line_num => $line) {
   $pos = strpos($line, ';');
   if (!$pos) {
      $num1 = $line_num + 1; //start counting lines at 1
      die("; is missing in line $num1: " . htmlspecialchars($line) . "<br>No output file generated.");
   }
   $key = substr($line, 0, $pos);
   $value = substr($line, $pos+1);
   $value = getAvgVal($value, $line_num, $line);
   $elem[$key] = $value;
 }

// 2. Sort the array on the values
asort($elem);

// 3. Put the sorted array in a new file called 'output.txt'
$myfile = fopen("output.txt", "w");
foreach ($elem as $key=>$value) {
   $txt = $key."; ".$value."\n";
   fwrite($myfile,$txt);
}
fclose($myfile);

?>