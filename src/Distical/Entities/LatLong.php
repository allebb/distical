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
        
    }

    private function validateLat()
    {
        
    }

    public function getLatitude()
    {
        return $this->lat;
    }

    public function getLongditude()
    {
        return $this->long;
    }

    public function getLat()
    {
        return $this->getLatitude();
    }

    public function getLng()
    {
        return $this->getLongditude();
    }

}
