<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ProductSellingInterface
{
    /**
     * @param int $productId
     * @return mixed
     * @description Satışta olmayan bir ürünün N11 ürün ID si kullanılarak satışa başlanması için kullanılır.
     */
    public function startSellingProductByProductId(int $productId): object;

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Satışta olmayan bir ürünün mağaza ürün kodu kullanılarak satışa başlanması için kullanılır.
     */
    public function startSellingProductBySellerCode(string $productSellerCode): object;

    /**
     * @param int $productId
     * @return mixed
     * @description Satışta olan ürünün n11 ürün ID si kullanılarak satışa kapatılması için kullanılır.
     */
    public function stopSellingProductByProductId(int $productId): object;

    /**
     * @param string $productSellerCode
     * @return mixed
     * @description Satışta olan ürünün mağaza ürün kodu kullanılarak satışının durdurulması için kullanılır.
     */
    public function stopSellingProductBySellerCode(string $productSellerCode): object;
}
