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
class Distance
{

    /**
     * The distance in kilometres
     */
    private $kilometres;

    /**
     * Class constructor
     * @param integer|float|decimal $kilometres The distance in kilometres.
     */
    public function __construct($kilometres = 0)
    {
        $this->validateDistance($kilometres);
        $this->kilometres = $kilometres;
    }

    /**
     * Validates the distance constuctor value.
     * @param mixed $distance 
     * @throws \InvalidArgumentException
     */
    private function validateDistance($distance)
    {
        if (!is_numeric($distance)) {
            throw new \InvalidArgumentException('The distance must be a number.');
        } elseif (!$distance > 0) {
            throw new \InvalidArgumentException('The distance must be greater than zero!');
        }
    }

    /**
     * Distance as kilometres
     * @return int
     */
    public function asKilometres()
    {
        return $this->kilometres;
    }

    /**
     * Distance as miles
     * @return int
     */
    public function asMiles()
    {
        return $this->kilometres * 0.621371192;
    }

    /**
     * Default __toString() method, defaults to returning the distance as kilometres.
     * @return int
     */
    public function __toString()
    {
        return (string) $this->asKilometres();
    }
}