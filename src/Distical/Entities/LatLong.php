<?php

namespace Ballen\Distical\Entities;

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
        if(!$this->validateLat()){
            throw new Exception('The latitude parameter is invalid, should be between -90 and 90');
        }
        if(!$this->validateLng()){
            throw new Exception('The longitude parameter is invalid, should be between -180 and 180');
        }
    }

    private function validateLat()
    {
        return preg_match(this::LAT_VALIDATION_REGEX, $this->lat);
    }

    private function validateLng()
    {
        return preg_match(this::LNG_VALIDATION_REGEX, $this->lng);
    }

    public function getLatitude()
    {
        return $this->lat;
    }

    public function getLongitude()
    {
        return $this->long;
    }

    public function getLat()
    {
        return $this->getLatitude();
    }

    public function getLng()
    {
        return $this->getLongitude();
    }

}
