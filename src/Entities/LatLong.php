<?php
namespace Ballen\Distical\Entities;

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
     * The latitude coordinate.
     * @var double
     */
    protected $latitude;

    /**
     * The longitude coordinate.
     * @var double
     */
    protected $longitude;

    /**
     * Create a new latitude and longitude object.
     * @param double $lat The latitude coordinate.
     * @param double $lng The longitude coordinate.
     * @throws \InvalidArgumentException
     */
    public function __construct($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        if (!$this->validateLat()) {
            throw new \Ballen\Distical\Exceptions\InvalidLatitudeFormatException('The latitude parameter is invalid, value must be between -90 and 90');
        }
        if (!$this->validateLng()) {
            throw new \Ballen\Distical\Exceptions\InvalidLongitudeFormatException('The longitude parameter is invalid, value must be between -180 and 180');
        }
    }

    /**
     * Validates the Latitude value.
     * 
     * @return boolean
     */
    private function validateLat()
    {
        if (($this->latitude >= -90) && ($this->latitude <= 90)) {
            return true;
        }
        return false;
    }

    /**
     * Validates the Longitude value.
     * @return boolean True if validation passes.
     */
    private function validateLng()
    {
        if (($this->longitude >= -180) && ($this->longitude <= 180)) {
            return true;
        }
        return false;
    }

    /**
     * Returns the current Latitude coordinate.
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the current Longitude coordinate.
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
