<?php


namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class SapBankStatementEInvoice extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/SapBankStatementEInvoiceService.wsdl";

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
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     * @description Hesap ekstresi için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapBankStatementEInvoice(string $startDate, string $endDate) {
        $this->_parameters["startDate"] = $startDate;
        $this->_parameters["endDate"] = $endDate;
        return $this->_client->GetSapBankStatementEInvoice($this->_parameters);
    }

}
