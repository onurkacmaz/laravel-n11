<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\ProductInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Product extends Service implements ProductInterface
{

    public const ACTIVE = "Active";
    public const SUSPENDED = "Suspended";
    public const PROHIBITED = "Prohibited";
    public const UNLISTED = "Unlisted";
    public const WAITING_FOR_APPROVAL = "WaitingForApproval";
    public const REJECTED = "Rejected";
    public const UNAPPROVED_UPDATE = "UnapprovedUpdate";

    public const DISCOUNT_AMOUNT = 1;
    public const DISCOUNT_PERCENT = 2;
    public const DISCOUNTED_PRICE = 3;

    public const TL = 1;
    public const USD = 2;
    public const EURO = 3;

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/ProductService.wsdl";

    /**
     * City constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @param int $productId
     * @return object
     * @description N11 ürün ID sini kullanarak sistemde kayıtlı olan ürünün bilgilerini getirir.
     */
    public function getProductByProductId(int $productId): object
    {
        $this->_parameters["productId"] = $productId;
        return $this->_client->GetProductByProductId($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @return object
     * @description Mağaza ürün kodunu kullanarak sistemde kayıtlı olan ürünün bilgilerini getirir.
     */
    public function getProductBySellerCode(string $productSellerCode): object
    {
        $this->_parameters["sellerCode"] = $productSellerCode;
        return $this->_client->GetProductBySellerCode($this->_parameters);
    }

    /**
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     */
    public function getProductList(int $currentPage = 1, int $pageSize = 100): object
    {
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize
        ];
        return $this->_client->GetProductList($this->_parameters);
    }

    /**
     * @param array $data
     * @return object
     * @description Yeni ürün oluşturmak veya mevcut ürünü güncellemek için kullanılır.
     * Ürün kodu “productSellerCode” adıyla veirlen data bu mağaza için bir kayıtlı bir ürünü gösteriyorsa bu ürün güncellenir, aksi halde yeni bir ürün oluşturulur.
     */
    public function saveProduct(array $data): object
    {
        $this->_parameters["product"] = $data;
        return $this->_client->SaveProduct($this->_parameters);
    }

    /**
     * @param int $currentPage
     * @param int $pageSize
     * @param string|null $keyword
     * @param null $saleStartDate
     * @param null $saleEndDate
     * @param string $approvalStatus
     * @return object
     * @description Mağaza ürünlerini aramak için kullanılır.
     */
    public function searchProducts(int $currentPage = 1, int $pageSize = 100, string $keyword = null, $saleStartDate = null, $saleEndDate = null, $approvalStatus = self::ACTIVE): object
    {
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize
        ];
        $this->_parameters["productSearch"] = [
            "name" => $keyword,
            "saleDate" => [
                "startDate" => $saleStartDate,
                "endDate" => $saleEndDate,
            ]
        ];
        $this->_parameters["approvalStatus"] = $approvalStatus;
        return $this->_client->SearchProducts($this->_parameters);
    }

    /**
     * @param int $productId
     * @return object
     * @description Kayıtlı olan bir ürünü N11 Id si kullanarak silmek için kullanılır.
     */
    public function deleteProductById(int $productId): object
    {
        $this->_parameters["productId"] = $productId;
        $this->_client->DeleteProductById($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @return object
     * @description Kayıtlı olan bir ürünü mağaza ürün kodu kullanılarak silmek için kullanılır.
     */
    public function deleteProductBySellerCode(string $productSellerCode): object
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        $this->_client->DeleteProductBySellerCode($this->_parameters);
    }

    /**
     * @param int $productId
     * @param int $discountType
     * @param float|int $discountValue
     * @param string|null $startDate
     * @param string|null $endDate
     * @return object
     * @description Bir ürünün N11 ürün ID sini kullanarak indirim bilgilerinin güncellenmesi için kullanılır.
     * Girilen indirim miktarı ürün listeleme fiyatına uygulanır.
     * Liste fiyatı ile ürünün indirimli fiyatı arasındaki fark kadar ürün stok birim fiyatlarına da indirim uygulanır.
     */
    public function updateDiscountValueByProductId(int $productId, int $discountType = self::DISCOUNT_AMOUNT, float $discountValue = 0, string $startDate = null, string $endDate = null): object
    {
        $this->_parameters["productId"] = $productId;
        $this->_parameters["discountType"] = $discountType;
        $this->_parameters["productDiscount"] = [
            "discountValue" => $discountValue,
            "discountStartDate" => $startDate,
            "discountEndDate" => $endDate,
        ];
        return $this->_client->UpdateDiscountValueByProductId($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @param int $discountType
     * @param float|int $discountValue
     * @param string|null $startDate
     * @param string|null $endDate
     * @return object
     * @description Bir ürünün mağaza ürün kodunu kullanarak indirim bilgilerinin güncellenmesi için kullanılır.
     * Girilen indirim miktarı ürün listeleme fiyatına uygulanır.
     * Liste fiyatı ile ürünün indirimli fiyatı arasındaki fark kadar ürün stok birim fiyatlarına da indirim uygulanır.
     */
    public function updateDiscountValueByProductSellerCode(string $productSellerCode, int $discountType = self::DISCOUNT_AMOUNT, float $discountValue = 0, string $startDate = null, string $endDate = null): object
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        $this->_parameters["discountType"] = $discountType;
        $this->_parameters["productDiscount"] = [
            "discountValue" => $discountValue,
            "discountStartDate" => $startDate,
            "discountEndDate" => $endDate,
        ];
        return $this->_client->UpdateDiscountValueByProductSellerCode($this->_parameters);
    }

    /**
     * @param int $productId
     * @param float $price
     * @param int $currencyType
     * @param string|null $sellerStockCode
     * @param float|null $optionPrice
     * @return object
     * @description Bir ürünün N11 ürün ID si kullanılarak ürünün sadece baz fiyat bilgilerini,
     * ürün stok birimi fiyat bilgilerini veya her ikisinin güncellenmesi için kullanılır.
     */
    public function updateProductPriceById(int $productId, float $price, $currencyType = self::TL, string $sellerStockCode = null, float $optionPrice = null): object
    {
        $this->_parameters["productId"] = $productId;
        $this->_parameters["price"] = $price;
        $this->_parameters["currencyType"] = $currencyType;
        $this->_parameters["product"] = [
            "stockItems" => [
                "stockItem" => [
                    "sellerStockCode" => $sellerStockCode,
                    "optionPrice" => $optionPrice,
                ]
            ]
        ];
        return $this->_client->UpdateProductPriceById($this->_parameters);
    }

    /**
     * @param string $productSellerCode
     * @param float $price
     * @param int $currencyType
     * @param string|null $sellerStockCode
     * @param float|null $optionPrice
     * @return object
     * @description Bir ürünün N11 ürün ID si kullanılarak ürünün sadece baz fiyat bilgilerini,
     * ürün stok birimi fiyat bilgilerini veya her ikisinin güncellenmesi için kullanılır.
     */
    public function updateProductPriceBySellerCode(string $productSellerCode, float $price, $currencyType = self::TL, string $sellerStockCode = null, float $optionPrice = null): object
    {
        $this->_parameters["productSellerCode"] = $productSellerCode;
        $this->_parameters["price"] = $price;
        $this->_parameters["currencyType"] = $currencyType;
        $this->_parameters["product"] = [
            "stockItems" => [
                "stockItem" => [
                    "sellerStockCode" => $sellerStockCode,
                    "optionPrice" => $optionPrice,
                ]
            ]
        ];
        return $this->_client->UpdateProductPriceBySellerCode($this->_parameters);
    }

}
