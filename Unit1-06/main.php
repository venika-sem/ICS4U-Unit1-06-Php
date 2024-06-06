<?php
/**
 * This program finds the mean and median of an array of numbers.
 * By Venika Sem
 * @version 1.0
 * @since Feb-2024
 */

// Check if file path is provided
if ($argc < 2) {
    echo "Usage: php " . basename(__FILE__) . " <file_path>\n";
    exit(1);
}

$filePath = $argv[1];

// Check if file exists
if (!file_exists($filePath)) {
    echo "File not found: $filePath\n";
    exit(1);
}

// Read file and split contents into array
$fileContents = file_get_contents($filePath);
$array = array_map('intval', explode("\n", trim($fileContents))); // Convert string to int

// Error check
$errorPassed = true;
foreach ($array as $value) {
    if (!is_numeric($value)) {
        echo "Array contains a non-numeric value.\n";
        $errorPassed = false;
        break;
    }
}

if ($errorPassed) {
    // Find mean and median
    echo "Current array: " . implode(', ', $array) . "\n\n";
    $mean = findMean($array);
    $median = findMedian($array);
    echo "The mean is $mean\n";
    echo "The median is $median\n";
}

// Show the program as done
echo "\nDone.\n";

// Finds the mean of an array of numbers
function findMean($list) {
    $sumOfNumbers = 0;
    foreach ($list as $value) {
        $sumOfNumbers += $value;
    }
    $mean = $sumOfNumbers / count($list);
    return $mean;
}

// Finds the median of an array of numbers
function findMedian($list) {
    sort($list);
    $halfLength = count($list) / 2;
    $remainder = $halfLength % 1;
    $median = 0;
    if ($remainder != 0) {
        $median = $list[$halfLength - 0.5];
    } else {
        $median = ($list[$halfLength - 1] + $list[$halfLength]) / 2;
    }
    return $median;
}
?>
