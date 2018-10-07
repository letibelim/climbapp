<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 07/10/18
 * Time: 11:11
 *
 * Google Geocoding service. See https://developers.google.com/maps/documentation/geocoding/start
 * Use Unirest library for request : http://unirest.io/php.html
 */

namespace App\Service;

use App\Entity\Address;
use Unirest\Request;

class GoogleGeocoding
{
    private $googleApiKey;
    private $googleUrl;
    public function __construct($googleApiKey, $geocodingUrl)
    {
        $this->googleApiKey = $googleApiKey;
        $this->googleUrl = $geocodingUrl;
    }

    public function getCoordinates(Address $address)
    {
        $headers = ['Accept' => 'application/json'];
        $query = [
            'key' => $this->googleApiKey,
            'address' => $address->__toString(),
        ];

        $response = Request::get($this->googleUrl, $headers, $query);
        if ($response->code === 200) {
            return $response->body->results[0]->geometry->location;
        }

        return null;
    }
}