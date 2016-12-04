<?php
namespace Ballen\Distical\Exceptions;

/**
 * Distical
 *
 * Distical is a simple distance calculator library for PHP 5.3+ which
 * amongst other things can calculate the distance between two or more lat/long
 * co-ordinates.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/allebb/distical
 * @link http://bobbyallen.me
 *
 */
class InvalidLongitudeFormatException extends \Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
