<?php
/**
 * Calculate the total price.
 * @param array $items An array of items with 'name' and 'price' keys.
 * @return float The total price of all items in the cart.
 */
function calculateTotalPrice(array $items): float
{
    $total = 0; // Initialize total price
    foreach ($items as $item) {
        $total += $item['price']; // Add each item's price to total
    }
    return $total; // Return the calculated total price
}
/**
 * Perform a series of string manipulations.
 * @param string $string The input string to manipulate.
 * @return string The modified string.
 */
function manipulateString(string $string): string
{
    $string = str_replace(' ', '', $string); // Remove spaces from the string
    $string = strtolower($string); // Convert the string to lowercase
    return $string; // Return the modified string
}


/**
 * Check if a number is even or odd.
 * @param int $number The number to check.
 * @return string A string indicating if the number is even or odd.
 */

function isEvenOrOdd(int $number): string
{
    if ($number % 2 === 0) {
        return "The number {$number} is even."; /* Return if number is even*/
    } else {
        return "The number {$number} is odd."; // Return if number is odd
    }
}


$items = [
    ['name' => 'Widget A', 'price' => 10], // Define items with their names and prices
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$total = calculateTotalPrice($items); // Calculate total price of items
echo "Total price: {$total}\n"; // Display the total price
echo "<br>";

$string = "This is a poorly written program with little structure and readability.";
$modifiedString = manipulateString($string); // Manipulate the given string
echo "Modified string: {$modifiedString}\n"; // Display the modified string
echo "<br>";

$number = 11; // Define a number to check if it is even or odd
$evenOrOdd = isEvenOrOdd($number); // Check if the number is even or odd
echo "{$evenOrOdd}\n"; // Display if the number is even or odd