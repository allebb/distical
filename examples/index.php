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
require_once '../src/Entities/LatLong.php';
use Ballen\Distical\Calculator;
use Ballen\Distical\Entities\LatLong;

$central_ipswich = new LatLong(51.73441738801072, 0.4632282257080078); // Central Ipswich co-ordinates!
$central_aylesbury = new LatLong(51.81259469696908, -0.8111858367919922); // Central Aylesbury co-ordinates!

echo '<h1>Distical examples</h1>';

echo '<h2>Object instansiation with constructor co-ordinates:</h2>';
$point_to_point = new Calculator($central_ipswich, $central_aylesbury); // Create a new instance of the class.
echo '<p>Total distance between Ipswich, Suffolk and Aylesbury in Buckinghamshire is ' . $point_to_point->get() . ' kilometres.</p>';

echo '<h2>Getting distance conversions:</h2>';
$central_colchester = new LatLong(51.888359, 0.892639); // Central Colchester co-ordinates!

$point_to_point2 = new Calculator;
$distance = $point_to_point2->between($central_ipswich, $central_colchester)->get();
echo 'Distance from Ipswich to Colchester is: ' . $distance->asMiles() . ' miles (or ' . $distance->asKilometres() . 'km).<br /><br />';
