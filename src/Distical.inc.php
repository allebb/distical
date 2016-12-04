<?php
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
/* * *****************************************************************************
 * THIS FILE SHOULD BE USED FOR AUTOMATICALLY LOADING THIS LIBRARY WHEN YOU ARE
 *  USING IT "STANDALONE" AND NOT USING COMPOSER OR ANOTHER PACKAGE MANAGER.
 */

$includes = array(
    'Calculator.php',
    'Entities/LatLong.php',
    'Entities/Distance.php',
    'Exceptions/InvalidLatitudeFormatException.php',
    'Exceptions/InvalidLongitudeFormatException.php',
);

foreach ($includes as $file) {
    require_once dirname(__FILE__) . '/' . $file;
}