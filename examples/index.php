<?php

/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two lat/long
 * co-ordinates.
 *
 * @author bobbyallen.uk@gmail.com (Bobby Allen)
 * @version 1.1.0
 * @license http://www.gnu.org/licenses/gpl.html
 * @link https://github.com/bobsta63/distical
 *
 */
/**
 * ---- EXAMPLE LIBRARY USAGE ----
 */
require_once '../src/Distical/Calculator.php';

use Distical\Calculator;

$points = array(
    'a' => array('lat' => 51.73441738801072, 'lon' => 0.4632282257080078), // Central Ipswich!
    'b' => array('lat' => 51.81259469696908, 'lon' => -0.8111858367919922) // Central Aylesbury!
);

echo '<h1>Distical examples</h1>';

echo '<h2>Object instansiation with constructor co-ordinates:</h2>';
$point_to_point = new Calculator($points); // Create a new instance of the class.
#$point_to_point->between($points); // Register the points (A to B etc!) as an alternative to passing it in with the class initiation string.

$point_to_point->asMiles(); // Calculate as 'miles' as opposed to 'km'.
$point_to_point->calculate(); // Calcluate the distance and store it ready to 'display()'!

echo 'Total distance between Ipswich, Suffolk and Aylesbury in Buckinghamshire is: ' . $point_to_point->display() . ' ' . $point_to_point->unitOfMeasure() . '.<br /><br />';

echo '<h2>Method chaining example:</h2>';
$points_ipswich_colchester = array(
    'a' => array('lat' => 52.055868, 'lon' => 1.161804), // Central Ipswich!
    'b' => array('lat' => 51.888359, 'lon' => 0.892639) // Central Colchester!
);

$point_to_point2 = new Calculator;
// Since v1.1.0, You can also do method chaining too like so...
echo 'Distance from Ipswich to Colchester is: ' .$point_to_point2->between($points_ipswich_colchester)->asMiles()->calculate()->display().' ' .$point_to_point2->unitOfMeasure(). '<br /><br />';

echo '<h2>Simple logic and rounding on distance calculations:</h2>';
/**
 * Lets checks if the total distance are greater than a defined distance.
 */
$check_distance = 10;

if ($point_to_point2->checkGreaterThan($check_distance)) {
    echo ceil($point_to_point2->display()) . ' ' . $point_to_point2->unitOfMeasure() . ' is greater than ' . $check_distance . " " . $point_to_point2->unitOfMeasure();
} else {
    echo ceil($point_to_point2->display()) . ' ' . $point_to_point2->unitOfMeasure() . ' is less than ' . $check_distance . " " . $point_to_point2->unitOfMeasure();
}
