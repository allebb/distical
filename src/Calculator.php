<?php
namespace Ballen\Distical;

use Ballen\Distical\Entities\LatLong;
use Ballen\Distical\Entities\Distance;

/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two or more lat/long
 * co-ordinates.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/allebb/distical
 * @link http://bobbyallen.me
 *
 */
class Calculator
{

    /**
     * Stores the earth's mean radius, used by the calculate() method.
     */
    const MEAN_EARTH_RADIUS = 6372.797;

    /**
     * LatLon points to measure between.
     * @var Entities\LatLong[]
     */
    private $points;

    /**
     * The constructor
     * @param Entities\LatLong $pointA Optional initial point.
     * @param Entities\LatLong $pointB Optional final point.
     */
    public function __construct($pointA = null, $pointB = null)
    {
        if (($pointA instanceof LatLong) && ($pointB instanceof LatLong)) {
            $this->between($pointA, $pointB);
        }
    }

    /**
     * Adds a new lat/long co-ordinate to measure.
     * @param LatLong $point The LatLong co-ordinate object.
     * @param string $key Optional co-ordinate key (name).
     * @return \Ballen\Distical\Calculator
     */
    public function addPoint(LatLong $point, $key = null)
    {
        if (is_null($key)) {
            $this->points[] = $point;
            return $this;
        }
        $this->points[$key] = $point;
        return $this;
    }

    /**
     * Remove a lat/long co-ordinate from the points collection.
     * @param int|string $key The name or ID of the point key.
     * @throws \InvalidArgumentException
     * @return \Ballen\Distical\Calculator
     */
    public function removePoint($key = null)
    {
        if (isset($this->points[$key])) {
            unset($this->points[$key]);
            return $this;
        }
        throw new \InvalidArgumentException('The point key does not exist.');
    }

    /**
     * Helper method to get distance between two points.
     * @param LatLong $pointA Point A (eg. Departure point)
     * @param LatLong $pointB Point B (eg. Arrival point)
     * @return \Ballen\Distical\Calculator
     * @throws \RuntimeException
     */
    public function between(LatLong $pointA, LatLong $pointB)
    {
        if (!empty($this->points)) {
            throw new \RuntimeException('The between() method can only be called when it is the first set or co-ordinates.');
        }
        $this->addPoint($pointA);
        $this->addPoint($pointB);
        return $this;
    }

    /**
     * Calculates the distance between two lat/lng posistions.
     * @param LatLong $pointA Point A (eg. Departure point)
     * @param LatLong $pointB Point B (eg. Arrival point)
     * @return double
     */
    private function distanceBetweenPoints(LatLong $pointA, LatLong $pointB)
    {
        $pi180 = M_PI / 180;
        $latA = $pointA->lat() * $pi180;
        $lngA = $pointA->lng() * $pi180;
        $latB = $pointB->lat() * $pi180;
        $lngB = $pointB->lng() * $pi180;
        $dlat = $latB - $latA;
        $dlng = $lngB - $lngA;
        $calcA = sin($dlat / 2) * sin($dlat / 2) + cos($latA) * cos($latB) * sin($dlng / 2) * sin($dlng / 2);
        $calcB = 2 * atan2(sqrt($calcA), sqrt(1 - $calcA));
        return self::MEAN_EARTH_RADIUS * $calcB;
    }

    /**
     * Calculates the distance between each of the points.
     * @return double Distance in kilometres.
     */
    private function calculate()
    {
        if (count($this->points) < 2) {
            throw new \RuntimeException('There must be two or more points (co-ordinates) before a calculation can be performed.');
        }
        $total = 0;
        foreach ($this->points as $point) {
            if (isset($previous)) {
                $total += $this->distanceBetweenPoints($previous, $point);
            }
            $previous = $point;
        }
        return $total;
    }

    /**
     * Returns the total distance between the two lat/lng points.
     * @return Distance
     */
    public function get()
    {
        return new Distance($this->calculate());
    }
}
