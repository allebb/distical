<?php
namespace Ballen\Distical\Entities;

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
class Distance
{

    /**
     * Converstion from Kilomters to Miles.
     */
    const KILOMETERS_IN_MILES = 0.621371192;

    /**
     * Converstion from Kilomters to Naugtical miles.
     */
    const KILOMETERS_INL_NAUTICAL_MILES = 0.539956803;

    /**
     * The distance in kilometres
     * @var double|int
     */
    private $kilometres;

    /**
     * Class constructor
     * @param mixed $kilometres The distance in kilometres.
     */
    public function __construct($kilometres = 0)
    {
        $this->validateDistance($kilometres);
        $this->kilometres = $kilometres;
    }

    /**
     * Validates the distance constructor value.
     * @param mixed $distance
     * @throws \InvalidArgumentException
     * @return void
     */
    private function validateDistance($distance)
    {
        if (!is_numeric($distance)) {
            throw new \InvalidArgumentException('The distance value must be of a valid type.');
        }
        if (!$distance > 0) {
            throw new \InvalidArgumentException('The distance must be greater than zero!');
        }
    }

    /**
     * Distance as kilometres
     * @return double
     */
    public function asKilometres()
    {
        return $this->kilometres;
    }

    /**
     * Distance as miles
     * @return double
     */
    public function asMiles()
    {
        return $this->kilometres * self::KILOMETERS_IN_MILES;
    }

    /**
     * Distance as nautical miles
     * @return double
     */
    public function asNauticalMiles()
    {
        return $this->kilometres * self::KILOMETERS_INL_NAUTICAL_MILES;
    }

    /**
     * Default __toString() method, defaults to returning the distance as kilometres.
     * @return string
     */
    public function __toString()
    {
        return (string) $this->asKilometres();
    }
}
