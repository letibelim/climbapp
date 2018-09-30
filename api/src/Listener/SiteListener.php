<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 30/09/18
 * Time: 20:21
 */

namespace App\Listener;

use App\Entity\Site;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Serializer\SerializerInterface;
use Unirest\Request;
class SiteListener
{
    private $googleApiKey;
    private $googleUrl;
    private $serializer;
    public function __construct($googleApiKey, $geocodingUrl, SerializerInterface $serializer)
    {
        $this->googleApiKey = $googleApiKey;
        $this->googleUrl = $geocodingUrl;
        $this->serializer = $serializer;
    }

    public function prePersist(Site $site, LifecycleEventArgs $event)
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