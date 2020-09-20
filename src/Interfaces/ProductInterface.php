<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ProductInterface
{
    /**
     * @var string
     */
    public const END_POINT = "ProductService.wsdl";
    /**
     * @var string
     */
    public const ACTIVE = "Active";
    /**
     * @var string
     */
    public const SUSPENDED = "Suspended";
    /**
     * @var string
     */
    public const PROHIBITED = "Prohibited";
    /**
     * @var string
     */
    public const UNLISTED = "Unlisted";
    /**
     * @var string
     */
    public const WAITING_FOR_APPROVAL = "WaitingForApproval";
    /**
     * @var string
     */
    public const REJECTED = "Rejected";
    /**
     * @var string
     */
    public const UNAPPROVED_UPDATE = "UnapprovedUpdate";

    /**
     * @var int
     */
    public const DISCOUNT_AMOUNT = 1;
    /**
     * @var int
     */
    public const DISCOUNT_PERCENT = 2;
    /**
     * @var int
     */
    public const DISCOUNTED_PRICE = 3;

    /**
     * @var int
     */
    public const TL = 1;
    /**
     * @var int
     */
    public const USD = 2;
    /**
     * @var int
     */
    public const EURO = 3;

    /**
     * @param int $productId
     * @return object
     * @description N11 ürün ID sini kullanarak sistemde kayıtlı olan ürünün bilgilerini getirir.
     */
    public function getProductByProductId(int $productId): object;

    /**
     * @param string $productSellerCode
     * @return object
     * @description Mağaza ürün kodunu kullanarak sistemde kayıtlı olan ürünün bilgilerini getirir.
     */
    public function getProductBySellerCode(string $productSellerCode): object;

    /**
     * @param int $currentPage
     * @param int $pageSize
     * @return object
     */
    public function getProductList(int $currentPage = 1, int $pageSize = 100): object;

    /**
     * @param array $data
     * @return object
     * @description Yeni ürün oluşturmak veya mevcut ürünü güncellemek için kullanılır.
     * Ürün kodu “productSellerCode” adıyla veirlen data bu mağaza için bir kayıtlı bir ürünü gösteriyorsa bu ürün güncellenir, aksi halde yeni bir ürün oluşturulur.
     */
    public function saveProduct(array $data): object;

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
    public function searchProducts(int $currentPage = 1, int $pageSize = 100, string $keyword = null, $saleStartDate = null, $saleEndDate = null, $approvalStatus = self::ACTIVE): object;

    /**
     * @param int $productId
     * @return object
     * @description Kayıtlı olan bir ürünü N11 Id si kullanarak silmek için kullanılır.
     */
    public function deleteProductById(int $productId): object;

    /**
     * @param string $productSellerCode
     * @return object
     * @description Kayıtlı olan bir ürünü mağaza ürün kodu kullanılarak silmek için kullanılır.
     */
    public function deleteProductBySellerCode(string $productSellerCode): object;

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
    public function updateDiscountValueByProductId(int $productId, int $discountType = self::DISCOUNT_AMOUNT, float $discountValue = 0, string $startDate = null, string $endDate = null): object;

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
    public function updateDiscountValueByProductSellerCode(string $productSellerCode, int $discountType = self::DISCOUNT_AMOUNT, float $discountValue = 0, string $startDate = null, string $endDate = null): object;

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
    public function updateProductPriceById(int $productId, float $price, $currencyType = self::TL, string $sellerStockCode = null, float $optionPrice = null): object;

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
    public function updateProductPriceBySellerCode(string $productSellerCode, float $price, $currencyType = self::TL, string $sellerStockCode = null, float $optionPrice = null): object;

    /**
     * @param array $data
     * @return object
     * @description Kayıtlı olan bir ürünün, N11 ürün ID’si ya da mağaza kodu ile ürün fiyatını, ürün üzerindeki indirimi ve isteğe bağlı olarak stok ID’si ya da mağaza stok kodu ile belirtilen stoklarının, miktarı ve ilgili stok biriminin liste fiyatının güncellenmesi için kullanılır.
     */
    public function updateProductBasic(array $data): object;

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
    public function getProductQuestionList(int $productId, string $buyerEmail, string $subject, $status, string $questionDate, int $currentPage = 1, int $pageSize = self::GENERAL_LIMIT): object;

    /**
     * @param int $productQuestionId
     * @return object
     * @description GetProductQuestionList ile sıralanan soruların içeriğini, buradan gelen ID ve getProductQuestionDetail yardımıyla görüntüleyebilirsiniz.
     */
    public function getProductQuestionDetail(int $productQuestionId): object;

    /**
     * @param int $productQuestionId
     * @param string $productAnswer
     * @return object
     * @description Müşterilerden gelen ürün sorularını cevaplamak için kullanılır.
     * Cevap vermek için productQuestionId değeri zorunludur ve GetProductQuestionList‘ten id edinilebilir.
     */
    public function saveProductAnswer(int $productQuestionId, string $productAnswer): object;

    /**
     * @return object
     * @description Seller ın sahip olduğu tüm ürünleri, ait olduğu statülere göre sınıflandırıp, statü/sayı bilgisi döner.
     * Seller a göre cevap döndüğü için istekte sadece authorization olması yeterlidir.
     * Her bir seller maksimum 3 kez istek gönderebilir.
     */
    public function productAllStatusCountsRequest(): object;
}
