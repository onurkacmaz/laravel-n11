<?php


namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\SapCommissionEInvoiceDetailInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class SapCommissionEInvoiceDetail extends Service implements SapCommissionEInvoiceDetailInterface
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * Sap Bank Statement E-Invoice Service constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint(self::END_POINT);
    }

    /**
     * @param string $date
     * @return mixed
     * @description Fatura detayı için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapCommissionEInvoiceDetail(string $date): object {
        $this->_parameters["date"] = $date;
        return $this->_client->GetSapCommissionEInvoiceDetail($this->_parameters);
    }

}
