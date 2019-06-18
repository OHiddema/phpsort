<?php

function getAvgVal($str, $line) {
   $pos = strpos($str,'-');
   if (!$pos) {
      die ("- is missing in: " . htmlspecialchars($line) . "<br>No output file generated");
   }
   $val1 = substr($str,0,$pos);
   $val2 = substr($str,$pos+1);
   $val1 = (int)$val1;
   $val2 = (int)$val2;
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
foreach ($read as $line) {
   $pos = strpos($line, ';');
   if (!$pos) {
      die("; is missing in: " . htmlspecialchars($line) . "<br>No output file generated.");
   }
   $key = substr($line, 0, $pos);
   $value = substr($line, $pos+1);
   $value = getAvgVal($value, $line);
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