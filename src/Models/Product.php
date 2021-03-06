<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\ProductInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Product extends Service implements ProductInterface
{
    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * City constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint(self::END_POINT);
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
    public function getProductList(int $currentPage = 1, int $pageSize = self::GENERAL_LIMIT): object
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
    public function searchProducts(int $currentPage = 1, int $pageSize = self::GENERAL_LIMIT, string $keyword = null, $saleStartDate = null, $saleEndDate = null, $approvalStatus = self::ACTIVE): object
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

    /**
     * @param array $data
     * @return object
     * @description Kayıtlı olan bir ürünün, N11 ürün ID’si ya da mağaza kodu ile ürün fiyatını, ürün üzerindeki indirimi ve isteğe bağlı olarak stok ID’si ya da mağaza stok kodu ile belirtilen stoklarının, miktarı ve ilgili stok biriminin liste fiyatının güncellenmesi için kullanılır.
     */
    public function updateProductBasic(array $data): object
    {
        $this->_parameters["productId"] = $data["productId"];
        $this->_parameters["productSellerCode"] = $data["productSellerCode"];
        $this->_parameters["price"] = $data["price"];
        $this->_parameters["description"] = $data["description"];
        $this->_parameters["images"] = [
            "image" => $data["images"]
        ];
        $this->_parameters["productDiscount"] = [
            "discountType" => $data["discountType"],
            "discountValue" => $data["discountValue"],
            "discountStartDate" => $data["startDate"],
            "discountEndDate" => $data["discountEndDate"],
            "discountStockCode" => $data["discountStockCode"],
            "optionPrice" => $data["optionPrice"],
            "quantity" => $data["quantity"],
        ];
        $this->_parameters["stockItems"] = [
            "stockItem" => $data["stockItems"]
        ];
        return $this->_client->UpdateProductBasic($this->_parameters);
    }

    /**
     * @param int $productId
     * @param string $buyerEmail
     * @param string $subject
     * @param $status
     * @param string $questionDate
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     * @description Müşterileriniz tarafından mağazanıza sorulan soruları listeler.
     * Sorularınızı listelemek için Appkey ve Appsecret bilgileriniz gerekmektedir.
     */
    public function getProductQuestionList(int $productId, string $buyerEmail, string $subject, $status, string $questionDate, int $currentPage = 1, int $pageSize = self::GENERAL_LIMIT): object {
        $this->_parameters["currentPage"] = $currentPage;
        $this->_parameters["pageSize"] = $pageSize;
        $this->_parameters["productQuestionSearch"] = [
            "productId" => $productId,
            "buyerEmail" => $buyerEmail,
            "subject" => $subject,
            "status" => $status,
            "questionDate" => $questionDate,
        ];
        return $this->_client->GetProductQuestionList($this->_parameters);
    }

    /**
     * @param int $productQuestionId
     * @return object
     * @description GetProductQuestionList ile sıralanan soruların içeriğini, buradan gelen ID ve getProductQuestionDetail yardımıyla görüntüleyebilirsiniz.
     */
    public function getProductQuestionDetail(int $productQuestionId): object {
        $this->_parameters["productQuestionId"] = $productQuestionId;
        return $this->_client->GetProductQuestionDetail($this->_parameters);
    }

    /**
     * @param int $productQuestionId
     * @param string $productAnswer
     * @return object
     * @description Müşterilerden gelen ürün sorularını cevaplamak için kullanılır.
     * Cevap vermek için productQuestionId değeri zorunludur ve GetProductQuestionList‘ten id edinilebilir.
     */
    public function saveProductAnswer(int $productQuestionId, string $productAnswer): object {
        $this->_parameters["productQuestionId"] = $productQuestionId;
        $this->_parameters["productAnswer"] = $productAnswer;
        return $this->_client->SaveProductAnswer($this->_parameters);
    }

    /**
     * @return object
     * @description Seller ın sahip olduğu tüm ürünleri, ait olduğu statülere göre sınıflandırıp, statü/sayı bilgisi döner.
     * Seller a göre cevap döndüğü için istekte sadece authorization olması yeterlidir.
     * Her bir seller maksimum 3 kez istek gönderebilir.
     */
    public function productAllStatusCountsRequest(): object {
        return $this->_client->ProductAllStatusCountsRequest($this->_parameters);
    }

}
