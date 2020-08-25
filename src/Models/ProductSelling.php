<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class ProductSelling extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/ProductSellingService.wsdl";

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
     * @param int $productId
     * @return mixed
     * @description Satışta olmayan bir ürünün N11 ürün ID si kullanılarak satışa başlanması için kullanılır.
     */
    public function startSellingProductByProductId(int $productId)
    {
        $this->_parameters["productId"] = $productId;
        return $this->_client->StartSellingProductByProductId($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Satışta olmayan bir ürünün mağaza ürün kodu kullanılarak satışa başlanması için kullanılır.
     */
    public function startSellingProductBySellerCode(string $productSellerCode)
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        return $this->_client->StartSellingProductBySellerCode($this->_parameters);
    }

    /**
     * @param int $productId
     * @return mixed
     * @description Satışta olan ürünün n11 ürün ID si kullanılarak satışa kapatılması için kullanılır.
     */
    public function stopSellingProductByProductId(int $productId)
    {
        $this->_parameters["productId"] = $productId;
        return $this->_client->StopSellingProductByProductId($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Satışta olan ürünün mağaza ürün kodu kullanılarak satışının durdurulması için kullanılır.
     */
    public function stopSellingProductBySellerCode(string $productSellerCode)
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        return $this->_client->StopSellingProductBySellerCode($this->_parameters);
    }

}
