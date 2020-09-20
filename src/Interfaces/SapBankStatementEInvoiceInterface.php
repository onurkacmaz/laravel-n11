<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface SapBankStatementEInvoiceInterface
{

    /**
     * @var string
     */
    public const END_POINT = "SapBankStatementEInvoiceService.wsdl";

    /**
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     * @description Hesap ekstresi için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapBankStatementEInvoice(string $startDate, string $endDate): object;
}
