<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\SettlementInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Settlement extends Service implements SettlementInterface
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * City constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint(self::END_POINT);
    }

    /**
     * @param string $startDate
     * @param int $endDate
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     * @description Seçilen tarih aralığına göre ödeme bilgilerini listeleyen servis.
     */
    public function getSettlementList(string $startDate, int $endDate, int $currentPage = 1, int $pageSize = 100): object {
        $this->_parameters["startDate"] = $startDate;
        $this->_parameters["endDate"] = $endDate;
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize,
        ];
        return $this->_client->GetSettlementList($this->_parameters);
    }

    /**
     * @param string $date
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     * @description GetSettlementList metodu ile listelenen ödemelere ait ayrıntıları gösteren metod. Belirli bir gün seçilerek, o güne ait satış/uzlaşma detayları getirilir.
     */
    public function getSettlementDetail(string $date, int $currentPage = 1, int $pageSize = 100): object {
        $this->_parameters["date"] = $date;
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize,
        ];
        return $this->_client->GetSettlementDetail($this->_parameters);
    }

}
