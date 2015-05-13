<?php namespace Ballen\Distical;

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
     * @param array $points_array Optional inital points array.
     */
    public function __construct($points_array = null)
    {
        if ($points_array != null) {
            $this->between($points_array);
        } else {
            $this->between(array(
                'a' => array('lat' => 0, 'lon' => 0),
                'b' => array('lat' => 0, 'lon' => 0),
            ));
        }
    }

    /**
     * Adds a new lat/long co-ordinate to measure.
     * @param \Ballen\Distical\LatLong $point
     * @param string $key Optional co-ordinate key (name).
     */
    public function addPoint(LatLong $point, $key = null)
    {
        if (!is_null($key)) {
            $this->points[$key] = $point;
        } else {
            $this->points[] = $point;
        }
    }

    /**
     * Remove a lat/long co-ordinate from the points collection.
     * @param int|string $key The name or ID of the point key.
     * @throws \InvalidArgumentException
     */
    public function removePoint($key = null)
    {
        if (isset($this->points[$key])) {
            unset($this->points[$key]);
        } else {
            throw new \InvalidArgumentException('The point key does not exist.');
        }
    }

    /**
     * Setter to register lat/long points for 'A' and 'B'.
     * @param array $points_array Lat/Lng points to measure between as an array.
     * @return \Ballen\Distical\Calculator
     */
    public function between($points_array)
    {
        $points_object = json_decode(json_encode($points_array));
        $this->a = $points_object->a;
        $this->b = $points_object->b;
        return $this;
    }

    /**
     * Calculates the disatance between each of the points.
     * @return integer Distance in kilometres.
     */
    private function calculate()
    {
        $pi80 = M_PI / 180;
        $this->a->lat *= $pi80;
        $this->a->lon *= $pi80;
        $this->b->lat *= $pi80;
        $this->b->lon *= $pi80;
        $dlat = $this->b->lat - $this->a->lat;
        $dlng = $this->b->lon - $this->a->lon;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($this->a->lat) * cos($this->b->lat) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return self::MEAN_EARTH_RADIUS * $c;
    }

    /**
     * Returns the total distance between the two lat/lng points.
     * @return \Ballen\Distical\Distance
     */
    public function get()
    {
        return new Distance($this->calculate());
    }
}
