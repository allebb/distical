<?php namespace Ballen\Distical\Entities;

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
class LatLong
{

    /**
     * Validation regex for Latitude parameters.
     */
    const LAT_VALIDATION_REGEX = "/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/";

    /**
     * Validation regex for Longitude parameters.
     */
    const LNG_VALIDATION_REGEX = "/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/";

    /**
     * The latitude co-ordinate.
     * @var double
     */
    protected $latitude;

    /**
     * The longitude co-ordinate.
     * @var double
     */
    protected $longitude;

    /**
     * Create a new latitude and longitude object.
     * @param double $lat The latitude co-ordinate.
     * @param double $lng The longitude co-ordinate.
     * @throws \InvalidArgumentException
     */
    public function __construct($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        if (!$this->validateLat()) {
            throw new \InvalidArgumentException('The latitude parameter is invalid, should be between -90 and 90');
        }
        if (!$this->validateLng()) {
            throw new \InvalidArgumentException('The longitude parameter is invalid, should be between -180 and 180');
        }
    }

    /**
     * Validates the Latitude value.Tuesday12327
     * 
     * @return boolean
     */
    private function validateLat()
    {
        return preg_match(self::LAT_VALIDATION_REGEX, $this->latitude);
    }

    /**
     * Validates the Longitude value.
     * @return boolean True if validation passes.
     */
    private function validateLng()
    {
        return preg_match(self::LNG_VALIDATION_REGEX, $this->longitude);
    }

    /**
     * Returns the current Latitude co-ordinate.
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the current Longitude co-ordinate.
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Alias of getLatitude
     * @return double
     */
    public function lat()
    {
        return $this->getLatitude();
    }

    /**
     * Alias of getLongitude
     * @return double
     */
    public function lng()
    {
        return $this->getLongitude();
    }
}
