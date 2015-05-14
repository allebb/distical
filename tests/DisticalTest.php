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
use \Ballen\Distical\Calculator;
use \Ballen\Distical\Entities\LatLong;
use \PHPUnit_Framework_TestCase;

class DisticalTest extends PHPUnit_Framework_TestCase
{

    public function testBetweenUsingConstructorToString()
    {
        return true;
    }

    public function testBetweenUsingConstructorToMiles()
    {
        return true;
    }

    public function testBetweenToString()
    {
        return false;
    }

    public function testBetweenToKilometers()
    {
        return true;
    }

    public function testBetweenToMiles()
    {
        return false;
    }

    public function testBetweenToNauticalMiles()
    {
        return true;
    }
}
