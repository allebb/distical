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
$centralIpswich = new LatLong(51.73441738801072, 0.4632282257080078); // Central Ipswich co-ordinates!
$centralAylesbury = new LatLong(51.81259469696908, -0.8111858367919922); // Central Aylesbury co-ordinates!
$centralColchester = new LatLong(51.888359, 0.892639); // Central Colchester co-ordinates!

echo '<h1>Distical examples</h1>';

echo '<h2>Object instantiation with constructor coordinates:</h2>';

// Create a new instance of the class passing in two coordinates (LatLong objects)
$pointToPointCalculator = new Calculator($centralIpswich, $centralAylesbury);

// Calculate the distance and return in both kilometre and miles...
$km = $pointToPointCalculator->get()->asKilometres();
$miles = $pointToPointCalculator->get()->asMiles();

// Output the distance calculation in summary:
echo "<p>Total distance between Ipswich and Aylesbury is  {$km}km (or {$miles} miles).</p>";


echo '<h2>Getting distance conversion for multiple points:</h2>';
// Create an instance of the Calculator
$multiPointCalculator = new Calculator;

$distance = $multiPointCalculator->between($centralColchester, $centralIpswich) // Add our initial two coordinates...
    ->addPoint($centralAylesbury) // We can now chain on a third (forth, fifth etc).
    ->get(); // Calculate the whole distance once only (chaining would calculate multiple times!)

// Output the distance in summary:
echo "<p>Distance from Colchester to Ipswich and then straight on to Aylesbury is:  " . $distance->asKilometres(). "km (or " . $distance->asMiles() . " miles).</p>";
