<?php
/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two or more lat/long
 * co-ordinates.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @version 2.0.0
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/bobsta63/distical
 * @link http://www.bobbyallen.me
 *
 */
require_once '../src/Calculator.php';
require_once '../src/Distance.php';
use Ballen\Distical\Calculator;

$points = array(
    'a' => array('lat' => 51.73441738801072, 'lon' => 0.4632282257080078), // Central Ipswich!
    'b' => array('lat' => 51.81259469696908, 'lon' => -0.8111858367919922) // Central Aylesbury!
);

echo '<h1>Distical examples</h1>';

echo '<h2>Object instansiation with constructor co-ordinates:</h2>';
$point_to_point = new Calculator($points); // Create a new instance of the class.
#$point_to_point->between($points); // Register the points (A to B etc!) as an alternative to passing it in with the class initiation string.
echo '<p>Total distance between Ipswich, Suffolk and Aylesbury in Buckinghamshire is ' . $point_to_point->get() . ' kilometres.</p>';

echo '<h2>Method chaining example:</h2>';
$points_ipswich_colchester = array(
    'a' => array('lat' => 52.055868, 'lon' => 1.161804), // Central Ipswich!
    'b' => array('lat' => 51.888359, 'lon' => 0.892639) // Central Colchester!
);

$point_to_point2 = new Calculator;
echo 'Distance from Ipswich to Colchester is: ' . $point_to_point2->between($points_ipswich_colchester)->get()->asMiles() . ' miles (or ' . $point_to_point2->between($points_ipswich_colchester)->get()->asKilometres() . 'km).<br /><br />';
