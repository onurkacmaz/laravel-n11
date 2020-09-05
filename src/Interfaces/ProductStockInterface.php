<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ProductStockInterface
{
    /**
     * @param int $productId
     * @return mixed
     * @description Sistemde kayıtlı olan ürünün N11 ürün ID si ile ürün stok bilgilerini getiren metottur.
     * Cevap içinde stok durumunun “version” bilgisi de vardır, ürün stoklarında değişme olduysa bu versiyon bilgisi artacaktır,
     * Çağrı yapan taraf versiyon bilgisini kontrol ederek N11 e verilen stok bilgilerinde değişim olup olmadığını anlayabilir.
     */
    public function getProductStockByProductId(int $productId);

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Sistemde kayıtlı olan ürünün N11 ürün ID si ile ürün stok bilgilerini getiren metottur.
     * Cevap içinde stok durumunun “version” bilgisi de vardır, ürün stoklarında değişme olduysa bu versiyon bilgisi artacaktır,
     * Çağrı yapan taraf versiyon bilgisini kontrol ederek N11 e verilen stok bilgilerinde değişim olup olmadığını anlayabilir.
     */
    public function getProductStockBySellerCode(string $productSellerCode);

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
    public function updateStockByStockAttributes(int $productId, string $attrName, string $attrValue, int $quantity, int $version = 0);

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
    public function updateStockByStockId(int $stockItemId, int $quantity, int $version = 0);

    /**
     * @param string $stockSellerCode
     * @param int $quantity
     * @param int $version
     * @return mixed
     * @description Mağaza ürün stok kodu kullanarak kayıtlı ürünün stok bilgilerini güncellemek için kullanılır.
     * Mağaza ürün stok kodu ve miktar bilgileri girilerek güncelleme işlemi yapılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function updateStockByStockSellerCode(string $stockSellerCode, int $quantity, int $version = 0);

    /**
     * @param string $attrName
     * @param string $attrValue
     * @param int $quantityToIncrease
     * @param int $version
     * @return mixed
     * @description Bir ürünün stok seçenek bilgilerini kullanarak stok miktarını arttırmak için kullanılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockAttributes(string $attrName, string $attrValue, int $quantityToIncrease, int $version = 0);

    /**
     * @param int $stockItemId
     * @param int $quantityToIncrease
     * @return mixed
     * @description Bir ürünün n11 ürün stok ID bilgisini kullanarak stok miktarını arttırmak için kullanılır.
     * Bir ürüne ait n11 ürün stok ID sine, ProductStockService içindeki GetProductStockByProductId veya GetProductStockBySellerCode metotları ile ulaşılabilir.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockId(int $stockItemId, int $quantityToIncrease);

    /**
     * @param string $sellerStockCode
     * @param int $quantityToIncrease
     * @return mixed
     * @description Bir ürünün mağaza stok kodu kullanarak stok miktarını arttırmak için kullanılır.
     * N11 tarafında değişen stok miktarlarını ezmemek için, “version” bilgisi verilmesi durumunda ilgili ürün stok bilgisinin N11 de versiyonu ile karşılaştırma yapılır, stok versiyon numaraları uyumsuz ise işlem gerçekleştirilmez.
     */
    public function increaseStockByStockSellerCode(string $sellerStockCode, int $quantityToIncrease);
}
