<?php

namespace Onurkacmaz\LaravelN11\Models;


use Illuminate\Support\Collection;
use Onurkacmaz\LaravelN11\Service;

class Category extends Service
{

    /**s
     * @var \SoapClient|null
     */
    private $_client = null;

    /**
     * @var string
     */
    private $endPoint = "/CategoryService.wsdl";

    /**
     * Category constructor
     * endPoint set edildi.
     * @throws \SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = self::setEndPoint($this->endPoint);
    }

    /**
     * @return mixed
     * @description Üst Seviye Kategorileri Listeler
     */
    public function topLevelCategories()
    {
        return $this->_client->GetTopLevelCategories($this->_parameters);
    }

}
