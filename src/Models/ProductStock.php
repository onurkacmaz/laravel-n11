<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\ProductStockInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class ProductStock extends Service implements ProductStockInterface
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/ProductStockService.wsdl";

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
     * @description Sistemde kayıtlı olan ürünün N11 ürün ID si ile ürün stok bilgilerini getiren metottur.
     * Cevap içinde stok durumunun “version” bilgisi de vardır, ürün stoklarında değişme olduysa bu versiyon bilgisi artacaktır,
     * Çağrı yapan taraf versiyon bilgisini kontrol ederek N11 e verilen stok bilgilerinde değişim olup olmadığını anlayabilir.
     */
    public function getProductStockByProductId(int $productId): object
    {
        $this->_parameters["product"]["id"] = $productId;
        return $this->_client->GetProductStockByProductId($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Sistemde kayıtlı olan ürünün N11 ürün ID si ile ürün stok bilgilerini getiren metottur.
     * Cevap içinde stok durumunun “version” bilgisi de vardır, ürün stoklarında değişme olduysa bu versiyon bilgisi artacaktır,
     * Çağrı yapan taraf versiyon bilgisini kontrol ederek N11 e verilen stok bilgilerinde değişim olup olmadığını anlayabilir.
     */
    public function getProductStockBySellerCode(string $productSellerCode): object
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        return $this->_client->GetProductStockBySellerCode($this->_parameters);
    }

    /**
     * @param int $productId
     * @param string $attrName
     * @param string $attrValue
     * @param int $quantity
     * @param int $version
     * @return mixed
     * @description Ürün stok seçenek bilgilerini kullanarak kayıtlı ürünün stok bilgilerini güncellemek için kullanılır.
     * Ürün n11 ID si ve stok seçenek bilgileri girilerek güncelleme işlemi yapılır.
     * Bir ürüne ait stok bilgilerine, ProductStockService içindeki GetProductStockByProductId veya GetProductStockBySellerCode metotları ile ulaşılabilir.
     * Bir ürün için tüm stok bilgilerini güncelleme işlemi gerçekleştirilebilir.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function updateStockByStockAttributes(int $productId, string $attrName, string $attrValue, int $quantity, int $version = 0): object
    {
        $this->_parameters["product"] = [
            "Id" => $productId,
            "stockItems" => [
                "stockItem" => [
                    "attributes" => [
                        "attribute" => [
                            "name" => $attrName,
                            "value" => $attrValue,
                            "quantity" => $quantity,
                            "version" => $version,
                        ]
                    ]
                ]
            ]
        ];
        return $this->_client->DeleteAndUpdateStockByStockAttributes($this->_parameters);
    }

    /**
     * @param int $stockItemId
     * @param int $quantity
     * @param int $version
     * @return mixed
     * @description n11 ürün stok ID si kullanarak kayıtlı ürünün stok bilgilerini güncellemek için kullanılır.
     * n11 ürün stok ID si ve miktar bilgileri girilerek güncelleme işlemi yapılır.
     * Bir ürüne ait n11 ürün stok ID sine, ProductStockService içindeki GetProductStockByProductId veya GetProductStockBySellerCode metotları ile ulaşılabilir.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function updateStockByStockId(int $stockItemId, int $quantity, int $version = 0): object
    {
        $this->_parameters["stockItems"] = [
            "stockItem" => [
                "id" => $stockItemId,
                "quantity" => $quantity,
                "version" => $version,
            ]
        ];
        return $this->_client->UpdateStockByStockId($this->_parameters);
    }

    /**
     * @param string $stockSellerCode
     * @param int $quantity
     * @param int $version
     * @return mixed
     * @description Mağaza ürün stok kodu kullanarak kayıtlı ürünün stok bilgilerini güncellemek için kullanılır.
     * Mağaza ürün stok kodu ve miktar bilgileri girilerek güncelleme işlemi yapılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function updateStockByStockSellerCode(string $stockSellerCode, int $quantity, int $version = 0): object
    {
        $this->_parameters["stockItems"] = [
            "stockItem" => [
                "sellerStockCode" => $stockSellerCode,
                "quantity" => $quantity,
                "version" => $version,
            ]
        ];
        return $this->_client->UpdateStockByStockSellerCode($this->_parameters);
    }

    /**
     * @param string $attrName
     * @param string $attrValue
     * @param int $quantityToIncrease
     * @param int $version
     * @return mixed
     * @description Bir ürünün stok seçenek bilgilerini kullanarak stok miktarını arttırmak için kullanılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockAttributes(string $attrName, string $attrValue, int $quantityToIncrease, int $version = 0): object
    {
        $this->_parameters["product"] = [
            "stockItems" => [
                "stockItem" => [
                    "attributes" => [
                        "attribute" => [
                            "name" => $attrName,
                            "value" => $attrValue,
                        ]
                    ],
                    "quantityToIncrease" => $quantityToIncrease,
                    "version" => $version
                ]
            ]
        ];
        return $this->_client->IncreaseStockByStockAttributes($this->_parameters);
    }

    /**
     * @param int $stockItemId
     * @param int $quantityToIncrease
     * @return mixed
     * @description Bir ürünün n11 ürün stok ID bilgisini kullanarak stok miktarını arttırmak için kullanılır.
     * Bir ürüne ait n11 ürün stok ID sine, ProductStockService içindeki GetProductStockByProductId veya GetProductStockBySellerCode metotları ile ulaşılabilir.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockId(int $stockItemId, int $quantityToIncrease): object
    {
        $this->_parameters["stockItems"] = [
            "stockItem" => [
                "id" => $stockItemId,
                "quantityToIncrease" => $quantityToIncrease
            ]
        ];
        return $this->_client->IncreaseStockByStockId($this->_parameters);
    }

    /**
     * @param string $sellerStockCode
     * @param int $quantityToIncrease
     * @return mixed
     * @description Bir ürünün mağaza stok kodu kullanarak stok miktarını arttırmak için kullanılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockSellerCode(string $sellerStockCode, int $quantityToIncrease): object
    {
        $this->_parameters["stockItems"] = [
            "stockItem" => [
                "sellerStockCode" => $sellerStockCode,
                "quantityToIncrease" => $quantityToIncrease
            ]
        ];
        return $this->_client->IncreaseStockByStockSellerCode($this->_parameters);
    }

}
