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
use \Ballen\Distical\Entities\LatLong;

class LatLongEntityTest extends \PHPUnit_Framework_TestCase
{
    /** @var LatLong */
    protected $entity;

    /** @var float */
    protected $test_lat = 52.005497;

    /** @var float */
    protected $test_lng = 1.045748;

    public function __construct()
    {
        $this->entity = new LatLong($this->test_lat, $this->test_lng);
    }

    public function testEntityCreation()
    {
        $this->assertInstanceOf('Ballen\Distical\Entities\LatLong', $this->entity);
    }

    public function testGetLatFromEntity()
    {
        $this->assertEquals($this->test_lat, $this->entity->getLatitude());
    }

    public function testGetLonFromEntity()
    {
        $this->assertEquals($this->test_lng, $this->entity->getLongitude());
    }

    public function testAliasLatFromEntity()
    {
        $this->assertEquals($this->test_lat, $this->entity->lat());
    }

    public function testAliasLngFromEntity()
    {
        $this->assertEquals($this->test_lng, $this->entity->lng());
    }

    public function testInvalidLatCoordValidation()
    {
        $this->setExpectedException(\Ballen\Distical\Exceptions\InvalidLatitudeFormatException::class, 'The latitude parameter is invalid, value must be between -90 and 90');
        $test = new LatLong(-91, $this->test_lng);
    }

    public function testInvalidLonCoordValidation()
    {
        $this->setExpectedException(\Ballen\Distical\Exceptions\InvalidLongitudeFormatException::class, 'The longitude parameter is invalid, value must be between -180 and 180');
        $test = new LatLong($this->test_lat, 181);
    }

    public function testInvalidCoords()
    {
        $this->setExpectedException(\Ballen\Distical\Exceptions\InvalidLatitudeFormatException::class, 'The latitude parameter is invalid, value must be between -90 and 90');
        $test = new LatLong(-91, 251);
    }

    public function testValidCoords()
    {
        $test = new LatLong($this->test_lat, $this->test_lng);
        $this->assertInstanceOf(\Ballen\Distical\Entities\LatLong::class, $test);
    }
}
