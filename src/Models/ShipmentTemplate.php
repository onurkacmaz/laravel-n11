<?php


namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\ShipmentTemplateInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class ShipmentTemplate extends Service implements ShipmentTemplateInterface
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/ShipmentService.wsdl";

    /**
     * Shipment Service constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @param string $templateName
     * @return mixed
     * @description Teslimat şablon ismi ile aratılan şablonun adres metod gibi özelliklerini gösterme.
     * deliverableCities teslimat yapılacak şehirlerin seçimini yaptığımız alan bu alana değer girilmezse tüm şehirlere gönderim yapılacak anlamındadır.
     */
    public function getShipmentTemplate(string $templateName) {
        $this->_parameters["name"] = $templateName;
        return $this->_client->GetShipmentTemplate($this->_parameters);
    }

}
