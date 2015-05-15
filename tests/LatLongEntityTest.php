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
use \Ballen\Distical\Entities\LatLong;
use \PHPUnit_Framework_TestCase;

class LatLongEntityTest extends PHPUnit_Framework_TestCase
{

    protected $entity;
    protected $test_lat = 52.005497;
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
        $this->setExpectedException('\Ballen\Distical\Exceptions\InvalidLatitudeFormatException', 'The latitude parameter is invalid, value must be between -90 and 90');
        $test = new LatLong(-91, $this->test_lng);
    }

    public function testInvalidLonCoordValidation()
    {
        $this->setExpectedException('Ballen\Distical\Exceptions\InvalidLongitudeFormatException', 'The longitude parameter is invalid, value must be between -180 and 180');
        $test = new LatLong($this->test_lat, 181);
    }

    public function testInvalidCoords()
    {
        $this->setExpectedException('Ballen\Distical\Exceptions\InvalidLatitudeFormatException', 'The latitude parameter is invalid, value must be between -90 and 90');
        $test = new LatLong(-91, 51);
    }
}
