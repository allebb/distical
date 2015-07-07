<?php namespace Ballen\Distical;

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
 * @version 2.0.0
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/bobsta63/distical
 * @link http://www.bobbyallen.me
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
     * @var array
     */
    private $points;

    /**
     * The constructor
     * @param \Ballen\Distical\LatLong $point_a Optional initial point.
     * @param \Ballen\Distical\LatLong $point_b Optional final point.
     */
    public function __construct($point_a = null, $point_b = null)
    {
        if (($point_a instanceof LatLong) && ($point_b instanceof LatLong)) {
            $this->between($point_a, $point_b);
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
        if (!is_null($key)) {
            $this->points[$key] = $point;
        } else {
            $this->points[] = $point;
        }
        return $this;
    }

    /**
     * Remove a lat/long co-ordinate from the points collection.
     * @param int|string $key The name or ID of the point key.
     * @throws InvalidArgumentException
     * @return \Ballen\Distical\Calculator
     */
    public function removePoint($key = null)
    {
        if (isset($this->points[$key])) {
            unset($this->points[$key]);
        } else {
            throw new \InvalidArgumentException('The point key does not exist.');
        }
        return $this;
    }

    /**
     * Helper method to get distance between two points.
     * @param LatLong $point_a Point A (eg. Departure point)
     * @param LatLong $point_b Point B (eg. Arrival point)
     * @return \Ballen\Distical\Calculator
     * @throws \RuntimeException
     */
    public function between(LatLong $point_a, LatLong $point_b)
    {
        if (!empty($this->points)) {
            throw new \RuntimeException('The between() method can only be called when it is the first set or co-ordinates.');
        }
        $this->addPoint($point_a);
        $this->addPoint($point_b);
        return $this;
    }

    /**
     * Calculates the distance between two lat/lng posistions.
     * @param LatLong $point_a Point A (eg. Departure point)
     * @param LatLong $point_b Point B (eg. Arrival point)
     * @return double
     */
    private function distanceBetweenPoints(LatLong $point_a, LatLong $point_b)
    {
        $pi180 = M_PI / 180;
        $lat_a = $point_a->lat() * $pi180;
        $lng_a = $point_a->lng() * $pi180;
        $lat_b = $point_b->lat() * $pi180;
        $lng_b = $point_b->lng() * $pi180;
        $dlat = $lat_b - $lat_a;
        $dlng = $lng_b - $lng_a;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat_a) * cos($lat_b) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return self::MEAN_EARTH_RADIUS * $c;
    }

    /**
     * Calculates the disatance between each of the points.
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
