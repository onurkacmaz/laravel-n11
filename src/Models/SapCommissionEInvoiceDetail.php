<?php


namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class SapCommissionEInvoiceDetail extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/SapCommissionEInvoiceDetailService.wsdl";

    /**
     * Sap Bank Statement E-Invoice Service constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @param string $date
     * @return mixed
     * @description Hesap ekstresi için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapCommissionEInvoiceDetail(string $date) {
        $this->_parameters["date"] = $date;
        return $this->_client->GetSapCommissionEInvoiceDetail($this->_parameters);
    }

}
