<?php namespace Ballen\Distical;

use Ballen\Distical\Entities\LatLong as LatLong;

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
     * @param \Ballen\Distical\LatLong $a Optional initial point.
     * @param \Ballen\Distical\LatLong $b Optional final point.
     */
    public function __construct($a = null, $b = null)
    {
        if (( $a instanceof LatLong) and ( $b instanceof LatLong)) {
            $this->between($a, $b);
        }
    }

    /**
     * Adds a new lat/long co-ordinate to measure.
     * @param \Ballen\Distical\LatLong $point
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
     * @param LatLong $a Point A (eg. Departure point)
     * @param LatLong $b Point B (eg. Arrival point)
     * @return \Ballen\Distical\Calculator
     * @throws \RuntimeException
     */
    public function between(LatLong $a, LatLong $b)
    {
        if (!empty($this->points)) {
            throw new \RuntimeException('The between() method can only be called when it is the first set or co-ordinates.');
        }
        $this->addPoint($a);
        $this->addPoint($b);
        return $this;
    }

    /**
     * Calculates the disatance between each of the points.
     * @return integer Distance in kilometres.
     */
    private function calculate()
    {
        if (count($this->points) < 2) {
            throw new \RuntimeException('There must be two or more points (co-ordinates) before a calculation can be performed.');
        }
        $pi180 = M_PI / 180;
        $i = 0;
        $total = 0;
        $previous = null;
        foreach ($this->points as $point) {
            $i++;
            if ($i > 1) {
                $lat_a = $previous->lat() * $pi180;
                $lng_a = $previous->lng() * $pi180;
                $lat_b = $point->lat() * $pi180;
                $lng_b = $point->lng() * $pi180;
                $dlat = $lat_b - $lat_a;
                $dlng = $lng_b - $lng_a;
                $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat_a) * cos($lat_b) * sin($dlng / 2) * sin($dlng / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $total = $total + (self::MEAN_EARTH_RADIUS * $c);
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
