<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 30/09/18
 * Time: 20:21
 */

namespace App\Listener;

use App\Entity\Site;
use Unirest\Request;
class SiteListener
{
    private $googleApiKey;
    private $googleUrl;
    public function __construct($googleApiKey, $geocodingUrl)
    {
        $this->googleApiKey = $googleApiKey;
        $this->googleUrl = $geocodingUrl;
    }

    public function prePersist(Site $site)
    {
        $address = $site->getAddress();
        $headers = ['Accept' => 'application/json'];
        $query = [
            'key' => $this->googleApiKey,
            'address' => $address->__toString(),
        ];

        $response = Request::get($this->googleUrl, $headers, $query);
        if ($response->code === 200){
            $coordinates = $response->body->results[0]->geometry->location;
            $site->setCoordinates($coordinates->lat . ',' . $coordinates->lng);
        }
    }
}