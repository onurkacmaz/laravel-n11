<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface SapBankStatementEInvoiceInterface
{
    /**
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     * @description Hesap ekstresi için günlük sorgulama limiti sayısı 3 olarak set edilmiştir.
     */
    public function getSapBankStatementEInvoice(string $startDate, string $endDate): object;
}
