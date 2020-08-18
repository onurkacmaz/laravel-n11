<?php

namespace Onurkacmaz\LaravelN11\Models;


use Illuminate\Support\Collection;
use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Category extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client = null;

    /**
     * @var string
     */
    private $endPoint = "/CategoryService.wsdl";

    /**
     * Category constructor
     * endPoint set edildi.
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
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
