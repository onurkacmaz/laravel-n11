<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ShipmentTemplateInterface
{

    /**
     * @var string
     */
    public const END_POINT = "ShipmentService.wsdl";

    /**
     * @param string $templateName
     * @return mixed
     * @description Teslimat şablon ismi ile aratılan şablonun adres metod gibi özelliklerini gösterme.
     * deliverableCities teslimat yapılacak şehirlerin seçimini yaptığımız alan bu alana değer girilmezse tüm şehirlere gönderim yapılacak anlamındadır.
     */
    public function getShipmentTemplate(string $templateName): object;
}
