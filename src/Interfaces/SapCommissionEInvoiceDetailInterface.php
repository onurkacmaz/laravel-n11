<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface SapCommissionEInvoiceDetailInterface
{

    /**
     * @var string
     */
    public const END_POINT = "SapCommissionEInvoiceDetailService.wsdl";

    /**
     * @param string $date
     * @return mixed
     * @description Fatura detayı için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapCommissionEInvoiceDetail(string $date): object;
}
