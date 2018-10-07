<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 30/09/18
 * Time: 20:21
 */

namespace App\Listener;

use App\Entity\Address;
use App\Entity\Site;
use App\Service\GoogleGeocoding;
/**
 * Class SiteListener
 * @package App\Listener
 *
 * Store coordinates of a new Site based
 */
class AddressListener
{
    private $geocoding;
    public function __construct(GoogleGeocoding $geocoding)
    {
        $this->geocoding = $geocoding;
    }

    public function prePersist(Address $address)
    {
        $this->setCoordinates($address);
    }

    public function preUpdate(Address $address)
    {
        $this->setCoordinates($address);
    }

    private function setCoordinates(Address $address)
    {
        $coordinates = $this->geocoding->getCoordinates($address);
        if($coordinates){
            $address->setCoordinates($coordinates->lat . ',' . $coordinates->lng);
        } else {
            $address->setCoordinates(null);
        }
    }
}