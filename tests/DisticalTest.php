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

    protected $latlong1;
    protected $latlong2;
    protected $latlong3;
    protected $latlong4;

    public function __construct()
    {
        $this->latlong1 = new LatLong(52.005497, 1.045748);
        $this->latlong2 = new LatLong(52.052728, 1.160446);
    }

    public function testBetweenUsingConstructorToString()
    {
        $calculator = new Calculator($this->latlong1, $this->latlong2);
        $this->assertEquals(9.4449247131313214, $calculator->get()->asKilometres());
    }

    public function testBetweenUsingConstructorToMiles()
    {
        $calculator = new Calculator($this->latlong1, $this->latlong2);
        $this->assertEquals(5.86880412733486675, $calculator->get()->asMiles());
    }

    public function testBetweenToString()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals('9.4449247131313', $calculator->get()->__toString());
    }

    public function testBetweenToKilometers()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(9.4449247131313214, $calculator->get()->asKilometres());
    }

    public function testBetweenToMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(5.86880412733486675, $calculator->get()->asMiles());
    }

    public function testBetweenToNauticalMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(5.0998513526780807, $calculator->get()->asNauticalMiles());
    }
}
