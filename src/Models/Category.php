<?php

namespace Onurkacmaz\LaravelN11\Models;

use OnurKacmaz\LaravelN11\Service;

class Category extends Service
{

    /**s
     * @var \SoapClient|null
     */
    private static $_client = null;

    /**
     * @var string
     */
    private static $endPoint = "/CategoryService.wsdl";

    /**
     * Category constructor
     * endPoint set edildi.
     * @throws \SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        self::$_client = $this->setEndPoint(self::$endPoint);
    }

    /**
     * @return mixed
     * @description Üst Seviye Kategorileri Listeler
     */
    public static function getTopLevelCategories()
    {
        return self::$_client->GetTopLevelCategories(self::$_parameters);
    }

}
