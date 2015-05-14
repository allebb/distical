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
require_once '../src/Distical.inc.php';
use Ballen\Distical\Calculator;
use Ballen\Distical\Entities\LatLong;

// Define some co-ordinates...
$central_ipswich = new LatLong(51.73441738801072, 0.4632282257080078); // Central Ipswich co-ordinates!
$central_aylesbury = new LatLong(51.81259469696908, -0.8111858367919922); // Central Aylesbury co-ordinates!
$central_colchester = new LatLong(51.888359, 0.892639); // Central Colchester co-ordinates!

echo '<h1>Distical examples</h1>';
echo '<h2>Object instansiation with constructor co-ordinates:</h2>';
$point_to_point = new Calculator($central_ipswich, $central_aylesbury); // Create a new instance of the class.
echo '<p>Total distance between Ipswich and Aylesbury is ' . $point_to_point->get() . 'km (or ' . $point_to_point->get()->asMiles() . ').</p>';

echo '<h2>Getting distance conversion for multiple points:</h2>';
$multi_point_distance = new Calculator;
$distance = $multi_point_distance->between($central_colchester, $central_ipswich)->addPoint($central_aylesbury)->get();
echo 'Distance from Colchester to Ipswich and then streight on to Aylesbury is: ' . $distance->asKilometres() . 'km (or ' . $distance->asMiles() . ' miles).<br /><br />';
