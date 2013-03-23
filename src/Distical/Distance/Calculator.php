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

namespace Distical\Distance;

class Calculator
{
    /**
     * Stores the earth's mean radius, used by the calculate() method.
     */

    const MEAN_EARTH_RADIUS = 6372.797;

    /**
     * Stores the format to report distance on.
     * @var string Format prefix (valid options are 'm' for miles or 'k' for kilometres)
     */
    private $format;

    /**
     * The human readable measure of distance.
     * @var string Human readable format, eg. 'Miles' or 'Kilometres'.
     */
    private $human_format;

    /**
     * Object variable storage for point 'A'
     * @var object Key pair values (lat and lon).
     */
    private $a;

    /**
     * Object variable storage for point 'B'
     * @var object Key pair values (lat and lon).
     */
    private $b;

    /**
     * Object variable storage for the result of the distance converion.
     * @var decimal The total distance between points 'A' and 'B' after running 'calculate()'.
     */
    private $total = 0.0;

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
     * Setter to register lat/long points for 'A' and 'B'.
     * @param array $points_array A multi-dimensional array of 'A' and 'B' point lat/long values.
     */
    public function between($points_array)
    {
        $points_object = json_decode(json_encode($points_array));
        $this->a = $points_object->a;
        $this->b = $points_object->b;

        return $this;
    }

    /**
     * Change the format for results to 'Miles'
     */
    public function asMiles()
    {
        $this->human_format = 'miles';
        $this->format = 'm';

        return $this;
    }

    /**
     * Change the format for results to 'Kilometres'
     */
    public function asKilometres()
    {
        $this->human_format = 'kilometres';
        $this->format = 'k';

        return $this;
    }

    /**
     * Display the huamn readable format.
     * @return string The human readable format as a string.
     */
    public function unitOfMeasure()
    {
        return $this->human_format;
    }

    /**
     * Does the actual calculation between the two lat/long points.
     */
    public function calculate()
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
        $this->total = self::MEAN_EARTH_RADIUS * $c;

        return $this;
    }

    /**
     * A helper method to check if the calculated distance is greater than a
     * specfied distance.
     * @param  int     $distance The distance to check against.
     * @return boolean
     */
    public function checkGreaterThan($distance)
    {
        if ($this->total > $distance)
            return true;
        return false;
    }

    /**
     * Returns the total distance between the two lat/lng points.
     * @return decimal The total distance between both points.
     */
    public function display()
    {
        switch ($this->format) {
            case 'm':
                $out_total = $this->total * 0.621371192;
                break;
            case 'k':
                $out_total = $this->total;
                break;
        }

        return $out_total;
    }

}
