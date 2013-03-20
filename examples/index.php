<?php

/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two lat/long
 * co-ordinates.
 *
 * @author bobbyallen.uk@gmail.com (Bobby Allen)
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl.html
 * @link https://github.com/bobsta63/distical
 *
 */
/**
 * ---- EXAMPLE LIBRARY USAGE ----
 */
require_once '../src/Distical/Calculator.php';

use Distical\Calculator;

#$points = array(
#    'a' => array('lat' => 52.055868, 'lon' => 1.161804), // Central Ipswich!
#    'b' => array('lat' => 51.888359, 'lon' => 0.892639) // Central Colchester!
#);

$points = array(
    'a' => array('lat' => 51.73441738801072, 'lon' => 0.4632282257080078), // Central Ipswich!
    'b' => array('lat' => 51.81259469696908, 'lon' => -0.8111858367919922) // Central Aylesbury!
);

$point_to_point = new Calculator($points); // Create a new instance of the class.
#$point_to_point->between($points); // Register the points (A to B etc!) as an alternative to passing it in with the class initiation string.

$point_to_point->asMiles(); // Calculate as 'miles' as opposed to 'km'.
$point_to_point->calculate(); // Calcluate the distance and store it ready to 'display()'!

echo "Total distance = " . $point_to_point->display() . " " . $point_to_point->unitOfMeasure() . "<br><br>";

/**
 * Lets checks if the total distance are greater than a defined distance.
 */
$check_distance = 10;

if ($point_to_point->checkGreaterThan($check_distance)) {
    echo $point_to_point->display() . $point_to_point->unitOfMeasure() . " is greater than " . $check_distance . " " . $point_to_point->unitOfMeasure();
} else {
    echo $point_to_point->display() . $point_to_point->unitOfMeasure() . " is less than " . $check_distance . " " . $point_to_point->unitOfMeasure();
}
