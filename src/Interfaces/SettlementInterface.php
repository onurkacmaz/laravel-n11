<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface SettlementInterface
{

    /**
     * @var string
     */
    public const END_POINT = "SettlementService.wsdl";

    /**
     * @param string $startDate
     * @param int $endDate
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     * @description Seçilen tarih aralığına göre ödeme bilgilerini listeleyen servis.
     */
    public function getSettlementList(string $startDate, int $endDate, int $currentPage = 1, int $pageSize = 100): object;

    /**
     * @param string $date
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     * @description GetSettlementList metodu ile listelenen ödemelere ait ayrıntıları gösteren metod. Belirli bir gün seçilerek, o güne ait satış/uzlaşma detayları getirilir.
     */
    public function getSettlementDetail(string $date, int $currentPage = 1, int $pageSize = 100): object;
}
