<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ShipmentCompanyInterface
{
    /**
     * @return mixed
     * @description Sistemde tanımlı olan tüm kargo şirketlerini listeler.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     */
    public function getShipmentCompanies(): object;
}
