<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ProductInterface
{
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
}
