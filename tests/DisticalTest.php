<?php

namespace Tests;

/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two or more lat/long
 * coordinates.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/allebb/distical
 * @link http://bobbyallen.me
 *
 */
use \Ballen\Distical\Calculator;
use \Ballen\Distical\Entities\LatLong;

class DisticalTest extends \PHPUnit_Framework_TestCase
{
    /** @var LatLong */
    protected $latlong1;

    /** @var LatLong */
    protected $latlong2;

    /** @var LatLong */
    protected $latlong3;

    /** @var LatLong */
    protected $latlong4;

    public function __construct()
    {
        $this->latlong1 = new LatLong(52.005497, 1.045748);
        $this->latlong2 = new LatLong(52.052728, 1.160446);
        $this->latlong3 = new LatLong(52.062515, 1.250790);
    }

    public function testCalculationWithSinglePoint()
    {
        $this->setExpectedException('RuntimeException', 'There must be two or more points (co-ordinates) before a calculation can be performed.');
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1)->get();
    }

    public function testAddPointWithKey()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'CapelStMary');
    }

    public function testRemovePointWithKey()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'ToBeRemovedAfter');
        $calculator->removePoint('ToBeRemovedAfter');
    }

    public function testRemovePointWithInvalidKey()
    {
        $this->setExpectedException('InvalidArgumentException', 'The point key does not exist.');
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'ThisIsTheFirstAndOnlyNamedKey');
        $calculator->removePoint('TheSecondNamedKey');
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

    public function testBetweenWithAdditionalPointToString()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals('15.718672763592', $calculator->get()->__toString());
    }

    public function testBetweenWithAdditionalPointToKilometers()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals(15.718672763592, $calculator->get()->asKilometres());
    }

    public function testBetweenWithAdditionalPointToMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals(9.7671304317710099, $calculator->get()->asMiles());
    }

    public function testBetweenWithAdditionalPointToNauticalMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals(8.4874042928322382, $calculator->get()->asNauticalMiles());
    }

    public function testPointToPointToString()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals('9.4449247131313', $calculator->get()->__toString());
    }

    public function testPointToPointToMiles()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals(5.8688041273486675, $calculator->get()->asMiles());
    }

    public function testPointToPointToKilometers()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals(9.4449247131313, $calculator->get()->asKilometres());
    }

    public function testPointToPointToNauticalMiles()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals(5.0998513526780807, $calculator->get()->asNauticalMiles());
    }

    public function testPointBeforeBetween()
    {
        $this->setExpectedException('RuntimeException', 'The between() method can only be called when it is the first set or co-ordinates.');
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong3)->between($this->latlong1, $this->latlong2)->get();
    }
}
