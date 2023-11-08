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

ini_set('precision', 15); // Force float precision (to ensure tests run as expected on any environment)

use \Ballen\Distical\Calculator;
use Ballen\Distical\Entities\Distance;
use \Ballen\Distical\Entities\LatLong;
use PHPUnit\Framework\TestCase;

class DisticalTest extends TestCase
{
    /** @var LatLong */
    protected $latlong1;

    /** @var LatLong */
    protected $latlong2;

    /** @var LatLong */
    protected $latlong3;

    /** @var LatLong */
    protected $latlong4;

    public function setUp(): void
    {
        $this->latlong1 = new LatLong(52.005497, 1.045748);
        $this->latlong2 = new LatLong(52.052728, 1.160446);
        $this->latlong3 = new LatLong(52.062515, 1.250790);
    }

    public function testCalculationWithSinglePoint()
    {
        $this->expectException('RuntimeException');
        $this->expectExceptionMessage(
            'There must be two or more points (co-ordinates) before a calculation can be performed.'
        );
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1)->get();
    }

    public function testAddPointWithKey()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'CapelStMary');

        $this->expectExceptionMessage(
            'There must be two or more points (co-ordinates) before a calculation can be performed.'
        );
        $calculator->get();
    }

    public function testRemovePointWithKey()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'ToBeRemovedAfter');
        $calculator->addPoint($this->latlong2, 'CapelStMary');
        $this->assertInstanceOf(Distance::class, $calculator->get());

        $calculator->removePoint('ToBeRemovedAfter');
        $this->expectExceptionMessage(
            'There must be two or more points (co-ordinates) before a calculation can be performed.'
        );
        $calculator->get();
    }

    public function testResetPoints()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1);
        $calculator->addPoint($this->latlong2);
        $this->assertInstanceOf(Distance::class, $calculator->get());

        $calculator->resetPoints();
        $calculator->addPoint($this->latlong3);
        $this->expectExceptionMessage(
            'There must be two or more points (co-ordinates) before a calculation can be performed.'
        );
        $calculator->get();

        $calculator->addPoint($this->latlong2);
        $this->assertEquals(6.273748050460542, $calculator->get()->asKilometres());
    }

    public function testCalculationsAfterResetPoints()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1);
        $calculator->addPoint($this->latlong2);
        $calculator->resetPoints();
        $calculator->addPoint($this->latlong2);
        $calculator->addPoint($this->latlong3);

        $this->assertEquals(6.273748050460542, $calculator->get()->asKilometres());
        $this->assertNotEquals(9.444924713131321, $calculator->get()->asKilometres());
    }

    public function testResetPointsAfterCalculation()
    {
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1);
        $calculator->addPoint($this->latlong2);
        $this->assertInstanceOf(Distance::class, $calculator->get(true));

        $calculator->addPoint($this->latlong3);
        $this->expectExceptionMessage(
            'There must be two or more points (co-ordinates) before a calculation can be performed.'
        );
        $calculator->get();
    }

    public function testRemovePointWithInvalidKey()
    {
        $this->expectExceptionMessage('The point key does not exist.');
        $this->expectException('InvalidArgumentException');
        $calculator = new Calculator();
        $calculator->addPoint($this->latlong1, 'ThisIsTheFirstAndOnlyNamedKey');
        $calculator->removePoint('TheSecondNamedKey');
    }

    public function testBetweenUsingConstructorToString()
    {
        $calculator = new Calculator($this->latlong1, $this->latlong2);
        $this->assertEquals(9.444924713131321, $calculator->get()->asKilometres());
    }

    public function testBetweenUsingConstructorToMiles()
    {
        $calculator = new Calculator($this->latlong1, $this->latlong2);
        $this->assertEquals(5.8688041273486675, $calculator->get()->asMiles());
    }

    public function testBetweenToString()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals('9.44492471313132', $calculator->get()->__toString());
    }

    public function testBetweenToKilometers()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(9.444924713131321, $calculator->get()->asKilometres());
    }

    public function testBetweenToMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(5.8688041273486675, $calculator->get()->asMiles());
    }

    public function testBetweenToNauticalMiles()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2);
        $this->assertEquals(5.099851352678081, $calculator->get()->asNauticalMiles());
    }

    public function testBetweenWithAdditionalPointToString()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals('15.7186727635919', $calculator->get()->__toString());
    }

    public function testBetweenWithAdditionalPointToKilometers()
    {
        $calculator = new Calculator;
        $calculator->between($this->latlong1, $this->latlong2)->addPoint($this->latlong3);
        $this->assertEquals(15.718672763591863, $calculator->get()->asKilometres());
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
        $this->assertEquals(8.487404292832238, $calculator->get()->asNauticalMiles());
    }

    public function testPointToPointToString()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals('9.44492471313132', $calculator->get()->__toString());
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
        $this->assertEquals(9.444924713131321, $calculator->get()->asKilometres());
    }

    public function testPointToPointToNauticalMiles()
    {
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong1)->addPoint($this->latlong2);
        $this->assertEquals(5.099851352678081, $calculator->get()->asNauticalMiles());
    }

    public function testPointBeforeBetween()
    {
        $this->expectException(
            'RuntimeException',
            'The between() method can only be called when it is the first set or co-ordinates.'
        );
        $calculator = new Calculator;
        $calculator->addPoint($this->latlong3)->between($this->latlong1, $this->latlong2)->get();
    }
}
