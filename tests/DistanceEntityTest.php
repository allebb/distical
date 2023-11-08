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

use \Ballen\Distical\Entities\Distance;
use PHPUnit\Framework\TestCase;

class DistanceEntityTest extends TestCase
{
    /** @var Distance */
    protected $entity;

    public function setUp(): void
    {
        $this->entity = new Distance(100);
    }

    public function testEntityCreation()
    {
        $this->assertInstanceOf(Distance::class, $this->entity);
    }

    public function testInvalidEntityCreationWithAsString()
    {
        $this->expectExceptionMessage('The distance value must be of a valid type.');
        new Distance('a random string');
    }

    public function testInvalidEntityCreationWithZero()
    {
        $this->expectExceptionMessage('The distance must be greater than zero!');
        new Distance(0);
    }

    public function testInvalidEntityCreationWithNegative()
    {
        $this->expectExceptionMessage('The distance must be greater than or equals zero!');
        new Distance(-1, true);
    }

    public function testEntityCreationWithAllowedZero()
    {
        $test = new Distance(0, true);
        $this->assertInstanceOf(Distance::class, $test);
        $this->assertEquals(0, $test->asKilometres());
    }

    public function testConversionToKilometres()
    {
        $this->assertEquals(100, $this->entity->asKilometres());
    }

    public function testConversionToMiles()
    {
        $this->assertEquals(62.137119200000001, $this->entity->asMiles());
    }

    public function testConversionToNauticalMiles()
    {
        $this->assertEquals(53.995680300000004, $this->entity->asNauticalMiles());
    }

    public function testConversionToString()
    {
        $this->assertEquals('100', $this->entity->__toString());
    }
}
