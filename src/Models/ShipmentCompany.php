<?php


namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class ShipmentCompany extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/ShipmentCompanyService.wsdl";

    /**
     * Shipment Company Service constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @return mixed
     * @description Sistemde tanımlı olan tüm kargo şirketlerini listeler.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     */
    public function getShipmentCompanies() {
        return $this->_client->GetShipmentCompanies();
    }

}
