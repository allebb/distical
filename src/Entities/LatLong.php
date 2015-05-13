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

    const LAT_VALIDATION_REGEX = "/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/";
    const LNG_VALIDATION_REGEX = "/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/";

    protected $lat;
    protected $lng;

    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        if (!$this->validateLat()) {
            throw new Exception('The latitude parameter is invalid, should be between -90 and 90');
        }
        if (!$this->validateLng()) {
            throw new Exception('The longitude parameter is invalid, should be between -180 and 180');
        }
    }

    /**
     * Validates the Latitude value.
     * @return boolean True if validation passes.
     */
    private function validateLat()
    {
        return preg_match(this::LAT_VALIDATION_REGEX, $this->lat);
    }

    /**
     * Validates the Longitude value.
     * @return boolean True if validation passes.
     */
    private function validateLng()
    {
        return preg_match(this::LNG_VALIDATION_REGEX, $this->lng);
    }

    /**
     * Returns the current Latitude co-ordinate.
     * @return float
     */
    public function getLatitude()
    {
        return (float) $this->lat;
    }

    /**
     * Returns the current Longitude co-ordinate.
     * @return float
     */
    public function getLongitude()
    {
        return $this->long;
    }

    /**
     * Alias of getLatitude
     * @return float
     */
    public function getLat()
    {
        return $this->getLatitude();
    }

    /**
     * Alias of getLongitude
     * @return float
     */
    public function getLng()
    {
        return $this->getLongitude();
    }
}
